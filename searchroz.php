<?php
require("panel.php");
require("setup.php");

$result = $c->query("show tables like '2%r'");
if($result->num_rows == 0){
    echo "<main><p>Brak klas do wyświetlenia</p>";
}
else
{
echo "<main class=''><ul>";
    while ($r = $result->fetch_array())  {
        echo "<li class='list-item'><a href='klasa.php?klasa={$r[0]}'>{$r[0]}</a><a href='usun.php?klasa={$r[0]}'>Usuń</a></li>";
    }
}

?>
</ul>
</main>
