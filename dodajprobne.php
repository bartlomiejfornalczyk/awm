<?php
require("setup.php");
require("panel.php");
$rok = $_POST['rok'];
$klasa = $_POST['klasa'];
$liczba = $_POST['liczba'];
$miesiac = $_POST['miesiac'];


if ($c->connect_error) {
    die("Brak połączenia: " . $c->connect_error);
}
    
//    $sql = "create table if not exists matura{$rok};";
//    $c->query($sql);
    $c->select_db("matura{$rok}");

    $sql= "create table if not exists {$rok}_{$miesiac}_wyniki_{$klasa} (
    id int primary key,
    wynik float)";
    $c->query($sql);
    for($i=1; $i<=$liczba; $i++) { 
        $c->query("insert into {$rok}_{$miesiac}_wyniki_{$klasa}(id) values ({$i})");
    }
//    echo "Utworzono $podst rekordy<br>";

echo '<main class="main-dflex"><h2 class="informacja">Dodawanie klasy '.$klasa.'</h2><div class="container"><form action="wpiszprobne.php" method="post">';
    $result = $c->query("select id from {$rok}_{$miesiac}_wyniki_{$klasa}");
    while ($r = $result->fetch_assoc())  {
        echo "<div class='form-group'><input type='number' step='0.1' max='100' name='wynik[]'> <label for='input' class='control-label'>Wynik nr ".$r["id"]."</label><i class='bar'></i></div>";
    }
    echo '<input type="hidden" value="'.$rok.'" name="rok" />';
    echo '<input type="hidden" value="'.$klasa.'" name="klasa" />';
    echo '<input type="hidden" value="'.$miesiac.'" name="miesiac" />';
    echo '<div class="button-container"><button type="submit" class="button" name="wyslij"><span>Wyślij</span></button></div></form></div>';


?>

    