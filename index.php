<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>DDBMS</title>
    <!-- Include script.js file -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</head>

<body>
    <div class="header">
        <div id="item1">
            <form method="post">
                <select name="selection" id="selection" onchange="this.form.submit()">
                    <option value="all" <?php if(isset($_POST['selection']) && $_POST['selection']=='all'){echo 'selected';} ?>>ALL MOVIES</option>
                    <option value="before" <?php if(isset($_POST['selection']) && $_POST['selection']=='before'){echo 'selected';} ?>>Movies before 1980</option>
                    <option value="after" <?php if(isset($_POST['selection']) && $_POST['selection']=='after'){echo 'selected';} ?>>Movies after 1980</option>
                </select>
            </form>
        </div>
    </div>

    <div id="search">
        <input type="text" placeholder="Search.." height="50px">
    </div>

    <div id="data">
        <table>
            <tr>
                <th>Title</th>
                <th>Year</th>
                <th>Genre</th>
                <th>Director</th>
                <th>Actor</th>
            </tr>

            <?php
            require_once 'db.php'; // Include the db.php file for database configurations

            if (isset($_POST['selection'])) {
                if ($_POST['selection'] == 'before') {
                    $sql = "SELECT * FROM trimmed_node_2";
                } elseif ($_POST['selection'] == 'after') {
                    $sql = "SELECT * FROM trimmed_node_3";
                } else {
                    $sql = "SELECT * FROM trimmed_node_1";
                }
            } else {
                // Default selection value
                $sql = "SELECT * FROM trimmed_node_1";
            }

            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error);
            }

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                      <td>" . $row["title"] . "</td>
                      <td>" . $row["year"] . "</td>
                      <td>" . $row["genre"] . "</td>
                      <td>" . $row["actor"] . "</td>
                      <td>" . $row["director"] . "</td>
                      <td><button id='delete' onclick='deleteRow(" . $row["id"] . ")'>x</button></td>
                    </tr>";
            }
            ?>

            <tr>
                <td><input type="text" id="title" placeholder="Enter Title"></td>
                <td><input type="text" id="year" placeholder="Enter Year"></td>
                <td><input type="text" id="genre" placeholder="Enter Genre"></td>
                <td><input type="text" id="director" placeholder="Enter Director"></td>
                <td><input type="text" id="actor" placeholder="Enter Actor"></td>
                <td><button id="add" onclick="addRow()">Add</button></td>
            </tr>
          </table>
    </div>
</body>
</html>
