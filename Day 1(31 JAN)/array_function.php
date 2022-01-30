<?php
//1.array_chunk
$array1 = array('a','b','c','d','e');
var_dump(array_chunk($array1, 3));//chunk array for array lenth 3
echo "<br>";
var_dump(array_chunk($array1,3,true));//chunk array for array lenth 3 wtih continuas indexing
//2.array_combine
$car = array("maruti","tata","bugadi");
$prize = array(100000,1000000,14000000);
$car_prize = array_combine($car, $prize);//combine array as array1 is key and array2 is value
echo "<br>";
var_dump($car_prize);
//3.array_diff
$name1 = array("hardi","pandu","sidhu");
$name2 = array("hardi","morin","pandu");
$name = array_diff($name1, $name2);//return this value of array1 wich is not in other array
echo "<br>";
print_r($name); 
//4.array_fill
$fruit = array_fill(4,6,"pear");//fill the given value in the array
echo "<br>";
print_r($fruit);
//5.array_flip
$fruits = array("apple","banana","pear");
$fliped_fruits = array_flip($fruits);//fliped the array 
echo "<br>";
print_r($fruits);
echo "<br>";
print_r($fliped_fruits);
//6.array_intersect
$name1 = array("hardi","pandu","sidhu");
$name2 = array("hardi","morin","pandu");
echo "<br>";
print_r(array_intersect($name1, $name2));//which value are matched this is given as output
//7.array_keys
$name3 = array(1=>"maruti",2=>"tata");
echo "<br>";
print_r(array_keys($name3));//return keys of the array
$fruits = array('apple','banana','apple','pear','apple');
echo "<br>";
print_r(array_keys($fruits,'apple'));//retuen position of second peramiter
//8.array_merge
echo "<br>";
print_r(array_merge($name1,$name2));//merge tow or more array
//9.array_multisort
array_multisort($name1,$name2);//sort multipal array 
echo "<br>";
print_r($name1);
echo "<br>";
print_r($name2);
//10.array_pad
echo "<br>";
print_r(array_pad($name1, 5, "pavar"));//pading the value in the existing array upto given lenght
//11.array_pop
echo "<br>";
print_r(array_pop($name1));//return the last element
echo "<br>";
print_r($name1);//it's means last element is removed
//12.array_push
echo "<br>";
array_push($fruits, 'raspberry');//add given value in the last of array
echo "<br>";
print_r($fruits);
//13.array_rand
$rand = array_rand($fruits,4);//return the random key value of array
echo "<br>";
print_r($rand);
//14.array_replace
$value = array(1,2,3,4,5);
$replace = array(0,3);
echo "<br>";
print_r(array_replace($value, $replace));
//15.array_reverse
echo "<br>";
print_r(array_reverse($value));
//16.array_serch
echo "<br>";
print_r(array_search(5, $value));//return position of element if it's exists
//17.array_shift
$shift = array_shift($value);//remove the fist index value and shift this array one step
echo "<br>";
print_r($shift);//return shift value
echo "<br>";
print_r($value);//return existing array
//18.array_splice
echo "<br>";
print_r(array_splice($fruits, 3));//return 3 element from starting
echo "<br>";
print_r(array_splice($fruits,1,2));//return two element from first index element
//19.array_sum
echo "<br>";
echo array_sum($value);//return sum of all element of integer or float array
//20.sizeof
echo "<br>";
echo sizeof($value);//retuen size of array

?>