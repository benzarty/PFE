<div class="content-wrapper">
	<div class="content-header sty-one>

	</div>

	<!-- Main content -->
	<div class="content">
	
	<?php echo form_open('Admin/saveteacher'); ?>
	<?php if (isset($message)) { ?>
		<div class="alert alert-success" role="alert">Operation is done Correctly</div>
	<?php } ?>

	<div class="row m-t-3">
		<div class="col-lg-12">
			<div class="card ">
				<div class="card-header bg-black">
					<h5 class="text-white m-b-0">Information Detail</h5>
				</div>
				<div class="card-body">

					<form>
						<div class="row">

						
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<label class="control-label">Started Day</label>
									<input class="form-control" id="datefield" type="date" name="datedebut" required="true"></div>
							</div>
							<div class="col-md-6">
								<div class="form-group has-feedback">
									<label class="control-label">Finished Day</label>
									<input class="form-control" id="datefieldd" type="date" name="datefin" required="true"></div>
							</div>

						

							<div class="col-md-12">
								<div class="form-group has-feedback">
									<label class="control-label">Reason</label>
									<textarea class="form-control" id="placeTextarea" rows="3" placeholder="Reason" name="raison" required="true"></textarea>
								</div>
							</div>
							<input type="hidden" value="<?php echo $user->id ?>" name="idteacher">



							<div class="col-md-12">
								<button type="submit" class="btn btn-success">Submit</button>
							</div>
						</div>
					</form>

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
document.getElementById("datefieldd").setAttribute("min", today);

	</script>
</div>
