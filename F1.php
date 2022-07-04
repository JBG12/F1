<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="f1.css">
    <link rel="icon" type="images/x-icon" href="images/F1_logo2.svg">
    <title>Formule 1</title>
</head>
<?php include('data.php'); ?>
<body>
<?php include('header.php'); ?>
    <div class="content">
        <div class="races">
        
    
<?php


/*========================================================================
  Display races
/*=======================================================================*/
$year = 2022;

$round = 'next';

// Get API url where we get the data from
$base_url = 'http://ergast.com/api/f1/';
$url = $base_url . $year .'/'. $round .'.json';
$f1_data_base = get_url_info($url);
// $round_url = $base_url . $year . '.json';
// $get_round = get_url_info($round_url);

// Display next race
echo '<p class="title"> Volgende race</p>';
echo '<div class="race">';
    echo '<h2> De ' . $f1_data_base['RaceTable']['Races'][0]['raceName'] .' '. $f1_data_base['RaceTable']['Races'][0]['season'] . '</h2>';
    echo '<p class="date">'. $f1_data_base['RaceTable']['Races'][0]['date'] .'</p>';
    echo '<p> Op het ' . $f1_data_base['RaceTable']['Races'][0]['Circuit']['circuitName'] .' in '. $f1_data_base['RaceTable']['Races'][0]['Circuit']['Location']['country'] . '</p>';
    if (!empty($_SESSION['UID'])) {
        echo '<form action="F1.php" method="POST">';
        echo '<button name="openPredict" class="predict"> Voorspellen </button>';
        echo '</form>';
    }
    if (isset($_POST['openPredict'])) {
        echo '<div class="submitMenu">';
            echo '<form action="F1.php" method="POST">';
                echo '<div class="boxOne">';
                echo '<div class="box">';
                echo '<p class="label"> Wie word #1?</p>';
                echo '<select name="number_one" class="number" required>';
                    $round = 'last';
                    $url = $base_url . $year .'/'. $round .'/results.json';
                    $f1_data_base2 = get_url_info($url);
                    for ($i=0;$i<20;$i++) {
                        echo '<option value="'. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId'] .'">'. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'] .'</option>';
                    }
                echo '</select>';
                echo '</div>';
                echo '<div class="box">';
                echo '<p class="label"> Wie word #2?</p>';
                echo '<select name="number_two" class="number" required>';
                    for ($i=0;$i<20;$i++) {
                        echo '<option value="'. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId'] .'">'. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'] .'</option>';
                    }
                echo '</select>';
                echo '</div>';
                echo '<div class="box">';
                echo '<p class="label"> Wie word #3?</p>';
                echo '<select name="number_three" class="number" required>';
                    for ($i=0;$i<20;$i++) {
                        echo '<option value="'. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId'] .'">'. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'] .'</option>';
                    }
                echo '</select>';
                echo '</div>';
                echo '<div class="box">';
                echo '<p class="label"> Wie word #4?</p>';
                echo '<select name="number_four" class="number" required>';
                    for ($i=0;$i<20;$i++) {
                        echo '<option value="'. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId'] .'">'. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'] .'</option>';
                    }
                echo '</select>';
                echo '</div>';
                echo '<div class="box">';
                echo '<p class="label"> Wie word #5?</p>';
                echo '<select name="number_five" class="number" required>';
                    for ($i=0;$i<20;$i++) {
                        echo '<option value="'. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId'] .'">'. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'] .'</option>';
                    }
                echo '</select>';
                echo '</div>';
                echo '<div class="box">';
                echo '<p class="label"> Wie zal de snelse ronde zetten? </p>';
                echo '<select name="fastest" class="number" required>';
                    for ($i=0;$i<20;$i++) {
                        echo '<option value="'. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId'] .'">'. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName'] .' '. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName'] .'</option>';
                    }
                echo '</select>';
                echo '</div>';
                echo '</div>';
                $round = $f1_data_base['RaceTable']['round'];
                echo '<input name="round" type="hidden" value="'. $round .'">';
                $race_name = $f1_data_base['RaceTable']['Races'][0]['raceName'];
                echo '<input name="race_name" type="hidden" value="'. $race_name .'">';
                $race_date = $f1_data_base['RaceTable']['Races'][0]['date'];
                echo '<input name="race_date" type="hidden" value="'. $race_date .'">';
                echo '<input value="Voorspellen" type="submit" name="predict" class="predict">';
            echo '</form>';
        echo '</div>';
    }
echo '</div>';

$round = 'last';
$year = '2022';
// Get API url where we get the data from
$base_url = 'http://ergast.com/api/f1/';
// Url for 
$url = $base_url . $year .'/results.json?limit=300';
$url_new = get_url_info($url);
$url_new_two = $url_new['RaceTable']['Races'];
// We do the race count minus one to not display the next race (the race that has not happend yet and thus has no results).
$races_count = count($url_new_two) - 1;
// Display previous races and there results.
echo '<p class="title"> Vorige races</p>';
// Loop through all the races in reverse. We go from the highest (ID) race (aka the newest race, which result a user would want to see first) to the lowest (ID) race.
for ($i=$races_count;$i>0;$i--) {
echo '<div class="race">';
    echo '<h2> De ' . $url_new_two[$i]['raceName'] .'</h2>';
    echo '<p class="date">'. $url_new_two[$i]['date'] .'</p>';
    echo '<p> Op het ' . $url_new_two[$i]['Circuit']['circuitName'] .' in '. $url_new_two[$i]['Circuit']['Location']['country'];
    echo '<div class="pos"><p class="nr1"> #1 </p> <p>'. $url_new_two[$i]['Results'][0]['Driver']['givenName'].' '. $url_new_two[$i]['Results'][0]['Driver']['familyName'] . ' in ' . $url_new_two[$i]['Results'][0]['Time']['time'] . '</p></div>';
    echo '<div class="pos"><p class="nr2"> #2 </p> <p>'. $url_new_two[$i]['Results'][1]['Driver']['givenName'].' '. $url_new_two[$i]['Results'][1]['Driver']['familyName'] . ' in ' . $url_new_two[$i]['Results'][1]['Time']['time'] . '</p></div>';
    echo '<div class="pos"><p class="nr3"> #3 </p> <p>'. $url_new_two[$i]['Results'][2]['Driver']['givenName'].' '. $url_new_two[$i]['Results'][2]['Driver']['familyName'] . ' in ' . $url_new_two[$i]['Results'][2]['Time']['time'] . '</p></div>';
    echo '<div class="pos"><p class="nr3"> #4 </p> <p>'. $url_new_two[$i]['Results'][3]['Driver']['givenName'].' '. $url_new_two[$i]['Results'][3]['Driver']['familyName'] . ' in ' . $url_new_two[$i]['Results'][3]['Time']['time'] . '</p></div>';
    echo '<div class="pos"><p class="nr3"> #5 </p> <p>'. $url_new_two[$i]['Results'][4]['Driver']['givenName'].' '. $url_new_two[$i]['Results'][4]['Driver']['familyName'] . ' in ' . $url_new_two[$i]['Results'][4]['Time']['time'] . '</p></div>';
echo '</div>';
}

?>
        </div>
    </div>
    <?php 
    $base_url = 'http://ergast.com/api/f1/';
    $url_two = $base_url . $year .'/'. 2 .'/results.json';
    $json2 = file_get_contents($url_two);
    // Decode the json data.
    $f1_data2 = json_decode($json2, TRUE);

    // echo '<pre>';
    // var_dump($f1_data2);
    // echo '</pre>';
    ?>
</body>
</html>