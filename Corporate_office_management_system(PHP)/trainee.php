<?php  
	if(isset($_GET['add'])){
		if($_POST){
		$name=$_POST['name'];
		$address=$_POST['address'];
		$phone_number=$_POST['phone_number'];
		$appointment_date=$_POST['appointment_date'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$department=$_POST['department'];
		
		mysqli_query($con,"INSERT INTO `trainee` (`department`,`name`,`address`,`phone_number`,`appointment_date`,`email`,`password`)
		VALUES ('$department','$name','$address','$phone_number','$appointment_date','$email','$password')");
		}
	} 
	if($_SESSION['login_type'] == 'junior_officer'){
	if(isset($_GET['update'])){
		if($_POST){
		
		$performance=$_POST['performance'];
		
		$id = $_POST['id'];
		mysqli_query($con," UPDATE `trainee` SET  `performance` =  '$performance' 
		                                                 	
															WHERE  `trainee_id` ='$id'");
		}
	}
    }else{
	if(isset($_GET['update'])){
		if($_POST){
		
		$department=$_POST['department'];
		
		$id = $_POST['id'];
		mysqli_query($con," UPDATE `trainee` SET  `department` =  '$department' 
		                                          			
													WHERE  `trainee_id` ='$id'");
		}
	}
	   
	}
	
	
	
	
	
	if(isset($_GET['delete'])){
       $id=$_GET['delete'];
	   mysqli_query($con,"DELETE FROM `trainee` WHERE `trainee_id`='$id'");
									}

?>
<div id="main-content">
		<div class="page-title">
			<div>
				<h1><i class="icon-desktop"></i> Trainee</h1>
				
			</div>
		</div>
		
		<div class="row-fluid">
			<div class="span12">
				<div class="box box-blue">
					<div class="box-title">
						<h3>
							<i class="icon-folder-close"></i>
						</h3>
						<ul class="nav nav-tabs">
							<li <?php if(!isset($_GET['edit'])){ ?>class="active"<?php } ?>>
								<a href="#list" data-toggle="tab">List</a>
							</li>
							<li>
								<a href="#add" data-toggle="tab">Add</a>
							</li>
							<?php if(isset($_GET['edit'])){ ?>
							<li class="active" >
								<a href="#edit" data-toggle="tab">Edit</a>
							</li>
							<?php } ?>
						</ul>
					</div>
					<div class="box-content">
						<div class="tab-content">
							<div class="tab-pane <?php if(!isset($_GET['edit'])){ ?>active<?php } ?>" id="list">
								<div class="box">
									<div class="box-title">
										<h3>
											<i class="icon-table"></i> Basic Info
										</h3>
									</div>
									<div class="box-content">
										<table class="table">
											<thead>
												<tr>
													<th>Department</th>
													<th>Name</th>
													<th>Address</th>
													<th>Phone number</th>
													<th>Appointment Date</th>
													<th>Performance</th>
													<th>Email</th>
												
													<?php 
														if($_SESSION['login_type'] == 'admin' ||
                                                           $_SESSION['login_type'] == 'managing_director'||
														   $_SESSION['login_type'] == 'junior_officer' ) {
													?>
													
													<th>Edit</th>
													<?php }?>
													<?php 
														if($_SESSION['login_type'] == 'admin' ||
                                                           $_SESSION['login_type'] == 'managing_director') {
													?>
													<th>Delete</th>
													<?php }?>
												</tr>
											</thead>	
											
											<tbody>
											<!--php loop start -->
											<?php
											
											   $result = mysqli_query($con,"SELECT * FROM trainee");
											   while($row = mysqli_fetch_array($result)){
											?>
												<tr>
													<td><?php echo $row['department']; ?></td>
													<td><?php echo $row['name']; ?></td>
													<td><?php echo $row['address']; ?></td>
													<td><?php echo $row['phone_number']; ?></td>
													<td><?php echo $row['appointment_date']; ?></td>
													<td>
                                                    <?php echo $row['performance']; ?>%
													<div style="background:#999; width:90%">
														<div style="background:#06F; height:30px; width:<?php echo $row['performance']; ?>%">
                                                    	</div>
                                                    </div> 
                                                    </td>
													<td><?php echo $row['email']; ?></td>
													
													<?php 
														if($_SESSION['login_type'] == 'admin' ||
                                                           $_SESSION['login_type'] == 'managing_director'||
														   $_SESSION['login_type'] == 'junior_officer' ) {
													?>
													
													
													<td><a href="index.php?page=trainee&edit=<?php echo $row['trainee_id']; ?>" >Edit</a></td>
													<?php }?>
													<?php 
														if($_SESSION['login_type'] == 'admin' ||
                                                           $_SESSION['login_type'] == 'managing_director') {
													?>
													<td><a href="index.php?page=trainee&delete=<?php echo $row['trainee_id']; ?>" onclick="return confirm('Are you sure to delete this?')" >Delete</a></td>
													<?php }?>
													
												</tr>
											  <?php	}?>
											<!--php loop end -->
											</tbody>
										
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="add">
								<div class="box-content">
									<form action="index.php?page=trainee&add=do" class="form-horizontal" method="post">
								          
										<div class="control-group">
											<label class="control-label">Department</label>
											<div class="controls">
											<!--<input type="text" name="department" placeholder="Department Name" class="input-large" />-->
											<select name="department">
											      
												  <option value="Finance" >Finance</option>
												  <option value="Technology">Technology</option>
												  <option value="Human Resource">Human Resource</option>
												  <option value="Planning">Planning</option>
											</select>
											</div>
										</div>	
										<div class="control-group">
											<label class="control-label">Name</label>
											<div class="controls">
											<input type="text" name="name" placeholder="name" class="input-large" />
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label">Address</label>
											<div class="controls">
											<input type="text" name="address" placeholder="address" class="input-large" />
											</div>
										</div>
									
										<div class="control-group">
											<label class="control-label">Phone number</label>
											<div class="controls">
											<input type="text" name="phone_number" placeholder="name of managing director" class="input-large" />
											</div>
										</div>
									
										<div class="control-group">
											<label class="control-label">Appointment date</label>
											<div class="controls">
											<input type="text" name="appointment_date" placeholder="name of managing director" class="input-large" />
											</div>
										</div>
									
										<div class="control-group">
											<label class="control-label">Email</label>
											<div class="controls">
											<input type="text" name="email" placeholder="name of managing director" class="input-large" />
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Password</label>
											<div class="controls">
											<input type="text" name="password" placeholder="name of managing director" class="input-large" />
											</div>
										</div>
										
										<div class="form-actions">
										   <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
										</div>
									</form>
								</div>								
							</div>
							
							<?php if(isset($_GET['edit'])){
                                $trn = $_GET['edit']; 
							   $result = mysqli_query($con,"SELECT * FROM trainee WHERE trainee_id='$trn'");
							   while($row = mysqli_fetch_array($result)){
							?>
							<div class="tab-pane active" id="edit">
								<form action="index.php?page=trainee&update=do" method="post"class="form-horizontal">
								    <?php 
														if($_SESSION['login_type'] == 'admin' ||
                                                           $_SESSION['login_type'] == 'managing_director') {
													?>
													
									   <div class="control-group">
											<label class="control-label">Department</label>
											<div class="controls">
											<select name="department">
											      <option value="Technology"<?php if($row['department'] == 'Technology'){echo 'selected';} ?>>Technology</option>
												  <option value="Finance" <?php if($row['department'] == 'Finance'){echo 'selected';} ?>>Finance</option>
												  
												  <option value="Human Resource"<?php if($row['department'] == 'Human Resource'){echo 'selected';} ?>>Human Resource</option>
												  <option value="Planning"<?php if($row['department'] == 'Planning'){echo 'selected';} ?>>Planning</option>
											</select>
											</div>
										</div> 
                                      <?php }?>										
										
										
						
									      <?php 
														if($_SESSION['login_type'] == 'junior_officer' ){
                                                            
													?>
										<div class="control-group">
											<label class="control-label">Performance</label>
											<div class="controls">
                                            <span id="abc"><?php echo $row['performance']; ?></span> % Satisfactory
                                            <br />
											0 <input type="range" min="0" max="100" name="performance" value="<?php echo $row['performance']; ?>"  class="input-large" onchange="sets(this.value)" /> 100 
											</div>
										</div>
                                        <script>
											function sets(abc){
												document.getElementById('abc').innerHTML = abc;
											}
										</script>
										 <?php } ?>
									
										<input type="hidden" name="id" value='<?php echo $trn; ?>' />
									<!--- other input types for adding-->
									
									<div class="form-actions">
									   <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
									</div>
								</form>
							</div>
							<?php } } ?>
						</div>
					</div>
				</div>
			</div>
		</div>