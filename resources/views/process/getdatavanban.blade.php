<?php

    require ("./process/simple_html_dom.php");
//  $url = file_get_html ("http://vbpl.vn/pages/vanbanmoi.aspx");

    $url = "http://vbpl.vn/pages/vanbanmoi.aspx";
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
    $url= $dom->load($res, true, true);
    $title = array();
    $link = array();
    foreach ($content = $url->find("div.content-news ul li a") as $value) {
        $title_temp=$value -> find("text",0);
        $title_temp ->innertext;
        $h=$value->href;
        $link_temp  ="http://vbpl.vn".$h;
        array_push($title, $title_temp);
        array_push($link, $link_temp);
    }

    for ( $i= 0; $i < count($title) ; $i++ ) {
        $tenvanban = trim(stripslashes($title[$i]));
        $lienket = $link[$i];

        $qr = "Select * from packages2 where  link ='$lienket'";
        $kiemtratrung = DB::select($qr);

        $dem = count($kiemtratrung);
        if ($dem == 0){
            $goithau = new App\Packages2;
            $goithau->title =$tenvanban;
            $goithau->link = $lienket;
            $goithau->save();
        }

    }

    //return redirect('admin/list-package');
