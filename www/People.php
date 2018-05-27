<?php include('nav.php') ?>


    <div class="container">
            <h3>Add new Actor/Director</h3><hr>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="form-group">
                    <input type="radio" name="actorDir[]" value="Actor" checked>Actor</input>
                    <input type="radio" name="actorDir[]" value="Director">Director</input>
                </div>

                <div class="form-group">
                    <label for="firstName">First Name</label>
                    <input type="text" class="form-control" placeholder="Text input" name="firstName" maxlength=20>
                </div>

                <div class="form-group">
                    <label for="lastName">Last Name</label>
                    <input type="text" class="form-control" placeholder="Text input" name="lastName" maxlength=20>
                </div>
                
                <div class="form-group">
                    <input type="radio" name="sex[]" value="Male" checked>Male</input>
                    <input type="radio" name="sex[]" value="Female">Female</input>
                </div>

                <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="text" class="form-control" placeholder="Text input" name="dob" maxlength=10>
                    <p>ie: 1997-05-05</p>
                </div>

                <div class="form-group">
                    <label for="dod">Date of Death</label>
                    <input type="text" class="form-control" placeholder="Text input" name="dod" maxlength=10>
                    <p>(leave blank if  still alive)</p>
                </div>

                <button type="submit" class="btn btn-default">Add!</button>

            </form>
            <?php
                function validateDate($date, $format = 'Y-m-d') {
                    $d = DateTime::createFromFormat($format, $date);
                    return $d && $d->format($format) == $date;
                }

                if($_SERVER["REQUEST_METHOD"] == "POST"){
                    $actorDir = $_POST["actorDir"];

                    if(empty($_POST["firstName"]) || empty($_POST["lastName"])) {
                        if(empty($_POST["firstName"])) {
                            echo ("<br>First name is empty<br>");
                        }
                        
                        if(empty($_POST["lastName"])) {
                            echo ("<br>Last name is empty<br>");
                        }
                        exit(-1);
                    }else{
                        $firstName = $_POST["firstName"];
                        $lastName = $_POST["lastName"];
                    }

                    $sex = $_POST["sex"];
            
                    if(empty($_POST["dob"])) {
                        echo ("<br>Date of birth is empty<br>");
                        exit(-1);
                    } else {
                        
                        if (validateDate($_POST["dob"]) == FALSE) {
                            echo ("<br> Birthday is not formatted<br>");
                            exit(-1);
                        }

                        $orderdate = explode('-', $_POST["dob"]);
                        $birthyear = $orderdate[0];
                        $birthmonth = $orderdate[1];
                        $birthday = $orderdate[2];
                        $dob = $birthyear.$birthmonth.$birthday;
                    }

                    if(empty($_POST["dod"])) {
                        $dod = "NULL";
                    } else {
                        if (validateDate($_POST["dod"]) == FALSE) {
                            echo ("<br> Dead day is not formatted<br>");
                            exit(-1);
                        }

                        $orderdate1 = explode('-', $_POST["dod"]);
                        $deadYear = $orderdate1[0];
                        $deadMonth = $orderdate1[1];
                        $deadDay = $orderdate1[2];
                        $dod = $deadYear.$deadMonth.$deadDay;
                    }
                }

                if($actorDir && $firstName && $lastName && $sex && $dob && $dod) {
                    $db = new mysqli('localhost', 'cs143', '', 'CS143');
                    if($db->connect_errno > 0){
                        die("Unable to connect to database");
                    }

                    $temp = $db->query("SELECT id FROM MaxPersonID;");

                    if (!$temp) {
                        echo("Failed query");
                        exit(-1);
                    }

                    $row = $temp->fetch_assoc();
                    $newID = $row["id"] + 1;
                    
                    if (!$db->query("UPDATE MaxPersonID SET id = id+1;")) {
                        echo ("Failed query ID");
                        exit(-1);
                    }

                    if ($actorDir[0] == "Actor") {
                        if (!$db->query("INSERT INTO Actor VALUES($newID, '$lastName', '$firstName', '$sex[0]', $dob, $dod);")) {
                            echo ("Failed Insert");
                            exit(-1);
                        }

                        echo ("<br>Successfully insert<br>");
                    }

                    if ($actorDir[0] == "Director") {
                        if (!$db->query("INSERT INTO Director VALUES($newID, '$lastName', '$firstName', $dob, $dod);")) {
                            echo ("Failed Insert");
                            exit(-1);
                        }

                        echo ("<br>Successfully insert<br>");
                    }


                    $temp->free();
                    $db->close();
                }
                ?>
    </div>
    

    <script src="layout/jquery.js"></script>
    <script src="layout/bootstrap.min.js"></script>
</body>
</html>




