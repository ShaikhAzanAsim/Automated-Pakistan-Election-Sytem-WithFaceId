<?php
    // Delete content of the file
    file_put_contents("last_predicted_cnic.txt", "");

    // Respond with success status
    http_response_code(200);
?>
