
<?php $children =$this->getChildren();

foreach ($children as $child) {

	$child->toHtml();
}