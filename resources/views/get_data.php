    <meta charset="utf-8">
    <?php
            require ($_SERVER['DOCUMENT_ROOT']."/lv/path.php");
            require ($main_URL."/libs/simple_html_dom.php");
            require ($main_URL."/config/db.php");
            mysqli_query($conn,"SET character_set_results=utf8");
            mb_language('uni');
            mb_internal_encoding('UTF-8');       
            mysqli_query($conn,"set names 'utf8'");
            $conn->set_charset("utft");
            $ti[]="";             
           $url = file_get_html ("http://vbpl.vn/pages/vanbanmoi.aspx");
            
                 echo $url;
                
                   $title = array();   // Mảng tên gói thầu
                   $link = array();     // mảng địa chỉ thông tin chi tiết gói thầu
                    // mảng thông tin bên mời thầu
                   

             // Lấy dữ liệu hàng hóa
             foreach ($content = $url->find("div.content-news ul li a") as $value) {

    $title_temp=$value -> find("text",0);

  $title_temp ->innertext;


 $h=$value->href;

 $link_temp  ="http://vbpl.vn".$h;
 array_push($title, $title_temp);
 array_push($link, $link_temp);
           // Thêm dữ liệu 
                 for ( $i= 0; $i < count($title) ; $i++ ) {

                 mysqli_query($conn,"SET character_set_client=utf8");
                 mysqli_query($conn,"SET character_set_connection=utf8" );             
                 $rs = mysqli_query($conn,"insert into vanbanphapluat VALUES ('$title[$i]','$link[$i]'");     
                              
            }

      



         
    ?>
