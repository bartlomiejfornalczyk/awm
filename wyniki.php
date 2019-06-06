<?php
$s="localhost";
$u="matura";
$p="matura";
$c = new mysqli($s, $u, $p, "matura2018");
$t = "wyniki_4bte";
$result = $c->query("select * from $t where wynik<0.3");
$overall = $c->query("select id from $t");
$x = $result->num_rows;
$y = $overall->num_rows;
$pro = round(($x/$y)*100, 1);
while ($r = $result->fetch_assoc())  {
        echo "Numer {$r["id"]} nie zdał matury i osiągnął wynik {$r["wynik"]} <br>";        
    }
echo "Stanowi to $pro% wszystkich zdających <br>";
echo 'Zdało: ';
echo 100-$pro."%";




?>
