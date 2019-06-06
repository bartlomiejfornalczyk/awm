<?php
require("panel.php");
require("setup.php");
$klasa = $_GET['klasa'];
echo "<main class='main-dflex'>";
?>
<div class="container">
    <p>Czy na pewno chcesz usunąć klasę <?=$klasa?>?</p>
    <form action="" method="post">
    <div class="form-radio ">
              <div class="radio">
                     <label>
                            <input type="radio" value="tak" name="radio" checked ><i class="helper"></i>
                            Tak
                     </label>
              </div>
       </div>
       <div class="form-radio ">
              <div class="radio">
                     <label>
                            <input type="radio" value="nie" name="radio"  ><i class="helper"></i>
                            Nie
                     </label>
              </div>
       </div>
       <div class="button-container">
    <button type="submit" class="button" name="wyslij"><span>Wyślij</span></button>
  </div>
    </form>
</div>
<?php
if(isset($_POST['wyslij']))
{
    if($_POST['radio']=='tak')
    {
        $result = $c->query("drop table $klasa");
        header("location: search.php");
    }
    else
    {
        header("location: search.php");
    } 
}
?>
