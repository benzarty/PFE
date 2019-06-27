<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from uxliner.com/bizadmin/demo/main/table-jsgrid.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 09:33:53 GMT -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Child Care Centre</title>
	<!-- Tell the browser to be responsive to screen width -->

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- v4.0.0 -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/bootstrap/css/bootstrap.min.css');?>">

	<!-- Favicon -->
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/dashboard/dist/img/logo-mini.png');?>">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/css/style.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/css/font-awesome/css/font-awesome.min.css');?>">

	<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/css/et-line-font/et-line-font.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/css/themify-icons/themify-icons.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/css/simple-lineicon/simple-line-icons.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/css/skins/_all-skins.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/plugins/datatables/css/dataTables.bootstrap.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/plugins/iCheck/flat/blue.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/style.css');?>">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<link href="<?php echo base_url('assets/datatables/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker.css')?>" rel="stylesheet">





	<!-- jsgrid Tables -->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/plugins/jsgrid/jsgrid.css');?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/plugins/jsgrid/theme.css');?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/plugins/formwizard/jquery-steps.css');?>" />
	<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/plugins/dropify/dropify.min.css');?>" />
	<link href="<?php echo base_url('assets/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')?>" rel="stylesheet">


	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>


<!-- Dropzone -->
	<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/plugins/dropzone-master/dropzone.css');?>">
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url('assets/dashboard/dist/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css');?>">

	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
	<style type="text/css">
		

		html {
  scroll-behavior: smooth;
}
	</style>




	<![endif]-->

</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper boxed-wrapper">
	<header class="main-header">
		<!-- Logo -->
		<a href="<?php echo base_url('Admin/indexteacher');?>" class="logo" style="background-color: black">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><img src="<?php echo base_url('assets/dashboard/dist/img/logo-mini.png')?>" style="height: 100%;width: 100%;" alt=""></span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><img style="height:90px;width: 80%;margin-top: -25px; " src="<?php echo base_url('assets/dashboard/dist/img/logo.png')?>" alt=""></span> </a>
		<!-- Header Navbar -->
		<nav class="navbar blue-bg navbar-static-top" style="background-color: black">
			<!-- Sidebar toggle button-->
			<ul class="nav navbar-nav pull-left">
				<li><a class="sidebar-toggle" data-toggle="push-menu" href="#"></a> </li>
			</ul>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<!-- Messages -->
					<li class="dropdown messages-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-envelope-o"></i>
						<?php
								 if ($messagenotifm==1) { ?>
							<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div> 
									<?php } ?>
						</a>
						<ul class="dropdown-menu">
					<?php			 if ($messagenotifm==1) { ?>

							<li class="header">You have new messages</li>
																<?php } ?>
										<?php			 if ($messagenotifm==0) { ?>

							<li class="header">You have no messages</li>
																<?php } ?>

							<li>
								<ul class="menu">
									<?php 
									
										foreach ($blogss as $blog) {
											# code...
										?>

									<li><a href="#">
											<div class="pull-left icon-circle red"><i class="fa fa-envelope-open "></i></div>  
   




                                            <input type="hidden" value="<?php echo $blog->id; ?>">
                                        
                                            <input type="hidden" value="<?php echo $blog->id; ?>">
											<h4><?php echo $blog->title; ?></h4>
											<p><?php echo $blog->message; ?></p>
											<p><span class="time">
												<p><?php echo $date2=$blog->datee; ?></p>



												
													
												</span></p>
										</a></li>
												<?php 
							}

								?>
								</ul>
							</li>
							<li class="footer"><a href="<?php echo base_url('Admin/Consultationmailteacher/'.$user->id);?>">View All Messages</a></li>
						</ul>
					</li>
					<!-- Notifications  -->
					<li class="dropdown messages-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-bell-o"></i>
						<?php
								 if ($messagenotif==1) { ?>

							<div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>

									<?php } ?>
						</a>
						<ul class="dropdown-menu">
							<li class="header">Notifications</li>
							<li>
								<ul class="menu">
										<?php 
									
										foreach ($blogs as $blog) {
											# code...
										?>

									<li><a href="#">
										<?php if( $blog->title == 'Conge') { ?>
											<div class="pull-left icon-circle red"><i class="icon-plane	"></i></div>  <?php } ?>
    <?php if( $blog->title == 'Announcement') { ?>
											<div class="pull-left icon-circle blue"><i class="ti-announcement"></i></div>  <?php } ?>
											<?php if( $blog->title == 'Convocation') { ?>
											<div class="pull-left icon-circle yellow"><i class="icon-call-out"></i></div>  <?php } ?>

											<?php if( $blog->title == 'Annonce') { ?>
												<div class="pull-left icon-circle bg-aqua"><i class="ti-announcement"></i></div>  <?php } ?>


                                            <input type="hidden" value="<?php echo $blog->id; ?>">
                                           <input type="hidden" value="<?php echo $blog->id; ?>">
											<h4><?php echo $blog->title; ?></h4>
											<p><?php echo $blog->message; ?></p>
											<p><span class="time">
												<p><?php echo $date2=$blog->datee; ?></p>



												
													
												</span></p>
										</a></li>
												<?php 
							}

								?>
								
								</ul>
							</li>
							<li class="footer"><a href="<?php echo base_url('Admin/MarkreadNotifTeacher');?>">Check all Notifications</a></li>
						</ul>
					</li>
					<!-- User Account  -->
					<li class="dropdown user user-menu p-ph-res"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo site_url().'uploads/'.$user->image?>" class="user-image" alt="User Image"> <span class="hidden-xs"><?php echo $user->firstName; ?> <?php echo $user->lastName ; ?></span> </a>
						<ul class="dropdown-menu">
							<li style="background-color: black" class="user-header ">
								<div class="pull-left user-img"><img src="<?php echo site_url().'uploads/'.$user->image?>" class="img-responsive img-circle" alt="User"></div>
								<p class="text-left"><?php echo $user->firstName; ?> <?php echo $user->lastName ; ?><small><?php echo $user->mail; ?></small> </p>
							</li>
							<li><a href="<?php echo base_url('Admin/profilteacher');?>"><i class="icon-profile-male"></i> My Profile</a></li>
							<li><a href="<?php echo base_url('Admin/Consultationmailteacher/'.$user->id);?>"><i class="icon-envelope"></i> Inbox</a></li>
							<li role="separator" class="divider"></li>
							<li role="separator" class="divider"></li>
							<li><a href="<?php echo base_url('Admin/logout');?>"><i class="fa fa-power-off"></i> Logout</a></li>
						</ul>
					</li>
					<!-- Control Sidebar Toggle Button -->

				</ul>
			</div>
		</nav>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<!-- sidebar -->
		<div class="sidebar">
			<!-- Sidebar user panel -->
			<div class="user-panel">
				<div class="image text-center"> <img src="<?php echo site_url().'uploads/'.$user->image?>" class="img-circle" alt="User Image"> </div>
				<div class="info">
					<p>Hello <?php echo $user->username; ?></p>
					<a href="<?php echo base_url('Admin/logout');?>"><i class="fa fa-power-off"></i></a> </div>
			</div>

			<!-- sidebar menu -->
			<ul class="sidebar-menu" data-widget="tree">
				<li> <a href="<?php echo base_url('Admin/ADDteachertoclass/'.$user->id);?>" > <i class="icon-home"></i> <span>Class Management</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>

				</li>

				<li class="treeview"> <a href="#"> <i class=" icon-plane"></i> <span>Leave Requests</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
					<ul class="treeview-menu">
						<li><a href="<?php echo base_url('Admin/writerequest');?>"><i class="fa fa-angle-right"></i>write Requests</a></li>
						<li><a href="viewcongeeteacher/?id=<?php echo $user->id; ?>"<i class="fa fa-angle-right"></i>View Statue</a></li>
					</ul>

				</li>
				<li class="treeview"> <a href="#"> <i class="ti-email"></i> <span>Inbox</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
					<ul class="treeview-menu">

						<li><a  href="<?php echo base_url('Admin/Consultationmailteacher/'.$user->id);?>"><i class="fa fa-angle-right"></i> Consultation</a></li>
						<li><a href="<?php echo base_url('Admin/ajoutmailteacher');?>"><i class="fa fa-angle-right"></i> Write</a></li>
					</ul>
				</li>
				<li> <a href="<?php echo base_url('Admin/consultevenementteacher');?>"><i class="ti-announcement"></i> <span>View Announcement </span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>

				</li>




			</ul>
			<?php $id=$user->id; ?>
		</div>
	</aside>



