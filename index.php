<?php
$weatherUrls = array(
    "http://www.google.com/ig/api?weather=kyoto,kyoto",
    "http://www.google.com/ig/api?weather=osaka,osaka",
    "http://www.google.com/ig/api?weather=kobe,hyogo",
);

foreach($weatherUrls as $weatherUrl) {
    $weatherXml = simplexml_load_file($weatherUrl);

    $googleUrl = "http://www.google.com";
    $nowGifs[] = $googleUrl . $weatherXml->weather->current_conditions->icon['data'];

    $placeName[] = $weatherXml->weather->forecast_information->city['data'];

    $now_md = Date("n/d", strtotime("now")+32400);
    $now_yobi = Date("D", strtotime("now")+32400);

    $tommorow_md = Date("n/d", strtotime("now")+118800);
    $tommorow_yobi = Date("D", strtotime("now")+118800);

    foreach ($weatherXml->weather->forecast_conditions as $forecast) {
        $yobi = $forecast->day_of_week['data'] ;
        if ($yobi==$now_yobi){
            $todayGifs[] = $googleUrl . $forecast->icon['data'] ;
        }
        if ($yobi==$tommorow_yobi){
            $tommorowGifs[] = $googleUrl . $forecast->icon['data']  ;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>天気</title>
</head>
</html>
<body>
<?php
foreach($weatherUrls as $index => $weatherUrl) {
    echo '<p>';
    echo $placeName[$index];
    echo '</p>';
    echo '現在<img src=' . $nowGifs[$index] . '>';
    echo '今日<img src=' . $todayGifs[$index] . '>';
    echo '明日<img src=' . $tommorowGifs[$index] . '>';
}
?>
</body>
</html>

