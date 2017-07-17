<html><body>
<?php
function xmp_print_r($arr) { echo '<xmp>'; print_r($arr); echo '</xmp>'; }
$conn = pg_connect('host=heart5.kaist.ac.kr dbname=codatest_mjkwon port=5432 user=bisler password=bislaprom3 connect_timeout=5') or die('Could not connect: '.pg_last_error());
$res = pg_query("SELECT CURRENT_TIMESTAMP");
$arr = pg_fetch_all($res);
xmp_print_r($arr);
?>
</body>
</html>