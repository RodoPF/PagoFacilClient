<?php
require_once 'lib/vendor/me/sender.php';
$test = new Cash_Getter();
$test->type = 'post';
$test->params = array(
'branch_key' => 'e147ee31531d815e2308d6d6d39929ab599deb98', 
'user_key' => 'f541b3f11f0f9b3fb33499684f22f6d711f2af58',
'secret_key' => 'c68bd305206c6487a307d9a044138132f26a10845e9245c953d1965c6853fc02',
'date_start' => '2016-01-01 00:00:00',
'date_end' => date('Y-m-d h:n:s'),
'mode' => 'R'
);
$test->send();
echo $test->getResult();
?>