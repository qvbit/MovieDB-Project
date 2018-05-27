<?php include('nav.php') ?>

    <div class="container">
            <h3>Add Comment</h3><hr>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <?php
                    $db = new mysqli('localhost', 'cs143', '', 'CS143');
                    if($db->connect_errno > 0){
                        die('Unable to connect to database [' . $db->connect_error . ']');
                    }

                    $temp = $db->query("SELECT CONCAT(title,' ','(',year,')') AS MovieName, id FROM Movie;");
    
                    if(!$temp){
                        echo ("<br>Failed query<br>");
                        exit(-1);
                    }
 
                    $db->close();
                ?>

                <div class="form-group">
		            <label for="movie">Movie Title</label>
		            <select class="form-control" name="movieTitle">
		                <option value=<?php echo $id ?>> <?php echo $movieName ?> </option>
		                <?php
		                	if($temp->num_rows>0){
		                		while($row = $temp->fetch_assoc()){
            			?>
                			<option value = <?php echo $row["id"] ?>> <?php echo $row["MovieName"] ?></option>
		                <?php		}
		                	}else{
                		?>
                			<option>None</option>
                		<?php
		                	}
                		?>
		            </select>
                </div>

                <div class="form-group">
                    <label for="rating">Rating</label>
                    <select  class="form-control" name="rating">
                        <option value=""> </option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <p>5 is best, 1 is worst</p>
                </div>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" placeholder="Text input" name="name" maxlength=20>
                </div>

                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" rows="10" placeholder="500 characters maximum" name="comment" maxlength=500></textarea>
                </div>

                	<button type="submit" class="btn btn-default">Add!</button>
            </form>
            
            <?php

                if($_SERVER["REQUEST_METHOD"] == "POST"){
                   if(empty($_POST["movieTitle"])){
                        echo ("<br>Movie is empty<br>");
                        exit(-1);
                    }else{
                        $movieTitle = $_POST['movieTitle'];
                    }

                    if(empty($_POST["rating"])){
                        echo ("<br>Rating is empty<br>");
                        exit(-1);
                    }else{
                        $rating = $_POST["rating"];
                    }

                    if(empty($_POST["name"])){
                        echo ("<br>Name cannot be empty<br>");
                        exit(-1);
                    }else{
                        $name = $_POST["name"];
                    }

                    if(empty($_POST["comment"])){
                        echo ("<br>Comment cannot be empty<br>");
                        exit(-1);
                    }else{
                        $comment = $_POST["comment"];
                    }
                }

                if($_GET["id"] && $_GET["name"]){
                    $id = $_GET["id"];
                    $movieName=$_GET["name"];
                }

                if($movieTitle && $rating && $name && $comment){
                    $db = new mysqli('localhost', 'cs143', '', 'CS143');
                    if($db->connect_errno > 0){
                        die('Unable to connect to database [' . $db->connect_error . ']');
                    }

                    if(!$db->query("INSERT INTO Review VALUES ('$name', CURRENT_TIMESTAMP(), $movieTitle, $rating, '$comment');")){
                        echo ("<br>Failed Insert<br>");
                        exit(-1);
                    }

                    echo ("<br>Succefully Insert<br>");
                    echo (" <a href=' Information_Movie.php?mid=$movieTitle '>View your comment</a>"); 
                }
            ?>
        
    </div>
    
    <script src="layout/jquery.js"></script>

    <script src="layout/bootstrap.min.js"></script>

</body>
</html>

