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
    <link rel="stylesheet" href="stylesheets/index.css">
    <link rel="icon" type="image/gif/png" href="favicon.png">
    <title>To-Do List</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-tasks d-inline-block" width="30" height="30" alt="Image brand"></i>
                To-Do List
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="todo.html">To-Do List</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h1 class="text-center mb-4" id="welcome">Welcome to Your Dashboard!</h1>

    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="container progress-bars px-0">
                    <label for="incomplete">Incompleted Tasks: <span id="numIncompleteTasks"></span></label>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                            role="progressbar" id="incomplete"><span id="incompletePercent"></span></div>
                    </div>
                    <label for="complete">Completed Tasks: <span id="numCompletedTasks"></span></label>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                            role="progressbar" id="complete"><span id="completedPercent"></span></div>
                    </div>
                </div>
                <p class="mb-3">
                    Total number of tasks: <span id="totalNumTasks"></span>
                </p>
                <div id="piechart"></div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-8 offset-2 px-0" style="background-color: #eee;">
                        <div class="d-flex justify-content-end pt-2 bg-white" align="right">
                            <div id="completedTab">
                                <p class="m-0">Completed</p>
                            </div>
                            <div id="incompletedTab" class="active">
                                <p class="m-0">Upcoming</p>
                            </div>
                        </div>
                        <div>
                            <div id="completedTasks" class="d-none">
                            </div>
                            <div id="incompletedTasks" class="d-block">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mustache.js/3.1.0/mustache.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        $(document).ready(function () {
            $("#welcome").hide().fadeIn('slow');

            // Number of completed and incompleted tasks
            var completedTasks = 0;
            var incompletedTasks = 0;

            // Get tasks
            $.ajax({
                type: 'GET',
                url: 'api/tasks.php',
                dataType: 'json',
                success: function (tasks) {
                    $.each(tasks, function (index, task) {
                        if (task.complete) {
                            $('#completedTasks').append(createTaskItem(task.task,
                                completedTasks % 2));
                            completedTasks++;
                        } else {
                            $('#incompletedTasks').append(createTaskItem(task.task,
                                incompletedTasks % 2));
                            incompletedTasks++;
                        }
                    });
                    // Update text fields for completed tasks, incompleted tasks, and total tasks
                    $('#numCompletedTasks').text(completedTasks);
                    $('#numIncompleteTasks').text(incompletedTasks);
                    $('#totalNumTasks').text(tasks.length);

                    // Update progress bars
                    var incompletePercent = Math.round((incompletedTasks / tasks.length) * 100);
                    var completedPercent = 100 - incompletePercent;
                    $('#incompletePercent').text(incompletePercent.toString() + '%');
                    $('#completedPercent').text(completedPercent.toString() + "%");
                    $('#incomplete').css('width', incompletePercent.toString() + '%');
                    $('#complete').css('width', completedPercent.toString() + '%');
                },
                error: function () {
                    alert('Error loading tasks');
                }
            });

            function createTaskItem(task, order) {
                return order == 1 ?
                    `<div class="task-item text-primary" style="background-color: #ebebeb;"><p class="m-0"><a href="todo.html">${task}</a></p></div>` :
                    `<div class="task-item text-primary" style="background-color: #f5f5f5;"><p class="m-0"><a href="todo.html">${task}</a></p></div>`
            }

            $('#completedTab').on("click", function () {
                $('#completedTab').addClass('active');
                $('#incompletedTab').removeClass('active');

                $('#completedTasks').addClass('d-block');
                $('#completedTasks').removeClass('d-none');
                $('#incompletedTasks').addClass('d-none');
                $('#incompletedTasks').removeClass('d-block');
            })

            $('#incompletedTab').on("click", function () {
                $('#incompletedTab').addClass('active');
                $('#completedTab').removeClass('active');

                $('#incompletedTasks').addClass('d-block');
                $('#incompletedTasks').removeClass('d-none');
                $('#completedTasks').addClass('d-none');
                $('#completedTasks').removeClass('d-block');
            })

            // Load google charts
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            // Draw the chart and set the chart values
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Status', 'Number of tasks'],
                    ['Completed tasks', completedTasks],
                    ['Incompleted tasks', incompletedTasks]
                ]);

                // Optional; add a title and set the width and height of the chart
                var options = {
                    'title': 'Tasks status',
                    'width': 650,
                    'height': 400
                };

                // Display the chart inside the <div> element with id="piechart"
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        });
    </script>
</body>

</html>