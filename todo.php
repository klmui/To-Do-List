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
                        <a class="nav-link" href="todo.php">To-Do List <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary" type="button" id="add" data-toggle="collapse" data-target="#addForm"
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
                                placeholder="Task name">
                        </div>
                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-primary add-task-btn" id="submitForm">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <ul class="list-group list-group-flush" id="tasks">
            <!-- To be filled -->
        </ul>
        <template id="taskListTemplate"> 
            <li class="list-group-item">
                <p>
                    <span class="noedit task">{{task}}</span>
                    <input class="edit task"/>
                </p> 
                <button data-id='{{id}}' class='remove'>X</button>
                <button class="editOrder noedit">Edit</button> 
                <button class="saveEdit edit">Save</button> 
                <button class="cancelEdit edit">Cancel</button> 
            </li>
        </template>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
         integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="./todo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.1.0/mustache.js"></script>    </body>
</body>
</html>