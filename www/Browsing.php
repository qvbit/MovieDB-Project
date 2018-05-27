<?php include('nav.php') ?>

<div class="container">
        <h3><b>Search</b></h3><hr>
        <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
                <?php


                    if(!$_GET["keys"]) {
                        $Err_flag = 1;
                    } else {
                        $keys = $_GET["keys"];
                        $keys = explode(' ', $keys);
                        $Err_flag = 0;
                    }

                    if($Err_flag == "0"){  
                        $cnt = count($keys);
    
    
                        $qA = "SELECT * FROM (SELECT id, CONCAT(first,' ',last) AS Aname, sex, dob, dod FROM Actor) actor WHERE ";
                        for($k = 0; $k < $cnt; $k++) {
                            $qA = $qA."actor.Aname LIKE '%".$keys[$k]."%'";
                            if($k != $cnt - 1) {
                            $qA = $qA." AND ";
                            }
                            else {
                                $qA = $qA.";";
                            }
                        }

                        $qM = "SELECT * FROM Movie WHERE ";
                        for($k = 0; $k < $cnt; $k++) {
                            $qM = $qM."title LIKE '%".$keys[$k]."%'";
                            if($k != $cnt - 1) {
                                $qM = $qM." AND ";
                            }
                            else {
                                $qM = $qM.";";
                            }
                        }



                        $db = new mysqli('localhost', 'cs143', '', 'CS143');
                        if($db->connect_errno > 0){
                            die('Connection to database unsuccesful [' . $db->connect_error . ']');
                        }
    
                        $mov = $db->query($qM);
                        $act = $db->query($qA);

                        $db->close();

                    }

                ?>
                <input type="text" class="form-control" placeholder="Enter a movie or actor/actress name" name="keys"
                       value="<?php echo $_GET["keys"] ?>" ><br>
                <input type="submit" value="Submit" class="btn btn-default">
                
                <?php if ($mov) { ?>
                
                <h4>Matching Actors:</h4>
                <div class='table-responsive'>
                    <table class='table table-bordered table-condensed table-hover'>
                    <thead> 
                        <tr>
                        <td>Name</td>
                        <td>Date of Birth</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($act->num_rows > 0){
                        while($rowA = $act->fetch_assoc()) { ?>
                        <tr>
                        <td><a href="Information_Actor.php?aid=<?php echo $rowA["id"]?>"> <?php echo $rowA["Aname"]?></a></td>
                        <td><?php echo $rowA["dob"]?></td>
                        </tr>
                        <?php }} ?>
                        </tbody>
                    </table>    
                </div><hr>
				
                <h4>Matching Movies:</h4>
                <div class='table-responsive'>
                    <table class='table table-bordered table-condensed table-hover'>
                    <thead> 
                        <tr>
                        <td>Title</td>
                        <td>Year</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if ($mov->num_rows > 0){
                        while($rowM = $mov->fetch_assoc()) { ?>
                        <tr>
                        <td><a href="Information_Movie.php?mid=<?php echo $rowM["id"]?>"> <?php echo $rowM["title"]?></a></td>
                        <td><?php echo $rowM["year"]?></td>
                        </tr>
                        <?php }}} ?>
                        </tbody>
                    </table>    
                </div>
            </div>
        </form>
</div>

<script src="layout/jquery.js"></script>
<script src="layout/bootstrap.min.js"></script>

</body>
</html>

</html>
