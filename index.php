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
            <select name="selection" id="selection">
                <option value="all">ALL MOVIES</option>
                <option value="before">Movies before 1980</option>
                <option value="after">Movies after 1980</option>
            </select>
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
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "mco2";

                $connection = new mysqli($servername, $username, $password, $database);

                if ($connection->connect_error) {
                  die("Connection failed: " . $connection->connect_error);
                }

                $sql = "SELECT * FROM MCO2.node_1 WHERE id < 20";
                $result = $connection->query($sql);

                if(!$result) {
                  die("Invalid query: " . $connection->error);
                }

                while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                  <td>" . $row["id"] . "</td>
                  <td>" . $row["year"] . "</td>
                  <td>". $row["genre"] . "</td>
                  <td>" . $row["actor"] . "</td>
                  <td>" . $row["director"] . "</td>
                  <td><button id='delete'>x</button></td>
                </tr>";
              
                }

            ?>


            <tr>
              <td>#28</td>
              <td>2002</td>
              <td>Not Available</td>
              <td>Jeff Jingle</td>
              <td>Greg Fritzpatrick</td>
              <td><button id="delete">x</button></td>
            </tr>
            <tr>
              <td>#7 Train: An Immigrant Journey, The</td>
              <td>2000</td>
              <td>Documentary</td>
              <td>Hye Jung Park</td>
              <td>Not Available</td>
              <td><button id="delete">x</button></td>
            </tr>
            <tr>
                <td>$</td>
                <td>1971</td>
                <td>Comedy</td>
                <td>Richard (I) Brooks</td>
                <td>Darrell (I) Armstrong</td>
                <td><button id="delete">x</button></td>
              </tr>
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