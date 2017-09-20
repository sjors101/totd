<html>
<head>
<meta http-equiv="refresh" content="500">
<!--TOTD - Decide who will be...! Ticketflipper of the Day
Author: Sjors101 <https://github.com/sjors101/>, 22/08/2017-->
<style>
body {
    padding-top: 15px;
    text-align: center;
    font-size: 160%;
    font-family: Arial, Helvetica, sans-serif;
    color: black;
}
a {
    color: black;
    text-decoration: none;
}
</style>
</head>
<body>

<a href="http://localhost:3080/totd//change_totd.php" target="_blank">TOTD:</a>
<?php
include_once 'db_connect.php';

function isWeekend($date) {
    return (date('N', strtotime($date)) >= 6);
}

$dateToday = date("Y-m-d");
$dateLast = "2050-01-01";

$queryEmployee = db_select("SELECT name, active, lastdate, count FROM employee where active='1' ORDER BY lastdate");

foreach($queryEmployee as $row){
    if ($row["lastdate"] == $dateToday) {
        echo $row["name"];
        die();
    }
    elseif ($row["lastdate"] != $dateToday) {      
        if ($row["lastdate"] < $dateLast) {
            $dateLast = $row["lastdate"];
            $victim = $row["name"];
            $count = $row["count"];
        }
    }   else {
    echo "0 results";
    }
}

# if everyone is inactive
if (!($queryEmployee)){
    echo "Nobody :(";   
}

// updating lastdate
$count = $count+1;
if ($dateLast < $dateToday and !(isWeekend($dateToday))){
    $query = db_query("UPDATE employee SET lastdate='$dateToday', count='$count' WHERE name='$victim'");
}
print ($victim);
?>

</body>
</html>
