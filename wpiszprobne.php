<?php 
require('setup.php');
require('panel.php');

$wynik = $_POST['wynik'];
$rok = $_POST['rok'];
$klasa = $_POST['klasa'];
$miesiac = $_POST['miesiac'];
//echo count($wynik);
    $x = 1;
    for($i=0; $i<count($wynik); $i++) {
    $wynik[$i]=$wynik[$i]/100;
     $c->query("update {$rok}_{$miesiac}_wyniki_{$klasa} set wynik={$wynik[$i]} where id={$x}");
     $x++;
}
header("location: klasa.php?klasa={$rok}_{$miesiac}_wyniki_{$klasa}");
?>
