
<?php
	include ("../config/connect.php");
	require ("libs/phpEmailer/PHPMailerAutoload.php");
    require ("libs/phpEmailer/class.phpmailer.php");
	require ("libs/phpEmailer/class.phpmaileroauthgoogle.php");
	$result = array();
  
 if (isset($_POST['register'])) {
 	if ($_POST['username']!=null && $_POST['email']!=null && $_POST['pass']!=null)
 	{
 		
 		$name = $_POST['username'];
 		$email = $_POST['email'];
 		$password =  password_hash(($_POST['pass']), PASSWORD_DEFAULT);
 	    $token = bin2hex(random_bytes(22));
 	    $servername = $_SERVER['SERVER_NAME'];
 	    $content = "Bạn đã đăng ký thành công! Vui lòng nhấn vào liên kết để kích hoạt tài khoản </br>"."<a href ='$servername/goithau/android/register_verify.php?tk=$token'>$servername/goithau/android/register_verify.php?tk=$token</a>";
 	    $qr = "insert into users VALUES ('','$name','$email','$password','0','0','$token','','')";

 	    $rs = mysqli_query($conn,$qr); 
 	  
 	    		    	
      

 	     SendMail($email,'Trợ Lý Ảo',$content); 	   
 	     $result['result'] = "Đăng Ký Thành công. Vui lòng kiểm tra Email"; 

 	 } else $result['result'] = "Vui lòng nhập thông tin";	

 	 echo json_encode($result);
	
}


// Hàm gửi email 
function SendMail ($adress,$user_name,$content){
		$mail = new PHPMailer;
		$mail->CharSet = "utf8";
	//	$mail->SMTPDebug = 2;

                              // Enable verbose debug output

		$mail->isSMTP();                                    // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'trolyao.goithau@gmail.com';                 // SMTP username
		$mail->Password = 'trolyao2xX@';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	   // Enable TLS encryption, `ssl` also accepted
		$mail->Port=587;       
		$mail->isHTML(true);                    
		$mail->setFrom('trolyao.goithau@gmail.com',  "Trợ Lý Ảo");
		$mail->addAddress( $adress, $user_name);                   
		$mail->Subject = "Thông Tin Gói Thầu";
		$mail->Body    = $content;
		

		if(!$mail->send()) {
		    echo 'Message could not be sent.';		    
		    
		}//
		// else {
		 //   echo "Gửi thành công ";
		    
		    
		}
	}
?>