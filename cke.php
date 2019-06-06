<?php 
require('panel.php');
require('setup.php');
$c->query("use matura");
?>
<main class="main-dflex">
<h1 class="warn">Proszę wpisywać dane w formie liczb całkowitych z zakresu 0-100!</h1>
<h2 class="informacja">Dane staninowe CKE</h2>
<div class="formularz container">
    <form action="#" method="post">
    <div class="form-group">
              <input type="number" min="2012" max="2099" step="1"  name='rok' required>
              <label for="input" class="control-label">Rok matury</label><i class="bar"></i>
       </div>    
       <div class="form-group">
       <input type="number" min="0" max="100" step="0.01" name="nn" required>
              <label for="input" class="control-label">Najniższy</label><i class="bar"></i>
       </div> 
       <div class="form-group">
       <input type="number" min="0" max="100" name="bn" required></label><br>
              <label for="input" class="control-label">Bardzo niski</label><i class="bar"></i>
       </div> 
       <div class="form-group">
       <input type="number" min="0" max="100" step="0.01" name="n" required>
              <label for="input" class="control-label">Niski</label><i class="bar"></i>
       </div> 
       <div class="form-group">
       <input type="number" min="0" max="100" step="0.01" name="ns" required>
              <label for="input" class="control-label">Niżej średniej</label><i class="bar"></i>
       </div> 
       <div class="form-group">
       <input type="number" min="0" max="100" step="0.01" name="s" required>
              <label for="input" class="control-label">Średni</label><i class="bar"></i>
       </div> 
       <div class="form-group">
       <input type="number" min="0" max="100" step="0.01" name="ws" required>
              <label for="input" class="control-label">Wyżej średniej</label><i class="bar"></i>
       </div> 
       <div class="form-group">
       <input type="number" min="0" max="100" step="0.01" name="w" required>
              <label for="input" class="control-label">Wysoki</label><i class="bar"></i>
       </div> 
       <div class="form-group">
       <input type="number" min="0" max="100" step="0.01" name="bw" required>
              <label for="input" class="control-label">Bardzo wysoki</label><i class="bar"></i>
       </div> 
       <div class="form-group">
       <input type="number" min="0" max="100" step="0.01" name="nw" required>
              <label for="input" class="control-label">Najwyższy</label><i class="bar"></i>
       </div> 
       <div class="button-container">
    <button type="submit" class="button" name="submit"><span>Wyślij</span></button>
  </div>
    </form>
    </div>
    <?php
    if(isset($_POST['submit']))
{
    $rok = $_POST['rok'];
    $nn = $_POST['nn']/100;
    $bn = $_POST['bn']/100;
    $n = $_POST['n']/100;
    $ns = $_POST['ns']/100;    
    $s = $_POST['s']/100;
    $ws = $_POST['ws']/100;
    $w = $_POST['w']/100;
    $bw = $_POST['bw']/100;
    $nw = $_POST['nw']/100;
        $c->query("create table {$rok}_wyniki_cke (`nn` float DEFAULT NULL,
 `bn` float DEFAULT NULL,
 `n` float DEFAULT NULL,
 `ns` float DEFAULT NULL,
 `s` float DEFAULT NULL,
 `ws` float DEFAULT NULL,
 `w` float DEFAULT NULL,
 `bw` float DEFAULT NULL,
 `nw` float DEFAULT NULL
 )");
        $c->query("insert into {$rok}_wyniki_cke values($nn, $bn, $n, $ns, $s, $ws, $w, $bw, $nw)");
    }?>
