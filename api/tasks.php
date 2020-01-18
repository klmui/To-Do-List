<?php
    // Get the type of the request
    $method = $_SERVER['REQUEST_METHOD'];

    // Handle GET request to return all tasks
    if ($method == 'GET') {
        $jsonData = file_get_contents('../tasks.json');
        echo $jsonData;
    }

    // Handle POST request
    // 'title' is from the post request, not the name of the input
    // if (isset($_POST['task'])) {
    //     $task = $_POST['task'];
    //     if ($task == '') {
    //         die(error('Error: No title'));
    //     }
    //     echo json_encode(createNewTask($task));
    // } 
    
    // Add task to JSON file
    function createNewTask(String $task) {
        $response = array();

        // Create the response
        $response["id"] = getId();
        $response['task'] = $task;
        $response['complete'] = false;

        // Get data from existing json file, convert it, and push data
        $jsonData = file_get_contents('tasks.json');
        $arr_data = json_decode($jsonData, true);
        array_push($arr_data, $response);
        $jsonData = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents('tasks.json', $jsonData);
        return $response;
    }

    // Get last id here
    function getId() {
        $arr = file_get_contents('tasks.json');
        $arr = json_decode($arr, true); // decode the JSON into an associative array
        $lastId = $arr[count($arr) - 1]['id'];
        return $lastId + 1; // Increments id
    }

     // Function to print out error messages to the console
     function error($msg) {
        $response = array("success" => false, "message" => $msg);
        return json_encode($response);
    }
?>