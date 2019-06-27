<div class="content-wrapper">
	
	<div class="content">
			<div class="card">
			<div class="card-body">





				<div class="col-lg-12 m-b-3">
		<h3>Student List </h3><div class="text-right"> <button  style="margin-top: -62px;" data-toggle="modal" data-target="#myModal" class="btn btn-rounded btn-danger"><i class="icon-plus"> Assignment of the Student</i></button></div>

		<h4 class="text-black">Students in this class :</h4>

			<table id="table_etudiantparclass" class="table table-striped table-bordered table-responsive" width="100%">
				<thead>
				<tr>

					<th style="width: 25%">First Name </th>
					<th style="width: 25%">Last Name </th>
					<th style="width: 25%">Gender </th>
					<th style="width: 25%">Date of Birth </th>

					<th style="width: 50%">Picture </th>
					<th style="width: 50%">Action </th>






				</tr>
				</thead>
				<tbody>

				</tbody>


			</table>




	</div>
				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">

							<div class="card-header bg-blue">
								<h4 class="text-white m-b-0">Student Available To Add  :<button  type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button></h4>



							</div>


							<form  method="post" enctype="multipart/form-data">



								<div class="form-group" >

									<div class="card" >
										<div class="col-lg-12 m-b-2">

											<div class="table-responsive">
												<table class="table">
													<thead class=".bg-inverse">
													<tr>
														<th scope="col">First Name </th>
														<th scope="col">Last Name</th>

														<th scope="col">Gender</th>
														<th scope="col" style="text-align: center">Action</th>





													</tr>
													</thead>
													<tbody>

													<?php

													foreach ($requests as $req) {
														# code...
														?>

														<tr>
															<td><?php echo $req->firstName; ?></td>
															<td><?php echo $req->lastName; ?></td>
															<td><?php echo $req->gender; ?></td>
															<td style="text-align: center"><input type="checkbox" class="ajout_checkbox " value="<?php echo $req->id; ?>"></td>







														</tr>
														<?php
													}

													?>



													</tbody>
												</table>
											</div></div>

									</div>

								</div>


								<div class="modal-footer">
									<button   name="affectationeleve" id="affectationeleve" class="btn btn-rounded btn-outline-secondary"><i class="icon-plus"> Add</i></button>
									<button type="button" class="btn btn-rounded" data-dismiss="modal">Close</button>


								</div>
							</form>


						</div>

					</div>
				</div>


</div>
			</div>
	</div>
</div>
<script type="text/javascript">
function delete_parclasse(id)
{
if(confirm('Are you sure delete this data?'))
{
// ajax delete data to database
$.ajax({
url : "<?php echo site_url('Admin/ajax_deleteparclasse')?>/"+id,
type: "POST",
dataType: "JSON",
success: function(data)
{
//if success reload ajax table
$('#modal_form').modal('hide');
reload_table_student();
},
error: function (jqXHR, textStatus, errorThrown)
{
alert('Error deleting data');
}
});

}
}
</script>
