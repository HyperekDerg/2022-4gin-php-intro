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
        $tableRes .= '<table class="table">';
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
$array = explode(' ', file_get_contents('lorem.txt'));
$table = new tableTool($array);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>
    <title>Interative Table JS</title>
</head>
<body>
    <?php
    echo $table->renderHTML(3);
    ?>
    <div id='form' style="margin-bottom: 20px; margin-left: 20px; margin-right: 20px;">
        <h3 style="margin-top: 50px;">ADD NEW ITEM</h3>
        <br>
        <button class="btn btn-primary btn-sm" style="margin-left:10px;" id="addNew" onclick="createNew()">ADD</button>
    </div>
    <script>
        function changeWhenOnTR(selectItem){
            if(selectItem.style.backgroundColor !== 'lightblue'){
                selectItem.style.backgroundColor = 'lightblue';
            }
        }
        function changeWhenNotOnTR(selectItem){
            if(selectItem.style.backgroundColor == 'lightblue'){
                selectItem.style.backgroundColor = '';
            }
        }
        function changeWhenOnTD(selectItem){
            if(selectItem.style.fontWeight !== '1000'){
                selectItem.style.fontWeight = '1000';
            }
        }
        function changeOnLeaveTd(selectItem){
            if(selectItem.style.fontWeight == '1000'){
                selectItem.style.fontWeight = '';
            }
        }
        function removeRow(selectedRow){
           selectedRow.closest('tr').remove();
        }
        function createNew(){
            var newRow = document.createElement('tr');
            newRow.setAttribute( 'onMouseEnter', 'changeWhenOnTR(this)');
            newRow.setAttribute( 'onMouseLeave', 'changeWhenNotOnTR(this)');
            for(i=0; i<cL; i++){
                var newCL = document.createElement('td');
                newCL.setAttribute( 'onMouseEnter', 'changeWhenOnTD(this)');
                newCL.setAttribute( 'onMouseLeave', 'changeWhenNotOnTD(this)');
                newCL.innerHTML = document.getElementById('inputID'+i).value;
                newRow.appendChild(newCL);
            }   
            newRow.innerHTML += '<td><button class="btn btn-outline-danger btn-sm" onclick="removeRow(this)">REMOVE</button></td><td><button onclick="moveUp(this)" class="btn btn-outline-warning btn-sm">MOVE UP</button></td><td><button onclick="moveDown(this)" class="btn btn-outline-info btn-sm">MOVE DOWN</button></td>';
            document.querySelector('table').appendChild(newRow);
        }
        function moveUp(selectedRow){
            var currentRow= selectedRow.closest('tr')
            var rowIndex
            var allRows = document.querySelector('table').rows;
            for(i=0; i<allRows.length; i++){
                if(allRows[i].id==currentRow.id){
                    rowIndex=i;
                }
            }
            var upperIndex=rowIndex-1
            var currHTML= currentRow.innerHTML;
            var upperHTML = allRows[upperIndex].innerHTML;
            currentRow.innerHTML = upperHTML
            allRows[upperIndex].innerHTML = currHTML;
            document.getElementsByClassName("btn btn-outline-warning btn-sm")[0].disabled = true;
            document.getElementsByClassName("btn btn-outline-warning btn-sm")[1].disabled = false;
        }
        function moveDown(selectedRow){
            var currentRow= selectedRow.closest('tr')
            var rowIndex
            var allRows = document.querySelector('table').rows;
            for(i=0; i<allRows.length; i++){
                if(allRows[i].id==currentRow.id){
                    rowIndex=i;
                }
            }
            var lowerIndex=rowIndex+1
            var currHTML= currentRow.innerHTML;
            var lowerHTML = allRows[lowerIndex].innerHTML;
            currentRow.innerHTML = lowerHTML
            allRows[lowerIndex].innerHTML = currHTML;
            document.getElementsByClassName("btn btn-outline-info btn-sm")[row.length-1].disabled = true;
            document.getElementsByClassName("btn btn-outline-info btn-sm")[row.length-2].disabled = false;
        }
        var row = document.querySelectorAll('tr');
        var cL = document.querySelector('table').rows[0].cells.length;
        var formButton = document.getElementById('addNew');

        row.forEach((element, index) => {element.setAttribute('id', 'rowId'+index ),
        element.innerHTML += '<td><button class="btn btn-outline-danger btn-sm" onclick="removeRow(this)">REMOVE</button></td><td><button onclick="moveUp(this)" class="btn btn-outline-warning btn-sm">MOVE UP</button></td><td><button onclick="moveDown(this)" class="btn btn-outline-info btn-sm">MOVE DOWN</button></td>', 
        element.setAttribute( 'onMouseEnter', 'changeWhenOnTR(this)'),
        element.setAttribute( 'onMouseLeave', 'changeWhenNotOnTR(this)')});

        document.getElementsByClassName("btn btn-outline-warning btn-sm")[0].disabled = true;
        document.getElementsByClassName("btn btn-outline-info btn-sm")[row.length-1].disabled = true;

        var kom = document.querySelectorAll('th, td');

        kom.forEach(element => {element.setAttribute( 'onMouseEnter', 'changeWhenOnTD(this)'),
        element.setAttribute( 'onMouseLeave', 'changeOnLeaveTd(this)')});

        for (i=0; i<cL; i++){
            var newInput = document.createElement('input');
            newInput.setAttribute('id', 'inputID'+i);
            document.getElementById('form').insertBefore(newInput, formButton);
        }
    </script>
</body>
</html>