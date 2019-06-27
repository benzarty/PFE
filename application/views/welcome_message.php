<html>
<link rel="stylesheet" href="dist/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="dist/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="dist/css/style.css">
<head>
<title>Login Page</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/login/style.css');?>">
<body>
	<div class="banner">
    <div class="loginbox">
    <img src="<?php echo base_url('assets/login/avatar.png');?>" class="avatar">
        <h1>Login Here</h1>
        <form method="POST" action="<?php echo site_url('Admin/login_validation') ?>">
            
            <input type="text" name="username" placeholder="Enter Username" >
			<span class="text-danger"><?php echo form_error('username');?></span>
           
            <input type="password" name="password" placeholder="Enter Password" >
			<span class="text-danger"><?php echo form_error('password');?></span>

			<input type="submit" name="insert" value="Login">
			<?php echo $this->session->flashdata("error"); ?>

        </form>
        
    </div>


</div>




</body>
</head>
</html>
