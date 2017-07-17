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

$data = array();
while ($row = pg_fetch_row($result)) {
    
    $data[] = $row;
}

if(isset($data))
{
    header('Content-Type: application/json');
    echo json_encode($data);
}
  
