<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Awesome-->
    <script src="https://kit.fontawesome.com/92992f5a3f.js" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="todo.css">
    <title>To-Do List</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <i class="fas fa-tasks d-inline-block" width="30" height="30" alt="Image brand"></i>
                Everyday To-Do List
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Dashboard</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="todo.html">To-Do List <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addForm"
                aria-expanded="false" aria-controls="addForm">
                +
            </button>
        </div>
        <div class="collapse" id="addForm">
            <div class="card card-body">
                <form method="post" id="addTaskForm">
                    <div class="form-row align-items-center justify-content-center">
                        <div class="col-sm-9 my-1">
                            <label class="sr-only" for="taskName">Task Name</label>
                            <input type="text" class="form-control" id="taskName" name="taskName"
                                placeholder="Task name" required>
                        </div>
                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-primary add-task-btn">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="accordion" id="accordionExample">
            <?php
                $arr = file_get_contents('tasks.json');
                $arr = json_decode($arr, true); // decode the JSON into an associative array
                for ($i = 0; $i < count($arr); $i++) {
                    $taskName = $arr[$i]['task'];
                    $id = strval($arr[$i]['id']);
                    echo "<div class='card'>
                    <div class='card-header' id='headingOne'>
                        <h2 class='mb-0'>
                            <button class='title-btn btn btn-link' type='button' data-toggle='collapse' data-target='#collapseOne'
                                aria-expanded='true' aria-controls='collapseOne'>
                                $taskName
                            </button>
                        </h2>
                    </div>
    
                    <div id='collapseOne' class='collapse show' aria-labelledby='headingOne'
                        data-parent='#accordionExample'>
                        <div class='card-body'>
                            <button class='btn btn-primary complete'>Complete</button>
                            <button class='btn btn-danger'>Delete</button>
                        </div>
                    </div>
                    </div>";
                }
            ?>
        </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="todo.js"></script>
</body>
</html>