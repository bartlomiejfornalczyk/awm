<?php
require("panel.php");
require("setup.php");
$rok = $_POST['rok'];
$miesiac = $_POST['miesiac'];
$name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
$c->query("drop table {$rok}_{$miesiac}_wyniki_klas");
$i=0;
?>
<main>
    <table>
        <tr>
            <th></th>

            <?php
            $select = null;
        while ($klasa = $name->fetch_array())  {
        $result[$i]= $c->query("select * from $klasa[0] where wynik<0.3");
        $overall[$i] = $c->query("select id from $klasa[0]");
            
        $select .= $klasa[0]." ";
        echo "<th>";
        echo substr($klasa[0], 21);
        echo "</th>";
        $i++;
        }
            
            
            $sel = explode(" ", $select);
            $ile = count($sel);
//            $c->query("create table if not exists wyniki_klas(wynik float)");
//            $c->query("drop {$rok}_{$miesiac}_wyniki_klas");
            $sql = "create table {$rok}_{$miesiac}_wyniki_klas(wynik float) ";
//            $c->query($sql);
        
            for($i = 0; $i<$ile-1; $i++)
            {
                $sql.="select wynik from $sel[$i] union all ";
                
            }
            $sql = substr($sql, 0, -10);
//            echo $sql.'<br>';
//            echo $sql;
            $c->query($sql);

            
        
        ?>
            <th>ZSE</th>

        </tr>
        <tr>
            <td>Zdałoby</td>

            <?php
        for($j = 0; $j<$i; $j++)
        {
            $x[$j] = $result[$j]->num_rows;
            $y[$j] = $overall[$j]->num_rows;
            $pro[$j] = round(($x[$j]/$y[$j])*100, 2);
            echo "<td>";
            echo 100-$pro[$j];
            echo "%</td>";
        }
        ?>
            <?php
            $result = $c->query("select count(wynik) as result from {$rok}_{$miesiac}_wyniki_klas where wynik<0.3");
            $overall = $c->query("select count(wynik) as overall from {$rok}_{$miesiac}_wyniki_klas");
            $result = $result->fetch_array();
            $overall = $overall->fetch_array();
            $wynik = round(($result['result']/$overall['overall']*100), 2);
        
               echo "<td>";
                echo 100-$wynik ;
                echo "%</td>"; 
            
//            $oke = $c->query("select * from {$rok}_oke");
//            while($row = $oke->fetch_assoc())
//            {
//            
//                
//                echo "<td>";
//                echo $row['oke'];
//                echo "%</td>"; 
//                
//                echo "<td>";
//                echo $row['ote'];
//                echo "%</td>";
//                
//                echo "<td>";
//                echo $row['kraj'];
//                echo "%</td>";
//                        
//                echo "<td>";
//                echo $row['krajt'];
//                echo "%</td>";
//            }
        ?>
        </tr>
        <tr>
            <td>Nie zdałoby</td>
            <?php for($j = 0; $j<$i; $j++)
        {
            echo "<td>";
            echo $pro[$j];
            echo "%</td>";
        }
        ?>

            <?php
            $zse = 100-$wynik;
                echo "<td>";
                
                echo $wynik;
                echo "%</td>";

//            $oke = $c->query("select * from {$rok}_oke");
//            while($row = $oke->fetch_assoc())
//            {
//
//                
//                echo "<td>";
//                $ok = $row['oke'];
//                echo 100-$row['oke'];
//                echo "%</td>"; 
//                
//                echo "<td>";
//                echo 100-$row['ote'];
//                echo "%</td>";
//                
//                echo "<td>";
//                $kraj = $row['kraj'];
//                echo 100-$row['kraj'];
//                echo "%</td>";
//                        
//                echo "<td>";
//                $krajt = $row['krajt'];
//                echo 100-$row['krajt'];
//                echo "%</td>";
//                
//                
//                $podst = $row['podst'];
//                $roz = $row['rozsz'];
//            }
        ?>
        </tr>
    </table>
    <?php
//    #############################################   Wnioski
//    if($zse > $ok){
//        echo '<p class="wniosek zdawalnosc">Zdawalność uczniów technikum ZSE jest wyższa w porównaniu z wynikami matury uczniów wszystkich szkół w województwie łódzkim';
//            if($zse > $kraj)
//            {
//                echo ' jak i w kraju</p>';
//                echo '<p class="roznica"> W porównaniu z wynikami uczniów z technikum w kraju - o ';
//                echo $zse-$krajt."% wyższa zdawalność</p>";
//            }
//        
//    }
//    else
//    {
//        echo '<p>Zdawalność uczniów technikum ZSE jest niższa w porównaniu z wynikami matury uczniów wszystkich szkół w województwie łódzkim';
//        if($kraj > $zse)
//            {
//                echo ' jak i w kraju</p>';
//                echo '<p class="roznica"> W porównaniu z wynikami uczniów z technikum w kraju - różnica o ';
//                echo $zse-$krajt."%</p>";
//            }
//    }
    ############################################
    ?>

    <br>
    <hr>
    <br>
    <?php 
    ############################################
//    echo "Do egzaminu maturalnego  z  matematyki  na  poziomie rozszerzonym w ZSE przystąpiło $roz uczniów. Wynik  z poziomu  rozszerzonego  nie decydował o zdawalności egzaminu maturalnego.";								
    ############################################
    ?>

    <table>
        <tr>
            <th></th>

            <?php
            #####################
            $i=0;
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    $result = $c->query("select round(avg(wynik), 4) as avg from $k[0]");    
                    $x[$i] = $result->fetch_assoc();
            
                    echo "<th>";
                    echo substr($k[0], 21);
                    echo "</th>";
                    $i++; 
        }  
            #####################
        ?>

            <th>ZSE</th>


        </tr>
        <tr>
            <td>Procenty</td>
            <?php
            
        for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
           
            print_r($x[$j]['avg'] * 100);
             echo '%</td>';
        }

            $xdd = $c->query("select round(avg(wynik), 4) as avg from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $xdd->fetch_array())
            {
            $zse = $row['avg'];
            echo "<td>" . 100*$row['avg'] . "%</td>";
            }
            echo '<tr><td>Punkty</td>';
        for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
           
            print_r($x[$j]['avg'] * 100 * 0.5);
             echo '</td>';
        }

            $xdd = $c->query("select round(avg(wynik), 4) as avg from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $xdd->fetch_array())
            {
                
                echo "<td>" . 50*$row['avg'] . "</td>";
            }
//            $oke = $c->query("select * from {$rok}_oke");
//            while($row = $oke->fetch_assoc())
//            {
//                
//                echo "<td>";
//                echo $row['aoke'];
//               
//                echo "%</td>"; 
//                
//                echo "<td>";
//                $ao = $row['aote'];
//                echo $row['aote'];
//                echo "%</td>";
//                
//                echo "<td>";
//              
//                echo $row['akraj'];
//                echo "%</td>";
//                        
//                echo "<td>";
//             
//                echo $row['akrajt'];
//                $ak = $row['akrajt'];
//                echo "%</td>";
//                
//                
//            
//            }
        ?>

        </tr>
    </table>
    <br><br>
    <hr>
    <br>





    <!--WYKRES-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            packages: ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Punkty', 'Osoby'],
                <?php  
                    $result = $c->query("SELECT round(wynik*0.5*100) as pkt, COUNT(*) AS ilosc FROM {$rok}_{$miesiac}_wyniki_klas GROUP BY pkt ORDER BY pkt");
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["pkt"]."', ".$row["ilosc"]."],";  
                          }  
                          ?>
            ]);
            var options = {
                title: 'Wyniki matury w punktach w ZSE',
                width: 1000,
                height: 400,
                hAxis: {
                    title: 'Liczba punktów',
                },
                vAxis: {
                    format: '#',
                    title: 'Liczebność'

                }
            };
            var chart = new google.visualization.ColumnChart(document.querySelector('.pieChart'));
            chart.draw(data, options);
        }

    </script>

    <div class="pieChart"></div>
    <!--WYKRES-->
    <br>
    <br>
    <hr>
    <table>
        <tr>
            <th></th>

            <?php
            #####################
            $i=0;
            $w = null;
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    $result = $c->query("select round(avg(wynik), 3) as avg from $k[0]");    
                    $w[$i] = $result->fetch_assoc();
            
                    echo "<th>";
                    echo substr($k[0],21);
                    echo "</th>";
                    $i++; 
        }  
            #####################
        ?>

            <th>ZSE</th>

        </tr>
        <tr>
            <td>Średnia</td>
            <?php
            
        for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
           
            print_r($w[$j]['avg'] * 100 * 0.5);
             echo '</td>';
        }
            $sel = explode(" ", $select);
            $ile = count($sel);
//            $c->query("create table if not exists wyniki_klas(wynik float)");
           
           $c->query("use {$rok}_{$miesiac}_wyniki_klas");
        
            for($i = 0; $i<$ile-1; $i++)
            {
                $sql.="select wynik from $sel[$i] union all ";
            }
            $sql = substr($sql, 0, -10);
            $c->query($sql);
//            $xd = $result->fetch_array();
            $xdd = $c->query("select round(avg(wynik), 3) as avg from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $xdd->fetch_array())
            {
                
                echo "<td>" . 50*$row['avg'] . "</td>";
            }
            
        ?>
        </tr>
        <tr>
            <td>Mediana</td>


            <?php
            #####################
            
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select median(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['median(wynik)'];
                    echo round($mediana * 0.5 * 100, 3);
                    echo '</td>';
                }  
            #####################
            $wklas = $c->query("select median(wynik) as md from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $wklas->fetch_array())
            {
                echo '<td>';
                $mediana = $row['md'];
                    echo round($mediana * 0.5 * 100, 3);
                 echo '</td>';
            }?>

        <tr>
        <tr>
            <td>Dominanta</td>


            <?php
            #####################
            
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("SELECT stats_mode(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['stats_mode(wynik)'];
                    echo round($mediana * 0.5  *100, 3);
                    echo '</td>';
                }  
            #####################
            $wklas = $c->query("select stats_mode(wynik) from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $wklas->fetch_array())
            {
                echo '<td>';
                 $mediana = $row['stats_mode(wynik)'];
                    echo round($mediana * 0.5  * 100, 3);
                 echo '</td>';
            }?>
        <tr>
        <tr>
            <td>Rozstęp</td>


            <?php
            #####################
            
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select round(max(wynik),2) - round(min(wynik),2) as rozstep from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['rozstep'];
                    echo round($mediana * 0.5  *100, 3);
                    echo '</td>';
                }  
            #####################

            $wklas = $c->query("select round(max(wynik),2) - round(min(wynik),2) as rozstep from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $wklas->fetch_array())
            {
                echo '<td>';
                 $mediana = $row['rozstep'];
                    echo round($mediana * 0.5  * 100, 3);
                 echo '</td>';
            }?>
        <tr>

            <td>Maksimum</td>
            <?php
            #####################
            $i=0;
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    $result = $c->query("select round(max(wynik), 2) as max from $k[0]");    
                    $l[$i] = $result->fetch_assoc();
                    $i++; 
        }  
            #####################
           
            
            for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
                $max = explode(".", ($l[$j]['max'] * 0.5 * 100));
//                $max = substr(($l[$j]['max'] * 0.5 * 100), 0, 2);
                print_r($max[0]);
             echo '</td>';
        }
            $zse = $c->query("select round(max(wynik), 2) as max from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $zse->fetch_array())
            {
                $max = explode(".", 50*$row['max']);
                echo "<td>";
                print_r($max[0]);
                echo "</td>";
            }
            ?>

        </tr>
        <tr>
            <td>Minimum</td>
            <?php
            #####################
            $i=0;
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    $result = $c->query("select round(min(wynik), 2) as max from $k[0]");    
                    $l[$i] = $result->fetch_assoc();
                    $i++; 
        }  
            #####################
        ?>
            <?php
            
            for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
           
                $max = explode(".", ($l[$j]['max'] * 0.5 * 100));
                print_r($max[0]);
             echo '</td>';
        }
            $zse = $c->query("select round(min(wynik), 2) as max from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $zse->fetch_array())
            {
                
                echo "<td>" . substr(50*$row['max'], 0, 2) . "</td>";
            }
            ?>
        </tr>
        <tr>
            <td>Odchylenie standardowe</td>


            <?php
            #####################
            
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['stddev(wynik)'];
                    echo round($mediana * 0.5  *100, 2);
                    echo '</td>';
                }  
            #####################
            $zse = $c->query("select stddev(wynik) from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $zse->fetch_array())
            {
                echo '<td>';
                $mediana = $row['stddev(wynik)'];
                echo round($mediana * 0.5  *100, 2);
                echo '</td>';
            }
            
?>
        <tr>
        <tr>
            <td>Typowy przedział zmienności</td>


            <?php
            #####################
            
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    echo '<td>(';
                    $result = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['avg(wynik)-stddev(wynik)'];
                    $mediana2 = $result['avg(wynik)+stddev(wynik)'];
                    echo round($mediana * 0.5  * 100, 2);
                    echo '; ';
                    echo round($mediana2 * 0.5  *100, 2);
                    echo ')</td>';
                }  
            #####################
            $zse = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $zse->fetch_array())
            {
                echo '<td>(';
               $mediana = $row['avg(wynik)-stddev(wynik)'];
                    $mediana2 = $row['avg(wynik)+stddev(wynik)'];
                    echo round($mediana * 0.5  *100, 2);
                    echo '; ';
                    echo round($mediana2 * 0.5  *100, 2);
                    echo ')</td>';
            }
?>
        <tr>
            <!--
        <tr>
            <td>Średnia - odchylenie</td>


            <?php
            #####################
            
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select avg(wynik)-stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['avg(wynik)-stddev(wynik)'];
                    echo round($mediana * 0.5  *100, 2);
                    echo '</td>';
                }  
            #####################
                        $zse = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $zse->fetch_array())
            {
                echo '<td>';
               $mediana = $row['avg(wynik)-stddev(wynik)'];
                    echo round($mediana * 0.5  *100, 2);
                    echo '</td>';
            }
?>
        <tr>
        <tr>
            <td>Średnia + odchylenie</td>


            <?php
            #####################
            
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select avg(wynik)+stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['avg(wynik)+stddev(wynik)'];
                    echo round($mediana * 0.5  *100, 2);
                    echo '</td>';
                }  
            #####################
                                    $zse = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $zse->fetch_array())
            {
                echo '<td>';
               $mediana = $row['avg(wynik)+stddev(wynik)'];
                    echo round($mediana * 0.5  *100, 2);
                    echo '</td>';
            }
?>
        <tr>
-->

    </table>
    <br>
    <br>
    <hr>
    <!--    DANE PROCENTOWE-->
    <table>
        <tr>
            <th></th>

            <?php
            #####################
            $i=0;
            $w = null;
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    $result = $c->query("select round(avg(wynik), 4) as avg from $k[0]");    
                    $w[$i] = $result->fetch_assoc();
            
                    echo "<th>";
                    echo substr($k[0], 21);
                    echo "</th>";
                    $i++; 
        }  
            #####################
        ?>

            <th>ZSE</th>


        </tr>
        <tr>
            <td>Średnia</td>
            <?php
            
        for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
           
            print_r($w[$j]['avg'] * 100);
             echo '</td>';
        }

            $xdd = $c->query("select round(avg(wynik), 4) as avg from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $xdd->fetch_array())
            {
                
                echo "<td>" . 100*$row['avg'] . "</td>";
            }
        
        ?>
        </tr>
        <tr>
            <td>Mediana</td>


            <?php
            #####################
            
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select median(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['median(wynik)'];
                    echo round($mediana * 100, 3);
                    echo '</td>';
                }  
            #####################
            $wklas = $c->query("select median(wynik) as md from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $wklas->fetch_array())
            {
                echo '<td>';
                $mediana = $row['md'];
                    echo round($mediana* 100, 3);
                 echo '</td>';
            }?>

        <tr>
        <tr>
            <td>Dominanta</td>


            <?php
            #####################
            
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("SELECT stats_mode(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['stats_mode(wynik)'];
                    echo round($mediana *100, 3);
                    echo '</td>';
                }  
            #####################
            $wklas = $c->query("select stats_mode(wynik) from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $wklas->fetch_array())
            {
                echo '<td>';
                 $mediana = $row['stats_mode(wynik)'];
                    echo round($mediana * 100, 3);
                 echo '</td>';
            }?>
        <tr>
        <tr>
            <td>Rozstęp</td>


            <?php
            #####################
            
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select round(max(wynik),2) - round(min(wynik),2) as rozstep from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['rozstep'];
                    echo round($mediana *100, 3);
                    echo '</td>';
                }  
            #####################

            $wklas = $c->query("select round(max(wynik),2) - round(min(wynik),2) as rozstep from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $wklas->fetch_array())
            {
                echo '<td>';
                 $mediana = $row['rozstep'];
                    echo round($mediana * 100, 3);
                 echo '</td>';
            }?>
        <tr>

            <td>Maksimum</td>
            <?php
            #####################
            $i=0;
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    $result = $c->query("select round(max(wynik), 2) as max from $k[0]");    
                    $l[$i] = $result->fetch_assoc();
                    $i++; 
        }  
            #####################
           
            
            for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
                $max = explode(".", ($l[$j]['max'] * 100));
//                $max = substr(($l[$j]['max'] * 0.5 * 100), 0, 2);
                print_r($max[0]);
             echo '</td>';
        }
            $zse = $c->query("select round(max(wynik), 2) as max from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $zse->fetch_array())
            {
                $max = explode(".", 100*$row['max']);
                echo "<td>";
                print_r($max[0]);
                echo "</td>";
            }
            ?>

        </tr>
        <tr>
            <td>Minimum</td>
            <?php
            #####################
            $i=0;
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    $result = $c->query("select round(min(wynik), 2) as max from $k[0]");    
                    $l[$i] = $result->fetch_assoc();
                    $i++; 
        }  
            #####################
        ?>
            <?php
            
            for($j = 0; $j<$i; $j++)
        {
            echo '<td>';
           
                $max = explode(".", ($l[$j]['max']* 100));
                print_r($max[0]);
             echo '</td>';
        }
            $zse = $c->query("select round(min(wynik), 2) as max from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $zse->fetch_array())
            {
                
                echo "<td>" . substr(100*$row['max'], 0, 2) . "</td>";
            }
            ?>
        </tr>
        <tr>
            <td>Odchylenie standardowe</td>


            <?php
            #####################
            
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['stddev(wynik)'];
                    echo round($mediana *100, 2);
                    echo '</td>';
                }  
            #####################
            $zse = $c->query("select stddev(wynik) from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $zse->fetch_array())
            {
                echo '<td>';
                $mediana = $row['stddev(wynik)'];
                echo round($mediana *100, 2);
                echo '</td>';
            }
            
?>
        <tr>
        <tr>
            <td>Typowy przedział zmienności</td>


            <?php
            #####################
            
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    echo '<td>(';
                    $result = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['avg(wynik)-stddev(wynik)'];
                    $mediana2 = $result['avg(wynik)+stddev(wynik)'];
                    echo round($mediana *100, 2);
                    echo '; ';
                    echo round($mediana2 *100, 2);
                    echo ')</td>';
                }  
            #####################
            $zse = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $zse->fetch_array())
            {
                echo '<td>(';
               $mediana = $row['avg(wynik)-stddev(wynik)'];
                    $mediana2 = $row['avg(wynik)+stddev(wynik)'];
                    echo round($mediana *100, 2);
                    echo '; ';
                    echo round($mediana2 *100, 2);
                    echo ')</td>';
            }
?>
        <tr>
            <!--
        <tr>
            <td>Średnia - odchylenie</td>


            <?php
            #####################
            
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select avg(wynik)-stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['avg(wynik)-stddev(wynik)'];
                    echo round($mediana *100, 2);
                    echo '</td>';
                }  
            #####################
                        $zse = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $zse->fetch_array())
            {
                echo '<td>';
               $mediana = $row['avg(wynik)-stddev(wynik)'];
                    echo round($mediana *100, 2);
                    echo '</td>';
            }
?>
        <tr>
        <tr>
            <td>Średnia + odchylenie</td>


            <?php
            #####################
            
            $name = $c->query("SHOW TABLES FROM `matura` WHERE `Tables_in_matura` LIKE '{$rok}_{$miesiac}_wyniki_%' and `Tables_in_matura` not LIKE '{$rok}_{$miesiac}_wyniki_klas'");
                while ($k = $name->fetch_array())  {
                    echo '<td>';
                    $result = $c->query("select avg(wynik)+stddev(wynik) from $k[0]");    
                    $result= $result->fetch_array();
                    $mediana = $result['avg(wynik)+stddev(wynik)'];
                    echo round($mediana *100, 2);
                    echo '</td>';
                }  
            #####################
                                    $zse = $c->query("select avg(wynik)-stddev(wynik), avg(wynik)+stddev(wynik) from {$rok}_{$miesiac}_wyniki_klas");
            while($row = $zse->fetch_array())
            {
                echo '<td>';
               $mediana = $row['avg(wynik)+stddev(wynik)'];
                    echo round($mediana *100, 2);
                    echo '</td>';
            }
?>
        <tr>
-->

    </table>
    <?php
    $result = $c->query("SELECT round(wynik*0.5*100) as pkt, COUNT(*) AS ilosc FROM {$rok}_{$miesiac}_wyniki_klas GROUP BY pkt ORDER BY pkt desc");
    $result=$result->fetch_assoc();
//    print_r($result);
//    echo $result['pkt'] $result['ilosc'];
    echo "<p>Najwyższym wynikiem był wynik {$result['pkt']} punktów (" . 2*$result['pkt'] . "%) - {$result['ilosc']} osób</p>";
?>



</main>
