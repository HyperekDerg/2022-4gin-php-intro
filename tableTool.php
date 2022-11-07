<?php
require_once "tableTool.interface.php";

class tableTool implements tableToolInterface
{
    var $table_data;
    public function __construct($data)
    {
        $this->table_data=$data;
    }
    private function Sortowanie($szukana)
    {
        sort($this->table_data);
        $sortRes=array();
        foreach ($this->table_data as $wyrazy) {
            if(preg_match("/{$szukana}/i", $wyrazy)) {
                $sortRes[]= $wyrazy;
            }
        }
        return $sortRes;
    }
    public function renderHTML($cols, $filterString = '')
    {
        $liczba   = 1;
        $sortData = $this->Sortowanie($filterString);
        $tableRes = '';
        $tableRes .= '<table>';
        foreach ($sortData as $wyraz) {
            
            if ($liczba <= $cols) {
                if ($liczba % $cols == 1) {
                    $tableRes .= '<tr><th>' . $wyraz . '</th>';
                } else if ($liczba % $cols == 0) {
                    $tableRes .= '<th>' . $wyraz . '</th></tr>';
                } else {
                    $tableRes .= '<th>' . $wyraz . '</th>';
                }
            } else {
                if ($liczba % $cols == 1) {
                    $tableRes .= '<tr><td>' . $wyraz . '</td>';
                } else if ($liczba % $cols == 0) {
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
    public function renderCSV($cols, $filterString = '')
    {
        $liczba = 1;
        $csvRes = '';
        $sortData = $this->Sortowanie($filterString);
        foreach (  $sortData as $wyraz) {
            if ($liczba < $cols) {
                $csvRes .= $wyraz . "\t";
                $liczba++;
            } else {
                $csvRes .= $wyraz . "\n";
                $liczba = 1;
            }
        }
        return $csvRes;
    }
    public function renderMD($cols, $filterString = '')
    {
        $liczba       = 0;
        $mdRes        = '';
        $liczbaKolumn = $cols - 1;
        $sortData = $this->Sortowanie($filterString);
        foreach (  $sortData as $word) {
            if ($liczba % $cols == 0) {
                $mdRes .= "|";
            }
            $mdRes .= $word . '|';
            if ($liczba % $cols == $liczbaKolumn) {
                $mdRes .= "\n";
            }
            if ($liczba % $cols == $liczbaKolumn && $liczba < $cols) {
                $mdRes .= '|';
                for ($i = 0; $i < $cols; $i++) {
                    $mdRes .= '---|';
                }
                $mdRes .= "\n";
            }
            $liczba++;
        }
        return $mdRes;
    }
}

// NIE DOTYKAĆ KODU PONIŻEJ TEJ LINIJKI

$array = explode(' ', file_get_contents('lorem.txt'));

$table = new tableTool($array);

// Tests
echo $table->renderHTML(3);
echo $table->renderHTML(10);
echo $table->renderHTML(5, 'id');
echo $table->renderCSV(3);
echo $table->renderCSV(10);
echo $table->renderCSV(5, 'id');
echo $table->renderMD(3);
echo $table->renderMD(10);
echo $table->renderMD(5, 'id'); 