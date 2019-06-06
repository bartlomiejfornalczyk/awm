<?php
require("panel.php");
require("setup.php");
$rok = $_POST['rok'];

    if(isset($_POST['wyslij']))
    {   
        $wnioski = $_POST['wnioski'];
            $c->query("update {$rok}_podstawa_wnioski set wniosek = CONCAT(IFNULL(wniosek,''), '$wnioski') where id=1");
            header("location: rozrap.php?rok=$rok&submit=#");
        
    }
    if(isset($_POST['podmien']))
    {   
        $wnioski = $_POST['wnioski'];
       
        
            $c->query("update {$rok}_podstawa_wnioski set wniosek = '$wnioski' where id=1");
            header("location: rozrap.php?rok=$rok&submit=#");
        
    }
?>