<style>
body {
    padding-top: 25px;
    text-align: center;
    font-size: 160%;
    font-family: Arial, Helvetica, sans-serif;
    color: black;
}
</style>
<?php
     /* 
    * TOTD - Decide who will be...! Ticketflipper of the Day
    * Author: Sjors101 <https://github.com/sjors101/>, 22/08/2017
    */

    include_once 'db_connect.php';
    
    $dateToday = date("Y-m-d");
    $yesterday = date('Y-m-d', strtotime('-1 day', strtotime($dateToday)));
    $dateLast = "2050-01-01";
    $postName=$_POST['postName'];
    $checkB=$_POST['checkB'];

    $queryEmployee = db_select("SELECT name, active, lastdate, count FROM employee where active='1' ORDER BY lastdate");

    foreach($queryEmployee as $row){
        // check for active victim today
        if ($row["lastdate"] == $dateToday) {
            $currentTF = $row["name"];
        }        
        elseif ($row["lastdate"] < $dateLast) {
            $dateLast = $row["lastdate"];
            $oldestTF = $row["name"];
            $count = $row["count"];
        }
    }
    
#if inactive    
    if ($checkB == 1){
        if ($postName == $currentTF){
            echo "$currentTF is set inactive</br>";
            db_query("UPDATE employee SET active='0' WHERE name='$postName'");
            
            echo "$oldestTF is the new ticketflipper";
            db_query("UPDATE employee SET lastdate='$dateToday' WHERE name='$oldestTF'");            
        }
        else{
            echo "$postName is set inactive";
            db_query("UPDATE employee SET active='0' WHERE name='$postName'");           
        }
    }
# point new ticketflipper    
    else{
        if ($postName == $currentTF){
            echo "$currentTF is already ticketflipper";
        }
        else{
            echo "$currentTF is removed from ticketflipper duty</br>";
            db_query("UPDATE employee SET lastdate='$yesterday' WHERE name='$currentTF'");            
            echo "$postName is the new ticketflipper";
            db_query("UPDATE employee SET lastdate='$dateToday', active='1' WHERE name='$postName'");
        }
    }
?>
