<?php 
	ob_start();
	include_once "db.php";

	if(isset($_GET['edit_id'])){
		$edit_id = $_GET['edit_id'];
		$query = "SELECT * FROM post WHERE id=$edit_id";
		$data = mysqli_query($connect,$query);
		foreach($data as $val){
			$id = $val['id'];
			$title = $val['title'];
			$category = $val['category'];
			$author = $val['author'];
			$image = $val['image'];
			$description = $val['description'];
			$date = $val['date'];
		}
	}
 ?>

 <?php 

	if(isset($_POST['update'])){
		$title = $_POST['posttitle'];
		$category = $_POST['postcategory'];
		$author = $_POST['postauthor'];

		$filename = $_FILES['postimage']['name'];
		if($filename){
			$query = "SELECT * FROM post WHERE id=$edit_id";
			$result = mysqli_query($connect,$query);
			$data = mysqli_fetch_assoc($result);
			$filename = $data['image'];
			$img_path = 'photo/'.$filename;
			if(file_exists($img_path)){
				unlink($img_path);
			}
		}
		$tmp_file = $_FILES['postimage']['tmp_name'];
		move_uploaded_file($tmp_file, 'photo/'.$filename);


		$description  = $_POST['postdescription'];
		$date = $_POST['postdate'];

		$query = "UPDATE `post` SET `title`='$title',`category`='$category',`author`='$author',`image`='$filename',`description`='$description',`date`='$date' WHERE id=$edit_id";
		$result = mysqli_query($connect,$query);
		if(!$result){
			die("Fail").mysqli_error();
		}
		header('location:showpost.php');
	}
 ?>


<?php include_once "layout/header.php" ?>

	<div class="container">
		<div class="jumbotron">
			<h2 class="text-center">Post Update</h2>

			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="">Title</label>
					<input type="text" name="posttitle" value="<?php echo $title ?>" class="form-control">
				</div>

				<div class="form-group">
					<label for="">Category</label>
					<select name="postcategory" class="form-control" id="">
						<option value="<?php echo $category ?>"><?php echo $category ?></option>
						<option value="Education">Education</option>
						<option value="Relationship">Relationship</option>
						<option value="Technology">Technology</option>
						<option value="Health">Health</option>
					</select>
				</div>

				<div class="form-group">
					<label for="">Author</label>
					<input type="text" name="postauthor" value="<?php echo $author ?>" class="form-control">
				</div>

				<div class="form-group">
					<label for="">Image</label>
					<img src="photo/<?php echo $image ?>" width="120" alt="">
					<input type="file" name="postimage" class="form-control">
				</div>

				<div class="form-group">
					<label for="">Description</label>
					<textarea name="postdescription" class="form-control" id="" cols="30" rows="10"><?php echo $description ?></textarea>
				</div>

				<div class="form-group">
					<label for="">Date</label>
					<input type="date" name="postdate" value="<?php echo $date ?>" class="form-control">
				</div>

				<input type="submit" name="update" class="btn btn-primary">
			</form>
		</div>
	</div>

<?php include_once "layout/footer.php" ?>

