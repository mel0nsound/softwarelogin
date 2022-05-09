<?php 

$host="localhost";
$user="s62042380106";
$password="pw62042380106@URU";
$db="dbs62042380106";

session_start();


$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
	die("errors");
}


if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$username=$_POST["username"];
	$password=$_POST["password"];


	$sql="select * from users where username='".$username."' AND password='".$password."' ";

	$result=mysqli_query($data,$sql);

	$row=mysqli_fetch_array($result);

	if($row["username"]== NULL)
	{	
		$_SESSION["username"]=$username;
		header("location:main.php");
	}
	elseif($row["Userlevel"]=="M")
	{
		$_SESSION["username"]=$username;
		header("location:index.php");
	}
	elseif($row["Userlevel"]=="A")
	{
		$_SESSION["username"]=$username;
		header("location:index0.php");
	}


}

?>
