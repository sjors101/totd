<style>
body {
    padding-top: 15px;
    text-align: center;
    font-size: 100%;
    font-family: Arial, Helvetica, sans-serif;
    color: black;
}
</style>
<html><body>
<!--TOTD - Decide who will be...! Ticketflipper of the Day
Author: Sjors101 <https://github.com/sjors101/>, 22/08/2017-->
<?php
include_once 'db_connect.php';

$queryEmployee = db_select("SELECT name, active, lastdate, count FROM employee");

echo "<form action=change_action.php method=post>";
echo "Set ticketflipper: <select name='postName'> </br>";

foreach($queryEmployee as $row){
    echo "<option value='" . $row['name'] ."'>" . $row['name'] ."</option>";
}
echo '</select> </br>';
echo 'On inactive: <input type="checkbox" name="checkB" value="1"> </br>';
echo '<input type=submit value="Go">';
echo '</form>'
?>

</body></html>
