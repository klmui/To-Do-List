$(function(){
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
    $('#addTaskForm').submit(function(event) {
        event.preventDefault(); // Prevent page from reloading after submitting
        $taskName = $('#taskName').val();
        if ($taskName != '') {
            $('#add').trigger("click");
            $('#taskName').val('');
        }

        console.log(event);
        $.ajax({
            type: 'POST',
            url: '/api/tasks.php',
            data: {
                task: $taskName
            },
            success: function(newTask) {
                console.log(newTask);
                parsedData = JSON.parse(newTask);
                addTask(parsedData);
            },
            error: function() {
                alert('Error posting task');
            }
        });
    });

    // Delete a task from screen and json file
    $('#tasks').delegate('.remove', 'click', function() {
        // Get li of the task
        var $li = $(this).closest('li');

        $.ajax({
            type: 'DELETE',
            url: '/api/tasks.php/' + $(this).attr('data-id'),
            success: function() {
                // Remove li without refreshing the page
                $li.fadeOut(300, function() {
                    $(this).remove();
                });
            }
        });
    });

    // Update a task on the screen and on the json file
    $('#tasks').delegate('.editOrder', 'click', function() {
        var $li = $(this).closest('li');
        $li.find('input.task').val($li.find('span.task').html()); // Setting input to same as span
        $li.addClass('edit');
    });

    $('#tasks').delegate('.cancelEdit', 'click', function() {
        $(this).closest('li').removeClass('edit');
    });

    $('#tasks').delegate('.saveEdit', 'click', function() {
        var $li = $(this).closest('li');
        var task = $li.find('input.task').val();
        $.ajax({
            type: 'PUT',
            url: '/api/tasks.php/' + $li.attr('data-id'),
            data: {
                task: task
            },
            success: function(newOrder) {
                $li.find('span.task').html(task);
                $li.removeClass('edit');
            },
            error: function() {
                alert('error updating order');
            }
        });  
    });

    // Helper method to add item to the to-do list
    function addTask(task) {
        $('#tasks').append(Mustache.render(taskTemplate, task));
    }
});
