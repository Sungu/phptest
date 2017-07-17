<?php
header("Content-Type:application/json");
  
// 1. 데이터베이스에서 데이터를 가져옴
$conn = pg_connect('host=heart5.kaist.ac.kr dbname=codatest_mjkwon port=5432 user=bisler password=bislaprom3 connect_timeout=5') or die('Could not connect: '.pg_last_error());

$entity1 = '6257';
$entity2 = '5468';
$entity3 = '7849';
$entity4 = '6256';

$query1 = "SELECT * FROM gene where entrezid='$entity1';";
$query2 = "SELECT * FROM gene where entrezid='$entity2';";
$query3 = "SELECT * FROM gene where entrezid='$entity3';";
$query4 = "SELECT * FROM gene where entrezid='$entity4';";

// $result = pg_query($conn, "SELECT * FROM gene where symbol= 'TP53'");
$result1 = pg_query($conn, $query1);
$result2 = pg_query($conn, $query2);
$result3 = pg_query($conn, $query3);
$result4 = pg_query($conn, $query4);
// 2. 데이터베이스로부터 반환된 데이터를
// 객체 형태로 가공함

$data1 = array();
while ($row = pg_fetch_row($result1)) {
    
    $data1[] = array('geneid'=> $row[0],'entrezid'=> $row[1],'a_ensemblid'=> $row[2],'a_biogridid'=> $row[3],'a_pharmgkbid'=> $row[4],'symbol'=> $row[5],
                    'a_synonym'=> $row[6],'ncbitaxid'=> $row[7],'a_uniprotid'=> $row[8],'a_ecnumber'=> $row[9],'a_goid'=> $row[10]);
}

$data2 = array();
while ($row = pg_fetch_row($result2)) {
    
    $data2[] = array('geneid'=> $row[0],'entrezid'=> $row[1],'a_ensemblid'=> $row[2],'a_biogridid'=> $row[3],'a_pharmgkbid'=> $row[4],'symbol'=> $row[5],
                    'a_synonym'=> $row[6],'ncbitaxid'=> $row[7],'a_uniprotid'=> $row[8],'a_ecnumber'=> $row[9],'a_goid'=> $row[10]);
}

$data3 = array();
while ($row = pg_fetch_row($result3)) {
    
    $data3[] = array('geneid'=> $row[0],'entrezid'=> $row[1],'a_ensemblid'=> $row[2],'a_biogridid'=> $row[3],'a_pharmgkbid'=> $row[4],'symbol'=> $row[5],
                    'a_synonym'=> $row[6],'ncbitaxid'=> $row[7],'a_uniprotid'=> $row[8],'a_ecnumber'=> $row[9],'a_goid'=> $row[10]);
}

$data4 = array();
while ($row = pg_fetch_row($result4)) {
    
    $data4[] = array('geneid'=> $row[0],'entrezid'=> $row[1],'a_ensemblid'=> $row[2],'a_biogridid'=> $row[3],'a_pharmgkbid'=> $row[4],'symbol'=> $row[5],
                    'a_synonym'=> $row[6],'ncbitaxid'=> $row[7],'a_uniprotid'=> $row[8],'a_ecnumber'=> $row[9],'a_goid'=> $row[10]);
}

$data_all = array($entity1 => $data1 , $entity2 => $data2 , $entity3 => $data3 , $entity4 => $data4);


print_r ($data_all);
// $fp = fopen('dic.json', 'w');
// fwrite($fp, json_encode($data));
// fclose($fp);

