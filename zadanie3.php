<?php
require_once 'vendor/autoload.php';

$generator = Faker\Factory::create();
$tablica     = $generator->words(100);

function  renderHTMLTable(array $lista, $kolumna)
{
    $liczba = 1;
    $tableRes = '';
    sort($lista);
    $tableRes .= '<table>';
    foreach ($lista as $wyraz) {
        
        if ($liczba <= $kolumna) {
            if ($liczba % $kolumna == 1) {
                $tableRes .= '<tr><th>' . $wyraz . '</th>';
            } else if ($liczba % $kolumna == 0) {
                $tableRes .= '<th>' . $wyraz . '</th></tr>';
            } else {
                $tableRes .= '<th>' . $wyraz . '</th>';
            }
        } else {
            if ($liczba % $kolumna == 1) {
                $tableRes .= '<tr><td>' . $wyraz . '</td>';
            } else if ($liczba % $kolumna == 0) {
                $tableRes .= '<td>' . $wyraz . '</td></tr>';
            } else {
                $tableRes .= '<td>' . $wyraz . '</td>';
            }
        }
        $liczba++;
    }
    $tableRes .= '</table>';
    return $tableRes;
}

$kolumna = '4';
renderHTMLTable($tablica, $kolumna);
?>  