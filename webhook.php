<?php
$archivo = fopen('payment_status.txt', 'a');
$data = time('u').'----------------------------------------'."\n";
$data.= print_r($_REQUEST, true);
$data.= '--------------------------------------------------'."\n";
fwrite($archivo, $data);
fclose($archivo);
?>
