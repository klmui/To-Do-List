<?php
    // Get the type of the request
    $method = $_SERVER['REQUEST_METHOD'];

    // Handle GET request to return all tasks
    if ($method == 'GET') {
        $jsonData = file_get_contents('../tasks.json');
        echo $jsonData;
    }

    // Handle POST request
    if ($method == 'POST') {
        $task = $_POST['task']; // 'task' is from the post request
        // TODO check task here
        echo json_encode(createNewTask($task));
    }

    // Handle DELETE request
    if ($method == 'DELETE') {
        // Get data-id
        $id = explode("/", $_SERVER['PHP_SELF'])[3];
        $data = file_get_contents('../tasks.json');
        // decode json to associative array
        $json_arr = json_decode($data, true);
        // get array index to delete
        $arr_index = array();
        foreach ($json_arr as $key => $value) {
            if ($value['id'] == $id) {
                $arr_index = $key;
            }
        }
        // delete data
        unset($json_arr[$arr_index]);
        // rebase array
        $json_arr = array_values($json_arr);
        // encode array to json and save to file
        file_put_contents('../tasks.json', json_encode($json_arr, JSON_PRETTY_PRINT));
    }

    // Handle PUT request
    if ($method == 'PUT') {
        $id = explode("/", $_SERVER['PHP_SELF'])[3];
        $data = file_get_contents('../tasks.json');
        // decode json to associative array
        $json_arr = json_decode($data, true);
         // get array index to update
         $arr_index = array();
         foreach ($json_arr as $key => $value) {
             if ($value['id'] == $id) {
                 $arr_index = $key;
             }
         }
         // update data
        parse_str(file_get_contents("php://input"), $putVars); // Get data sent in
        if (isset($putVars['task'])) {
            $json_arr[$arr_index]['task'] = $putVars['task'];
        }
        if (isset($putVars['complete'])) {
            $doneStatus = $putVars['complete'];
            $json_arr[$arr_index]['complete'] = $doneStatus === 'true' ? true: false;
        }
        // rebase array
        $json_arr = array_values($json_arr);
        // encode array to json and save to file
        file_put_contents('../tasks.json', json_encode($json_arr, JSON_PRETTY_PRINT));
    }
    
    // Add task to JSON file
    function createNewTask(String $task) {
        $response = array();

        // Create the response
        $response["id"] = getId();
        $response['task'] = $task;
        $response['complete'] = false;

        // Get data from existing json file, convert it, and push data to file
        $jsonData = file_get_contents('../tasks.json');
        $arr_data = json_decode($jsonData, true);
        array_push($arr_data, $response);
        $jsonData = json_encode($arr_data, JSON_PRETTY_PRINT);
        file_put_contents('../tasks.json', $jsonData);
        return $response;
    }

    // Get last id here
    function getId() {
        $arr = file_get_contents('../tasks.json');
        $arr = json_decode($arr, true); // decode the JSON into an associative array
        $lastId = $arr[count($arr) - 1]['id'];
        return $lastId + 1; // Increments id
    }
?>