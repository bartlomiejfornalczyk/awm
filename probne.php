<?php require("panel.php");
require("setup.php");?>
<main class="main-dflex">
<h2 class="informacja">Dodawanie klasy</h2>
<div class="formularz container">
    <form action="dodajprobne.php" method="post" class="input-form">

       <div class="form-group">
              <input type="number" min="2012" max="2099" step="1"  name='rok' required>
              <label for="input" class="control-label">Rok matury</label><i class="bar"></i>
       </div>
       <div class="form-group">
              <input type="text" name="klasa" required>
              <label for="input" class="control-label">Klasa</label><i class="bar"></i>
       </div>
      
       <div class="form-group">
       <input type="number" name="liczba"  required>
              <label for="input" class="control-label">Liczba zdających</label><i class="bar"></i>
       </div>
       <div class="form-group">
  <select name="miesiac" id="">
      <option value="wrzesien">Wrzesień</option>
            <option value="pazdziernik">Październik</option>
            <option value="listopad">Listopad</option>
            <option value="grudzien">Grudzień</option>
            <option value="styczen">Styczeń</option>
            <option value="luty">Luty</option>
            <option value="marzec">Marzec</option>
            <option value="kwiecien">Kwiecień</option>
            <label for="select" class="control-label">Wybierz miesiąc</label><i class="bar"></i>
        </select>
      
    </div>
       <div class="button-container">
    <button type="submit" class="button" name="wyslij"><span>Wyślij</span></button>
  </div>

    </form>
    </div>
</main>
