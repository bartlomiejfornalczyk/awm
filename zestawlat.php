<?php require("panel.php");
require("setup.php");?>

<main class="main-dflex">
<h2 class="informacja">Dane łatwości standardów</h2>
<div class="formularz container">
    <form action="zeslat.php" method="post" class="input-form">

       <div class="form-group">
              <input type="number" min="2012" max="2099" step="1"  name='rok' required>
              <label for="input" class="control-label">Rok matury</label><i class="bar"></i>
       </div>
       <div class="button-container">
    <button type="submit" class="button" name="wyslij"><span>Wyślij</span></button>
  </div>

    </form>
    </div>