<?php $messages = $this->getMessages();
	

if($messages)
{
    foreach ($messages as $type => $message)
    {
        echo($type." : ".$message);
    }   
}   
?>