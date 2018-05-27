<?php include('nav.php') ?>

    <div class="container">

    		<?php

				$db = new mysqli('localhost', 'cs143', '', 'CS143');
				if($db->connect_errno > 0){
    				die('Connection to database unsuccesful [' . $db->connect_error . ']');
				}

				if($_GET["mid"]){
					$mid=$_GET["mid"];

					$query="SELECT * FROM Movie WHERE id=$mid;";
					$mov = $db->query($query);
					$rowM = $mov->fetch_assoc();

					$dir = $db->query("SELECT CONCAT(first, ' ',last, ' ', '(', dob, ')') AS DirectorName FROM Director, MovieDirector WHERE Director.id = MovieDirector.did AND MovieDirector.mid=$mid;");

					$gen = $db->query("SELECT genre FROM MovieGenre WHERE mid = $mid;");

					$act = $db->query("SELECT CONCAT(A.first, ' ',A.last) AS ActorName, aid, MA.role FROM Actor A,MovieActor MA WHERE MA.mid = $mid AND A.id = MA.aid;");

					$rev = $db->query("SELECT * FROM Review WHERE mid = $mid;");

					$avg = $db->query("SELECT AVG(rating) AS avgRating FROM Review WHERE mid = $mid;");
					$rowAvg = $avg->fetch_assoc();
		
					$db->close();
				}
			?>

            <h3><b> Movie Info Page</b></h3><hr />
            <?php if ($mov) { ?>
            <h4> Movie Information: </h4>
            <div> 
            	<p>Title: <span><?php echo $rowM["title"]."(".$rowM["year"].")"; ?></span></p>
            	<p>Producer: <span><?php echo $rowM["company"];?></span></p>
            	<p>MPAA Rating: <span><?php echo $rowM["rating"];?></span></p>
            	<p>Director: <span>
            	
            		<?php 
                    if($dir->num_rows > 0){
                    while($rowDirector = $dir->fetch_assoc()) { ?>
                  <?php echo $rowDirector["DirectorName"]?>
                  <?php } }else { echo "N/A";}?>
            	</span></p>
            	<p>Genre: <span>
            		<?php 
                    if($gen->num_rows > 0){
                    while($rowGenre = $gen->fetch_assoc()) { ?>
	                <?php echo $rowGenre["genre"];?>
	                <?php } }else{ echo "N/A";}?>
            	</span></p>
            </div><hr />
            
        
	        <h4>Actors/Actresses in this movie:</h4>
	        <div class='table-responsive'> 
	        	<table class='table table-bordered table-condensed table-hover'>
	        		<thead> 
	        		<tr>
	        		<td>Name</td>
	        		<td>Role</td>
	        		</tr>
	        		</thead>
	        		<tbody>
	        		
	        		<?php if ($act->num_rows > 0){
	        		while($rowA = $act->fetch_assoc()) { ?>
	        		<tr>
	        		<td><a href="Information_Actor.php?aid=<?php echo $rowA["aid"]?>"> <?php echo $rowA["ActorName"]?></a></td>
	        		<td><?php echo $rowA["role"]?></td>
	        		</tr>
	        		<?php }} ?>
	        		</tbody>
	        	</table>
	        </div><hr />
	        
	        <h4>User reviews for this movie: </h4>
	        <div>
	        	<p><b><?php echo "Average score: ".$rowAvg["avgRating"]; ?></b></p>
	        </div>
	        <div class='table-responsive'> 
	        	<table class='table table-bordered table-condensed table-hover'>
	        		<thead> 
	        		<tr>
	        		<td>Name</td><td>Time</td><td>MovieID</td><td>Score</td><td>Comment</td>
	        		</tr>
	        		</thead>
	        		<tbody>
	        		<?php if ($rev->num_rows > 0){
	        		while($rowReview = $rev->fetch_assoc()) { ?>
	        		<tr>
	        		<td><?php echo $rowReview["name"]?></td>
	        		<td><?php echo $rowReview["time"]?></td>
	        		<td><?php echo $rowReview["mid"]?></td>
	        		<td><?php echo $rowReview["rating"]?></td>
	        		<td><?php echo $rowReview["comment"]?></td>
	        		</tr>
	        		<?php }} ?>
	        		</tbody>
	        	</table>
	        </div>
	        <div><a href="Comment.php?id=<?php echo $rowM["id"];?>&name=<?php echo $rowM["title"];?>">Place a review here if you wish!</a></div>
	        <hr />
			<?php } ?>
	        <label for="search">Search</label>
	        <form class="form-group" action="Browsing.php" method ="GET">
              <input type="text" class="form-control" placeholder="Enter movie name" name="keys"><br>
              <input type="submit" value="Submit" class="btn btn-default">
          	</form>   
    </div>
    

    <script src="layout/jquery.js"></script>
    <script src="layout/bootstrap.min.js"></script>

</body>

</html>