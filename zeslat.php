<?php require("panel.php");
require("setup.php");
$rok = $_POST['rok'];
$c->query("create table if not exists {$rok}_standardy(id int primary key, zse float, cke float, oke float)");
for($i=1; $i<=5; $i++)
{
    $c->query("insert into {$rok}_standardy(id) values ($i)");
}
$result = $c->query("select id from {$rok}_standardy");
?>

<main class="main-dflex">
<h2 class="informacja">Dane łatwości standardów</h2>
<div class="formularz container">
    <form action="test.php" method="post" class="input-form">
    <?php
    while($r = $result->fetch_array())
    {
echo '<div class="form-group">';
echo '<input type="number" min="0" max="100" step="1"  name="zse[]" required>';
echo '<label for="input" class="control-label">ZSE dla '.$r[0].' standardu</label><i class="bar"></i></div>';
echo '<div class="form-group">';
echo '<input type="number" min="0" max="100" step="1"  name="cke[]" required>';
echo '<label for="input" class="control-label">CKE dla '.$r[0]. ' standardu</label><i class="bar"></i></div>';
echo '<div class="form-group">';
echo '<input type="number" min="0" max="100" step="1"  name="oke[]" required>';
echo '<label for="input" class="control-label">OKE dla '.$r[0]. ' standardu</label><i class="bar"></i></div>';
    }
    
?>
<input type="hidden" value="<?=$rok?>" name="rok">
       <div class="button-container">
    <button type="submit" class="button" name="wyslij"><span>Wyślij</span></button>
  </div>
    </form>
    </div>
    