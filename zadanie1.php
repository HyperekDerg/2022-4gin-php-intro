<?php 
require_once 'vendor/autoload.php';

$generator = Faker\Factory::create();
$faker = $generator->words(100);

$Numer_listy= 1;
foreach ($faker as $i) {
    echo $Numer_listy.'. '.$i.'<br>';
    $Numer_listy ++;
}
?>