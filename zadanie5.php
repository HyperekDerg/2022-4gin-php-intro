<?php
require_once 'vendor/autoload.php';

$generator = Faker\Factory::create();
$tablica = $generator->words(100);

function renderMD(array $lista, $kolumna)
{
    $liczba = 0;
    $mdRes = '';
    $liczbaKolumn = $kolumna - 1;
    sort($lista);
    foreach ($lista as $word) {
        if ($liczba % $kolumna == 0) {
            $mdRes .= "|";
        }
        $mdRes .= $word . '|';
        if ($liczba % $kolumna == $liczbaKolumn) {
            $mdRes .= "\n";
        }
        if ($liczba % $kolumna == $liczbaKolumn && $liczba < $kolumna) {
            $mdRes .= '|';
            for ($i = 0; $i < $kolumna; $i++) {
                $mdRes .= '---|';
            }
            $mdRes .= "\n";
        }
        $liczba++;
    }
    return $mdRes;
}

$kolumna = '4';
renderMD($tablica, $kolumna);
