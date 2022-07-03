<?php
/*========================================================================
  Databse Connection ect
/*=======================================================================*/
// Start Session
session_start();

/*========================================================================
  Decode and get information from API as an object array
/*=======================================================================*/
function get_url_info($url) {
    // Get file contents from the json url.
    $json = file_get_contents($url);
    // Decode the json data.
    $f1_data = json_decode($json, TRUE);
    // Set base link (so it always gets MRData since its always used).
    $f1_data_base = $f1_data['MRData'];
    return $f1_data_base;
}

// Database connection values.
$db = mysqli_connect('localhost', 'root', '', 'f1');

// Login User
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    $query = "SELECT * FROM gebruikers WHERE email='$email' AND password='$password'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['UID'] = $user['ID'];
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
        ?>
        <script>
            $(document).ready(function(){
            $(".buttonLogout").before('<p> Je bent ingelogd </p>');
            });
        </script>
        <?php
    } else {
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
        ?>
        <script>
            $(document).ready(function(){
            $(".login").before('<p class="test2"> E-mail of wachtwoord verkeerd ingevuld </p>');
            });
        </script>
        <?php
    }
}
// Destroy users session.
if (isset($_POST['uitlog'])) {
    session_destroy();
    unset($_SESSION['UID']);
    header('location: F1.php');
    echo "<p class='msg'>Je bent uitgelogd</p>";
}
if (isset($_POST['uitlog'])) {
    ?>
    <script>
        $(document).ready(function(){
        $(".login form").append('<p> Je bent ingelogd </p>');
        });
    </script>
    <?php
}
/*========================================================================
  Predict race result
/*=======================================================================*/
if (isset($_POST['predict'])) {
    $base_url = 'http://ergast.com/api/f1/';
    $year = 2022;
    $round = 'last';
    $url = $base_url . $year .'/'. $round .'/results.json';
    $f1_data_baseA = get_url_info($url);

    $number_one     = '';
    $number_two     = '';
    $number_three   = '';
    $number_four    = '';
    $number_five    = '';
    $fastest        = '';
    $race           = '';
    $race_date      = '';
    $round          = '';
    // Checks here to make sure the posted value isn't changed to something else(for exampe there own name or SQL code) 
    // we loop through the name ID's of the existing drivers to see if the input matches one. 
    for ($i=0;$i<20;$i++) {
        if (mysqli_real_escape_string($db, $_POST['number_one']) == $f1_data_baseA['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
            $number_one = mysqli_real_escape_string($db, $_POST['number_one']);
        }
        //
        if (mysqli_real_escape_string($db, $_POST['number_two']) == $f1_data_baseA['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
            $number_two = mysqli_real_escape_string($db, $_POST['number_two']);
        }
        //
        if (mysqli_real_escape_string($db, $_POST['number_three']) == $f1_data_baseA['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
            $number_three = mysqli_real_escape_string($db, $_POST['number_three']);
        }
        //
        if (mysqli_real_escape_string($db, $_POST['number_four']) == $f1_data_baseA['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
            $number_four = mysqli_real_escape_string($db, $_POST['number_four']);
        }
        //
        if (mysqli_real_escape_string($db, $_POST['number_five']) == $f1_data_baseA['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
            $number_five = mysqli_real_escape_string($db, $_POST['number_five']);
        }
        //
        if (mysqli_real_escape_string($db, $_POST['fastest']) == $f1_data_baseA['RaceTable']['Races'][0]['Results'][$i]['Driver']['driverId']) {
            $fastest = mysqli_real_escape_string($db, $_POST['fastest']);
        }
    }
    if (mysqli_real_escape_string($db, $_POST['round']) == ($f1_data_baseA['RaceTable']['round'] + 1)) {
        $round = mysqli_real_escape_string($db, $_POST['round']);
    }
    
    $user_id    = $_SESSION['UID'];
    $race       = mysqli_real_escape_string($db, $_POST['race_name']);
    $race_date  = mysqli_real_escape_string($db, $_POST['race_date']);

    if ((!empty($number_one)) && (!empty($number_two)) && (!empty($number_three)) && (!empty($number_four)) && (!empty($number_five)) && (!empty($fastest))) {
        $line = "INSERT INTO voorspellingen (userID, race, round, first, second, third, fourth, fifth, fastest, date) 
        VALUES ('$user_id', '$race', '$round', '$number_one', '$number_two', '$number_three', '$number_four', '$number_five', '$fastest', '$race_date')";
        mysqli_query($db, $line);
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
        ?>
        <script>
            $(document).ready(function(){
            $(".predict").after('<p class="pMSG"> Je voorspelling is opgeslagen. </p>');
            });
        </script>
        <?php
    } else {
        echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
        ?>
        <script>
            $(document).ready(function(){
            $(".predict").after('<p class="pMSG"> Voorspelling is niet opgeslagen; Ingevulde waarde was ongeldig. </p>');
            });
        </script>
        <?php
    }
}

?>