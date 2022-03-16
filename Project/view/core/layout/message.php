<?php $messages = $this->getMessages();
	

if($messages)
{
	foreach ($messages as $type => $message)
	 {
	 	if($type == "Success")
	 	{
	 		echo "<b style=color:green;>".$message."</b>";	
	 	}
		if($type == "Warning")
	 	{
	 		echo "<b style=color:yellow;>".$message."</b>";	
	 	}
		if($type == "Error")
	 	{
	 		echo "<b style=color:red;>".$message."</b>";	
	 	}
		
	}
}