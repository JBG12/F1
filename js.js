$(document).ready(function(){
    // Click anywhere on website to remove notification message.
    $("body").on('click', function () {
        // Remove notification.
        $('.msg').remove();
    });

    // base_url = 'http://ergast.com/api/f1/';
    // year = 2022;
    // round = 'last';
    // url = base_url . year +'/'+ round +'/results.json';
    // json = file_get_contents(url);
    // // Decode the json data.
    // f1_data = json_decode(json, TRUE);
    // // Set base link (so it always gets MRData since its always used).
    // f1_data_base = f1_data['MRData'];
    // number_one = '';
    // for (i=0;i<20;i++) {
    //     if (number_one == f1_data_baseA['RaceTable']['Races'][0]['Results'][i]['Driver']['driverId']) {
    //         $number_one = "S";
    //     }
    // }
});