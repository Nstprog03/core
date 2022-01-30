
<?php
echo "<pre>";
$arr_var=[
	'name'=>'Nishith',
	'number'=>'9409718566',
	'email'=>'nishithparmar03@gmail.com'
];

echo "For Each Loop";
foreach ($arr_var as $key => $value) {
	echo $key."->".$value."<br>";
}
$num=0;
while($num<=10)
{
	echo $num;
	$num++;
}

$sum=0;
do{
	$sum+=$num;
	$num++;
}while($sum<=30);
echo "<br>Sum=".$sum;

for ($i=0; $i <=50; $i++) { 
	echo "<br>i like for loop for".$i;
}
?>