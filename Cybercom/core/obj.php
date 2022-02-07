<?php
class box
{
protected $itam =null;
public function setItem($item)
{
	$this->item=$item;
	return $this;
}
public function getItem()
{
	
	return $this->item;
}

}
class user extends box{

}

$user = new user();
$user->setItem('phone');


$box = new box();
$box->setItem('mobile');
echo $user->getItem();

?>