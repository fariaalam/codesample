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
										
										mysqli_query($con,"INSERT INTO `accountant` (`department`,`name`,`address`,`phone_number`,`appointment_date`,`email`,`password`)
	                                    VALUES ('$department','$name','$address','$phone_number','$appointment_date','$email','$password')");
										
								/*		$to  = $email;
										$subject = 'Account Open';
										
										// email er jonno ** eikhan theke
										// **** onnogulate "Accountant" er jaegae type ta change kore diba
										$message = 'Your account as an "Accountant" has been created.';
										$message .= 'Please login as "Accountant" <br>';
										$message .= 'E-mail: '.$email;
										$message .= '<br>password: '.$password;
										$message .= '<br>Thanks';
										$headers  = 'MIME-Version: 1.0' . "\r\n";
										$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
										$headers .= 'To: '.$name.' <'.$email.'>'. "\r\n";
										$headers .= 'From: Office Management' . "\r\n";
										
										mail($to, $subject, $message, $headers);*/
										//** ei porjonto (local server e kaj korbe na)
	                                    }
									}
									if($_SESSION['login_type'] == 'managing_director'){
									if(isset($_GET['update'])){
									    if($_POST){
										
                                         $performance=$_POST['performance']; //**sobgulate update er vitore ei jaegae change korte hobe
                                         $id=$_POST['id'];
										 //**query r vitoreo change hobe "performance".. sobgulate
										mysqli_query($con," UPDATE `accountant` SET  `performance` =  '$performance'
		                                                 	
															WHERE  `accountant_id` ='$id'");
	                                    }
									}
									}else{
									  if(isset($_GET['update'])){
									  if($_POST){
										
                                         $department=$_POST['department']; //**sobgulate update er vitore ei jaegae change korte hobe
                                         $id=$_POST['id'];
										 //**query r vitoreo change hobe "performance".. sobgulate
										mysqli_query($con," UPDATE `accountant` SET  `department` =  '$department'
		                                                 	
															WHERE  `accountant_id` ='$id'");
	                                    }
									}
									
									}
									if(isset($_GET['delete'])){
                                         $id=$_GET['delete'];
										 
										mysqli_query($con,"DELETE FROM `accountant` WHERE accountant_id='$id'");
									}
								?>
<div id="main-content">
		<div class="page-title">
			<div>
				<h1><i class="icon-desktop"></i>Accountant</h1>
				
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
													<th>Performance</th> <!-- **ei line ta sobgulate jabe -->
													<th>Email</th>
												
													
                                                    
                                                    <!-- **ei part ta sobgulate delete e dia diba -->
													<?php 
														if($_SESSION['login_type'] == 'admin' ||
                                                           $_SESSION['login_type'] == 'managing_director') {
													?>
													<th>Edit</th>
													<th>Delete</th>
                                                    <?php } ?>
                                                    
												</tr>
											</thead>	
											
											<tbody>
											<!--php loop start -->
											<?php
											
											   $result = mysqli_query($con,"SELECT * FROM accountant");
											   while($row = mysqli_fetch_array($result)){
											?>
												<tr>
													<td><?php echo $row['department']; ?></td>
													<td><?php echo $row['name']; ?></td>
													<td><?php echo $row['address']; ?></td>
													<td><?php echo $row['phone_number']; ?></td>
													<td><?php echo $row['appointment_date']; ?></td>
                                                    
                                                    <!-- **ei td ta sobgulate jabe -->
													<td>
                                                    <?php echo $row['performance']; ?>%
													<div style="background:#999; width:90%">
														<div style="background:#06F; height:30px; width:<?php echo $row['performance']; ?>%">
                                                    	</div>
                                                    </div> 
                                                    </td>
                                                    <!-- **ei porjonto -->
                                                    
													<td><?php echo $row['email']; ?></td>
													
													
                                                    
                                                    <!-- **ei part ta sobgulate delete e dia diba -->
													<?php 
														if($_SESSION['login_type'] == 'admin' ||
                                                           $_SESSION['login_type'] == 'managing_director') {
													?>
													<td><a href="index.php?page=accountant&edit=<?php echo $row['accountant_id']; ?>" >Edit</a></td>
													<td><a href="index.php?page=accountant&delete=<?php echo $row['accountant_id']; ?>" onclick="return confirm('Are you sure to delete this?')" >Delete</a></td>
                                                    <?php } ?>
													
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
									<form action="index.php?page=accountant&add=do" class="form-horizontal" method="post">
									   <div class="control-group">
											<label class="control-label">Department</label>
											<div class="controls">
											
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
											<input type="text" name="name" placeholder="name of managing director" class="input-large" />
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label">Address</label>
											<div class="controls">
											<input type="text" name="address" placeholder="name of managing director" class="input-large" />
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
							
							<?php 
							
                                    if(isset($_GET['edit'])){
								    $acc = $_GET['edit'];
							        $result = mysqli_query($con,"SELECT * FROM accountant WHERE accountant_id='$acc'");
							        while($row = mysqli_fetch_array($result)){							
							?>
							<div class="tab-pane active" id="edit">
								<form action="index.php?page=accountant&update=do" method="post" class="form-horizontal">
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
										<!--<div class="control-group">
											<label class="control-label">Name</label>
											<div class="controls">
											<input type="text" name="name" value="<?php echo $row['name']; ?>" placeholder="name of managing director" class="input-large" />
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label">Address</label>
											<div class="controls">
											<input type="text" name="address" value="<?php echo $row['address']; ?>"  placeholder="Address" class="input-large" />
											</div>
										</div>
									
										<div class="control-group">
											<label class="control-label">Phone number</label>
											<div class="controls">
											<input type="text" name="phone_number" value="<?php echo $row['phone_number']; ?>" placeholder="phone_number" class="input-large" />
											</div>
										</div>
									
										<div class="control-group">
											<label class="control-label">Appointment date</label>
											<div class="controls">
											<input type="text" name="appointment_date" value="<?php echo $row['appointment_date']; ?>" placeholder="appointment-date" class="input-large" />
											</div>
										</div>-->
								        <?php 
														if($_SESSION['login_type'] == 'managing_director') {
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
									<!-- **eiporjonto  -->
									 
									 <?php }?>
										<!--<div class="control-group">
											<label class="control-label">Email</label>
											<div class="controls">
											<input type="text" name="email" value="<?php echo $row['email']; ?>" placeholder="email" class="input-large" />
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Password</label>
											<div class="controls">
											<input type="text" name="password" value="<?php echo $row['password']; ?>"  placeholder="password" class="input-large" />
											</div>
										</div>-->
										<input type="hidden" name="id" value='<?php echo $acc; ?>' />			
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