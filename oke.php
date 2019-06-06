<?php 
require('panel.php');
require('setup.php');

$c->query("use matura");
?>
<main class="main-dflex">
<h2 class="informacja">Dodawanie danych krajowych</h2>
<h1 class="warn">Proszę wpisywać dane w formie liczb całkowitych z zakresu 0-100!</h1>
<div class="container full-width">
    <form action="#" method="post" class="formstyle">
        
        <label class="inp" for="oke"> 
            <input type="number" min="0" max="100" step="0.01" name="oke">
            <span class="label">Wynik OKE Łódź</span>
            <span class="border"></span>
        </label> 
        <label class="inp">
            <input type="number" min="0" max="100" name="ote">
            <span class="label">Wynik OKE Łódź - technikum</span>
            <span class="border"></span>
        </label> 
         
        <label class="inp"> 
            <input type="number" min="0" max="100" step="0.01" name="kraj">           
            <span class="label">Wynik z kraju</span>
            <span class="border"></span>
        </label> 
        <label class="inp"> 
            <input type="number" min="0" max="100" name="krajt" step="0.01">
            <span class="label">Wynik z kraju - technikum</span>
            <span class="border"></span>
        </label> 
        <label class="inp">
            <input type="number" min="0" max="100" step="0.01" name="aoke">
            <span class="label">Średni wynik OKE Łódź</span>
            <span class="border"></span>
        </label> 
        <label class="inp"> 
            <input type="number" min="0" max="100" name="aote">
            <span class="label">Średni wynik OKE Łódź - technikum</span>
            <span class="border"></span>
        </label> 
         
        <label class="inp"> 
            <input type="number" min="0" max="100" step="0.01" name="akraj">
            <span class="label">Średni wynik z kraju</span>
            <span class="border"></span>
        </label> 
        <label class="inp"> 
            <input type="number" min="0" max="100" name="akrajt" step="0.01">
            <span class="label">Średni wynik z kraju - technikum</span>
            <span class="border"></span>
        </label> 
         
        <label class="inp"> 
            <input type="number" min="0" max="100" step="0.01" name="moke">
            <span class="label">Mediana OKE Łódź</span>
            <span class="border"></span>
        </label> 
        <label class="inp"> 
            <input type="number" min="0" max="100" name="mote">
            <span class="label">Mediana OKE Łódź - technikum</span>
            <span class="border"></span>
        </label> 
         
        <label class="inp"> 
            <input type="number" min="0" max="100" step="0.01" name="mkraj">
            <span class="label">Mediana w kraju</span>
            <span class="border"></span>
        </label> 
        <label class="inp"> 
            <input type="number" min="0" max="100" name="mkrajt" step="0.01">
            <span class="label">Mediana w kraju - technikum</span>
            <span class="border"></span>
        </label> 
         
        <label class="inp"> 
            <input type="number" min="0" max="100" step="0.01" name="doke">
            <span class="label">Dominanta OKE Łódź</span>
            <span class="border"></span>
        </label> 
        <label class="inp"> 
            <input type="number" min="0" max="100" name="dote">
            <span class="label">Mediana OKE Łódź - technikum</span>
            <span class="border"></span>
        </label> 
         
        <label class="inp"> 
            <input type="number" min="0" max="100" step="0.01" name="dkraj">
            <span class="label">Dominanta w kraju</span>
            <span class="border"></span>
        </label> 
        <label class="inp"> 
            <input type="number" min="0" max="100" name="dkrajt" step="0.01">
            <span class="label">Dominanta w kraju - technikum</span>
            <span class="border"></span>
        </label> 
         
        <label class="inp"> 
            <input type="number" min="0" max="100" step="0.01" name="maxoke">
            <span class="label">Maksimum OKE Łódź</span>
            <span class="border"></span>
        </label> 
        <label class="inp"> 
            <input type="number" min="0" max="100" name="maxote">
            <span class="label">Maksimum OKE Łódź - technikum</span>
            <span class="border"></span>
        </label> 
         
        <label class="inp"> 
            <input type="number" min="0" max="100" step="0.01" name="maxkraj">
            <span class="label">Maksimum w kraju</span>
            <span class="border"></span>
        </label> 
        <label class="inp"> 
            <input type="number" min="0" max="100" name="maxkrajt" step="0.01">
            <span class="label">Maksimum w kraju - technikum</span>
            <span class="border"></span>
        </label> 
         
        <label class="inp"> 
            <input type="number" min="0" max="100" step="0.01" name="minoke">
            <span class="label">Minimum OKE Łódź</span>
            <span class="border"></span>
        </label> 
        <label class="inp"> 
            <input type="number" min="0" max="100" name="minote">
            <span class="label">Minimum OKE Łódź - technikum</span>
            <span class="border"></span>
        </label> 
         
        <label class="inp"> 
            <input type="number" min="0" max="100" step="0.01" name="minkraj">
            <span class="label">Minimum w kraju</span>
            <span class="border"></span>
        </label> 
        <label class="inp"> 
            <input type="number" min="0" max="100" name="minkrajt" step="0.01">
            <span class="label">Minimum w kraju - technikum</span>
            <span class="border"></span>
        </label> 
         
        <label class="inp"> 
            <input type="number" min="0" max="100" step="0.01" name="roke">
            <span class="label">Rozstęp OKE Łódź</span>
            <span class="border"></span>
        </label> 
        <label class="inp"> 
            <input type="number" min="0" max="100" name="rote">
            <span class="label">Rozstęp OKE Łódź - technikum</span>
            <span class="border"></span>
        </label> 
         
        <label class="inp"> 
            <input type="number" min="0" max="100" step="0.01" name="rkraj">
            <span class="label">Rozstęp w kraju</span>
            <span class="border"></span>
        </label>  
        <label class="inp"> 
            <input type="number" min="0" max="100" name="rkrajt" step="0.01">
            <span class="label">Rozstęp w kraju - technikum</span>
            <span class="border"></span>
        </label> 
         
        <label class="inp">
            <input type="number" min="0" max="100" step="0.01" name="odoke">
            <span class="label">Odchylenie standardowe OKE Łódź</span>
            <span class="border"></span>
        </label>  
        <label class="inp"> 
            <input type="number" min="0" max="100" name="odote">
            <span class="label">Odchylenie standardowe OKE Łódź - technikum</span>
            <span class="border"></span>
        </label> 
         
        <label class="inp"> 
            <input type="number" min="0" max="100" step="0.01" name="odkraj">
            <span class="label">Odchylenie standardowe w kraju</span>
            <span class="border"></span>
        </label> 
        <label class="inp"> 
            <input type="number" min="0" max="100" name="odkrajt" step="0.01">
            <span class="label">Odchylenie standardowe w kraju - technikum</span>
            <span class="border"></span>
        </label> 
         
         

        <!--
        <label class="inp"> Ilu przystąpiło do matury rozszerzonej?
            <input type="number" min="0" name="roz" step="1"></label>
         
-->
<label class="inp rok" for="rok">
            <input type="number" min="2012" max="2099" step="1" name='rok'>
            <span class="label">Rok matury</span>
            <span class="border"></span>
        </label> 
        <div class="button-container">
    <button type="submit" class="button" name="submit"><span>Wyślij</span></button>
  </div>
    </form>
    </div>
    <br>

    <?php
if(isset($_POST['submit']))
{
    $rok = $_POST['rok'];
    $oke = $_POST['oke'];
    $ote = $_POST['ote'];
    $kraj = $_POST['kraj'];
    $krajt = $_POST['krajt'];
   
    $aoke = $_POST['aoke'];
    $aote = $_POST['aote'];
    $akraj = $_POST['akraj'];
    $akrajt = $_POST['akrajt']; 
    $moke = $_POST['moke'];
    $mote = $_POST['mote'];
    $mkraj = $_POST['mkraj'];
    $mkrajt = $_POST['mkrajt'];
    $doke = $_POST['doke'];
    $dote = $_POST['dote'];
    $dkraj = $_POST['dkraj'];
    $dkrajt = $_POST['dkrajt'];
    $maxoke = $_POST['maxoke'];
    $maxote = $_POST['maxote'];
    $maxkraj = $_POST['maxkraj'];
    $maxkrajt = $_POST['maxkrajt'];
    $minoke = $_POST['minoke'];
    $minote = $_POST['minote'];
    $minkraj = $_POST['minkraj'];
    $minkrajt = $_POST['minkrajt'];
    $roke = $_POST['roke'];
    $rote = $_POST['rote'];
    $rkraj = $_POST['rkraj'];
    $rkrajt = $_POST['rkrajt'];
    $odoke = $_POST['odoke'];
    $odote = $_POST['odote'];
    $odkraj = $_POST['odkraj'];
    $odkrajt = $_POST['odkrajt'];
    

    $sql= "create table {$rok}_oke (
    oke float,
    ote float,
    kraj float,
    krajt float,
    aoke float,
    aote float,
    akraj float,
    akrajt float
    moke float,
    mote float,
    mkraj float,
    mkrajt float,
    doke float,
    dote float,
    dkraj float,
    dkrajt float,
    maxoke float,
    maxote float,
    maxkraj float,
    maxkrajt float,
    minoke float,
    minote float,
    minkraj float,
    minkrajt float,
    roke float,
    rote float,
    rkraj float,
    rkrajt float,
    odoke flaot,
    odote float,
    odkraj float,
    odkrajt float    
    )";
    $w = $c->query("create table {$rok}_oke(oke float, ote float, kraj float, krajt float, aoke float, aote float, akraj float, akrajt float, moke float, mote float, mkraj float, mkrajt float, doke float, dote float, dkraj float, dkrajt float, maxoke float, maxote float, maxkraj float, maxkrajt float, minoke float, minote float, minkraj float, minkrajt float, roke float, rote float, rkraj float, rkrajt float, odoke float, odote float, odkraj float, odkrajt float)");
    echo $w;
    $c->query("insert into {$rok}_oke values ({$oke}, {$ote}, {$kraj}, {$krajt}, {$aoke}, {$aote}, {$akraj}, {$akrajt}, $moke, $mote, $mkraj, $mkrajt, $doke, $dote, $dkraj, $dkrajt, $maxoke,$maxote,$maxkraj, $maxkrajt, $minoke, $minote, $minkraj, $minkrajt, $roke, $rote, $rkraj, $rkrajt, $odoke, $odote, $odkraj, $odkrajt)");
    }


?>
</main>
