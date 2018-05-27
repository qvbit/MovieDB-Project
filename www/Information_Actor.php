<?php include('nav.php') ?>

    <div class="container">

    	<?php
			$db = new mysqli('localhost', 'cs143', '', 'CS143');
			if($db->connect_errno > 0){
    			die('Connection to database unsuccesful [' . $db->connect_error . ']');
			}
	
			if($_GET["aid"]){
	
				$aid = $_GET["aid"];
				$act = $db->query("SELECT * FROM Actor WHERE id=$aid;");
				$rowA = $act->fetch_assoc();
		
				$mov = $db->query("SELECT CONCAT(M.title,' ','(',M.year,')') AS MovieName, mid, MA.role FROM Movie M, MovieActor MA WHERE MA.mid=M.id AND MA.aid=$aid;");
			}

			$db->close();
		?>

            <h3><b> Actor Info Page</b></h3><hr />
            <?php if ($act) { ?>
            <h4> Actor Information: </h4>
            <div class='table-responsive'> 
            	<table class='table table-bordered table-condensed table-hover'>
	            	<thead> 
	            		<tr>
	            		<td>Name</td>
	            		<td>Sex</td>
	            		<td>Date of Birth</td>
	            		<td>Date of Death</td>
	            		</tr>
	            	</thead>
	            	<tbody>
		            	<tr>
			            	<td><?php echo $rowA["first"]." ".$rowA["last"];?></td>
			            	<td><?php echo $rowA["sex"];?></td>
			            	<td><?php echo $rowA["dob"];?></td>
			            	<td><?php echo $rowA["dod"] ? $rowA["dod"]:"Still Alive";?></td>
		            	</tr>
	            	</tbody>
            	</table>
            </div>
            	<hr /> 
        
	        <h4>Actor's Movies and Role:</h4>
	        <div class='table-responsive'> 
	        	<table class='table table-bordered table-condensed table-hover'>
	        		<thead> 
	        		<tr>
	        		<td>Role</td>
	        		<td>Movie Title</td>
	        		</tr>
	        		</thead>
	        		<tbody>
	        		<?php if ($mov->num_rows > 0){
	        		while($rowM = $mov->fetch_assoc()) { ?>
	        		<tr>
	        		<td><?php echo $rowM["role"]?></td>
	        		<td><a href="Information_Movie.php?mid=<?php echo $rowM["mid"]?>"> <?php echo $rowM["MovieName"]?></a></td>
	        		</tr>
	        		<?php }} ?>
	        		</tbody>
	        	</table>
	        </div><hr />
	        
	        <?php } ?>
	        
	        <label for="search">Search:</label>
	        <form class="form-group" action="Browsing.php" method ="GET">
              <input type="text" class="form-control" placeholder="Enter actor/actress name" name="keys"><br>
              <input type="submit" value="Submit" class="btn btn-default">
          	</form> 
    </div>


    <script src="layout/jquery.js"></script>
    <script src="layout/bootstrap.min.js"></script>

</body>

</html>