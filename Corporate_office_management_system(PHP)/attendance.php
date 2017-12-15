<?php  
									if(isset($_GET['fix'])){
										$date = $_POST['date'];
									} else {
										$date = date('Y-m-d');
									}
									
									
									$result = mysqli_query($con,"SELECT * FROM managing_director");
									while($row = mysqli_fetch_array($result)){
										$user = $row['managing_director_id'];
										$usr_typ = 'managing_director';
										$setit = 'no';
									   $result1 = mysqli_query($con,"SELECT * FROM attendance WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
									   while($row1 = mysqli_fetch_array($result1)){
										   $setit = 'yes';
									   }
									   if($setit == 'no'){
										   mysqli_query($con,"INSERT INTO `attendance` (`user_type`,`user_id`,`date`)  VALUES ('$usr_typ','$user','$date')");
									   }
									}
									
									
									$result = mysqli_query($con,"SELECT * FROM director");
									while($row = mysqli_fetch_array($result)){
										$user = $row['director_id'];
										$usr_typ = 'director';
										$setit = 'no';
									   $result1 = mysqli_query($con,"SELECT * FROM attendance WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
									   while($row1 = mysqli_fetch_array($result1)){
										   $setit = 'yes';
									   }
									   if($setit == 'no'){
										   mysqli_query($con,"INSERT INTO `attendance` (`user_type`,`user_id`,`date`)  VALUES ('$usr_typ','$user','$date')");
									   }
									}
									
									
									$result = mysqli_query($con,"SELECT * FROM human_resource");
									while($row = mysqli_fetch_array($result)){
										$user = $row['human_resource_id'];
										$usr_typ = 'human_resource';
										$setit = 'no';
									   $result1 = mysqli_query($con,"SELECT * FROM attendance WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
									   while($row1 = mysqli_fetch_array($result1)){
										   $setit = 'yes';
									   }
									   if($setit == 'no'){
										   mysqli_query($con,"INSERT INTO `attendance` (`user_type`,`user_id`,`date`)  VALUES ('$usr_typ','$user','$date')");
									   }
									}
									
									
									$result = mysqli_query($con,"SELECT * FROM accountant");
									while($row = mysqli_fetch_array($result)){
										$user = $row['accountant_id'];
										$usr_typ = 'accountant';
										$setit = 'no';
									   $result1 = mysqli_query($con,"SELECT * FROM attendance WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
									   while($row1 = mysqli_fetch_array($result1)){
										   $setit = 'yes';
									   }
									   if($setit == 'no'){
										   mysqli_query($con,"INSERT INTO `attendance` (`user_type`,`user_id`,`date`)  VALUES ('$usr_typ','$user','$date')");
									   }
									}
									
									
									$result = mysqli_query($con,"SELECT * FROM executive_officer");
									while($row = mysqli_fetch_array($result)){
										$user = $row['executive_officer_id'];
										$usr_typ = 'executive_officer';
										$setit = 'no';
									   $result1 = mysqli_query($con,"SELECT * FROM attendance WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
									   while($row1 = mysqli_fetch_array($result1)){
										   $setit = 'yes';
									   }
									   if($setit == 'no'){
										   mysqli_query($con,"INSERT INTO `attendance` (`user_type`,`user_id`,`date`)  VALUES ('$usr_typ','$user','$date')");
									   }
									}
									
									
									$result = mysqli_query($con,"SELECT * FROM senior_officer");
									while($row = mysqli_fetch_array($result)){
										$user = $row['senior_officer_id'];
										$usr_typ = 'senior_officer';
										$setit = 'no';
									   $result1 = mysqli_query($con,"SELECT * FROM attendance WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
									   while($row1 = mysqli_fetch_array($result1)){
										   $setit = 'yes';
									   }
									   if($setit == 'no'){
										   mysqli_query($con,"INSERT INTO `attendance` (`user_type`,`user_id`,`date`)  VALUES ('$usr_typ','$user','$date')");
									   }
									}
									
									
									$result = mysqli_query($con,"SELECT * FROM junior_officer");
									while($row = mysqli_fetch_array($result)){
										$user = $row['junior_officer_id'];
										$usr_typ = 'junior_officer';
										$setit = 'no';
									   $result1 = mysqli_query($con,"SELECT * FROM attendance WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
									   while($row1 = mysqli_fetch_array($result1)){
										   $setit = 'yes';
									   }
									   if($setit == 'no'){
										   mysqli_query($con,"INSERT INTO `attendance` (`user_type`,`user_id`,`date`)  VALUES ('$usr_typ','$user','$date')");
									   }
									}
									
									
									$result = mysqli_query($con,"SELECT * FROM trainee");
									while($row = mysqli_fetch_array($result)){
										$user = $row['trainee_id'];
										$usr_typ = 'trainee';
										$setit = 'no';
									   $result1 = mysqli_query($con,"SELECT * FROM attendance WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
									   while($row1 = mysqli_fetch_array($result1)){
										   $setit = 'yes';
									   }
									   if($setit == 'no'){
										   mysqli_query($con,"INSERT INTO `attendance` (`user_type`,`user_id`,`date`)  VALUES ('$usr_typ','$user','$date')");
									   }
									}
									
									if(isset($_GET['make'])){
																				
										$result = mysqli_query($con,"SELECT * FROM trainee");
										while($row = mysqli_fetch_array($result)){
											$user = $row['trainee_id'];
											$usr_typ = 'trainee';
											$stat = $_POST[$usr_typ.'_'.$user];
											$date = $_POST['dat'];
											mysqli_query($con," UPDATE `attendance` SET  `status` =  '$stat' 
										 	   WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date'");	
										}
										
																				
										$result = mysqli_query($con,"SELECT * FROM managing_director");
										while($row = mysqli_fetch_array($result)){
											$user = $row['managing_director_id'];
											$usr_typ = 'managing_director';
											$stat = $_POST[$usr_typ.'_'.$user];
											$date = $_POST['dat'];
											mysqli_query($con," UPDATE `attendance` SET  `status` =  '$stat' 
										 	   WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date'");	
										}
										
																				
										$result = mysqli_query($con,"SELECT * FROM director");
										while($row = mysqli_fetch_array($result)){
											$user = $row['director_id'];
											$usr_typ = 'director';
											$stat = $_POST[$usr_typ.'_'.$user];
											$date = $_POST['dat'];
											mysqli_query($con," UPDATE `attendance` SET  `status` =  '$stat' 
										 	   WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date'");	
										}
										
																				
										$result = mysqli_query($con,"SELECT * FROM human_resource");
										while($row = mysqli_fetch_array($result)){
											$user = $row['human_resource_id'];
											$usr_typ = 'human_resource';
											$stat = $_POST[$usr_typ.'_'.$user];
											$date = $_POST['dat'];
											mysqli_query($con," UPDATE `attendance` SET  `status` =  '$stat' 
										 	   WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date'");	
										}
										
																				
										$result = mysqli_query($con,"SELECT * FROM accountant");
										while($row = mysqli_fetch_array($result)){
											$user = $row['accountant_id'];
											$usr_typ = 'accountant';
											$stat = $_POST[$usr_typ.'_'.$user];
											$date = $_POST['dat'];
											mysqli_query($con," UPDATE `attendance` SET  `status` =  '$stat' 
										 	   WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date'");	
										}
										
																				
										$result = mysqli_query($con,"SELECT * FROM executive_officer");
										while($row = mysqli_fetch_array($result)){
											$user = $row['executive_officer_id'];
											$usr_typ = 'executive_officer';
											$stat = $_POST[$usr_typ.'_'.$user];
											$date = $_POST['dat'];
											mysqli_query($con," UPDATE `attendance` SET  `status` =  '$stat' 
										 	   WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date'");	
										}
										
																				
										$result = mysqli_query($con,"SELECT * FROM senior_officer");
										while($row = mysqli_fetch_array($result)){
											$user = $row['senior_officer_id'];
											$usr_typ = 'senior_officer';
											$stat = $_POST[$usr_typ.'_'.$user];
											$date = $_POST['dat'];
											mysqli_query($con," UPDATE `attendance` SET  `status` =  '$stat' 
										 	   WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date'");	
										}
										
																				
										$result = mysqli_query($con,"SELECT * FROM junior_officer");
										while($row = mysqli_fetch_array($result)){
											$user = $row['junior_officer_id'];
											$usr_typ = 'junior_officer';
											$stat = $_POST[$usr_typ.'_'.$user];
											$date = $_POST['dat'];
											mysqli_query($con," UPDATE `attendance` SET  `status` =  '$stat' 
										 	   WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date'");	
										}
										
									}
									
									
								?>
<div id="main-content">
		<div class="page-title">
			<div>
				<h1><i class="icon-desktop"></i>Attendance</h1>
				
			</div>
		</div>
		
		<div class="row-fluid">
			<div class="span12">
				<div class="box box-blue">
					<div class="box-title">
						<h3>
							<i class="icon-folder-close"></i>
						</h3>
					</div>
                    <center>
                    	<form action="index.php?page=attendance&fix=date" method="post" >
                            <input type="date" value="<?php echo $date; ?>" name="date" />
                            <input type="submit" value="submit" class="btn"  />
                        </form>
                     </center>                    
					<div class="box-content">
						<div class="tab-content">
							<div class="tab-pane <?php if(!isset($_GET['edit'])){ ?>active<?php } ?>" id="list">
								
                                <form action="index.php?page=attendance&make=date" method="post" >
                            	<input type="hidden" value="<?php echo $date; ?>" name="dat" />
                           		<input type="submit" value="Set Attendance" class="btn green"  />
                           <div class="row-fluid">
							 <div class="span3">
                                <div class="box">
									<div class="box-title">
										<h3>
											<i class="icon-table"></i> managing_director
										</h3>
									</div>
									<div class="box-content">
										<table class="table">
											<thead>
												<tr>
													<th>Name</th>
													<th>Attendance</th>
												</tr>
											</thead>	
											
											<tbody>
											<?php
											
											   $result = mysqli_query($con,"SELECT * FROM managing_director");
											    while($row = mysqli_fetch_array($result)){
												$user = $row['managing_director_id'];
												$usr_typ = 'managing_director';
											?>
												<tr>
													<td><?php echo $row['name']; ?></td>
													<td>
										<?php 
                                            $result1 = mysqli_query($con,"SELECT * FROM attendance 
											 WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
                                            while($row1 = mysqli_fetch_array($result1)){
                                                  $stat = $row1['status'];
                                            }
                                        ?>
                                        			<input type="checkbox" 
                                                    name="<?php echo $usr_typ ?>_<?php echo $user ?>"
                                                     value="p" <?php if($stat == 'p'){ echo 'checked'; } ?> />
                                                     </td>
													
												</tr>
											  <?php	}?>
											</tbody>
										
										</table>
									</div>
								</div>
                             </div>
							 <div class="span3">
								<div class="box">
									<div class="box-title">
										<h3>
											<i class="icon-table"></i> director
										</h3>
									</div>
									<div class="box-content">
										<table class="table">
											<thead>
												<tr>
													<th>Name</th>
													<th>Attendance</th>
												</tr>
											</thead>	
											
											<tbody>
											<?php
											
											   $result = mysqli_query($con,"SELECT * FROM director");
											   while($row = mysqli_fetch_array($result)){
											$user = $row['director_id'];
												$usr_typ = 'director';
											?>
												<tr>
													<td><?php echo $row['name']; ?></td>
													<td>
										<?php 
                                            $result1 = mysqli_query($con,"SELECT * FROM attendance 
											 WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
                                            while($row1 = mysqli_fetch_array($result1)){
                                                  $stat = $row1['status'];
                                            }
                                        ?>
                                        			<input type="checkbox" 
                                                    name="<?php echo $usr_typ ?>_<?php echo $user ?>"
                                                     value="p" <?php if($stat == 'p'){ echo 'checked'; } ?> />
                                                     </td>
													
												</tr>
											  <?php	}?>
											</tbody>
										
										</table>
									</div>
								</div>
                             </div>
							 <div class="span3">
								<div class="box">
									<div class="box-title">
										<h3>
											<i class="icon-table"></i> human resource
										</h3>
									</div>
									<div class="box-content">
										<table class="table">
											<thead>
												<tr>
													<th>Name</th>
													<th>Attendance</th>
												</tr>
											</thead>	
											
											<tbody>
											<?php
											
											   $result = mysqli_query($con,"SELECT * FROM human_resource");
											   while($row = mysqli_fetch_array($result)){
											$user = $row['human_resource_id'];
												$usr_typ = 'human_resource';
											?>
												<tr>
													<td><?php echo $row['name']; ?></td>
													<td>
										<?php 
                                            $result1 = mysqli_query($con,"SELECT * FROM attendance 
											 WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
                                            while($row1 = mysqli_fetch_array($result1)){
                                                  $stat = $row1['status'];
                                            }
                                        ?>
                                        			<input type="checkbox" 
                                                    name="<?php echo $usr_typ ?>_<?php echo $user ?>"
                                                     value="p" <?php if($stat == 'p'){ echo 'checked'; } ?> />
                                                     </td>
													
												</tr>
											  <?php	}?>
											</tbody>
										
										</table>
									</div>
								</div>
                             </div>
							 <div class="span3">
                                <div class="box">
									<div class="box-title">
										<h3>
											<i class="icon-table"></i> accountant
										</h3>
									</div>
									<div class="box-content">
										<table class="table">
											<thead>
												<tr>
													<th>Name</th>
													<th>Attendance</th>
												</tr>
											</thead>	
											
											<tbody>
											<?php
											
											   $result = mysqli_query($con,"SELECT * FROM accountant");
											   while($row = mysqli_fetch_array($result)){
											$user = $row['accountant_id'];
												$usr_typ = 'accountant';
											?>
												<tr>
													<td><?php echo $row['name']; ?></td>
													<td>
										<?php 
                                            $result1 = mysqli_query($con,"SELECT * FROM attendance 
											 WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
                                            while($row1 = mysqli_fetch_array($result1)){
                                                  $stat = $row1['status'];
                                            }
                                        ?>
                                        			<input type="checkbox" 
                                                    name="<?php echo $usr_typ ?>_<?php echo $user ?>"
                                                     value="p" <?php if($stat == 'p'){ echo 'checked'; } ?> />
                                                     </td>
													
												</tr>
											  <?php	}?>
											</tbody>
										
										</table>
									</div>
								</div>
                             </div>
                           </div>                           
                           <div class="row-fluid">
							 <div class="span3">
								<div class="box">
									<div class="box-title">
										<h3>
											<i class="icon-table"></i> executive officer
										</h3>
									</div>
									<div class="box-content">
										<table class="table">
											<thead>
												<tr>
													<th>Name</th>
													<th>Attendance</th>
												</tr>
											</thead>	
											
											<tbody>
											<?php
											
											   $result = mysqli_query($con,"SELECT * FROM executive_officer");
											   while($row = mysqli_fetch_array($result)){
											$user = $row['executive_officer_id'];
												$usr_typ = 'executive_officer';
											?>
												<tr>
													<td><?php echo $row['name']; ?></td>
													<td>
										<?php 
                                            $result1 = mysqli_query($con,"SELECT * FROM attendance 
											 WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
                                            while($row1 = mysqli_fetch_array($result1)){
                                                  $stat = $row1['status'];
                                            }
                                        ?>
                                        			<input type="checkbox" 
                                                    name="<?php echo $usr_typ ?>_<?php echo $user ?>"
                                                     value="p" <?php if($stat == 'p'){ echo 'checked'; } ?> />
                                                     </td>
													
												</tr>
											  <?php	}?>
											</tbody>
										
										</table>
									</div>
								</div>
                             </div>
							 <div class="span3">
								<div class="box">
									<div class="box-title">
										<h3>
											<i class="icon-table"></i> senior officer
										</h3>
									</div>
									<div class="box-content">
										<table class="table">
											<thead>
												<tr>
													<th>Name</th>
													<th>Attendance</th>
												</tr>
											</thead>	
											
											<tbody>
											<?php
											
											   $result = mysqli_query($con,"SELECT * FROM senior_officer");
											   while($row = mysqli_fetch_array($result)){
											$user = $row['senior_officer_id'];
												$usr_typ = 'senior_officer';
											?>
												<tr>
													<td><?php echo $row['name']; ?></td>
													<td>
										<?php 
                                            $result1 = mysqli_query($con,"SELECT * FROM attendance 
											 WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
                                            while($row1 = mysqli_fetch_array($result1)){
                                                  $stat = $row1['status'];
                                            }
                                        ?>
                                        			<input type="checkbox" 
                                                    name="<?php echo $usr_typ ?>_<?php echo $user ?>"
                                                     value="p" <?php if($stat == 'p'){ echo 'checked'; } ?> />
                                                     </td>
													
												</tr>
											  <?php	}?>
											</tbody>
										
										</table>
									</div>
								</div>
                             </div>
							 <div class="span3">
								<div class="box">
									<div class="box-title">
										<h3>
											<i class="icon-table"></i> junior officer
										</h3>
									</div>
									<div class="box-content">
										<table class="table">
											<thead>
												<tr>
													<th>Name</th>
													<th>Attendance</th>
												</tr>
											</thead>	
											
											<tbody>
											<?php
											
											   $result = mysqli_query($con,"SELECT * FROM junior_officer");
											   while($row = mysqli_fetch_array($result)){
											$user = $row['junior_officer_id'];
												$usr_typ = 'junior_officer';
											?>
												<tr>
													<td><?php echo $row['name']; ?></td>
													<td>
										<?php 
                                            $result1 = mysqli_query($con,"SELECT * FROM attendance 
											 WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
                                            while($row1 = mysqli_fetch_array($result1)){
                                                  $stat = $row1['status'];
                                            }
                                        ?>
                                        			<input type="checkbox" 
                                                    name="<?php echo $usr_typ ?>_<?php echo $user ?>"
                                                     value="p" <?php if($stat == 'p'){ echo 'checked'; } ?> />
                                                     </td>
													
												</tr>
											  <?php	}?>
											</tbody>
										
										</table>
									</div>
								</div>
                             </div>
							 <div class="span3">
								<div class="box">
									<div class="box-title">
										<h3>
											<i class="icon-table"></i> trainee
										</h3>
									</div>
									<div class="box-content">
										<table class="table">
											<thead>
												<tr>
													<th>Name</th>
													<th>Attendance</th>
												</tr>
											</thead>	
											
											<tbody>
											<?php
											
											   $result = mysqli_query($con,"SELECT * FROM trainee");
											   while($row = mysqli_fetch_array($result)){
											$user = $row['trainee_id'];
												$usr_typ = 'trainee';
											?>
												<tr>
													<td><?php echo $row['name']; ?></td>
													<td>
										<?php 
                                            $result1 = mysqli_query($con,"SELECT * FROM attendance 
											 WHERE user_type = '$usr_typ' AND user_id = '$user' AND date = '$date' ");
                                            while($row1 = mysqli_fetch_array($result1)){
                                                  $stat = $row1['status'];
                                            }
                                        ?>
                                        			<input type="checkbox" 
                                                    name="<?php echo $usr_typ ?>_<?php echo $user ?>"
                                                     value="p" <?php if($stat == 'p'){ echo 'checked'; } ?> />
                                                     </td>
													
												</tr>
											  <?php	}?>
											</tbody>
										
										</table>
									</div>
								</div>
                             </div>
                           </div>    
                                </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>