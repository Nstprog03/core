<?php

$con = mysqli_connect('localhost','root','','practice1');

if($con)

{
	echo "Connection Success<br>";
	$id=1;
	$uname="NishithP";
	$email="mishithparmar@gmail.com";
	$mobile="+919409718577";
	$pwd="03102000";
	$query="insert into users value('".$uname."','".$email."','".$mobile."','".$pwd."')";
	//$query="insert into users values(1,'NishithP_03','nishithparmar03@gmail.com','+919409718566','03102000n');";
	if($result=mysqli_query($con,$query))
	{
		echo "Query run Successfuly<br>";
	}
	else
	{
		echo mysqli_error($con);
	}
	$query="Select * from users where usename like 'Nishith%'";
	if ($result = mysqli_query($con, $query))
	 {
	 	while ($row = mysqli_fetch_row($result))
	 	{
    		echo"<br>";
    		print_r($row);

  		}
	}
	else
	{
		echo mysqli_error($con);
	}

	echo"<br><br>Before Update<br>";
	$query="Select * from users";
	if ($result = mysqli_query($con, $query))
	 {
	 	while ($row = mysqli_fetch_row($result))
	 	{
    		echo"<br>";
    		print_r($row);

  		}
	}
	else
	{
		echo mysqli_error($con);
	}
	$query="update users set mobile_num='+918320300508' where mobile_num='+919409718566'";
	
	if ($result = mysqli_query($con, $query))
	{
	 	echo"<br><br> After Update";
	 	$query="Select * from users";
		if ($result = mysqli_query($con, $query))
	 	{
	 		while ($row = mysqli_fetch_row($result))
	 		{
    			echo"<br>";
    			print_r($row);
    		}
		}
		else
		{
			echo mysqli_error($con);
		}
		echo"<br><br>Before Delete<br>";
	$query="Select * from users";
	if ($result = mysqli_query($con, $query))
	 {
	 	while ($row = mysqli_fetch_row($result))
	 	{
    		echo"<br>";
    		print_r($row);

  		}
	}
	else
	{
		echo mysqli_error($con);
	}
	$query="delete from users where mobile_num='+918320300508'";
	
	if ($result = mysqli_query($con, $query))
	{
	 	echo"<br><br> After Delete";
	 	$query="Select * from users";
		if ($result = mysqli_query($con, $query))
	 	{
	 		while ($row = mysqli_fetch_row($result))
	 		{
    			echo"<br>";
    			print_r($row);
    		}
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
		echo mysqli_error($con);
	}

}
}
else
{
	echo mysqli_error($con);
}

?>
