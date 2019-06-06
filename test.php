<?php
require("panel.php");
require("setup.php");
$rok = '2018';
    if(isset($_POST['wyslij']))
    {
        $rok = $_POST['rok'];
        $zse = $_POST['zse'];
        $cke = $_POST['cke'];
        $oke = $_POST['oke'];
        $y = 1;
        for($i=0; $i<5; $i++)
            {
                
    $c->query("update {$rok}_standardy set zse = $zse[$i]/100  where id = $y");
    $c->query("update {$rok}_standardy set oke = $oke[$i]/100  where id = $y");
    $c->query("update {$rok}_standardy set cke = $cke[$i]/100  where id = $y");
    $y++;
}
header("location: pokazlatwosc.php");    
}

    ?>