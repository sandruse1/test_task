<?php
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 27.12.2017
 * Time: 11:25
 */

require_once('DB.php');
$db = new DB();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>тестовое задание</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

    <div id="main_div">
        <p id="error_p"></p>
        <div id="search_div">
            <label for="search" >Search</label><br>
            <input id="search" style="margin-top: 5px" type="text" placeholder="client id or name ">
            <button onclick="prepare_data()">Отправить</button>
        </div>
        <div id="checked_div">
            <p>Cтатуса договора :</p>
            <input type="checkbox" name="group1" id="status1" value="work"  />
            <label for="status1">Work</label>
            <input type="checkbox" name="group1" id="status2" value="connecting" />
            <label for="status2">Connecting</label>
            <input type="checkbox" name="group1" id="status3" value="disconnected" />
            <label for="status3">Disconnected</label>
        </div>
    </div>
    <div id="list">
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="main.js"></script>
</body>
</html>