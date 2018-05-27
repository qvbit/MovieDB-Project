<?php include('nav.php') ?>


    <div class="container">
            <h3>Add Movie/Director Relation</h3><hr>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

                <?php
                    $db = new mysqli('localhost', 'cs143', '', 'CS143');
                    if($db->connect_errno > 0){
                        die('Unable to connect to database [' . $db->connect_error . ']');
                    }

                    $temp1 = $db->query("SELECT CONCAT(title,' ','(',year,')') AS MovieName, id FROM Movie;");

                    if(!$temp1){
                        echo ("<br>Failed query<br>");
                        exit(-1);
                    }

                    $temp2 = $db->query("SELECT CONCAT(first, ' ',last, ' ', '(', dob, ')')AS DirectorName, id, dob FROM Director ORDER BY last ASC;");

                    if(!$temp2){
                        echo ("<br>Failed query<br>");
                        exit(-1);
                    }

                    $db->close();
                ?>

                <div class="form-group">
                    <label for="mov">Movie Title</label>
                    <select class="form-control" name="mov">
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
                    <label for="dir">Director</label>
                    <select class="form-control" name="dir">
                        <option value=""> </option>
                        <?php
                            if($temp2->num_rows>0){
                                while($row = $temp2->fetch_assoc()){
                        ?>
                            <option value = <?php echo $row["id"] ?>> <?php echo $row["DirectorName"] ?></option>
                        <?php       }
                            }else{
                        ?>
                            <option>None</option>
                        <?php
                            }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-default">Add!</button>
            </form>


            <?php
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    if(empty($_POST['mov'])){
                        echo ("<br>Movie title is empty<br>");
                        exit(-1);
                    }else{
                        $mov = $_POST['mov'];
                    }
                    if(empty($_POST['dir'])){
                        echo ("<br>Director is empty<br>");
                        exit(-1);
                    }else{
                        $dir = $_POST['dir'];
                    }
                }

                if($mov && $dir){
                    $db = new mysqli('localhost', 'cs143', '', 'CS143');
                    if($db->connect_errno > 0){
                        die('Unable to connect to database [' . $db->connect_error . ']');
                        exit(-1);
                    }

                    if(!$db->query("INSERT INTO MovieDirector VALUES ('$mov', '$dir');")){
                        echo ("<br>Failed Insert<br>");
                        exit(-1);
                    }

                    echo ("<br>Succefully Insert<br>");
                    
                    $db->close();
                }
            ?>
        
    </div>

    <script src="layout/jquery.js"></script>
    <script src="layout/bootstrap.min.js"></script>

</body>
</html>