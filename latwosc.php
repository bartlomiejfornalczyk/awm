<!--select sum(wynik)*100/(max(wynik)*count(wynik)) from 2018_wyniki_klas-->
<?php
require("panel.php");
require("setup.php");

?>
<main class="main-dflex">
<h2 class="informacja">Dodawanie łatwości zadań</h2>
<div class="formularz container">
    <form action="latwo.php" method="post" class="input-form">

       <div class="form-group">
              <input type="number" min="2012" max="2099" step="1"  name='rok' required>
              <label for="input" class="control-label">Rok matury</label><i class="bar"></i>
       </div>
       <div class="form-group">
              <input type="text" name="ile" required>
              <label for="input" class="control-label">Ile było zadań?</label><i class="bar"></i>
       </div>
       <div class="button-container">
    <button type="submit" class="button" name="submit"><span>Wyślij</span></button>
  </div>
</form>
</div>
</main>
