// Add item to the to-do list
var completeButtons = $(".complete");
completeButtons.on("click", function () {
    $(this).parent().parent().parent().find('button.title-btn').toggleClass("completed");
});

$("#addTaskForm").submit(function (event) {
    event.preventDefault();
    var title = $("#taskName").val();
    $("#accordionExample").prepend(
        "<div class='card'><div class='card-header' id='headingOne'><h2 class='mb-0'><button class='title-btn btn btn-link' type='button' data-toggle='collapse' data-target='#collapseOne'aria-expanded='true' aria-controls='collapseOne'>" +
        title +
        "</button></h2></div><div id='collapseOne' class='collapse show' aria-labelledby='headingOne' data-parent='#accordionExample'><div class='card-body'><button class='btn btn-primary complete'>Complete</button><button class='btn btn-danger'>Delete</button></div></div></div>"
    );
    $(this).trigger("reset");
});