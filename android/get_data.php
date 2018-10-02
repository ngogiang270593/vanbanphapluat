<?php
	 include ("../config/connect.php");;
	mb_language('uni');
    mb_internal_encoding('UTF-8');       
    mysqli_query($conn,"set names 'utf8'");
    $conn->set_charset("utft");

// Lấy danh sách tất cả gói thầu 

	if (isset($_POST['get_all']) ) {

		$response = array();
		
		$query = "Select * from packages where hided is null order by id DESC";		
		$rs = mysqli_query($conn,$query);
		$myArray = array();
		while ($row = $rs->fetch_array(MYSQLI_ASSOC)) {
			$myArray[] = $row;
		}	   
	    if ($rs) {
	    	$response['data'] = $myArray;
	    	$response['result'] = "Thêm thành công";
	    }
	    else 
	    	$response['result'] = "Thất bại";
	    echo json_encode($response);


}


	if (isset($_POST['get_by_id']) &&  isset($_POST['id']) ) {

		$response = array();
		$id = $_POST['id'];		
        $myArray = array();
		$tukhoa = mysqli_query($conn,"Select * from keywords where user_id ='$id'");
		while ($mottukhoa = $tukhoa->fetch_array(MYSQLI_ASSOC)) {
			$mottu = $mottukhoa['keyword'];
			$goithau = mysqli_query($conn,"Select * from packages where (title like '%$mottu%' or bidder like '%mottu%') and hided is null order by id DESC ");
			while ($motgoithau = $goithau->fetch_array(MYSQLI_ASSOC)) {
				    $myArray[] = $motgoithau;
			}
		}
		
		
		$response['data'] = $myArray;   	    
	 
	    echo json_encode($response);


}



?>