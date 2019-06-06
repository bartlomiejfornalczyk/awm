<?php
require("panel.php");
require("setup.php");
?>
<main class="main-dflex">
    <?php
    if(isset($_POST['submit']))
    {
        $rok = $_POST['rok'];
        $ile = $_POST['ile'];
        $czy = $c->query("select * from {$rok}_latwosc");
        if(@$czy->num_rows > 0)
        {
            echo "<p class='warn'>Dane dotyczące łatwości dla roku $rok już istnieją! </p>";
        }
        else
        {
    $c->query("create table if not exists {$rok}_latwosc(id int primary key, zse float, oke float, cke float, standard varchar(10), azse float, aoke float, acke float)");

   
    for($i=1; $i<=$ile; $i++) { $c->query("insert into {$rok}_latwosc(id) values ({$i})");
        }
        // echo "Utworzono $podst rekordy<br>";

        echo '<div class="container" ><form action="wpiszlatwosc.php" method="post" >';
            $result = $c->query("select id from {$rok}_latwosc");
            // var_dump($result);
            while ($r = $result->fetch_assoc()) {
            // echo "{$r["id"]}.<input type='number' step='0.01' placeholder='Łatwość zadania nr {$r["id"]}' name='zse[]'> <input type='number' step='0.01' placeholder='Łatwość OKE' name='oke[]'> <input type='number' step='0.01' placeholder='Łatwość CKE' name='cke[]'> <input type='text' step='1' placeholder='Standard' name='standard[]'><br>";
                echo "<div class='form-group '><input type='number' step='1' max='100' name='zse[]'> <label for='input' class='control-label'>Łatwość zadania nr ".$r["id"]."</label><i class='bar'></i></div><div class='form-group'><input type='number' step='1' max='100' name='cke[]'> <label for='input' class='control-label'>Łatwość CKE</label><i class='bar'></i></div><div class='form-group'><input type='number' step='1' max='100' name='oke[]'> <label for='input' class='control-label'>Łatwość OKE</label><i class='bar'></i></div><div class='form-group'><input type='number' step='1' name='standard[]'> <label for='input' class='control-label'>Standard</label><i class='bar'></i></div>";
                echo '<br>';
            }
            echo 'Łatwość arkusza ';
            echo "<div class='form-group '><input type='number' step='1' max='100' name='azse[]'> <label for='input' class='control-label'>Łatwość arkusza ZSE</label><i class='bar'></i></div><div class='form-group '><input type='number' step='1' max='100' name='aoke[]'> <label for='input' class='control-label'>Łatwość arkusza OKE</label><i class='bar'></i></div><div class='form-group '><input type='number' step='1' max='100' name='acke[]'> <label for='input' class='control-label'>Łatwość arkusza CKE</label><i class='bar'></i></div>";
            echo '<input type="hidden" value="'.$rok.'" name="rok" />';
            echo '<input type="hidden" value="'.$ile.'" name="klasa" />';
           echo '<div class="button-container"><button type="submit" class="button" name="wyslij"><span>Wyślij</span></button></div></form></div>';
        }
    }
        ?>
