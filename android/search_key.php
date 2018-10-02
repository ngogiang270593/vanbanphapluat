<?php
	include ("../config/connect.php");
	mb_language('uni');
    mb_internal_encoding('UTF-8');       
    mysqli_query($conn,"set names 'utf8'");
    $conn->set_charset("utft");



	if (isset( $_POST['search']) && isset($_POST['key_word']) ) {

		$response = array();
		$date = date('d/m/Y H:i:s');
	
		$keyword = $_POST['key_word'];		
		$response['keyword'] =  $_POST['key_word'];
		$query = "Select * from packages where (title like '%$keyword%' or bidder like  '%$keyword%') and hided is null order by id DESC";
		$myArray = array();
		$rs = mysqli_query($conn,$query);
		while ($row = $rs->fetch_array(MYSQLI_ASSOC)) {
			$myArray[] = $row;
		}
	   
	         echo json_encode($myArray);	
	 
	       
	     

}



// Hiển thị danh sách từ khóa 
  if (isset($_GET['user_id'])){
  	$user_id = $_GET['user_id'];
  	$qr = "Select  * from keywords where user_id = '$user_id'";
  	mb_language('uni');
    mb_internal_encoding('UTF-8');       
    mysqli_query($conn,"set names 'utf8'");
    $conn->set_charset("utft");
  	$rs = mysqli_query($conn,$qr);  
	$tukhoa = mysqli_fetch_array($rs);
	print_r($tukhoa);
  	
  }



?>