<div class="content-wrapper">


	<!-- Main content -->

	<div class="content">
		<div class="row">

	<div class="row m-t-2">
		<div class="col-lg-12">
			<div class="card ">
				<div class="card-header bg-red">
					<h5 class="text-white m-b-0">Create Announcement :</h5>
				</div>
				<div class="card-body">
					<?php echo form_open('Admin/saveannonce'); ?>
					<?php if (isset($message)) { ?>
						<div class="alert alert-success alert-dismissible fade show" role="alert">Operation is done Correctly <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button></div>
					<?php } ?>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<label class="control-label">Titre</label>
									<input class="form-control" placeholder="Titre" type="text" name="titre" id="titre" required>
									<span class="fa fa-window-maximize form-control-feedback" aria-hidden="true"></span> </div>
							</div>
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<label class="control-label">Host</label>
									<input class="form-control" placeholder="Host" type="text" name="host" id="host" required>
									<span class="fa fa-user form-control-feedback" aria-hidden="true"></span> </div>
							</div>
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<label class="control-label">Type</label>
										<select class="form-control custom-select" name="typeee" required>
											<option value="public">Public</option>
											<option value="teacher">Teachers</option>
											<option value="parent">Parent</option>
										</select>
									</div>
							</div>
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<label class="control-label">Place</label>
									<input class="form-control" placeholder="Place" type="text" name="place" id="place" required>
									<span class=" fa icon-location-pin form-control-feedback" aria-hidden="true"></span> </div>
							</div>
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<label class="control-label">Date of event</label>
									<input class="form-control" placeholder="Date of event" type="Date" name="date" id="datefield" required>
									<span class="fa fa-calendar form-control-feedback" aria-hidden="true"></span> </div>
							</div>

							<div class="col-md-12">
								<div class="form-group has-feedback">
									<label class="control-label">Description</label>
									<textarea class="form-control" rows="3" placeholder="Description" name="description" id="description" required></textarea>
								</div>
							</div>
							<input type="hidden" value="<?php echo $user->id ?>" name="idadmin" id="idadmin"/>


							<div class="col-md-12">
								<button type="submit" class="btn btn-success" class="align-left" id="submit">Submit</button>
							</div>
						</div>
					<?php echo form_close(); ?>

				</div>
			</div>
		</div>
	</div>
	</div>
	</div></div>
<script type="text/javascript">
			var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

today = yyyy+'-'+mm+'-'+dd;
document.getElementById("datefield").setAttribute("min", today);






	</script>
