<?php
header("Content-Type:application/json");
  
// 1. 데이터베이스에서 데이터를 가져옴
$conn = pg_connect('host=heart5.kaist.ac.kr dbname=codatest_mjkwon port=5432 user=bisler password=bislaprom3 connect_timeout=5') or die('Could not connect: '.pg_last_error());

$result = pg_query($conn, "SELECT * FROM gene where symbol= 'TP53' and ncbitaxid = '9606'"); 
    // 2. 데이터베이스로부터 반환된 데이터를
    // 객체 형태로 가공함
if (!$result){
    echo "An error occurred.\n";
    exit;
}

$data = array();
while ($row = pg_fetch_row($result)) {
    
    $data[] = array('geneid'=> $row[0],'entrezid'=> $row[1],'a_ensemblid'=> $row[2],'a_biogridid'=> $row[3],'a_pharmgkbid'=> $row[4],'symbol'=> $row[5],
                    'a_synonym'=> $row[6],'ncbitaxid'=> $row[7],'a_uniprotid'=> $row[8],'a_ecnumber'=> $row[9],'a_goid'=> $row[10]);
}

echo json_encode($data);
