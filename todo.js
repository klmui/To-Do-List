$(document).ready(function(){
    var taskTemplate = $("#taskListTemplate").html();

    // Mark tasks as complete
    var completeButtons = $(".complete");
    completeButtons.on("click", function () {
        $(this).parent().parent().parent().find("span.title").toggleClass("completed");
    });

    // Get tasks
    $.ajax({
        type: 'GET',
        url: '/api/tasks.php',
        dataType: 'json',
        success: function(tasks) {
            console.log(tasks);
            $.each(tasks, function(index, task){
                addTask(task);
            });
        },
        error: function() {
            alert('Error loading orders');
        }
    }); 

    // Add a task to the to-do list and JSON file
    $('#submitForm').on('click', function() {
        $.ajax({
            type: 'POST',
            url: '/api/posts.php',
            data: {
                task: $('#taskName').val()
            },
            success: function(newTask) {
                console.log(newTask);
                parsedData = JSON.parse(newTask);
                addTask(newTask);
            },
            error: function() {
                alert('Error saving order');
            }
        });
    });


    // Helper method to add item to the to-do list
    function addTask(task) {
        $('#tasks').append(Mustache.render(taskTemplate, task));
    }
});
