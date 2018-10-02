<?php
	include ("../config/connect.php");
	mb_language('uni');
    mb_internal_encoding('UTF-8');       
    mysqli_query($conn,"set names 'utf8'");
    $conn->set_charset("utft");

// THêm từ khóa

	if (isset( $_POST['update']) && isset($_POST['email']) && isset($_POST['name']) && isset($_POST['id']) ) {
		
		$name = $_POST['name'];
		$email = $_POST['email'];
		$id = $_POST['id'];

        if (!isset($_POST['password'])) {
		$response = array();		
		$query = "update users set name ='$name' , email = '$email' where id ='$id' ";
		$rs = mysqli_query($conn,$query);
	    if ($rs) {
	    	$response['name'] = $name;
	    	$response['email'] = $email;
	    	$response['result'] = "Thay đổi thông tin thành công";
	    }
	    else 
	    	$response['result'] = "Thất bại";
	    echo json_encode($response);
} else
{
	$password = password_hash(($_POST['password']), PASSWORD_DEFAULT);
	  $response = array();		
		$query = "update users set name ='$name' , email = '$email', password ='$password' where id ='$id' ";
		$rs = mysqli_query($conn,$query);
	    if ($rs) {
	    	$response['name'] = $name;
	    	$response['email'] = $email;
	    	$response['result'] = "Thay đổi thông tin thành công";
	    }
	    else 
	    	$response['result'] = "Thất bại";
	    echo json_encode($response);
}

} 


?>