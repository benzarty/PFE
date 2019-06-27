<div class="content-wrapper">
	<!-- Content Header (Page header) -->


	<!-- Main content -->
	<div class="content">
		<div class="card">

			<div class="card-body">
				<h3>Folder List :</h3><div class="text-right"> <button  style="margin-top: -62px;" data-toggle="modal" data-target="#myModal" class="btn btn-rounded btn-danger"><i class="icon-plus"> Add Folder</i></button></div>



				<?php if(isset($st)){ ?>

					<input type="hidden" id="stfixedid" name="stfixedid" value="<?php echo $st->id; ?>">
				<?php }?>

				<div class="modal fade" id="myModal" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">

							<div class="card-header bg-blue">
								<h4 class="text-white m-b-0">Folder Upload :<button  type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button></h4>



							</div>


				<form action="<?php echo base_url('Admin/img_dossier')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" value="" name="id" idstud="0" id="dossierid"/>


					<div class="form-group" >

						<div class="card" >
							<div class="card-body" >
								<div class="form-group has-feedback">

								<?php if(isset($st)){ ?>
									<input class="form-control" placeholder="Entituled" type="text" name="intitule" required>

									<input type="hidden" name="stid" value="<?php echo $st->id; ?>">
								<?php }?></div>
								<div class="form-group has-feedback">

									<input type="file" id="input-file-now" class="dropify" name="document" required /></div>
							</div>

						</div>

					</div>
					<div class="modal-footer">

						<input type="submit" name="submit" class="btn btn-primary" value="Save">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>


					</div>
				</form>


						</div>

					</div>
				</div>
				<table id="table_dossier"  class="table table-striped table-bordered">
					<thead>
					<tr>
						<th style="text-align: center; "><strong>Entituled</strong></th>						
						<th style="text-align: center; "><strong>Action</strong></th>
					</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>






<script type="text/javascript">


	function delete_dossier(id)
	{
		if(confirm('Are you sure delete this data?'))
		{
			// ajax delete data to database
			$.ajax({
					url : "<?php echo site_url('Admin/ajax_deletedossier')?>/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					//if success reload ajax table
					$('#modal_form').modal('hide');
					reload_table_dossier();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error deleting data');
				}
			});

		}
	}
	function reload_table_dossier()
	{
		table_dossier.ajax.reload(null,false); //reload datatable ajax


	}



</script>
