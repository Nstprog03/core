<h4> All Rights Reserved ©WreakdWriter</h4>



<?php 
	$children =$this->getChildren();

	foreach ($children as $child) {

		echo $child->toHtml();
		// code...
	}
