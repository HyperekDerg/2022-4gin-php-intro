<?php

//Podstawowa klasa jaką można napisać.

class programowaniePHP
{
    public $wersja;
    public $temat;
    public $prowadzacy;
}

$lekcja = new programowaniePHP();

$lekcja->wersja = '1.8.1';
$lekcja->temat = 'Jak sprawdzić naszą wersję w programowaniu PHP';
$lekcja->prowadzacy = 'Jakub Rudnicki';

echo $lekcja->wersja . ' ' . $lekcja->temat . ' ' . $lekcja->prowadzacy . '<br><br>';

//Klasa z funkcją, wartości domyślne dla elementów klasy.

class gryKomputerowe
{
    public $wydawca = 'EA';
    public $nazwa = 'The Sims 4';

    public function napisz(string $napis)
    {
        echo $napis . '<br>';
    }
}

$gra = new gryKomputerowe();

echo $gra->napisz("Popularne gry.");
echo $gra->nazwa . '<br>';
echo $gra->wydawca . '<br>';
$gra->nazwa = "Half-Life 2";
$gra->wydawca = "Valve";
echo $gra->nazwa . '<br>';
echo $gra->wydawca . '<br>';

class kalkulator
{
    public function dodaj($liczba1, $liczba2)
    {
        $wynik = 'wynik dodawania: ';
        $wynik .= $liczba1 + $liczba2;
        return $wynik;
    }
    public function odejmij($liczba1, $liczba2)
    {
        $wynik = 'wynik odejmowania: ';
        $wynik .= $liczba1 - $liczba2;
        return $wynik;
    }
    public function mnoz($liczba1, $liczba2)
    {
        $wynik = 'wynik mnożenia: ';
        $wynik .= $liczba1 * $liczba2;
        return $wynik;
    }
    public function podziel($liczba1, $liczba2)
    {
        $wynik = 'wynik dzielenia: ';
        $wynik .= $liczba1 / $liczba2;
        return $wynik;
    }
}

$liczenie = new kalkulator();
echo $liczenie->dodaj(20, 10) . '<br>';
echo $liczenie->odejmij(20, 10) . '<br>';
echo $liczenie->mnoz(20, 10) . '<br>';
echo $liczenie->podziel(20, 10) . '<br>';
