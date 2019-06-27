<div class="content-wrapper">
	<div class="content-header sty-one">
		<?php if (isset($message)) { ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Data Updated Successfully </strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
			</div>
		<?php } ?>

	</div>

	<!-- Main content -->
	<div class="content">
		<div class="card">
			<div class="card-body">
				<div class="row">










					<div class="col-lg-12 m-t-2">
						<div class="row">

							<div class="col-lg-8 offset-2">
								<div class="card text-white bg-secondary mb-3">
									<form method="post" enctype="multipart/form-data" action="<?php echo base_url('Admin/Profilsettingteacher')?>">
										<input type="hidden" value="<?php echo $user->id; ?>" name="id"/>


										<input type="file" id="input-file-max-fs" class="dropify" data-max-file-size="2M" name="image" />

										<div class="card-body">
											<div class="card-body">

												<h4 class="text-center">Profil</h4>

												<div class="form-group">
													<label for="exampleInputuname">Username</label>
													<div class="input-group">
														<div class="input-group-addon"><i class="ti-user"></i></div>

														<input class="form-control" name="username" type="text" value="<?php echo $user->username; ?>">
													</div>
												</div>
												<div class="form-group">
													<label for="pwd2">Password</label>
													<div class="input-group">
														<div class="input-group-addon"><i class="ti-lock"></i></div>
														<input class="form-control" type="text" name="password" value="<?php echo $user->password; ?>">
													</div>
												</div>

												<div class="form-group">
													<label for="pwd1">Name</label>
													<div class="input-group">
														<div class="input-group-addon"><i class="ti-user"></i></div>
														<input class="form-control" type="text" name="firstName" value="<?php echo $user->firstName; ?>">
													</div>
												</div>
												<div class="form-group">
													<label for="pwd2">Last name</label>
													<div class="input-group">
														<div class="input-group-addon"><i class="ti-user"></i></div>
														<input class="form-control" type="text" name="lastName" value="<?php echo $user->lastName; ?>">
													</div>
												</div>
												<div class="form-group">
													<label for="pwd2">Email address</label>
													<div class="input-group">
														<div class="input-group-addon"><i class="ti-email"></i></div>
														<input class="form-control" type="text" name="mail" value="<?php echo $user->mail; ?>">
													</div>
												</div>

												<div class="text-center">	
													<button type="submit" name="submit" class="btn btn-success"><i class="fa fa-check"></i>Save Data </button></div>

									</form>
								</div>
							</div>
						</div>
					</div>


				</div>
			</div>
			<!-- MODEL -->


		</div>
	</div></div>
<!-- Main row -->
</div>
<!-- /.content -->



</div>
