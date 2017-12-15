<?php
	include 'config.php';
	
	if($_SESSION['login_permission'] == 'yes'){	
		include 'asset_links.php';
		include 'header.php';
			if(isset($_GET['page'])){
				if( $_GET['page'] == 'managing_director'){
					include 'managing_director.php';
				} else if($_GET['page'] == 'senior_officer'){
					include 'senior_officer.php';
				} else if($_GET['page'] == 'junior_officer'){
					include 'junior_officer.php';
				} else if($_GET['page'] == 'executive_officer'){
					include 'executive_officer.php';
				} else if($_GET['page'] == 'accountant'){
					include 'accountant.php';
				} else if($_GET['page'] == 'human_resource'){
					include 'human_resource.php';
				} else if($_GET['page'] == 'director'){
					include 'director.php';
				} else if($_GET['page'] == 'trainee'){
					include 'trainee.php';
				} else if($_GET['page'] == 'admin'){
					include 'admin.php';
				} else if($_GET['page'] == 'transaction'){
					include 'transaction.php';
				} else if($_GET['page'] == 'profile'){
					include 'profile.php';
				}else if($_GET['page'] == 'notice'){
					include 'notice.php';
				}else if($_GET['page'] == 'attendance'){
					include 'attendance.php';
				}else if($_GET['page'] == 'project'){
					include 'project.php';
				}
			} else {
				include 'dashboard.php';
			}
		include 'footer.php';
	}
?>