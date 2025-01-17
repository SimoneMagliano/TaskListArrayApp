<?php

require "./lib/JSONReader.php";
require "./lib/searchFunctions.php";

$taskList = JSONReader('./dataset/TaskList.json');

if (isset($_GET['searchText'])) {
    $searchText = trim(filter_var($_GET['searchText'], FILTER_SANITIZE_STRING));
    $taskList = array_filter($taskList, searchText($searchText));
}

if ((isset($_GET['status']))) {
    $status = $_GET['status'];
    $taskList = array_filter($taskList, searchStatus($status));
}

if(isset($_GET['status'])==''){
    $_GET['status']='all';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Taklist</title>
</head>
<body>

    <div class="container-fluid bg-secondary py-3 mb-3 text-light">
        <div class="container">
            <h1 class="display-1">Tasklist</h1>
        </div>
    </div>
 
    <div class="container">

        <form action="./index.php">
            <input type="text" value="<?=  $searchText ?>" name="searchText" >
            <button type="submit">cerca</button>

            <div id="status">

                <input type="radio" name="status" value="progress" id="progress">
                <label for="progress">progress</label>

                <input type="radio" name="status" value="done" id="done">
                <label for="done">done</label>

                <input type="radio" name="status" value="todo" id="todo">
                <label for="todo">todo</label>

                <input type="radio" name="status" value="all" id="all">
                <label for="all">all</label>
            </div>
            </form>
        <div class="input-group pb-3 my-1">
            <label class="w-100 pb-1 fw-bold" for="searchText">Cerca</label>
            <input id="searchText"  type="text" class="form-control" placeholder="attività da cercare">
            <div class="input-group-append">
              <button class="btn btn-primary" type="button">Invia</button>
            </div>
        </div>
        <div id="status-radio" class=" mb-3">
            <div class="fw-bold pe-2 w-100">Stato attività</div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" value="option1">
                <label class="form-check-label" >tutti</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"   value="option1">
                <label class="form-check-label" >da fare</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"   value="option2">
                <label class="form-check-label" >in lavorazione</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio"   value="option2">
                <label class="form-check-label" >fatto</label>
              </div>
        </div>
        <section class="tasklist mt-3">
            <h1 class="fw-bold fs-6">Elenco delle attività</h1>
            <table class="table">
                <tr>
                    <th class="w-100">nome</th>
                    <th class="text-center">stato</th>
                    <th class="text-center">data</th>
                </tr>          
            </table>

        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>