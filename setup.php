<?php
    $s="localhost";
    $u="matura";
    $p="matura";
    $c = new mysqli($s, $u, $p);
    $c->select_db("matura");
// header('Cache-Control: no cache'); //no cache
// session_cache_limiter('private_no_expire'); // works
?>

