<?php
	echo "<pre>";

	class fruit{}
	class_alias('fruit','boom');//create alias of main class
	
	$a = new fruit();
	$b = new boom();
	
	var_dump($a instanceof fruit);
	var_dump($b instanceof fruit);


	var_dump(class_exists('fruit'));//return true if classs exists
	var_dump(class_exists('robot'));

	class call{
		function called(){
		var_dump(get_called_class());//return name of class
		} 
	}
	$a = new call();
	$a::called();

	class cricket{
		public $player_name;
		public $player_run = "164";

		function player_name(){
			return;
		}

		function player_run(){
			return;
		}
	}

	$class_methods = get_class_methods('cricket');//return all method name of given class

	foreach ($class_methods as $method_name) {
    	echo "$method_name\n";
	}

//5.get_class_vars
	$var_name = new cricket();
	$class_variable = get_class_vars(get_class($var_name));//return name of variable and value

	foreach ($class_variable as $variable_name => $variable_value) {
		echo "$variable_name:$variable_value\n";
	}

//6.get_class
	$var = new cricket();
	var_dump(get_class($var));//return class name which object take references

//7.get_declared_classes
	print_r(get_declared_classes());//return name of all declare classes in given script as array formate

//8.get_declared_interfaces
	print_r(get_declared_interfaces());//return name of interfaces in array formate

//9.get_declared_traits
	trait Food{}
	print_r(get_declared_traits());//return name of traits in current script

//10.get_mangled_object_vars
	$rohit = new cricket();
	var_dump(get_mangled_object_vars($rohit));//return all peopertice of class

//11.get_object_vars
	var_dump(get_object_vars($rohit));//return all non-static propertice of array

//12.get_parent_class
	class hotel extends cricket{
		function __construct(){
			echo get_parent_class('hotel');
		}
	}
	$tajmahal = new hotel();//return parent class name of current class object
	echo "<br>";

//13.interface_exists
	interface car{}
	var_dump(interface_exists('car'));//return true if 'car' interface is exists when ever return false
	var_dump(interface_exists('food'));

//14.is_a
	var_dump(is_a($rohit, 'cricket'));//return true if object is refer given class
	var_dump(is_a($rohit, 'food'));

//15.is_subclass_of
	var_dump(is_subclass_of($tajmahal, 'cricket'));//return true if it's subclass is cricket else return false
	var_dump(is_subclass_of($rohit, 'cricket'));
	var_dump(is_subclass_of('hotel','cricket'));

//16.method_exists
	var_dump(method_exists($rohit, 'player_name'));//return true if method is exists in class

//17.property_exists
	var_dump(property_exists('cricket', 'player_name'));//return true if property is exists else return false
	var_dump(property_exists('cricket','player'));

//18.trait_exists
	var_dump(trait_exists('food'));//return true if trait is exists else return false
	var_dump(trait_exists('cricket'));

//19.enum_exists
	var_dump(enum_exists(user::class));//only sport in PHP8.1

?>