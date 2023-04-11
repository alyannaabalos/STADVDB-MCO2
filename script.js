$(document).ready(function() {
    $('#add-movie-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serialize();

        // Make an AJAX request to add.php
        $.ajax({
            type: 'POST',
            url: 'add.php',
            data: formData,
            success: function(response) {
                // Display success message
                $('#add-movie-result').html(response);
                form.trigger('reset'); // Reset form
            },
            error: function(xhr, status, error) {
                // Display error message
                $('#add-movie-result').html('Error: ' + error);
            }
        });
    });
});

// Call addRow() function on a click event or any other appropriate event
function addRow() {
    var title = $('#title').val();
    var year = $('#year').val();
    var genre = $('#genre').val();
    var director = $('#director').val();
    var actor = $('#actor').val();

    var formData = new FormData();
    formData.append('title', title);
    formData.append('year', year);
    formData.append('genre', genre);
    formData.append('director', director);
    formData.append('actor', actor);

    // Make an AJAX request to add.php
    $.ajax({
        type: 'POST',
        url: 'add.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            // Refresh the page after successful insertion
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error adding row to database. Status code: ' + xhr.status);
        }
    });
}

// Call deleteRow() function on a click event or any other appropriate event
function deleteRow(id) {
    // Make an AJAX request to remove.php without CSRF token
    $.ajax({
        type: 'POST',
        url: 'remove.php',
        data: {
            id: id
        },
        success: function(response) {
            // Refresh the page after successful deletion
            location.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error deleting row from database. Status code: ' + xhr.status);
        }
    });
}


