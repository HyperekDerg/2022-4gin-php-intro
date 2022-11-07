<?php 
require_once 'vendor/autoload.php';

$generator = Faker\Factory::create();
$faker = $generator->words(100);

function Sortowanie($szukana, array $lista)
{
    $Numer_listy = 1;
    sort($lista);
    foreach ($lista as $wyrazy) {
        if(preg_match("/{$szukana}/i", $wyrazy)) {
            echo $Numer_listy.'. '.$wyrazy.'<br>';
            $Numer_listy ++;
        }
    }
}


$search = '';
Sortowanie($search, $faker);
?>  