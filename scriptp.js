$(document).ready(function () {
    $('#libraryForm').on('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        // Fetch form data
        const formData = $(this).serialize();

        // Send data to the PHP file using AJAX
        $.ajax({
            url: 'processp.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                $('body').html(response); // Replace page content with server response
            },
            error: function () {
                alert('An error occurred. Please try again.');
            }
        });
    });
});
