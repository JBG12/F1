<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="f1.css">
    <link rel="icon" type="images/x-icon" href="images/F1_logo2.svg">
    <title>Formule 1</title>
</head>
</head>
<?php include('data.php'); ?>
<body>
<?php include('header.php'); ?>
<div class="content">
<?php

if (empty($_SESSION['UID'])) {
    echo '<h1 class="notLogged">Login om deze pagina te bezoeken</h1>';
} else {
    echo '<h1 class="notLogged"> Bekijk hier al je voorspellingen </h1>';
    $UID = $_SESSION['UID'];
    $query = "SELECT * FROM voorspellingen WHERE userID='$UID' ORDER BY date DESC";
    $result = mysqli_query($db, $query);
    echo '<h2 class="dark">Komende races:</h2>';
    while($row = $result->fetch_assoc()) {
        $base_url = 'http://ergast.com/api/f1/';
            $year = 2022;
            $round = 'last';
            $url = $base_url . $year .'/'. $round .'/results.json';
            $f1_data_base = get_url_info($url);
        // If the date of the race has not happend yet, dont display result of predict, just show what the user predicted.
        if ($row['date'] > date("Y-m-d")) {
            echo '<div class="raceV">';
            echo '<h2> De '.$row['race'].'</h2>';
            echo '<p>Jouw voorspellingen voor deze race:</p>';
            
            // Here I 'replace' the ID name of every racer to there first name and family name for proper display.
            $first_user = ' ';
            $second_user = ' ';
            $third_user = ' ';
            $fourth_user = ' ';
            $fifth_user = ' ';
            $fastest_user = ' ';
            for ($i=0;$i<20;$i++) {
                if ($row['first'] == $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
                    $first_user = $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'];
                }
                if ($row['second'] == $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
                    $second_user = $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'];
                }
                if ($row['third'] == $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
                    $third_user = $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'];
                }
                if ($row['fourth'] == $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
                    $fourth_user = $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'];
                }
                if ($row['fifth'] == $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
                    $fifth_user = $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'];
                }
                if ($row['fastest'] == $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
                    $fastest_user = $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'];
                }
            }
            echo '<p class="nr1">#1 '.$first_user.'</p>';
            echo '<p class="nr2">#2 '.$second_user.'</p>';
            echo '<p class="nr3">#3 '.$third_user.'</p>';
            echo '<p class="nr3">#4 '.$fourth_user.'</p>';
            echo '<p class="nr3">#5 '.$fifth_user.'</p>';
            echo '<br />';
            echo '<p> Jouw voorspelling voor de snelste ronde: </p>';
            echo '<p>'.$fastest_user.'</p>';
            echo '</div>';
        } else {
            echo '<h2 class="dark">Vorige races:</h2>';
            echo '<div class="raceV">';
            echo '<h2> De '.$row['race'].'</h2>';
            echo '<p>Jouw voorspellingen voor deze race:</p>';
            $base_url = 'http://ergast.com/api/f1/';
            $year = 2022;
            $round = $row['round'];
            $url = $base_url . $year .'/'. $round .'/results.json';
            $f1_data_base = get_url_info($url);

            // Here I do the same thing for races that have already been; get a better display name.
            $first_user = ' ';
            $second_user = ' ';
            $third_user = ' ';
            $fourth_user = ' ';
            $fifth_user = ' ';
            $fastest_user = ' '; 
            for ($i=0;$i<20;$i++) {
                if ($row['first'] == $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
                    $first_user = $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'];
                }
                if ($row['second'] == $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
                    $second_user = $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'];
                }
                if ($row['third'] == $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
                    $third_user = $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'];
                }
                if ($row['fourth'] == $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
                    $fourth_user = $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'];
                }
                if ($row['fifth'] == $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
                    $fifth_user = $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'];
                }
                if ($row['fastest'] == $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
                    $fastest_user = $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'];
                }
            }

            if ($f1_data_base['RaceTable']['Races'][0]['Results'][0]['Driver']['driverId'] == $row['first']) {
                echo '<div class="check good"></div>';
            } else {
                echo '<div class="check false">('.$f1_data_base['RaceTable']['Races'][0]['Results'][0]['Driver']['driverId'].') </div>';
            }
            echo '<p class="nr1">#1 '.$first_user.'</p>';

            if ($f1_data_base['RaceTable']['Races'][0]['Results'][1]['Driver']['driverId'] == $row['second']) {
                echo '<div class="check good"></div>';
            } else {
                echo '<div class="check false">('.$f1_data_base['RaceTable']['Races'][0]['Results'][1]['Driver']['driverId'].') </div>';
            }
            echo '<p class="nr2">#2 '.$second_user.'</p>';

            if ($f1_data_base['RaceTable']['Races'][0]['Results'][2]['Driver']['driverId'] == $row['third']) {
                echo '<div class="check good"></div>';
            } else {
                echo '<div class="check false">('.$f1_data_base['RaceTable']['Races'][0]['Results'][2]['Driver']['driverId'].') </div>';
            }
            echo '<p class="nr3">#3 '.$third_user.'</p>';
            if ($f1_data_base['RaceTable']['Races'][0]['Results'][3]['Driver']['driverId'] == $row['fourth']) {
                echo '<div class="check good"></div>';
            } else {
                echo '<div class="check false">('.$f1_data_base['RaceTable']['Races'][0]['Results'][3]['Driver']['driverId'].') </div>';
            }
            echo '<p class="nr3">#4 '.$fourth_user.'</p>';
            if ($f1_data_base['RaceTable']['Races'][0]['Results'][4]['Driver']['driverId'] == $row['fifth']) {
                echo '<div class="check good"></div>';
            } else {
                echo '<div class="check false">('.$f1_data_base['RaceTable']['Races'][0]['Results'][4]['Driver']['driverId'].') </div>';
            }
            echo '<p class="nr3">#3 '.$fifth_user.'</p>';
            echo '<br />';
            echo '<p> Jouw voorspelling voor de snelste ronde: </p>';
            echo '<p>'.$fastest_user.'</p>';
            for ($i=0;$i<20;$i++) {
                if ($f1_data_base['RaceTable']['Races'][0]['Results'][$i]['FastestLap']['rank'] == 1) {
                    $fastest_racer = $f1_data_base['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId'];
                }
            }
            if ($row['fastest'] == $fastest_racer) {
                echo '<div class="check good last"></div>';
            } else {
                echo '<div class="check false last">('.$fastest_racer.') </div>';
            }
            echo '</div>';
        }
    }
}

?>
</div>
</body>
</html>