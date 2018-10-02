<?php
        include ("db.php");
        require ("simple_html_dom.php");       
        $cate_num = array(1,3,5,10,15,12);
        $cate_id  = array("HH","XL","TV","PTV","HHP","NDT");       
        // Lấy thông tin các gói thầu
        foreach ($cate_num as $key => $num) { // Lấy dũ liệu về phân tích
          $title = array();  
          $link = array();     
          $bidder = array();  
          $cate = $cate_id[$key];
          $curl = curl_init();
          curl_setopt($curl, CURLOPT_HEADER, 0);
          curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
          mysqli_query($conn,"SET character_set_results=utf8");
          mb_language('uni');
          mb_internal_encoding('UTF-8');       
          mysqli_query($conn,"set names 'utf8'");
          $conn->set_charset("utft");     
          curl_setopt($curl, CURLOPT_URL, "http://muasamcong.mpi.gov.vn:8082/NC/ebid_table2.jsp?bidType=$num");
          $goithau=curl_exec($curl);
          $dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
          $goithau=$dom->load($goithau, true, true); // trả về dữ liệu
 
                    foreach ( $content = $goithau->find("td a")  as  $value) {  // Lấy thông tin title and link
                        if (substr( $value->attr['onclick'],0,13)=='goAspTuchLive')
                             {// Lấy dữ liệu ID_NO với goAspTuchLive
                              $id_no = substr( $value->attr['onclick'],30,2);         
                              $bid_no =substr( $value ->attr['onclick'], 15 ,11);           
                             }
                        else {// Lấy dữ liệu ID_NO với goAspTuch
                           $id_no = substr( $value->attr['onclick'],26,2);     
                           $bid_no =substr( $value ->attr['onclick'], 11 ,11);             
                             }   
                           $link_temp  ="http://muasamcong.mpi.gov.vn:8081/GG/EP_MPV_GGQ999.jsp?bid_no=".$bid_no."&&bid_turnno=$id_no&bid_type=$num"; 
                         array_push($link, $link_temp) ;   
                         // Tên gói thầu
                          $title_temp = $value->innertext;                            
                          array_push($title, $title_temp);      
              }//endforeach
                       // Tìm thông tin bên mời thầu
                       foreach ( $content = $goithau->find("tr")  as  $value) { 
                        $bidder_temp =  $value->children(2)->innertext();                
                        array_push($bidder, $bidder_temp) ;  
                       
              }
                   // Xóa phần tử thừa trong mảng người mời thầu 
                        array_shift($bidder);               
                         // Thêm dữ liệu               
                           for ( $i= 0; $i < count($title) ; $i++ ) {
                            $date =date('d/m/Y H:i:s');
                          
                           mysqli_query($conn,"SET character_set_client=utf8");
                           mysqli_query($conn,"SET character_set_connection=utf8" ); 
                           $tengoithau = trim(stripslashes($title[$i]));
                           $lienket = $link[$i];
                           $benmoithau = trim(stripslashes($bidder[$i]));      
                           $kiemtratrung = mysqli_query($conn,"Select * from packages where  link ='$lienket'");
                           $dem = mysqli_num_rows($kiemtratrung);             
                           if ($dem < 1)   {                             
                              $rs = mysqli_query($conn,"insert into packages VALUES ('','$tengoithau','$lienket','$benmoithau','$cate',NULL, UNIX_TIMESTAMP('$date'),UNIX_TIMESTAMP('$date'))");                
                              if (!$rs)   echo("Error description: " . mysqli_error($conn));                                        
             } 
      
        }
        
      }

 ?>
