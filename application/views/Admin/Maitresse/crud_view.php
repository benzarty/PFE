<div class="content-wrapper">
	<!-- Content Header (Page header) -->


	<!-- Main content -->
	<div class="content">
		<div class="card">

			<div class="card-body">


				<h3>Teachers List :</h3><div class="text-right"> <button  style="margin-top: -62px;" onclick="add_person()" class="btn btn-rounded btn-danger"><i class="icon-plus"> Add Teacher</i></button></div>



				<table id="table" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th style="width:20px">Picture</th></div>
			<th style="width: 15%">First Name</th>
			<th style="width: 15%">Last Name</th>
			<th>Gender</th>
			<th style="width: 10%">Address</th>
			<th>Date of Birth</th>
			<th>Phone Number</th>


			<th style="text-align: center;">Action</th>
			</tr>
			</thead>
			<tbody>

			</tbody>


			</table>
		</div>






		<!-- Bootstrap modal -->
		<div class="modal fade" id="modal_form" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="card-header bg-blue">
						<h4 class="text-white m-b-0">Teacher Data :<button  type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button></h4>



					</div>
					<form action="#" id="form" class="" enctype="multipart/form-data" >

						<div class="modal-body form">
							<input type="hidden" value="-1" name="id"/>
							<div class="form-body">
								<div class="form-group has-feedback">
									<input class="form-control" placeholder="First Name" type="text" name="firstName">
									<span class="help-block"></span>
									<span class="fa fa-user form-control-feedback" aria-hidden="true"></span> </div>


								<div class="form-group has-feedback">
									<input class="form-control" placeholder="Last Name" type="text" name="lastName">
									<span class="help-block"></span>
									<span class="fa fa-user form-control-feedback" aria-hidden="true"></span> </div>

								<div class="form-group row">
									<div class="col-md-12">
										<select class="form-control custom-select" name="gender">
											<option value="">--Select Gender--</option>
											<option value="male">Male</option>
											<option value="female">Female</option>
										</select>
										<span class="help-block"></span>
									</div>
								</div>

								<div class="form-group has-feedback">
									<textarea class="form-control" id="placeTextarea" rows="2" placeholder="Address" name="address"></textarea>
									<span class="help-block"></span>
								</div>

								<div class="form-group has-feedback">
									<input class="form-control" placeholder="Contact Number" type="number" name="telephone">
									<span class="help-block"></span>
									<span class="fa fa-phone form-control-feedback" aria-hidden="true"></span> </div>


								<div class="form-group row">
									<div class="col-md-12">
										<input name="dob" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
										<span class="help-block"></span>
									</div>
								</div>


							</div>

						</div>
						<div class="modal-footer">
							<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div class="modal fade" id="display_img_teacher" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="card-header bg-blue">
					</div>


					<div class="form-group">

						<div class="card">
							<a href="#" ><img id="display_img" src="" width="100%" height="100%" class="img-thumbnail" /></a>
						</div>

					</div>

				</div>
			</div>
		</div>

		<div class="modal fade" id="modal_formteacher" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="card-header bg-blue">
						<h4 class="text-white m-b-0">Upload Teacher :<button  type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button></h4>



					</div>
					<form action="<?php echo base_url('Admin/img_teacher')?>" method="post" enctype="multipart/form-data">
						<input type="hidden" value="" name="id" idstud="0" id="teacherid"/>


						<div class="form-group">

							<div class="card">
								<div class="card-body">
									<input type="file" id="input-file-now" class="dropify" name="image"/>
								</div>
								<input type="submit" name="submit" class="btn btn-info" value="Save image">

							</div>

						</div>


					</form>
				</div>
			</div>
		</div>



	</div></div>

</div>
<script type="text/javascript">

	var save_method; //for save method string
	var table;



	function add_person()
	{
		save_method = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal('show'); // show bootstrap modal
		$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
	}

	function Upload_teacher(id)
	{

		$('.form-group').removeClass('has-error'); // clear error class
		$('#teacherid').val(id);
		$('#modal_formteacher').modal('show'); // show bootstrap modal
	}
	function afficher_img_teacher(srcdata)
	{

		$('.form-group').removeClass('has-error'); // clear error class
		$('#display_img_teacher').modal('show'); // show bootstrap modal
		$('#display_img').attr('src',srcdata);

	}

	function edit_person(id)
	{
		save_method = 'update';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string


		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('Admin/ajax_edit/')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				//console.log("".data.firstName);
				$('[name="id"]').val(data.id);
				$('[name="firstName"]').val(data.firstName);
				$('[name="lastName"]').val(data.lastName);
				$('[name="gender"]').val(data.gender);
				$('[name="address"]').val(data.address);
				$('[name="telephone"]').val(data.telephone);

				$('[name="dob"]').datepicker('update',data.dob);
				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}

	function reload_table()
	{
		table.ajax.reload(null,false); //reload datatable ajax
	}

	function save()
	{
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled',true); //set button disable
		var url;

		if(save_method == 'add') {
			url = "<?php echo site_url('Admin/ajax_add')?>";
		} else if(save_method == 'update') {
			url = "<?php echo site_url('Admin/ajax_update')?>";
		}else
		{ 			url = "<?php echo site_url('Admin/ajax_uploadteacher')?>";


		}

		// ajax adding data to database
		$.ajax({
			url : url,
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data)
			{

				if(data.status) //if success close modal and reload ajax table
				{
					$('#modal_form').modal('hide');
					reload_table();
				}
				else
				{
					for (var i = 0; i < data.inputerror.length; i++)
					{
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
				}
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable


			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error adding / update data teacher');
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable

			}
		});
	}

	function delete_person(id)
	{
		if(confirm('Are you sure delete this data?'))
		{
			// ajax delete data to database
			$.ajax({
				url : "<?php echo site_url('Admin/ajax_delete')?>/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					//if success reload ajax table
					$('#modal_form').modal('hide');
					reload_table();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error deleting data');
				}
			});

		}
	}
	$(document).ready(function(){

		$('#formteacher').on('submit', function(e){
			e.preventDefault();
			if($('#input-file-now').val() == '')
			{
				alert("Please Select the File");
			}
			else
			{
				$.ajax({
					url:"<?php echo base_url(); ?>main/ajax_uploadteacher",
					//base_url() = http://localhost/tutorial/codeigniter
					method:"POST",
					data:new FormData(this).serialize(),
					async: false,
					contentType: false,
					cache: false,
					processData:false,
					mimeType:"multipart/form-data",
					success:function(data)
					{
						$('#input-file-now').html(data);
					}
				});
			}
		});
	});

</script>
