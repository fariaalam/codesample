<?php  
/*
project_id	

	2	budget

	3	department

	4	description

	5	project_head

	6	project_progress*/
									if(isset($_GET['add'])){
									    if($_POST){
										$budget=$_POST['budget'];
										$department=$_POST['department'];
										$description=$_POST['description'];
										$project_head=$_POST['project_head'];
										
										
																				
										mysqli_query($con,"INSERT INTO `project` (`budget`,`department`,`description`,`project_head`)
	                                    VALUES ('$budget','$department','$description','$project_head')");
										
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
									if(isset($_GET['update'])){
									    if($_POST){
										$project_head=$_POST['project_head'];
										$department=$_POST['department'];
										 $budget=$_POST['budget'];
										$description=$_POST['description'];
                                       $project_progress=$_POST['project_progress'];
										
										
									      //**sobgulate update er vitore ei jaegae change korte hobe
                                         $id=$_POST['id'];
										 //**query r vitoreo change hobe "performance".. sobgulate
										mysqli_query($con," UPDATE `project` SET  `project_head`='$project_head',   
										                     
		                                                 	`department` =  '$department',
                                                            `budget` =  '$budget', 															
		                                                	`description` =  '$description', 
														    `project_progress`='$project_progress' 
															 
															WHERE  `project_id` ='$id'");
	                                    }
									}
									
									if(isset($_GET['delete'])){
                                         $id=$_GET['delete'];
										 
										mysqli_query($con,"DELETE FROM `project` WHERE project_id='$id'");
									}
								?>
<div id="main-content">
		<div class="page-title">
			<div>
				<h1><i class="icon-desktop"></i>Project</h1>
				
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
							  
													  
													<?php 
														if($_SESSION['login_type'] == 'admin' ||
                                                           $_SESSION['login_type'] == 'managing_director'||
														   $_SESSION['login_type'] == 'director'||
														   $_SESSION['login_type'] == 'human_resource' ||
														   $_SESSION['login_type'] == 'accountant') {
													?>
							<li>
								<a href="#add" data-toggle="tab">Add</a>
							</li>
							<?php }?>
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
													<th>Project Head</th>
													<th>Department</th>
													<th>Budget</th>
													<th>Description</th>
													<th>Project Progress</th>
													
													
                                                    
                                                    
													<?php 
														if($_SESSION['login_type'] == 'admin' ||
                                                           $_SESSION['login_type'] == 'managing_director'||
														   $_SESSION['login_type'] == 'director'||
														   $_SESSION['login_type'] == 'human_resource' ||
														   $_SESSION['login_type'] == 'accountant') {
													?>
													<th>Edit</th>
													<th>Delete</th>
                                                    <?php } ?>
                                                    
												</tr>
											</thead>	
											
											<tbody>
											<!--php loop start -->
											<?php
											
											   $result = mysqli_query($con,"SELECT * FROM project");
											   while($row = mysqli_fetch_array($result)){
											?>
												<tr>
													<td><?php echo $row['project_head']; ?></td>
													<td><?php echo $row['department']; ?></td>
													<td><?php echo $row['budget']; ?></td>
													<td><?php echo $row['description']; ?></td>
													
                                                    
                                                   
													<td>														
														<div class="circle-stats-item blue">
														<i class="icon-bar-chart"></i>
														<span class="percent">%</span>
														<input value="<?php echo $row['project_progress']; ?>" data-fgcolor="blue" data-min="0" data-min="100" />
														</div>
                                                    </td>
                                                    
                                                    
													
													
                                                    
													<?php 
														if($_SESSION['login_type'] == 'admin' ||
                                                           $_SESSION['login_type'] == 'managing_director'||
														   $_SESSION['login_type'] == 'director'||
														   $_SESSION['login_type'] == 'human_resource' ||
														   $_SESSION['login_type'] == 'accountant') {
													?>
													<td><a href="index.php?page=project&edit=<?php echo $row['project_id']; ?>" >Edit</a></td>
                                                    
													<td><a href="index.php?page=project&delete=<?php echo $row['project_id']; ?>" onclick="return confirm('Are you sure to delete this?')" >Delete</a></td>
                                                    <?php } ?>
													
												</tr>
											  <?php	}?>
											<!--php loop end -->
											</tbody>
										
										</table>
									</div>
								</div>
							</div>
							
												  
													<?php 
														if($_SESSION['login_type'] == 'admin' ||
                                                           $_SESSION['login_type'] == 'managing_director'||
														   $_SESSION['login_type'] == 'director'||
														   $_SESSION['login_type'] == 'human_resource' ||
														   $_SESSION['login_type'] == 'accountant') {
													?>
							<div class="tab-pane" id="add">
								
								<div class="box-content">
									<form action="index.php?page=project&add=do" class="form-horizontal" method="post">
									   <div class="control-group">
											<label class="control-label">Project head</label>
											<div class="controls">
											 <select name="project_head">
											  <option value="" >Select a Project Head</option>
											      
										<?php							
								            
											$result3 = mysqli_query($con,"SELECT * FROM director");
											while($row3 = mysqli_fetch_array($result3)){
											?>
										   
											    
												  <option value="<?php echo $row3['name']; ?>" ><?php echo $row3['name']; ?></option>
												  <?php }?>
												 <!-- <option value="Technology">Technology</option>
												  <option value="Human Resource">Human Resource</option>
												  <option value="Planning">Planning</option>-->
											</select>
											
											</div>
										</div>		
										<div class="control-group">
											<label class="control-label">Department</label>
											<div class="controls">
											    <select name="department">
											      <option value="Finance" >Select a Department</option>
												  <option value="Finance" >Finance</option>
												  <option value="Technology">Technology</option>
												  <option value="Human Resource">Human Resource</option>
												  <option value="Planning">Planning</option>
										
											</select>
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label">Budget</label>
											<div class="controls">
											<input type="text" name="budget" placeholder="budget" class="input-large" />
											</div>
										</div>
									
										<div class="control-group">
											<label class="control-label">Description</label>
											<div class="controls">
											<input type="text" name="description" placeholder="Description" class="input-large" />
											</div>
										</div>
									
									
										
										<div class="form-actions">
										   <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
										</div>
									</form>
								</div>								
							</div>
							<?php }?>
							
							<?php 
							
                                    if(isset($_GET['edit'])){
								    $pro = $_GET['edit'];
							        $result = mysqli_query($con,"SELECT * FROM project WHERE project_id='$pro'");
							        while($row = mysqli_fetch_array($result)){							
							?>
							<div class="tab-pane active" id="edit">
								<form action="index.php?page=project&update=do" method="post" class="form-horizontal">
					                        <div class="control-group">
											<label class="control-label">Project Head</label>
											<div class="controls">
											<select name="project_head">
											
											      <option value="" >Select a Project Head</option>
											<?php 
												$result3 = mysqli_query($con,"SELECT * FROM director");
												while($row3 = mysqli_fetch_array($result3)){
											?>	  
											      <option value="<?php echo $row3['name']; ?>" <?php if($row['project_head'] == $row3['name']){echo 'selected';} ?>><?php echo $row3['name']; ?></option>
											<?php } ?>	  
											</select>
											</div>
										</div>	
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
									<div class="control-group">
											<label class="control-label">Budget</label>
											<div class="controls">
											<input type="text" name="budget"  value="<?php echo $row['budget']; ?>"placeholder="budget" class="input-large" />
											</div>
										</div>
									
										
										<div class="control-group">
											<label class="control-label">Description</label>
											<div class="controls">
											<input type="text" name="description" value="<?php echo $row['description']; ?>"  placeholder="description" class="input-large" />
											</div>
										</div>
									
										
									
									
										<div class="control-group">
											<label class="control-label">Project Progress</label>
											<div class="controls">
                                            <span id="abc"><?php echo $row['project_progress']; ?></span> % Satisfactory
                                            <br />
											0 <input type="range" min="0" max="100" name="project_progress" value="<?php echo $row['project_progress']; ?>"  class="input-large" onchange="sets(this.value)" /> 100 
											</div>
										</div>
                                        <script>
											function sets(abc){
												document.getElementById('abc').innerHTML = abc;
											}
										</script>
									
									
										
										<input type="hidden" name="id" value='<?php echo $pro; ?>' />			
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