<?php 
 
echo "<pre>";
$name ="Nishith";

echo $name;
echo "<br>";
$number_int =15;
$number_int2=$number_int;

echo $number_int;
echo "<br>";
var_dump($name);

print_r($number_int2);
$var_bool=true;

var_dump($var_bool);

$arr_var=[
	'name'=>'Nishith',
	'number'=>'9409718566',
	'email'=>'nishithparmar03@gmail.com'
];
print_r($arr_var);
echo count($arr_var);
 ?>