<?php
echo "<pre>";
echo "<br>";
$val3=35;
$val1=25;
$val2=50;
if($val1<$val2)
{
	if($val2>$val3)
	{
		echo $val2." is max";
	}
	else
	{
		echo $val3." is max";
	}
}
else
{
	if($val1>$val3)
	{
		echo $val1." is max";
	}
	else
	{
		echo $val3." is max";
	}
}

$num=25;
 if ($num > 20)
  {
 	echo "Statement :" .$num. " is Greater <br>";
 }
 elseif ($num = 10) {
  	echo "This num is : " .$num. "<br>";
  } 
 else {
 	echo "statement is failure:";
 }
 echo("<br>");
?>