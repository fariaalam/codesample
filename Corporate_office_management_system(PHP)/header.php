<div id="navbar" class="navbar">
	<div class="navbar-inner">
		<div class="container-fluid">

		<a href="#" class="brand">
			<small>
				<i class="icon-desktop"></i>AUST
			</small>
		</a>
		
		<a href="#" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
			<i class="icon-reorder"></i>
		</a>
		
		<ul class="nav creativeitem-nav pull-right">
			<li class="user-profile">
				<a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
					<span class="hidden-phone" id="user_info">
						<?php echo $_SESSION['login_type']; ?>
					</span>
					<i class="icon-caret-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-navbar" id="user_menu">

					<li>
						<a href="logout.php">
							<i class="icon-off"></i> Logout
						</a>
					</li>
				</ul>
			</li>
		</ul>

		</div><!--/.container-fluid-->
	</div><!--/.navbar-inner-->
</div>



<div class="container-fluid" id="main-container">

	<div id="sidebar" class="nav-collapse">

		<ul class="nav nav-list">
			
		
			
			<li>
				<a href="index.php">
					<i class="icon-dashboard"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<?php if($_SESSION['login_type'] == 'admin' ||
						$_SESSION['login_type'] == 'managing_director') { ?>
			<li>
				<a href="index.php?page=notice">
					<i class="icon-dashboard"></i>
					<span>Notice</span>
				</a>
			</li>
			<?php } ?>
			
			<?php if($_SESSION['login_type'] == 'admin' ||
						$_SESSION['login_type'] == 'managing_director'||
						$_SESSION['login_type'] == 'director' ||
						$_SESSION['login_type'] == 'human_resource') { ?>
			<li>
				<a href="index.php?page=attendance">
					<i class="icon-dashboard"></i>
					<span>attendance</span>
				</a>
			</li>
			<?php } ?>
			
			<?php if($_SESSION['login_type'] == 'admin' ||
						$_SESSION['login_type'] == 'managing_director'||
						$_SESSION['login_type'] == 'director'||
						$_SESSION['login_type'] == 'executive_officer'||
						$_SESSION['login_type'] == 'accountant') { ?>
			<li>
				<a href="index.php?page=transaction">
					<i class="icon-dashboard"></i>
					<span>Transactions</span>
				</a>
			</li>
			<?php } ?>
			
			<?php if($_SESSION['login_type'] == 'admin'||
			$_SESSION['login_type'] == 'managing_director'){ ?>
			<li>
				<a href="index.php?page=managing_director">
					<i class="icon-dashboard"></i>
					<span>Managing Director</span>
				</a>
				
			</li>
			<?php } ?>
			
			<?php if($_SESSION['login_type'] == 'admin' ||
						$_SESSION['login_type'] == 'managing_director' ||
						$_SESSION['login_type'] == 'director') { ?>
			<li>
				<a href="index.php?page=director">
					<i class="icon-dashboard"></i>
					<span>director</span>
				</a>
			</li>
			<?php } ?>
			
			
			<?php if($_SESSION['login_type'] == 'admin' ||
						$_SESSION['login_type'] == 'managing_director'||
						$_SESSION['login_type'] == 'director' ||
						$_SESSION['login_type'] == 'human_resource') { ?>
			<li>
				<a href="index.php?page=human_resource">
					<i class="icon-dashboard"></i>
					<span>human_resource</span>
				</a>
			</li>
			<?php } ?>
			
			
			
			<?php if($_SESSION['login_type'] == 'admin' ||
						$_SESSION['login_type'] == 'managing_director'||
						$_SESSION['login_type'] == 'director'||
						$_SESSION['login_type'] == 'human_resource' ||
						$_SESSION['login_type'] == 'accountant') { ?>
			<li>
				<a href="index.php?page=accountant">
					<i class="icon-dashboard"></i>
					<span>accountant</span>
				</a>
			</li>
			<?php } ?>
			
			<?php if($_SESSION['login_type'] == 'admin' ||
						$_SESSION['login_type'] == 'managing_director'||
						$_SESSION['login_type'] == 'director'||
						$_SESSION['login_type'] == 'human_resource'||
						$_SESSION['login_type'] == 'accountant' ||
						$_SESSION['login_type'] == 'executive_officer') { ?>
			<li>
				<a href="index.php?page=executive_officer">
					<i class="icon-dashboard"></i>
					<span>executive_officer</span>
				</a>
			</li>
			<?php } ?>
			
			<?php if($_SESSION['login_type'] == 'admin' ||
						$_SESSION['login_type'] == 'managing_director'||
						$_SESSION['login_type'] == 'director'||
						$_SESSION['login_type'] == 'human_resource'||
						$_SESSION['login_type'] == 'accountant'||
						$_SESSION['login_type'] == 'executive_officer'||
						$_SESSION['login_type'] == 'senior_officer') { ?>
			<li>
				<a href="index.php?page=senior_officer">
					<i class="icon-dashboard"></i>
					<span>senior_officer</span>
				</a>
			</li>
			<?php } ?>
			
			<?php if($_SESSION['login_type'] == 'admin' ||
						$_SESSION['login_type'] == 'managing_director'||
						$_SESSION['login_type'] == 'director'||
						$_SESSION['login_type'] == 'human_resource'||
						$_SESSION['login_type'] == 'executive_officer'||
						$_SESSION['login_type'] == 'accountant'||
						$_SESSION['login_type'] == 'senior_officer'||
						$_SESSION['login_type'] == 'junior_officer') { ?>
			<li>
				<a href="index.php?page=junior_officer">
					<i class="icon-dashboard"></i>
					<span>junior_officer</span>
				</a>
			</li>
			<?php } ?>
			
			<?php if($_SESSION['login_type'] == 'admin' ||
						$_SESSION['login_type'] == 'managing_director'||
						$_SESSION['login_type'] == 'director'||
						$_SESSION['login_type'] == 'human_resource'||
						$_SESSION['login_type'] == 'executive_officer'||
						$_SESSION['login_type'] == 'accountant'||
						$_SESSION['login_type'] == 'senior_officer'||
						$_SESSION['login_type'] == 'junior_officer'||
						$_SESSION['login_type'] == 'trainee') { ?>
			<li>
				<a href="index.php?page=trainee">
					<i class="icon-dashboard"></i>
					<span>trainee</span>
				</a>
			</li>
			<?php } ?>
			
			
			
			<li>
				<a href="index.php?page=project">
					<i class="icon-dashboard"></i>
					<span>project</span>
				</a>
			</li>
			
			<li>
				<a href="index.php?page=profile">
					<i class="icon-dashboard"></i>
					<span>profile</span>
				</a>
			</li>
		</ul>


</div>