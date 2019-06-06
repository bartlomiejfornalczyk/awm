<?php
require("panel.php");
require("setup.php");

?>
    <main class="main-dflex">
<h2 class="informacja">Generowanie raportu dla matury próbnej</h2>
<div class="formularz container">
    <form action="probnyrap.php" method="post" class="input-form">

       <div class="form-group">
              <input type="number" min="2012" max="2099" step="1"  name='rok' required>
              <label for="input" class="control-label">Wpisz rok</label><i class="bar"></i>
       </div>
      <div class="form-group">
      <select name="miesiac">
            <option value="wrzesien">Wrzesień</option>
            <option value="pazdziernik">Październik</option>
            <option value="listopad">Listopad</option>
            <option value="grudzien">Grudzień</option>
            <option value="styczen">Styczeń</option>
            <option value="luty">Luty</option>
            <option value="marzec">Marzec</option>
            <option value="kwiecien">Kwiecień</option>
        </select>
      </div>
       <div class="button-container">
    <button type="submit" class="button" name="submit"><span>Wyślij</span></button>
  </div>
</form>
</div>
</main>
<main>
    <form action="probnyrap.php" method="post">
        <label>
            Wybierz rok, dla którego wygenerować raport
            <input type="number" min="2012" max="2099" step="1" value="2018" name='rok'>
        </label>
        
        <button type="submit" name="submit">Wyślij</button>
    </form>
