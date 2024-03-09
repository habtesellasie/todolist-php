<?php


$json = file_get_contents('todo.json');
$jsonArray = json_decode($json, true);

$todo_name = $_POST['todo_name'];
unset($jsonArray[$todo_name]);


file_put_contents('todo.json', json_encode($jsonArray, JSON_PRETTY_PRINT));

header("Location: index.php");
