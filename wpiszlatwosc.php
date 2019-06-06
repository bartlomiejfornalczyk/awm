<?php 
require('setup.php');
require('panel.php');

$wynik = $_POST['zse'];
$awynik = $_POST['azse'];
$oke = $_POST['oke'];
$aoke = $_POST['aoke'];
$cke = $_POST['cke'];
$acke = $_POST['acke'];
$standard = $_POST['standard'];

$rok = $_POST['rok'];


//echo count($wynik);
    $x = 1;
    for($i=0; $i<count($wynik); $i++) {
//        echo $standard[$i];
     $c->query("update {$rok}_latwosc set zse={$wynik[$i]} where id={$x}");
     $c->query("update {$rok}_latwosc set oke={$oke[$i]} where id={$x}");
     $c->query("update {$rok}_latwosc set cke={$cke[$i]} where id={$x}");
     $c->query("update {$rok}_latwosc set standard='{$standard[$i]}' where id={$x}");
     $x++;
}
     $c->query("update {$rok}_latwosc set azse={$awynik[0]} where id=1");
     $c->query("update {$rok}_latwosc set aoke={$aoke[0]} where id=1");
     $c->query("update {$rok}_latwosc set acke={$acke[0]} where id=1");
     header("location: pokazlatwosc.php");
?>
