<?php include_once "layout/header.php" ?>

	<div class="container">
		<div class="jumbotron">
			<h2 class="text-center">Post Upload</h2>

			<form action="" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="">Title</label>
					<input type="text" name="posttitle" class="form-control">
				</div>

				<div class="form-group">
					<label for="">Category</label>
					<select name="postcategory" class="form-control" id="">
						<option value="Education">Education</option>
						<option value="Relationship">Relationship</option>
						<option value="Technology">Technology</option>
						<option value="Health">Health</option>
					</select>
				</div>

				<div class="form-group">
					<label for="">Author</label>
					<input type="text" name="postauthor" class="form-control">
				</div>

				<div class="form-group">
					<label for="">Image</label>
					<input type="file" name="postimage" class="form-control">
				</div>

				<div class="form-group">
					<label for="">Description</label>
					<textarea name="postdescription" class="form-control" id="editor1" cols="30" rows="10"></textarea>
				</div>

				<div class="form-group">
					<label for="">Date</label>
					<input type="date" name="postdate" class="form-control">
				</div>

				<div class="form-group">
					<label for="">Status</label>
					<select name="poststatus" class="form-control" id="">
						<option value="Public">Public</option>
						<option value="Hide">Hide</option>
					</select>
				</div>

				<input type="submit" name="postupload" class="btn btn-primary">
			</form>
		</div>
	</div>

<?php include_once "layout/footer.php" ?>

<?php 
	include_once "db.php";

	if(isset($_POST['postupload'])){
		$title = $_POST['posttitle'];
		$category = $_POST['postcategory'];
		$author = $_POST['postauthor'];

		$filename = $_FILES['postimage']['name'];
		$tmp_file = $_FILES['postimage']['tmp_name'];
		move_uploaded_file($tmp_file, 'photo/'.$filename);


		$description  = $_POST['postdescription'];
		$date = $_POST['postdate'];
		$status = $_POST['poststatus'];

		$query = "INSERT INTO `post`(`title`, `category`, `author`, `image`, `description`, `date`, `status`) VALUES ('$title','$category','$author','$filename','$description','$date','$status')";
		$result = mysqli_query($connect,$query);
		if(!$result){
			echo "Fail".mysqli_error();
		}
	}
 ?>