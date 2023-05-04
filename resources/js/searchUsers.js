$(document).ready(function() {
    $('#searchForm').submit(function(event) {
        event.preventDefault();

        var search = $('input[name="SearchFriends"]').val();
    
        $.ajax({
            url: '../controllers/SearchUsersController.php',
            type: 'POST',
            data: { search: search },
            success: function(response) {
                $('#results').html(response);
            }
        });
    });
});