<div class="content-wrapper">
	<!-- Content Header (Page header) -->


	<!-- Main content -->
	<div class="content">
		<div class="card">

			<div class="card-body">


				<h3>Students List :</h3><div class="text-right"> <button  style="margin-top: -62px;" onclick="add_student()" class="btn btn-rounded btn-danger"><i class="icon-plus"> Add Student</i></button></div>



				<table id="table_student" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
					<thead>
					<tr>
						<th style="width: 10%">Picture</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Gender</th>
					


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
							<h4 class="text-white m-b-0">Student Data :<button  type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button></h4>



						</div>
						<form action="#" id="form" class="" enctype="multipart/form-data" >

							<div class="modal-body form">
								<input type="hidden" value="-1" name="id" />
								<div class="form-body">


									<div class="form-group has-feedback">
										<input class="form-control" placeholder="First Name" type="text" name="firstName" id="firstName">
										<span class="help-block" style="color: #dd4b39"></span>
										<span class="fa fa-user form-control-feedback" aria-hidden="true"></span> </div>


									<div class="form-group has-feedback" >
										<input class="form-control" placeholder="Last Name" type="text" name="lastName" id="lastName">
										<span class="help-block"  style="color: #dd4b39"></span>
										<span class="fa fa-user form-control-feedback" aria-hidden="true"></span> </div>

									<div class="form-group row">
										<div class="col-md-12">
											<select class="form-control custom-select" name="gender" id="gender">
												<option value="">--Select Gender--</option>
												<option value="male">Male</option>
												<option value="female">Female</option>
											</select>
											<span class="help-block"></span>
											</div>
									</div>


									<div class="form-group has-feedback">
										<textarea class="form-control" rows="2" placeholder="Address" name="address" id="address"></textarea>
										<span class="help-block"  style="color: #dd4b39"></span>
									</div>




									<div class="form-group row">
										<div class="col-md-12">
											<input name="dob" id="dob" placeholder="yyyy-mm-dd" class="form-control datepicker " type="text">
											<span class="help-block"></span>
											<span class="fa fa-calendar form-control-feedback" aria-hidden="true"></span>

										</div>
									</div>


								</div>

							</div>
							<div class="modal-footer">
								<button type="button" id="btnSave" onclick="savestudent()" class="btn btn-primary">Save</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="modal fade" id="display_img_student" role="dialog">
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
			<div class="modal fade" id="modal_formstudent" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">

						<div class="card-header bg-blue" >
							<h4 class="text-white m-b-0">Upload Student :<button  type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button></h4>



						</div>
						<form action="<?php echo base_url('Admin/img_student')?>" method="post" enctype="multipart/form-data">
							<input type="hidden" value="" name="id" idstud="0" id="studentid"/>


							<div class="form-group" >

								<div class="card" >
									<div class="card-body" >
										<input type="file" id="input-file-now" class="dropify" name="image"  />
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

	var save_method_student; //for save method string
	var table_student;




	function add_student()
	{
		save_method_student = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal('show'); // show bootstrap modal
		$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
	}


	function Upload_student(id)
	{

		$('.form-group').removeClass('has-error'); // clear error class
		$('#studentid').val(id);
		$('#modal_formstudent').modal('show'); // show bootstrap modal
	}

	function afficher_img(srcdata)
	{

		$('.form-group').removeClass('has-error'); // clear error class
		$('#display_img_student').modal('show'); // show bootstrap modal
		$('#display_img').attr('src',srcdata);

	}
	function view_student(id)
	{
	
		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('Admin/ajax_viewstudent/')?>/" + id,
			type: "POST",
			dataType: "JSON",
			success: function(data)
			{
				//console.log("".data.firstName);
				$('[name="id"]').val(data.id);
				$('[name="firstName"]').val(data.firstName);
				$('[name="lastName"]').val(data.lastName);
				$('[name="gender"]').val(data.gender);
				$('[name="address"]').val(data.address);
				$('[name="dob"]').datepicker('update',data.dob);			

				$('#firstName').attr('disabled',true);
				$('#lastName').attr('disabled',true);
				$('#gender').attr('disabled',true);
				$('#address').attr('disabled',true);
				$('#dob').attr('disabled',true);

				$('#btnSave').css('display','none');
				
				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('View Student'); // Set title to Bootstrap modal title

			},
			
		});
	}

	function edit_student(id)
	{
		save_method_student = 'update';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string


		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('Admin/ajax_editstudent/')?>/" + id,
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

				$('#firstName').attr('disabled',false);
				$('#lastName').attr('disabled',false);
				$('#gender').attr('disabled',false);
				$('#address').attr('disabled',false);
				$('#dob').attr('disabled',false);
				$('#btnSave').css('display','block');
				
				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}

	function reload_table_student()
	{
		table_student.ajax.reload(null,false); //reload datatable ajax
	}

	function savestudent()
	{
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled',true); //set button disable
		var url;

		if(save_method_student == 'add') {
			url = "<?php echo site_url('Admin/ajax_addstudent')?>";
		} else if(save_method_student == 'update') {
			url = "<?php echo site_url('Admin/ajax_updatestudent')?>";
		}
		else
		{ 			url = "<?php echo site_url('Admin/ajax_uploadstudent')?>";


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
					reload_table_student();
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
				alert('Error adding / update dataparent');
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable

			}
		});
	}

	function delete_student(id)
	{
		if(confirm('Are you sure delete this data?'))
		{
			// ajax delete data to database
			$.ajax({
				url : "<?php echo site_url('Admin/ajax_deletestudent')?>/"+id,
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

	$(document).ready(function(){

		$('#formstudent').on('submit', function(e){
			e.preventDefault();
			if($('#input-file-now').val() == '')
			{
				alert("Please Select the File");
			}
			else
			{
				$.ajax({
					url:"<?php echo site_url('Admin/ajax_uploadstudent'); ?>",
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
