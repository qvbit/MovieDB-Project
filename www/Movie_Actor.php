	<?php include('nav.php') ?>

    <div class="container">
            <h3>Add Movie/Actor Relation</h3><hr>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                <?php
                    $db = new mysqli('localhost', 'cs143', '', 'CS143');
                    if($db->connect_errno > 0){
                        die('Unable to connect to database [' . $db->connect_error . ']');
                    }

                    $temp1 = $db->query("SELECT CONCAT(title,' ','(',year,')') AS MovieName, id FROM Movie;");
                    if (!$temp1) {
                        echo ("<br>Failed query<br>");
                        exit(-1);
                    }

                    $temp2 = $db->query("SELECT CONCAT(first, ' ', last,' ', '(', dob, ')')AS ActorName, id, dob FROM Actor ORDER BY last ASC;");
                    if (!$temp2) {
                        echo ("<br>Failed query<br>");
                        exit(-1);
                    }

                    $db->close();
                ?>

                <div class="form-group">
                    <label for="movie">Movie Title</label>
                    <select class="form-control" name="movie">
                        <option value=""> </option>
                        <?php
                            if($temp1->num_rows>0){
                                while($row = $temp1->fetch_assoc()){
                        ?>
                            <option value = <?php echo $row["id"] ?>> <?php echo $row["MovieName"] ?></option>
                        <?php       }
                            }else{
                        ?>
                            <option>None</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="actor">Actor</label>
                    <select class="form-control" name="actor">
                        <option value=""> </option>
                        <?php
                            if($temp2->num_rows>0){
                                while($row = $temp2->fetch_assoc()){
                        ?>
                            <option value = <?php echo $row["id"] ?>> <?php echo $row["ActorName"] ?></option>
                        <?php       }
                            }else{
                        ?>
                            <option>None</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="role">Role:</label>
                    <input type="text" class="form-control" name="role"><br>
                </div>

                    <button type="submit" class="btn btn-default">Add!</button>
            </form>
            <?php

                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if(empty($_POST["movie"])){
                        echo ("<br>Movie is empty<br>");
                        exit(-1);
                    }
                    else{
                        $mov = $_POST["movie"];
                    }
                    if(empty($_POST["actor"])){
                        echo ("<br>Actor is empty<br>");
                        exit(-1);
                    }
                    else{
                        $act = $_POST["actor"];
                    }
                    if(empty($_POST["role"])){
                        echo ("<br>Role is empty<br>");
                        exit(-1);
                    }
                    else{
                        $role = $_POST["role"];
                    }
                }

                if($mov && $act && $role){
                    $db = new mysqli('localhost', 'cs143', '', 'CS143');
                    if($db->connect_errno > 0){
                        die('Unable to connect to database [' . $db->connect_error . ']');
                    }

                    if(!$db->query("INSERT INTO MovieActor VALUES ('$mov', '$act', '$role');")){
                        echo ("<br>Failed Insert<br>");
                        exit(-1);
                    }

                    echo ("<br>Succefully Insert</br>");

                    $db->close();
                }
            ?>
        
    </div>

    <script src="layout/jquery.js"></script>
    <script src="layout/bootstrap.min.js"></script>

</body>
</html>