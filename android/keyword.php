<?php
	include ("../config/connect.php");
	mb_language('uni');
    mb_internal_encoding('UTF-8');       
    mysqli_query($conn,"set names 'utf8'");
    $conn->set_charset("utft");

// TIm tu khoa
	if (isset( $_POST['search']) && isset($_POST['key_word']) ) {

		$response = array();
		$date = date('d/m/Y H:i:s');
	
		$keyword = $_POST['key_word'];		
		$response['keyword'] =  $_POST['key_word'];
		$query = "Select * from packages where title like '%$keyword%' or bidder like  '%$keyword%'";
		$myArray = array();
		$rs = mysqli_query($conn,$query);
		while ($row = $rs->fetch_array(MYSQLI_ASSOC)) {
			$myArray[] = $row;
		}
	   
	         echo json_encode($myArray);	
	 
	       
	     

}

// THêm từ khóa

	if (isset( $_POST['add']) && isset($_POST['id']) && isset($_POST['key_word']) ) {

		$response = array();
		$date = date('d/m/Y H:i:s');
		$user_id = $_POST['id'];
		$keyword = $_POST['key_word'];
		$response['id'] = $_POST['id'];
		$response['keyword'] =  $_POST['key_word'];

		$query = "insert into keywords  values ('','$user_id','$keyword','','')";
		$rs = mysqli_query($conn,$query);
	    if ($rs) 
	    	$response['result'] = "Thêm thành công từ khóa '$keyword' ";
	    else 
	    	$response['result'] = "Thất bại";
	    echo json_encode($response);


}

// Xóa từ khóa

	if (isset( $_POST['delete']) && isset($_POST['id'])) {

		$response = array();
		$keyword_id = $_POST['id'];		
		$tentukhoa = mysqli_query($conn,"Select keyword from keywords where id ='$keyword_id'");
		foreach ($tentukhoa as $key => $value) {
			$key = $value['keyword'];
		}
		$query = "delete from keywords  where id ='$keyword_id' ";
		$rs = mysqli_query($conn,$query);
	    if ($rs) 
	    	$response['result'] = "Đã xóa từ khóa '$key'";
	    else 
	    	$response['result'] = "Thất bại";
	    echo json_encode($response);


}

if (isset( $_POST['show']) && isset($_POST['id']) ) {

		$response = array();
		$date = date('d/m/Y H:i:s');
	
		$id = $_POST['id'];		
	
		$query = "Select * from keywords where user_id = '$id' ";
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