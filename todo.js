$(document).ready(function(){
    // Mark tasks as complete
    var completeButtons = $(".complete");
    completeButtons.on("click", function () {
        $(this).parent().parent().parent().find('span.title').toggleClass("completed");
    });

    // Add item to the to-do list
    $("#addTaskForm").submit(function (event) {
        event.preventDefault();
        var task = $("#taskName").val();
        // Post request 
        $.post("./items.php", 
        // Data sent
        {
            task: task
        },
        function(res, status) {
            console.log('res', res); 
            console.log('status', status); 
            var data = JSON.parse(res);
            $("#taskAccordion").append(
                "<div class='card'><div class='card-header' id='headingOne'><h2 class='mb-0'><button class='title-btn btn btn-link' type='button' data-toggle='collapse' data-target='#collapseOne'aria-expanded='true' aria-controls='collapseOne'>" +
                data.task +
                "</button></h2></div><div id='collapseOne' class='collapse show' aria-labelledby='headingOne' data-parent='#taskAccordion'><div class='card-body'><button class='btn btn-primary complete'>Complete</button><button class='btn btn-danger'>Delete</button></div></div></div>"
            );
            $("#taskName").val(""); // Reset title input

            // Add task to JSON file here. Call last id method

        });
    });
    // Get last id in json 
    // $.getJSON('tasks.json', function(taskData){
    //     console.log(taskData[0]['id']);
    // });
});
