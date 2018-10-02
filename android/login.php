<?php
	
      include ("../config/connect.php");
	if (isset( $_POST['email']) && isset ( $_POST['password'])) {
		$email = $_POST['email'];
		$password =$_POST['password'];
		
		if ( $email != '' && $password != ''){
				
				//echo $email;
				//echo $password;	
		
		$qr = ("select * from users where email ='$email'");
		mb_language('uni');
          mb_internal_encoding('UTF-8');       
          mysqli_query($conn,"set names 'utf8'");
         $conn->set_charset("utft");
		$users = mysqli_query($conn,$qr);
		$user = mysqli_fetch_array($users);
		$mk = $user['password'];
		$ten = $user['name'];
		$mail = $user['email'];
		$id = $user['id'];
		 $response['result'] = "failed";	
		if (password_verify($password,$mk)){	
		    
			$response['result'] = "ok";
			$user = mysqli_fetch_array($users);			
			$response['id'] = $id;
			$response['name'] = $ten;
			$response['email'] = $mail;
           
     
		}  
		 echo  json_encode($response);
	}

         

}

?>