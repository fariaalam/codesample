<?php  
    $type = $_SESSION['login_type'];
	$id_field = $type.'_id';
	$id = $_SESSION['user'];
		$result = mysqli_query($con,"SELECT * FROM $type WHERE $id_field = $id");
		  while($row = mysqli_fetch_array($result)){
		        $name=$row['name'];
				
				
		  }


									if(isset($_GET['add'])){
									    if($_POST){
										$description=$_POST['description'];
										$title=$_POST['title'];
										$date=$_POST['date'];
										mysqli_query($con,"INSERT INTO `notice` (`description`,`date`,`title`,`provider_id`,`provider_name`,`provider_type`)
	                                    VALUES ('$description','$date','$title','$id','$name','$type')");
	                                    }
									}
									if(isset($_GET['update'])){
									    if($_POST){
										$description=$_POST['description'];
										$title=$_POST['title'];
										$date=$_POST['date'];
										$id=$_POST['id'];
										 
										mysqli_query($con," UPDATE `notice` SET  `description` =  '$description', 
		                                                 	`title` =  '$title', 
		                                                	`date` =  '$date'
															WHERE  `notice_id` ='$id'");	
	                                    }
									}
									
									
									if(isset($_GET['delete'])){
                                         $id=$_GET['delete'];
										 
										mysqli_query($con,"DELETE FROM `notice` WHERE `notice_id`='$id'");
									}
								?>
<div id="main-content">
		<div class="page-title">
			<div>
				<h1><i class="icon-desktop"></i>Notice</h1>
			
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
													
													<th>Description</th>
													<th>Title</th>
													<th>Date</th>
													<th>Provider_Name</th>
													<th>Edit</th>
													<th>Delete</th>
													
												</tr>
											</thead>	
											
											<tbody>
											<!--php loop start -->
											<?php
											
											   $result = mysqli_query($con,"SELECT * FROM notice");
											   while($row = mysqli_fetch_array($result)){
											?>
												<tr>
													<td><?php echo $row['description']; ?></td>
													<td><?php echo $row['title']; ?></td>
													<td><?php echo $row['date']; ?></td>
													<td><?php echo $row['provider_name']; ?></td>
													<td><a href="index.php?page=notice&edit=<?php echo $row['notice_id']; ?>" >Edit</a></td>
													<td><a href="index.php?page=notice&delete=<?php echo $row['notice_id']; ?>" onclick="return confirm('Are you sure to delete this?')" >Delete</a></td>
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
									<form action="index.php?page=notice&add=do" class="form-horizontal" method="post">
                                           
																	
										<div class="control-group">
											<label class="control-label">Description</label>
											<div class="controls">
											<input type="text" name="description" placeholder="add description" class="input-large" />
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label">Title</label>
											<div class="controls">
											<input type="text" name="title" placeholder="add title" class="input-large" />
											</div>
										</div>
									
										<div class="control-group">
											<label class="control-label">Date</label>
											<div class="controls">
											<input type="text" name="date" placeholder="add date" class="input-large" />
											</div>
										</div>
									
										
										
										<div class="form-actions">
										   <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
										</div>
									</form>
								</div>								
							</div>
							
							<?php if(isset($_GET['edit'])){ 
							    	$not = $_GET['edit'];
							   $result = mysqli_query($con,"SELECT * FROM `notice` WHERE notice_id='$not'");
							   while($row = mysqli_fetch_array($result)){
							
							?>
							<div class="tab-pane active" id="edit">
								<form action="index.php?page=notice&update=do" method="post" class="form-horizontal">
								
									    				
										<div class="control-group">
											<label class="control-label" >Description</label>
											<div class="controls">
											<input type="text" name="description" value="<?php echo $row['description'];?>" placeholder="name of managing director" class="input-large" />
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label">Title</label>
											<div class="controls">
											<input type="text" name="title" value="<?php echo $row['title'];?>" placeholder="name of managing director" class="input-large" />
											</div>
										</div>
									
										<div class="control-group">
											<label class="control-label">Date</label>
											<div class="controls">
											<input type="text" name="date" value="<?php echo $row['date'];?>" placeholder="name of managing director" class="input-large" />
											</div>
										</div>
									
										
										<input type="hidden" name="id" value='<?php echo $not; ?>' />
									<div class="form-actions">
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