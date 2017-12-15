
<div id="main-content">
		<div class="page-title">
			<div>
				<h1><i class="icon-desktop"></i> Dashboard</h1>
			</div>
		</div>
		
		<div class="row-fluid">
<div class="span12">
<div class="box box-magenta">
<div class="box-title">
<h3><i class="icon-comment"></i>NOTICE</h3>
<div class="box-tool">
<a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
</div>
</div>
<div class="box-content">
<ul class="messages nice-scroll" style="height: 300px; overflow: hidden; outline: none;" tabindex="5000">
	
	<?php											
		   $result = mysqli_query($con,"SELECT * FROM notice ORDER BY notice_id desc");
			
		   while($row = mysqli_fetch_array($result)){
				$type=$row['provider_type'];
				$id=$row['provider_id'];
		   
		?>
	<li>
	<img src="photo/<?php echo $type.'_'.$id; ?>.jpg" alt="">
		<div>
		<div>
		<h5><?php echo $row['provider_name']; ?></h5><br>
		<h5><?php echo $row['title']; ?></h5>
		<span class="time"><i class="icon-time"></i><?php echo $row['date']; ?></span>
		</div>
		<p><?php echo $row['description']; ?></p>
		</div>
	</li>
	<?php
	   } 
	?>
</ul>
</div>
</div>
</div>

</div>
		