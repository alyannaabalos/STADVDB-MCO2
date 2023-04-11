<?php
require_once 'db.php'; // Include the db.php file for database configurations

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $year = $_POST['year'];
    $genre = $_POST['genre'];
    $director = $_POST['director'];
    $actor = $_POST['actor'];

    // Check if title is not empty
    if (!empty($title)) {
        // Check if other attributes are empty and set default values if necessary
        if (empty($year)) {
            $year = null;
        }
        if (empty($genre)) {
            $genre = null;
        }
        if (empty($director)) {
            $director = null;
        }
        if (empty($actor)) {
            $actor = null;
        }

        // Get the current highest ID from the table
        $query = "SELECT MAX(id) as max_id FROM trimmed_node_1";
        $result = $connection->query($query);
        $row = $result->fetch_assoc();
        $next_id = $row['max_id'] + 1;

        // Prepare and bind parameters for the SQL statement
        $stmt = $connection->prepare("INSERT INTO trimmed_node_1 (id, title, year, genre, director, actor) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $next_id, $title, $year, $genre, $director, $actor);

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "New record added successfully";
        } else {
            // Log the error message to a file or database
            error_log("Error: " . $stmt->error);

            // Display a generic error message to the user
            echo "Error: Failed to add new record";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        // Display an error message to the user
        echo "Error: Title cannot be empty";
    }
}
?>
