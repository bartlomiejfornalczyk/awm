<?php
require("setup.php");

$r = $c->query("show tables");
while($w = $r->fetch_array())
{
    echo $w[0] . "<br>";
}
?>