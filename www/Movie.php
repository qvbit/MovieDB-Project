
<?php include('nav.php') ?>


    <div class="container">
            <h3>Add new Movie</h3><hr>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" placeholder="Text input" name="title" maxlength=100>
                </div>

                <div class="form-group">
                  <label for="company">Company</label>
                  <input type="text" class="form-control" placeholder="Text input" name="company" maxlength=50>
                </div>

                <div class="form-group">
                  <label for="year">Year</label>
                  <input type="text" class="form-control" placeholder="Text input" name="year">
                </div>

                <div class="form-group">
                    <label for="rating">MPAA Rating</label>
                    <select   class="form-control" name="rating">
                        <option value="G">G</option>
                        <option value="NC-17">NC-17</option>
                        <option value="PG">PG</option>
                        <option value="PG-13">PG-13</option>
                        <option value="R">R</option>
                    </select>
                </div>

                <div class="form-group">
                    <label >Genre:</label>
                    <input type="checkbox" name="genre[]" value="Action">Action</input>
                    <input type="checkbox" name="genre[]" value="Adventure">Adventure</input>
                    <input type="checkbox" name="genre[]" value="Animation">Animation</input>
                    <input type="checkbox" name="genre[]" value="Comedy">Comedy</input>
                    <input type="checkbox" name="genre[]" value="Crime">Crime</input>
                    <input type="checkbox" name="genre[]" value="Documentary">Documentary</input>
                    <input type="checkbox" name="genre[]" value="Drama">Drama</input>
                    <input type="checkbox" name="genre[]" value="Family">Family</input>
                    <input type="checkbox" name="genre[]" value="Fantasy">Fantasy</input>
                    <input type="checkbox" name="genre[]" value="Horror">Horror</input>
                    <input type="checkbox" name="genre[]" value="Musical">Musical</input>
                    <input type="checkbox" name="genre[]" value="Mystery">Mystery</input>
                    <input type="checkbox" name="genre[]" value="Romance">Romance</input>
                    <input type="checkbox" name="genre[]" value="Sci-Fi">Sci-Fi</input>
                    <input type="checkbox" name="genre[]" value="Short">Short</input>
                    <input type="checkbox" name="genre[]" value="Thriller">Thriller</input>
                    <input type="checkbox" name="genre[]" value="War">War</input>
                    <input type="checkbox" name="genre[]" value="Western">Western</input>
                </div>

                <button type="submit" class="btn btn-default">Add!</button>
            </form>

    <script src="layout/jquery.js"></script>
    <script src="layout/bootstrap.min.js"></script>
    
    <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if (empty($_POST['title'])) {
                        echo ("<br>Title is empty<br>");
                        exit(-1);
                    } else {
                        $tit = $_POST['title'];
                    }

                    if (empty($_POST['company'])) {
                        echo ("<br>Company is empty<br>");
                        exit(-1);
                    } else {
                        $cmp = $_POST['company'];
                    }

                    if (empty($_POST['year'])) {
                        echo ("<br>Year is empty<br>");
                        exit(-1);
                    } else {
                        $yr = (int)$_POST['year'];

                        if ($yr < 1000 || $yr > 2100) {
                            echo ("<br> year is not valid<br>");
                            exit(-1);
                        }
                    }

                    if (empty($_POST['rating'])) {
                        $rtg = "G";
                    }else{
                        $rtg = $_POST['rating'];
                    }

                    if (empty($_POST['genre'])) {
                        echo ("<br>Genre is empty<br>");
                        exit(-1);
                    } else {
                        $gen = $_POST['genre'];
                    }
                }

                if ($tit && $cmp && $yr && $rtg && $gen) {
                    $db = new mysqli('localhost', 'cs143', '', 'CS143');
                    if ($db->connect_errno > 0) {
                        die("Unable to connect to database");
                    }

                    $temp = $db->query("SELECT id FROM MaxMovieID;");

                    if (!$temp) {
                        echo("Failed query");
                        exit(-1);
                    }

                    $row = $temp->fetch_assoc();
                    $newId = $row["id"] + 1;

                    if (!$db->query("UPDATE MaxMovieID SET id = id+1;")) {
                        echo ("Failed query ID");
                        exit(-1);
                    }

                    $queryTemp = "INSERT INTO Movie VALUES($newId,'$tit',$yr,'$rtg','$cmp');";
                    foreach ($gen as $key => $value) {
                        $queryTemp .= "INSERT INTO MovieGenre VALUES($newId, '$value');";
                    }

                    if (!$db->multi_query($queryTemp)) {
                        echo ("Failed to insert");
                        exit(-1);
                    }

                    echo ("<br>Successfully insert<br>");
                    
                    $temp->free();
                    $db->close();
                }
            ?>

    </div>
</body>

</html>