<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>DDBMS</title>
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
                $hostname="127.0.0.1";
                $dbName = "mco2_imdb_database";
                $port = "51559";

                $connection = mysqli_init();
                //$connection->ssl_set(NULL, NULL, $ssl, NULL, NULL);
                $connection->real_connect($hostname, '', '', $dbName, $port);

                if ($connection->connect_error) {
                  die("Connection failed: " . $connection->connect_error);
                }

                if (isset($_POST['selection'])) {
                    if ($_POST['selection'] == 'before') {
                        $sql = "SELECT * FROM mco2_imdb_database.trimmed_node_2";
                    } elseif ($_POST['selection'] == 'after') {
                        $sql = "SELECT * FROM mco2_imdb_database.trimmed_node_3";
                    } else {
                        $sql = "SELECT * FROM mco2_imdb_database.trimmed_node_1";
                    }
                }
                else {
                  // Default selection value
                  $sql = "SELECT * FROM mco2_imdb_database.trimmed_node_1";
                }

                    $result = $connection->query($sql);

                    if(!$result) {
                      die("Invalid query: " . $connection->error);
                    }

                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>
                      <td>" . $row["title"] . "</td>
                      <td>" . $row["year"] . "</td>
                      <td>". $row["genre"] . "</td>
                      <td>" . $row["actor"] . "</td>
                      <td>" . $row["director"] . "</td>
                      <td><button id='delete'>x</button></td>
                    </tr>";
                  
                    }
                

            ?>

              <tr>
                <td><input type="text" placeholder="Enter Title"></td>
                <td><input type="text" placeholder="Enter Year"></td>
                <td><input type="text" placeholder="Enter Genre"></td>
                <td><input type="text" placeholder="Enter Director"></td>
                <td><input type="text" placeholder="Enter Actor"></td>
                <td><button id="add">Add</button></td>
              </tr>
          </table>
    </div>
</body>
</html>
