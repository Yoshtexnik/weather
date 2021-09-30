<?php
header("Content-type:application/json");

include_once "simple_html_dom.php";

$URL = "https://uz.weather.town/forecast/uzbekistan/samarqand-viloyati/urgut/";
$ch = curl_init($URL);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$res = curl_exec($ch);
$html = str_get_html($res);
$js = [];
foreach ($html->find('div[class="day-selector-container"]') as $day) {
    $js_t = [
        'hafta_kuni' => $day->find('div')[0]->plaintext,
        'title' => $day->find('div[class="week-wi"]')[0]->find('i')[0]->title,
        'temperature' => $day->find('div[class="temperature red"]')[0]->plaintext,
        'vaqt' => $day->find('div[class="date clear"]')[0]->plaintext,
        $day->find('div[class="infPrecipitaion param-hide"]')[0]->title => $day->find('div[class="infPrecipitaion param-hide"]')[0]->plaintext,
        $day->find('div[class="infHumidity param-hide"]')[0]->title => $day->find('div[class="infHumidity param-hide"]')[0]->plaintext,
        $day->find('div[class="infWind param-hide"]')[0]->title => $day->find('div[class="infWind param-hide"]')[0]->plaintext,
        $day->find('div[class="infDirection param-hide"]')[0]->title => $day->find('div[class="infDirection param-hide"]')[0]->plaintext,
        $day->find('div[class="infPressure param-hide"]')[0]->title => $day->find('div[class="infPressure param-hide"]')[0]->plaintext,
        "Description" => $day->find('div[class="infDescription param-hide"]')[0]->plaintext,
        "Bulutlilik" => $day->find('div[class="infClouds param-hide"]')[0]->plaintext,
        "TempDay" => $day->find('div[class="infTempDay param-hide"]')[0]->plaintext,
        "TempNight" => $day->find('div[class="infTempNight param-hide"]')[0]->plaintext,
        "TempEvening" => $day->find('div[class="infTempEvening param-hide"]')[0]->plaintext,
        "TempMorning" => $day->find('div[class="infTempMorning param-hide"]')[0]->plaintext,
        "Sunrise" => $day->find('div[class="infSunrise param-hide"]')[0]->plaintext,
        "Transit" => $day->find('div[class="infTransit param-hide"]')[0]->plaintext,
        "Sunset" => $day->find('div[class="infSunset param-hide"]')[0]->plaintext,
        "Twilight" => $day->find('div[class="infTwilight param-hide"]')[0]->plaintext,
    ];
    $js[] = array_map('trim', $js_t);

}
aecho html_entity_decode(json_encode($js, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_QUOT));
