<?php
require_once 'vendor/autoload.php';

$generator = Faker\Factory::create();
$tablica   = $generator->words(100);

function renderCSV(array $lista, $kolumna)
{
    $liczba = 1;
    $csvRes = '';
    sort($lista);
    foreach ($lista as $wyraz) {
        if ($liczba < $kolumna) {
            $csvRes .= $wyraz . "\t";
            $liczba++;
        } else {
            $csvRes .= $wyraz . "\n";
            $liczba = 1;
        }
    }
    return $csvRes;
}

$kolumna = '4';
renderCSV($tablica, $kolumna);
?>  