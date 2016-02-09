<?php
require_once 'lib/vendor/me/sender.php';
$test = new Cash_Sender();
$test->type = 'post';
$test->params = array(
'branch_key' => 'e147ee31531d815e2308d6d6d39929ab599deb98', 
'user_key' => 'f541b3f11f0f9b3fb33499684f22f6d711f2af58', 
'order_id' => 'tienda_pedro_001',
'product' => 'camara fotografica de 15 mega pixeles',
'amount' => '10.00', 
'store_code' => 'OXXO', 
'customer' => 'Rodolfo Solorzano', 
'email' => 'rodo@pagofacil.net'
);
$test->send();
echo $test->getResult();
?>