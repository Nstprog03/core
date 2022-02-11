<?php

$data = [

	['category'=>1,'attribute'=>1,'option'=>1],
	['category'=>1,'attribute'=>1,'option'=>2],
	['category'=>1,'attribute'=>2,'option'=>3],
	['category'=>1,'attribute'=>2,'option'=>4],
	['category'=>2,'attribute'=>3,'option'=>5],
	['category'=>2,'attribute'=>3,'option'=>6],
	['category'=>2,'attribute'=>4,'option'=>7],
	['category'=>2,'attribute'=>4,'option'=>8]
];

echo "<pre>";
echo "Array 1<br>";

$i = 0;
while($i<count($data)){
	
	$result[$data[$i]['category']][$data[$i]['attribute']][$data[$i]['option']]=$data[$i]['option'];
	$i++;
}

print_r($result);
echo "________________________________________________<br>";

$final = [];
foreach ($result as $categoryId => $level1) 
{
	$row['category'] = $categoryId;
	foreach ($level1 as $attributeId => $level2) 
	{
		$row['attribute'] = $attributeId;
		foreach ($level2 as $optionId => $level3) 
		{	
			$row['option'] = $optionId;
			array_push($final, $row);
		}
	}	
}
print_r($final);

?>