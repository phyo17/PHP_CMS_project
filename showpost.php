<?php 
	ob_start();
	session_start();
	if(!isset($_SESSION['sess_email'])){
		header('location:login_register.php');
	}
	
 ?>
<?php include_once "layout/header.php" ?>

	<div class="container">
		<div class="row">
			<div class="jumbotron">
				<h2 class="text-center">View All Posts</h2>

				<nav class="navbar navbar-light bg-light">
					<a href="addpost.php" class="btn btn-primary navbar-link">Add Post</a>
					<a href="logout.php" class="btn btn-default navbar-link float-right">Logout</a>
				</nav>

				<table class="table table-bordered table-hover">
					<tr>
						<th>No:</th>
						<th>Title</th>
						<th>Category</th>
						<th>Author</th>
						<th>Image</th>
						<th>Description</th>
						<th>Date</th>
						<th>Status</th>
						<th>Update</th>
						<th>Delete</th>
					</tr>
					<?php 
						include_once "db.php";

						$no = 1;
						$query = "SELECT * FROM `post` ORDER BY id DESC";
						$data = mysqli_query($connect,$query);
						foreach($data as $value){
					?>
						
					<tr>
						<td><?php echo $no++ ?></td>
						<td><?php echo $value['title'] ?></td>
						<td><?php echo $value['category'] ?></td>
						<td><?php echo $value['author'] ?></td>
						<td><img src="photo/<?php echo $value['image'] ?>" width="120" alt=""></td>
						<td><?php echo $value['description'] ?></td>
						<td><?php echo $value['date'] ?></td>
						<td>
							<?php 
								if($value['status']=='Hide'){
									echo "<a href='showpost.php?status={$value['id']}' class='btn btn-info'>ChangePublic</a>";
								}else{
									echo "<a href='showpost.php?status={$value['id']}' class='btn btn-default'>ChangeHide</a>";
								}
							 ?>
						</td>
						<td><a href="updatepost.php?edit_id=<?php echo $value['id'] ?>" class="btn btn-warning">Update</a></td>
						<td><a href="showpost.php?delete_id=<?php echo $value['id'] ?>" class="btn btn-danger">Delete</a></td>
					</tr>
					<?php
						}

					 ?>

				</table>
			</div>
		</div>
	</div>
<?php include_once "layout/footer.php" ?>

<?php 
	if(isset($_GET['status'])){
		$edit_status = $_GET['status'];
		$query = "SELECT * FROM post WHERE id=$edit_status";
		$data = mysqli_query($connect,$query);
		foreach($data as $val){
			$status = $val['status'];
		}

		if($status=="Hide"){
			$status = "Public";
		}else{
			$status = "Hide";
		}

		$query = "UPDATE `post` SET `status`='$status' WHERE id=$edit_status";
		mysqli_query($connect,$query);
		header('location:showpost.php');
	}
 ?>

 <?php 
 	if(isset($_GET['delete_id'])){
 		$delete_id = $_GET['delete_id'];

 		$query = "SELECT * FROM post WHERE id=$delete_id";
		$result = mysqli_query($connect,$query);
		$data = mysqli_fetch_assoc($result);
		$filename = $data['image'];
		$img_path = 'photo/'.$filename;
		if(file_exists($img_path)){
			unlink($img_path);
		}

		$query = "DELETE FROM `post` WHERE id=$delete_id";
		mysqli_query($connect,$query);
		header('location:showpost.php');
 	}
  ?>