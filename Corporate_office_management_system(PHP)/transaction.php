<?php  
									if(isset($_GET['add'])){
									    if($_POST){
										$title=$_POST['title'];
										$amount=$_POST['amount'];
										$type=$_POST['type'];
										$comment=$_POST['comment'];
										$date=$_POST['date'];
										
										mysqli_query($con,"INSERT INTO `transaction` (`title`,`amount`,`type`,`comment`,`date`)
	                                    VALUES ('$title','$amount','$type','$comment','$date')");
	                                    }
									}
								?>
<div id="main-content" >
		<div class="page-title">
			<div>
				<h1><i class="icon-desktop"></i> Transaction</h1>
				
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
								if($_SESSION['login_type'] == 'accountant') {
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
									<center>
										Month:
										<form action="index.php?page=transaction&month=do" class="form-horizontal" method="post">
											<input type="month" name="month" required />
											<input type="submit"  class="btn btn-primary" />
										</form>
									</center>
									<div class="box-content">
										<table class="table">
											<thead>
												<tr>
													
													<th>Title</th>
													<th>Amount</th>
													<th>Type</th>
													<th>Comment</th>
													<th>Date</th>
												</tr>
											</thead>	
											
											<tbody>
											<!--php loop start -->
											<?php											
												$exp = 0;
												$inc = 0;
												if(!isset($_GET['month'])){
													$result = mysqli_query($con,"SELECT * FROM transaction");
											   } else {
													$month_s = $_POST['month'].'-01';
													$month_e = $_POST['month'].'-31';
													$result = mysqli_query($con,"SELECT * FROM transaction WHERE date >= '$month_s' AND date <= '$month_e'");
											   }
											   while($row = mysqli_fetch_array($result)){
											?>
												<tr>
													<td><?php echo $row['title']; ?></td>
													<td><?php echo $row['amount']; ?></td>
													<td><?php echo $row['type']; ?></td>
													<td><?php echo $row['comment']; ?></td>
													<td><?php echo $row['date']; ?></td>
													
												</tr>
												<?php
													if($row['type'] == 'expense'){
														$exp += $row['amount'];
													} else if($row['type'] == 'income'){
														$inc += $row['amount'];
													}	
												?>
											  <?php	}?>
											<!--php loop end -->
											</tbody>
										
										</table>
									</div>
									
									total expense:	<?php echo $exp; ?><br>
									total income:	<?php echo $inc; ?><br>
									Balance: <?php echo $inc-$exp; ?><br>
								</div>
							</div>
							<?php 
														if($_SESSION['login_type'] == 'accountant') {
							?>
							<div class="tab-pane" id="add">
								
								<div class="box-content">
									<form action="index.php?page=transaction&add=do" class="form-horizontal" method="post">
                                           
																		
										<div class="control-group">
											<label class="control-label">Title</label>
											<div class="controls">
											<input type="text" name="title" placeholder="Title" class="input-large" />
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label">Amount</label>
											<div class="controls">
											<input type="number" name="amount" placeholder="Amount" class="input-large" />
											</div>
										</div>
									
										<div class="control-group">
											<label class="control-label">Type</label>
											<div class="controls">
												<select name="type">
													  
													  <option value="expense" >expense</option>
													  <option value="income">income</option>
												</select>
											</div>
										</div>
									
										<div class="control-group">
											<label class="control-label">Comment</label>
											<div class="controls">
											<input type="text" name="comment" placeholder="Comment" class="input-large" />
											</div>
										</div>
										
										<div class="control-group">
											<label class="control-label">Date</label>
											<div class="controls">
											<input type="date" name="date" placeholder="Date" class="input-large" />
											</div>
										</div>
									
										
										<div class="form-actions">
										   <button type="submit" class="btn btn-primary"><i class="icon-ok"></i> Save</button>
										</div>
									</form>
								</div>	
							</div>
							<?php }?>
							<?php if(isset($_GET['edit'])){ ?>
							<div class="tab-pane active" id="edit">
								<form action="#" class="form-horizontal">								
									
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