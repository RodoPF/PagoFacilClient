<?php
require_once 'lib/vendor/me/sender.php';
$test = new Soap_Sender();
$test->type = 'get';
$test->params = array(
	'nombre'=>'Juan',
	'apellidos'=>'Lopez',
	'numeroTarjeta'=>5579567890123456,
	'cvt'=>123,
	'cp'=>11560,
	'mesExpiracion'=>10,
	'anyoExpiracion'=>16,
	'monto'=>20.00,
	'idSucursal'=>'e147ee31531d815e2308d6d6d39929ab599deb98',
	'idUsuario'=>'f541b3f11f0f9b3fb33499684f22f6d711f2af58',
	'idServicio'=>'3',
	'email'=>'rodo@pagofacil.net',
	'telefono'=>5512345678,
	'celular'=>5587654321,
	'calleyNumero'=>'Anatole France 311',
	'colonia'=>'Polanco',
	'municipio'=>'Miguel Hidalgo',
	'estado'=>'Distrito Federal',
	'pais'=>'Mexico',
	'param1'=>'param1',
	'param2'=>'param2',
	'param3'=>'param3',
	'param4'=>'param4',
	'param5'=>'param5',
	'noMail'=>1
);
$test->send();
echo $test->getResult();
?>