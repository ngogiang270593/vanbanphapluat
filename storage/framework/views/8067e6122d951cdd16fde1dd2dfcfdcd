<!-- Phần xử lý -->
<?php
    require ("./process/simple_html_dom.php");
    // kết nối CSDL
    require ("./config/connect.php");
    mysqli_query($conn,"SET character_set_results=utf8");
    mb_language('uni');
    mb_internal_encoding('UTF-8');
    mysqli_query($conn,"set names 'utf8'");
    $conn->set_charset("utft");
    $ti[]="";
    $data_key = Array('1','3','5','15','10','12');
    $hanghoa = "";
    $xaylap = "";
    $tuvan = "";
    $phituvan = "";
    $honhop = "";
    $luachonnhadautu = "";
    foreach ($data_key as $key => $value) {
      $url = 'http://muasamcong.mpi.gov.vn:8082/NC/ebid_table2.jsp?bidType='.$value;
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      /*
       * XXX: This is not a "fix" for your problem, this is a work-around.  You
       * should fix your local CAs
       */
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

      /* Set a browser UA so that we aren't told to update */
      curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.116 Safari/537.36');
      $res = curl_exec($ch);
      $dom = new simple_html_dom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
      if($value == 1){
        $goithau= $dom->load($res, true, true);
      } else if($value == 3){
          $xaylap =$dom->load($res, true, true);
      } else if($value == 5 ){
          $tuvan = $dom->load($res, true, true);
      } else if($value == 15){
          $phituvan = $dom->load($res, true, true);
      } else if($value == 10){
          $honhop = $dom->load($res, true, true);
      } else if($value == 12){
          $luachonnhadautu = $dom->load($res, true, true);
      }

    }

    $title = array();   // Mảng tên gói thầu
    $link = array();     // mảng địa chỉ thông tin chi tiết gói thầu
    $bidder = array();   // mảng thông tin bên mời thầu

       // Hang hoa
        // Lấy dữ liệu hàng hóa
        foreach ( $content = $goithau->find("td a")  as  $value) {
            if (substr( $value->attr['onclick'],0,13)=='goAspTuchLive')
                {// Lấy dữ liệu ID_NO với goAspTuchLive
                 $id_no = substr( $value->attr['onclick'],30,2);
                 $bid_no =substr( $value ->attr['onclick'], 15 ,11);
                }
            else {// Lấy dữ liệu ID_NO với goAspTuch
                $id_no = substr( $value->attr['onclick'],26,2);
                $bid_no =substr( $value ->attr['onclick'], 11 ,11);
            }
            $link_temp  ="http://muasamcong.mpi.gov.vn:8081/GG/EP_MPV_GGQ999.jsp?bid_no=".$bid_no."&&bid_turnno=$id_no&bid_type=1";
            array_push($link, $link_temp) ;
             // Tên gói thầu
            $title_temp = $value->innertext;
            array_push($title, $title_temp);
        }
             // Tìm thông tin bên mời thầu
        foreach ( $content = $goithau->find("tr")  as  $value) {
            $bidder_temp =  $value->children(2)->innertext();
            array_push($bidder, $bidder_temp);
        }
        // Xóa phần tử thừa trong mảng người mời thầu
        array_shift($bidder);
        // Thêm dữ liệu
            for ( $i= 0; $i < count($title) ; $i++ ) {
            mysqli_query($conn,"SET character_set_client=utf8");
            mysqli_query($conn,"SET character_set_connection=utf8" );
            $tengoithau = trim(stripslashes($title[$i]));
            $lienket = $link[$i];
            $benmoithau = trim(stripslashes($bidder[$i]));
            $qr = "Select * from packages where  link ='$lienket'";
            $kiemtratrung = DB::select($qr);

            $dem = count($kiemtratrung);
            if ($dem == 0)
            {
                $goithau = new App\Packages;
                $goithau->title =$tengoithau;
                $goithau->link = $lienket;
                $goithau->bidder = $benmoithau;
                $goithau->cate_id = 'HH';
                $goithau->save();
            }

         }
 // Xay lap
                   $title = array();   // Mảng tên gói thầu
                   $link = array();     // mảng địa chỉ thông tin chi tiết gói thầu
                   $bidder = array();   // mảng thông tin bên mời thầu



             foreach ( $content = $xaylap->find("td a")  as  $value) {
              if (substr( $value->attr['onclick'],0,13)=='goAspTuchLive')
                   {// Lấy dữ liệu ID_NO với goAspTuchLive
                    $id_no = substr( $value->attr['onclick'],30,2);
                    $bid_no =substr( $value ->attr['onclick'], 15 ,11);
                   }
              else {// Lấy dữ liệu ID_NO với goAspTuch
                 $id_no = substr( $value->attr['onclick'],26,2);
                 $bid_no =substr( $value ->attr['onclick'], 11 ,11);
                   }
                 $link_temp  ="http://muasamcong.mpi.gov.vn:8081/GG/EP_MPV_GGQ999.jsp?bid_no=".$bid_no."&&bid_turnno=$id_no&bid_type=3";
               array_push($link, $link_temp) ;
               // Tên gói thầu
                $title_temp = $value->innertext;
                  array_push($title, $title_temp);
    }
             // Tìm thông tin bên mời thầu
        foreach ( $content = $xaylap->find("tr")  as  $value) {

             $bidder_temp =  $value->children(2)->innertext();
              array_push($bidder, $bidder_temp)      ;
    }
         // Xóa phần tử thừa trong mảng người mời thầu
          array_shift($bidder);
           // Thêm dữ liệu
                for ( $i= 0; $i < count($title) ; $i++ ) {
                 mysqli_query($conn,"SET character_set_client=utf8");
                 mysqli_query($conn,"SET character_set_connection=utf8" );
                 $tengoithau = trim(stripslashes($title[$i]));
                 $lienket = $link[$i];
                 $benmoithau = trim(stripslashes($bidder[$i]));
                 $qr = "Select * from packages where link ='$lienket'";
                 $kiemtratrung = DB::select($qr);

                $dem = count($kiemtratrung);
                if ($dem == 0)
                 {
                 $goithau = new App\Packages;
                 $goithau->title =$tengoithau;
                 $goithau->link = $lienket;
                 $goithau->bidder = $benmoithau;
                 $goithau->cate_id = 'XL';
                 $goithau->save();
               }

            }

 // Tu van
            $title = array();   // Mảng tên gói thầu
                   $link = array();     // mảng địa chỉ thông tin chi tiết gói thầu
                   $bidder = array();   // mảng thông tin bên mời thầu


             // Lấy dữ liệu hàng hóa
             foreach ( $content = $tuvan->find("td a")  as  $value) {
              if (substr( $value->attr['onclick'],0,13)=='goAspTuchLive')
                   {// Lấy dữ liệu ID_NO với goAspTuchLive
                    $id_no = substr( $value->attr['onclick'],30,2);
                    $bid_no =substr( $value ->attr['onclick'], 15 ,11);
                   }
              else {// Lấy dữ liệu ID_NO với goAspTuch
                 $id_no = substr( $value->attr['onclick'],26,2);
                 $bid_no =substr( $value ->attr['onclick'], 11 ,11);
                   }
                 $link_temp  ="http://muasamcong.mpi.gov.vn:8081/GG/EP_MPV_GGQ999.jsp?bid_no=".$bid_no."&&bid_turnno=$id_no&bid_type=5";
               array_push($link, $link_temp) ;
               // Tên gói thầu
                $title_temp = $value->innertext;
                  array_push($title, $title_temp);
    }
             // Tìm thông tin bên mời thầu
        foreach ( $content = $tuvan->find("tr")  as  $value) {

             $bidder_temp =  $value->children(2)->innertext();
              array_push($bidder, $bidder_temp)      ;
    }
         // Xóa phần tử thừa trong mảng người mời thầu
          array_shift($bidder);
           // Thêm dữ liệu
                for ( $i= 0; $i < count($title) ; $i++ ) {
                 mysqli_query($conn,"SET character_set_client=utf8");
                 mysqli_query($conn,"SET character_set_connection=utf8" );
                 $tengoithau = trim(stripslashes($title[$i]));
                 $lienket = $link[$i];
                 $benmoithau = trim(stripslashes($bidder[$i]));
                 $qr = "Select * from packages where  link ='$lienket'";
                 $kiemtratrung = DB::select($qr);

                $dem = count($kiemtratrung);
                if ($dem == 0)
                 {
                 $goithau = new App\Packages;
                 $goithau->title =$tengoithau;
                 $goithau->link = $lienket;
                 $goithau->bidder = $benmoithau;
                 $goithau->cate_id = 'TV';
                 $goithau->save();
               }

            }

            // phi tu van
            $title = array();   // Mảng tên gói thầu
                   $link = array();     // mảng địa chỉ thông tin chi tiết gói thầu
                   $bidder = array();   // mảng thông tin bên mời thầu


             // Lấy dữ liệu hàng hóa
             foreach ( $content = $phituvan->find("td a")  as  $value) {
              if (substr( $value->attr['onclick'],0,13)=='goAspTuchLive')
                   {// Lấy dữ liệu ID_NO với goAspTuchLive
                    $id_no = substr( $value->attr['onclick'],30,2);
                    $bid_no =substr( $value ->attr['onclick'], 15 ,11);
                   }
              else {// Lấy dữ liệu ID_NO với goAspTuch
                 $id_no = substr( $value->attr['onclick'],26,2);
                 $bid_no =substr( $value ->attr['onclick'], 11 ,11);
                   }
                 $link_temp  ="http://muasamcong.mpi.gov.vn:8081/GG/EP_MPV_GGQ999.jsp?bid_no=".$bid_no."&&bid_turnno=$id_no&bid_type=15";
               array_push($link, $link_temp) ;
               // Tên gói thầu
                $title_temp = $value->innertext;
                  array_push($title, $title_temp);
    }
             // Tìm thông tin bên mời thầu
        foreach ( $content = $phituvan->find("tr")  as  $value) {

             $bidder_temp =  $value->children(2)->innertext();
              array_push($bidder, $bidder_temp)      ;
    }
         // Xóa phần tử thừa trong mảng người mời thầu
          array_shift($bidder);
           // Thêm dữ liệu
                for ( $i= 0; $i < count($title) ; $i++ ) {
                 mysqli_query($conn,"SET character_set_client=utf8");
                 mysqli_query($conn,"SET character_set_connection=utf8" );
                 $tengoithau = trim(stripslashes($title[$i]));
                 $lienket = $link[$i];
                 $benmoithau = trim(stripslashes($bidder[$i]));
                 $qr = "Select * from packages where link ='$lienket'";
                 $kiemtratrung = DB::select($qr);

                $dem = count($kiemtratrung);
                if ($dem == 0)
                 {
                 $goithau = new App\Packages;
                 $goithau->title =$tengoithau;
                 $goithau->link = $lienket;
                 $goithau->bidder = $benmoithau;
                 $goithau->cate_id = 'PTV';
                 $goithau->save();
               }

            }

            // Hon hon
                     $title = array();   // Mảng tên gói thầu
                   $link = array();     // mảng địa chỉ thông tin chi tiết gói thầu
                   $bidder = array();   // mảng thông tin bên mời thầu



             foreach ( $content = $honhop->find("td a")  as  $value) {
              if (substr( $value->attr['onclick'],0,13)=='goAspTuchLive')
                   {// Lấy dữ liệu ID_NO với goAspTuchLive
                    $id_no = substr( $value->attr['onclick'],30,2);
                    $bid_no =substr( $value ->attr['onclick'], 15 ,11);
                   }
              else {// Lấy dữ liệu ID_NO với goAspTuch
                 $id_no = substr( $value->attr['onclick'],26,2);
                 $bid_no =substr( $value ->attr['onclick'], 11 ,11);
                   }
                 $link_temp  ="http://muasamcong.mpi.gov.vn:8081/GG/EP_MPV_GGQ999.jsp?bid_no=".$bid_no."&&bid_turnno=$id_no&bid_type=10";
               array_push($link, $link_temp) ;
               // Tên gói thầu
                $title_temp = $value->innertext;
                  array_push($title, $title_temp);
    }
             // Tìm thông tin bên mời thầu
        foreach ( $content = $honhop->find("tr")  as  $value) {

             $bidder_temp =  $value->children(2)->innertext();
              array_push($bidder, $bidder_temp)      ;
    }
         // Xóa phần tử thừa trong mảng người mời thầu
          array_shift($bidder);
           // Thêm dữ liệu
                for ( $i= 0; $i < count($title) ; $i++ ) {
                 mysqli_query($conn,"SET character_set_client=utf8");
                 mysqli_query($conn,"SET character_set_connection=utf8" );
                 $tengoithau = trim(stripslashes($title[$i]));
                 $lienket = $link[$i];
                 $benmoithau = trim(stripslashes($bidder[$i]));
                 $qr = "Select * from packages where  link ='$lienket'";
                 $kiemtratrung = DB::select($qr);

                $dem = count($kiemtratrung);
                if ($dem == 0)
                 {
                 $goithau = new App\Packages;
                 $goithau->title =$tengoithau;
                 $goithau->link = $lienket;
                 $goithau->bidder = $benmoithau;
                 $goithau->cate_id = 'HHP';
                 $goithau->save();
               }

            }

            // Lua chon nha dau tu
            $title = array();   // Mảng tên gói thầu
                   $link = array();     // mảng địa chỉ thông tin chi tiết gói thầu
                   $bidder = array();   // mảng thông tin bên mời thầu


             // Lấy dữ liệu hàng hóa
             foreach ( $content = $luachonnhadautu->find("td a")  as  $value) {
              if (substr( $value->attr['onclick'],0,13)=='goAspTuchLive')
                   {// Lấy dữ liệu ID_NO với goAspTuchLive
                    $id_no = substr( $value->attr['onclick'],30,2);
                    $bid_no =substr( $value ->attr['onclick'], 15 ,11);
                   }
              else {// Lấy dữ liệu ID_NO với goAspTuch
                 $id_no = substr( $value->attr['onclick'],26,2);
                 $bid_no =substr( $value ->attr['onclick'], 11 ,11);
                   }
                 $link_temp  ="http://muasamcong.mpi.gov.vn:8081/GG/EP_MPV_GGQ999.jsp?bid_no=".$bid_no."&&bid_turnno=$id_no&bid_type=12";
               array_push($link, $link_temp) ;
               // Tên gói thầu
                $title_temp = $value->innertext;
                  array_push($title, $title_temp);
    }
             // Tìm thông tin bên mời thầu
        foreach ( $content = $luachonnhadautu->find("tr")  as  $value) {

             $bidder_temp =  $value->children(2)->innertext();
              array_push($bidder, $bidder_temp)      ;
    }
         // Xóa phần tử thừa trong mảng người mời thầu
          array_shift($bidder);
           // Thêm dữ liệu
                for ( $i= 0; $i < count($title) ; $i++ ) {
                 mysqli_query($conn,"SET character_set_client=utf8");
                 mysqli_query($conn,"SET character_set_connection=utf8" );
                 $tengoithau = trim(stripslashes($title[$i]));
                 $lienket = $link[$i];
                 $benmoithau = trim(stripslashes($bidder[$i]));
                 $qr = "Select * from packages where  link ='$lienket'";
                 $kiemtratrung = DB::select($qr);

                $dem = count($kiemtratrung);
                if ($dem == 0)
                 {
                 $goithau = new App\Packages;
                 $goithau->title =$tengoithau;
                 $goithau->link = $lienket;
                 $goithau->bidder = $benmoithau;
                 $goithau->cate_id = 'NDT';
                 $goithau->save();
               }

            }

            	//header('location: ../http://tuoitre.vn');

           // return view ('admin.list_package');
             //return redirect('admin/list-package');
?>
