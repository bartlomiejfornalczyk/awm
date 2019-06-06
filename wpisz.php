<?php 
require('setup.php');
require('panel.php');

$wynik = $_POST['wynik'];
$rok = $_POST['rok'];
$klasa = $_POST['klasa'];
$poziom = $_POST['poziom'];
//echo count($wynik);
    $x = 1;
    for($i=0; $i<count($wynik); $i++) {
    $wynik[$i]=$wynik[$i]/100;
     $c->query("update {$rok}_wyniki_{$klasa}_{$poziom} set wynik={$wynik[$i]} where id={$x}");
     $x++;
}

if($poziom=="p")
{
    header("location: klasa.php?klasa={$rok}_wyniki_{$klasa}_p");
}
else if($poziom=="r"){
    header("location: klasa.php?klasa={$rok}_wyniki_{$klasa}_r");
}

?>
