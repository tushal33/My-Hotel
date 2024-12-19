 <?php
//Database connection - database already created in mysql
$host="localhost";
$username="root";
$password="";
$dbname="book_your_hotel";

//Create mysqli object
$con = new mysqli($host,$username,$password,$dbname);
//check connection
if($con->connect_error)
{
	die("Connection Failed" . $con->connect_error);
}
else
{
	// echo "Connection Done";
}

?>