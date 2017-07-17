<?php
header("Content-Type:application/json");
  
// 1. 데이터베이스에서 데이터를 가져옴
$conn = pg_connect('host=heart5.kaist.ac.kr dbname=codatest_mjkwon port=5432 user=bisler password=bislaprom3 connect_timeout=5') or die('Could not connect: '.pg_last_error());

if (!$conn) {
  echo "An error occurred.\n";
  exit;
}

$result = pg_query($conn, "SELECT * FROM gene where symbol= 'TP53' and ncbitaxid = '9606'"); 
    // 2. 데이터베이스로부터 반환된 데이터를
    // 객체 형태로 가공함
if (!$result){
    echo "An error occurred.\n";
    exit;
}

$o = array();
while ($row = pg_fetch_row($result)) {
    $t = new stdClass();
    echo "$row[0]";
    $t->geneid = $row[0]->geneid;
    $t->entrezid = $row[1]->entrezid;
    $t->a_ensemblid = $row[2]->a_ensemblid;
    $t->a_biogridid = $row[3]->a_biogridid;
    $t->a_pharmgkbid = $row[4]->a_pharmgkbid;
    $t->symbol = $row[5]->symbol;
    $t->a_synonym = $row[6]->a_synonym;
    $t->ncbitaxid = $row[7]->ncbitaxid;
    $t->a_uniprotid = $row[8]->a_uniprotid;
    $t->a_ecnumber = $row[9]->a_ecnumber;
    $t->a_goid = $row[10]->a_goid;
    $o[] = $t;
    unset($t);
}
  
// 3, 4 최종 결과 데이터를 JSON 스트링으로 변환 후 출력
echo json_encode($o);