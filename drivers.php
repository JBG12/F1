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
$base_url = 'http://ergast.com/api/f1/';
$round = 'last';
$year = '2022';
$url = $base_url . $year .'/'. $round .'/results.json';
$f1_data_base2 = get_url_info($url);

echo '<h2 class="dark center"> Overzicht van alle Racers </h2>';
echo '<div class="labels">';
    echo '<p class="driver dark"> Naam </p>';
    echo '<p class="driver dark"> Geboortedatum </p>';
    echo '<p class="driver dark"> Constructor </p>';
echo '</div>';
echo '<div class="drivers">';
for ($i=0;$i<20;$i++) {
    echo '<div class="driverBox">';
        // echo '<p class="driver">'.$f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName']. ' '. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName']. ' | '.
        // $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['dateOfBirth'] . ' | ' .  $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Constructor']['name'] .'</p>';
        echo '<p class="driver">'.$f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['givenName']. ' '. $f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['familyName']. '</p>';
        echo '<p class="driver">'.$f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Driver']['dateOfBirth'] . '</p>';
        echo '<p class="driver">'.$f1_data_base2['RaceTable']['Races'][0]['Results'][$i]['Constructor']['name'] .'</p>';
    echo '</div>';
}
echo '</div>';

?>
        </div>
    </div>