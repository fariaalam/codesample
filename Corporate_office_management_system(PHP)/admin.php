<div id="main-content">
		<div class="page-title">
			<div>
				<h1><i class="icon-desktop"></i> ADMIN</h1>
				
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
													
													<th>Name</th>
													<th>Address</th>
													<th>Phone number</th>
													<th>Appointment Date</th>
													<th>Email</th>
													<th>Password</th>
												</tr>
											</thead>	
											
											<tbody>
											<!--php loop start -->
											<?php
											
											   $result = mysqli_query($con,"SELECT * FROM admin");
											   while($row = mysqli_fetch_array($result)){
											?>
												<tr>
													
													<td><?php echo $row['name']; ?></td>
													<td><?php echo $row['address']; ?></td>
													<td><?php echo $row['phone_number']; ?></td>
													<td><?php echo $row['appointment_date']; ?></td>
													<td><?php echo $row['email']; ?></td>
													<td><?php echo $row['password']; ?></td>
													
												</tr>
											  <?php	}?>
											<!--php loop end -->
											</tbody>
										
										</table>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="add">
								<?php  
									if(isset($_GET['add'])){
									    if($_POST){
										$name=$_POST['name'];
										$address=$_POST['address'];
										$phone_number=$_POST['phone_number'];
										$appointment_date=$_POST['appointment_date'];
										$email=$_POST['email'];
										$password=$_POST['password'];
										
										mysqli_query($con,"INSERT INTO `admin` (`name`,`address`,`phone_number`,`appointment_date`,`email`,`password`)
	                                    VALUES ('$name','$address','$phone_number','$appointment_date','$email','$password')");
	                                    }
									}
								?>
								<div class="box-content">
									<form action="index.php?page=admin&add=do" class="form-horizontal" method="post">
									
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
							
							<?php if(isset($_GET['edit'])){ ?>
							<div class="tab-pane active" id="edit">
								<form action="#" class="form-horizontal">
								
									<div class="control-group">
										<label class="control-label">Name</label>
										<div class="controls">
										<input type="text" name="name" placeholder="name of managing director" class="input-large" />
										</div>
									</div>
									<!--- other input types for adding-->
									
									<div class="form-actions">
									   <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
									</div>
								</form>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>