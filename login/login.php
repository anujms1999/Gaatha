<?php
 session_start();
 if(!(isset($_POST['email']) and isset($_POST['psw'])))
 {
    header('Location: login.html');
 }
 $email = $_POST["email"];
 $psw = md5($_POST["psw"]);

  require_once 'connection.php';

  $flag=0;
  $sql="select email,hashpass,active from users where active=1";
  $result=$conn->query($sql);
   if($conn->query($sql)===FALSE)
	 die($conn->error);
   if($result->num_rows>0)
   {
     while($row=mysqli_fetch_assoc($result))
      {

	     if($row["email"]=== $email and $row["hashpass"]===$psw)
	    {
      $flag=1;
      $_SESSION['name']=$row['email'];
		   $_SESSION["email"]=$email;
           $_SESSION["psw"]=$psw;
		   $_SESSION["active"]=$row["active"];
		   header('Location: select_canteen.php');

	     }

      }

   }
  if($flag===0)
	 header('Location:login.html');
  $conn->close();


?>
