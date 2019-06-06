<?php
require("panel.php");
require("setup.php");

?>
    <main class="main-dflex">
<h2 class="informacja">Generowanie raportu dla matury rozszerzonej</h2>
<div class="formularz container">
    <form action="rap.php" method="get" class="input-form">

       <div class="form-group">
              <input type="number" min="2012" max="2099" step="1"  name='rok' required>
              <label for="input" class="control-label">Wpisz rok</label><i class="bar"></i>
       </div>
      
       <div class="button-container">
    <button type="submit" class="button" name="submit"><span>Wyślij</span></button>
  </div>
</form>
</div>
</main>
