<?php

include ("../config/connect.php");
require ("simple_html_dom.php");
mysqli_query($conn, "SET character_set_results=utf8");
mb_language('uni');
mb_internal_encoding('UTF-8');
mysqli_query($conn, "set names 'utf8'");
$conn->set_charset("utft");
$date = date('Y-m-d H:i:s');
mysqli_query($conn, "SET character_set_client=utf8");
mysqli_query($conn, "SET character_set_connection=utf8");
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
$url = $dom->load($res, true, true);
$title = array();
$link = array();
foreach ($content = $url->find("div.content-news ul li a") as $value) {
    $title_temp = $value->find("text", 0);
    $title_temp->innertext;
    $h = $value->href;
    $link_temp = "http://vbpl.vn" . $h;
    array_push($title, $title_temp);
    array_push($link, $link_temp);
}

for ($i = 0; $i < count($title); $i++) {
    $tenvanban = trim(stripslashes($title[$i]));
    $lienket = $link[$i];

    $qr = "Select * from packages2 where  link ='$lienket'";
    $kiemtratrung = mysqli_query($conn,$qr);
    $dem = mysqli_num_rows($kiemtratrung);
    if ($dem < 1) {
        $rs = mysqli_query($conn,"insert into packages2 VALUES ('','$tenvanban','$lienket',NULL, '$date', '$date')");
        if (!$rs) {  
            echo "Thêm mới thất bại: " . mysqli_error($conn) . " ";
        } else {
            echo "Thêm thành công văn bản: " . $tenvanban . " --- ";
        }
    }else {
        echo "Văn bản: " . $tenvanban . " đã tồn tại --- ";
    }
}