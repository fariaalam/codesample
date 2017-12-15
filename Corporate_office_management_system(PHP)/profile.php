<?php
	$type = $_SESSION['login_type'];
	$id_field = $type.'_id';
	$id = $_SESSION['user'];
	$res = '';
	if(isset($_GET['edit'])){
	   
		$name = $_POST['name'];
		$address=$_POST['address'];
	    $phone_number=$_POST['phone_number'];
	    $email=$_POST['email'];  
		
										 
    
   		mysqli_query($con,"UPDATE `$type` SET `name` = '$name', 
		                                      `address` =  '$address', 
		                                      `phone_number` ='$phone_number', 
											  `email`='$email'  
				                               WHERE $id_field ='$id' ");
		
	}
	if(isset($_GET['pic'])){
		move_uploaded_file($_FILES["pics"]["tmp_name"],'photo/'.$type.'_'.$id.'.jpg');
	}
	if(isset($_GET['cng_pass'])){
		$old = $_POST['current'];
		$new = $_POST['new'];
		$c_new = $_POST['con_new'];
		$result2 = mysqli_query($con,"SELECT * FROM $type WHERE $id_field = '$id'");
		while($row2 = mysqli_fetch_array($result2)){
			$old_match = $row2['password'];
		}
		if($old_match == $old){
			if($c_new  == $new ){
				mysqli_query($con,"UPDATE $type SET `password` = '$c_new' 
				                                 WHERE $id_field = '$id'");	
			} else {
				$res = "passwords Didn't match.";
			}
		} else {
			$res = "Current password is wrong.";
		}		
	}
	$result = mysqli_query($con,"SELECT * FROM $type WHERE $id_field = '$id'");
	$result1 = mysqli_query($con,"SELECT * FROM $type WHERE $id_field = '$id'");
?>

<div id="main-content">
	<div class="page-title">
		<div>
			<h1><i class="icon-file-alt"></i> User Profile</h1>
		</div>
	</div>
	<div id="breadcrumbs">
		<ul class="breadcrumb">
			<li>
			<i class="icon-home"></i>
			<a href="index.php">Home</a>
			<span class="divider"><i class="icon-angle-right"></i></span>
			</li>
			<li class="active">User Profile</li>
		</ul>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="box">
				<div class="box-title">
					<h3><i class="icon-file"></i> Profile Info</h3>
					<div class="box-tool">
						<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
						<a data-action="close" href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<div class="row-fluid">
						<div class="span3">
							<img src="photo/<?php echo $type.'_'.$id; ?>.jpg" style="height:200px;" alt=""/>
							<br/><br/>
						</div>
						<div class="span9 user-profile-info">
						<?php
						   while($row = mysqli_fetch_array($result)){
						?>
							
							<?php if($type !== 'admin'){ ?>
	                         <p>
								<span>Appointment-date:</span> <?php echo $row['appointment_date']; ?>
							</p>
                             <p>
								<span>Department:</span> <?php echo $row['department']; ?>
							</p>
							<?php } ?>						
							<p>
								<span>Name:</span> <?php echo $row['name']; ?>
							</p>
							<p>
							     <span>Address:</span> <?php echo $row['address']; ?>
							</p>
							<p>
							       <span>Phone-number:</span> <?php echo $row['phone_number']; ?>
							</p>
							
							<p>
								<span>Email:</span> <?php echo $row['email']; ?>
							</p>
							
						<?php
							}
						?>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<div class="box box-orange">
				<div class="box-title">
					<h3><i class="icon-file"></i> Edit Profile</h3>
					<div class="box-tool">
						<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
						<a data-action="close" href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form action="index.php?page=profile&edit=do" method="post" class="form-horizontal">
						<?php
						   
                             
						   while($row1 = mysqli_fetch_array($result1)){
						?>
						<div class="control-group">
							<label class="control-label">Name</label>
							<div class="controls">
								<input type="text" value="<?php echo $row1['name']; ?>" name="name" class="span6"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Address</label>
							<div class="controls">
								<input type="text" value="<?php echo $row1['address']; ?>" name="address" class="span6"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Email</label>
							<div class="controls">
								<input type="text" value="<?php echo $row1['email']; ?>" name="email" class="span6"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Phone-number</label>
							<div class="controls">
								<input type="text" value="<?php echo $row1['phone_number']; ?>" name="phone_number" class="span6"/>
							</div>
						</div>
	                      
						<?php
							} 
						?>
						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Submit</button>
							<button type="button" class="btn">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span6">
			<div class="box box-orange">
				<div class="box-title">
					<h3><i class="icon-file"></i> Edit Profile Picture</h3>
					<div class="box-tool">
						<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
						<a data-action="close" href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form action="index.php?page=profile&pic=do" method="post"  enctype="multipart/form-data" class="form-horizontal">
						<div class="control-group">
							<label class="control-label">Image Upload</label>
							<div class="controls">
						
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
										<img src="photo/<?php echo $type.'_'.$id; ?>.jpg" alt=""/>
									</div>
									<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">
									</div>
									<div>
										<span class="btn btn-file"><span class="fileupload-new">Select image</span>
										<span class="fileupload-exists">Change</span>
										<input type="file" class="default" name="pics" /></span>
										<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Submit</button>
							<button type="button" class="btn">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="span6">
			<div class="box box-red">
				<div class="box-title">
					<h3><i class="icon-file"></i> Change Password</h3>
					<div class="box-tool">
						<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
						<a data-action="close" href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form action="index.php?page=profile&cng_pass=do" method="post" class="form-horizontal">
						<div class="control-group">
							<label class="control-label">Current password</label>
							<div class="controls">
								<input type="password" class="span12" name="current" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">New password</label>
							<div class="controls">
								<input type="password" class="span12" name="new" />
							</div>
						</div>
						<div class="control-group">
							<label class="control-label">Re-type new password</label>
							<div class="controls">
								<input type="password" class="span12" name="con_new" />
							</div>
						</div>
						<?php echo $res; ?>
						<div class="form-actions">
							<button type="submit" class="btn btn-primary">Submit</button>
							<button type="button" class="btn">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<footer>
	<p>
		2014 © office-management.
	</p>
	</footer>
	<a id="btn-scrollup" class="btn btn-circle btn-large" href="#"><i class="icon-chevron-up"></i></a>
</div>