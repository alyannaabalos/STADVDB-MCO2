<?php
require_once 'db.php'; // Include the db.php file for database configurations

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Prepare and bind parameters for the SQL statement
    $stmt = $connection->prepare("DELETE FROM trimmed_node_1 WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        // Log the error message to a file or database
        error_log("Error: " . $stmt->error);

        // Display a generic error message to the user
        echo "Error: Failed to delete record";
    }

    // Close the prepared statement
    $stmt->close();
    // Note: The database connection is not closed here, as it may be used for other queries in the same request
}
?>
