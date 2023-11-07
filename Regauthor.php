<?php
	session_start();
	#fetch data from database
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"lms");
	$query = "select * from Authors ORDER BY author_id DESC";
	$author_name = "";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Reg Authors</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php">Library Management System (LMS)</a>
			</div>
			<font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
			<font style="color: white"><span><strong>Email: <?php echo $_SESSION['email'];?></strong></font>
		    <ul class="nav navbar-nav navbar-right">
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="#">View Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="#">Edit Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="change_password.php">Change Password</a>
	        	</div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="../logout.php">Logout</a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<span><marquee>This is library mangement system. Library opens at 8:00 AM and close at 8:00 PM</marquee></span><br><br>
		<center><h4>Registered Authors</h4><br></center>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
			<form method="post">
				<input type="text" name="value" id="" class="form-control">
				<button type="submit" name="search" class="btn btn-success my-3">Search</button>
				<button type="submit" name="fullList" class="btn btn-primary my-3">Full List</button>
			</form>
			<?php
			if (isset($_POST['fullList'])) {
			?>
				<form>
					<table class="table-bordered" width="900px" style="text-align: center">
						<tr>
							<th>Author Name</th>
						</tr>
				
					<?php
						$connection = mysqli_connect("localhost","root","");
						$db = mysqli_select_db($connection,"lms");
						$query = "select * from authors  ORDER BY author_id DESC";
						$query_run = mysqli_query($connection,$query);
						while ($row = mysqli_fetch_assoc($query_run)){
							?>
							<tr>
							<td><?php echo $row['author_name'];?></td>
							<td><button class="btn" name=""><a href="edit_author.php?bn=<?php echo $row['author_name'];?>">Edit</a></button>
								<button class="btn"><a href="delete_author.php?bn=<?php echo $row['author_name']; ?>" onclick="return confirm('Are you sure you want to delete this author?');">Delete</a>
							</button></td>
						</tr>

					<?php
						}
					?>	
				</table>
				</form>
				<?php
			}
			?>

			<?php
			if (isset($_POST['search'])) {
				$val = $_POST['value'];
			?>
			<form>
					<table class="table-bordered" width="900px" style="text-align: center">
						<tr>
							<th>Author Name</th>
						</tr>
				
					<?php
						$connection = mysqli_connect("localhost","root","");
						$db = mysqli_select_db($connection,"lms");
						$query = "select * from authors where author_name like '%" . $val . "%'  ORDER BY author_id DESC";
						$query_run = mysqli_query($connection,$query);
						while ($row = mysqli_fetch_assoc($query_run)){
							?>
							<tr>
							<td><?php echo $row['author_name'];?></td>
							<td><button class="btn" name=""><a href="edit_author.php?bn=<?php echo $row['author_name'];?>">Edit</a></button>
								<button class="btn"><a href="delete_author.php?bn=<?php echo $row['author_name']; ?>" onclick="return confirm('Are you sure you want to delete this author?');">Delete</a>
							</button></td>
						</tr>

					<?php
						}
					?>	
				</table>
				</form>
				<?php
			}
			?>
			</div>
			<div class="col-md-2"></div>
		</div>
</body>
</html>
