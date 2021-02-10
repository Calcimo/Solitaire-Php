<?php
declare(strict_types=1);

$section = array(
    "Normal Foreground Colors" => "[3",
    "Normal Background Colors" => "[4",
    "Strong Foreground Colors" => "[9",
    "Strong Background Colors" => "[10"
);

//echo $section["Normal Foreground Colors"]." ça fait des trucs\n";
//CA FAIT DU ROUGE OUAAAAAIS
echo "\e[1m"."\e[7m"."\e[41m"."jecris des trucs".$reset."\n";
//ET CA DU NOIR YEAAAAAH
echo "\e[1m"."\e[7m"."\e[40m"."jecris des trucs".$reset."\n";

$colors = array(
    "Black",
    "Red",
    "Green",
    "Yellow",
    "Blue",
    "Magenta",
    "Cyan",
    "White"
);

$reset = "\e[0m";
$bold = "\e[1m";
$underline = "\e[4m";
$inverse = "\e[7m";

foreach ($section as $title => $str) {
    echo $inverse.$title.$reset."\n";
    foreach ($colors as $s => $name) {
        echo "<ESC>".$str.$s."m "."\e".$str.$s."m $name".$reset."\n";
    }
}


echo "$bold Bold $reset suite du texte...\n";

// echo "Signe de coeur : " . json_decode("\"\U2665\"") . "\n";
echo "Signe de pique : " . mb_convert_encoding("\x26\x60", 'UTF-8', 'UTF-16BE') . "\n";
echo "Signe de trèfle : " . mb_convert_encoding("\x26\x63", 'UTF-8', 'UTF-16BE') . "\n";
echo "Signe de coeur : " . mb_convert_encoding("\x26\x65", 'UTF-8', 'UTF-16BE') . "\n";
echo "Signe de carreau : " . mb_convert_encoding("\x26\x66", 'UTF-8', 'UTF-16BE') . "\n";
echo "Signe du soleil ? : " . mb_convert_encoding("\x26\x3C", 'UTF-8', 'UTF-16BE') . "\n";



