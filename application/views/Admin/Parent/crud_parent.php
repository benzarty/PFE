<div class="content-wrapper">
	<!-- Content Header (Page header) -->


	<!-- Main content -->
	<div class="content">
		<div class="card">

			<div class="card-body">


				<h3>Parents List :</h3><div class="text-right"> <button  style="margin-top: -62px;" onclick="add_parent()" class="btn btn-rounded btn-danger"><i class="icon-plus"> Add Parent</i></button></div>



				<table id="table_parent" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
					<thead>
					<tr>
						<!--<div id="uploaded_image"></div>-->
						<th style="width:10%">Picture</th>
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
							<h4 class="text-white m-b-0">Parent Data :<button  type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button></h4>



						</div>
						<form action="#" id="form" class="" enctype="multipart/form-data" >

							<div class="modal-body form">
								<input type="hidden" value="" name="id"/>
								<div class="form-body">


									<div class="form-group has-feedback">
										<input class="form-control" placeholder="First Name" type="text" name="firstName" id="firstName">
										<span class="help-block" style="color: #dd4b39"></span>
										<span class="fa fa-user form-control-feedback" aria-hidden="true"></span>
									</div>



									<div class="form-group has-feedback">
										<input class="form-control" placeholder="Last Name" type="text" name="lastName"
										id="lastName">
										<span class="help-block" style="color: #dd4b39"></span>
										<span class="fa fa-user form-control-feedback" aria-hidden="true"></span>

									</div>

									<div class="form-group row">
										<div class="col-md-12">
											<select class="form-control custom-select" name="gender" id="gender">
												<option selected disabled value="">--Select Gender--</option>
												<option value="male">Male</option>
												<option value="female">Female</option>
											</select>
											<span class="help-block"></span>
										</div>
									</div>

									<div class="form-group has-feedback">
										<textarea class="form-control" id="address" rows="2" placeholder="Address" name="address"></textarea>
										<span class="help-block" style="color: #dd4b39"></span>
									</div>

									<div class="form-group ">
										<input class="form-control" placeholder="Contact Number" type="text" name="telephone" id="telephone" >
										<span class="help-block" style="color: #dd4b39"></span>
										<span class="fa fa-phone form-control-feedback" aria-hidden="true"></span>
									</div>


									<div class="form-group row">
										<div class="col-md-12">
											<input name="dob" id="dob" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-12">
											<input name="mail" id="mail" placeholder="Mail" class="form-control " type="mail">
											<span class="help-block"></span>
										</div>
									</div>
									<div class="form-group has-feedback">
										<input class="form-control" placeholder="Username" type="text" name="username" id="username">
										<span class="help-block" style="color: #dd4b39"></span>
										<span class="fa fa-user form-control-feedback" id="icon_lock" aria-hidden="true"></span>

									</div>
									<div class="form-group has-feedback">
										<input class="form-control" placeholder="Password" type="password" name="password" id="password">
										<span class="help-block" style="color: #dd4b39"></span>
										<span class="fa fa-lock form-control-feedback" aria-hidden="true" id="icon_lock1"></span>

									</div>


								</div>

							</div>
							<div class="modal-footer">
								<button type="button" id="btnSave" onclick="saveparent()" class="btn btn-primary">Save</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="modal fade" id="display_img_parent" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="card-header bg-blue">
						</div>


						<div class="form-group">

							<div class="card">
								<a href="#" ><img id="display_img_p" src="" width="100%" height="100%" class="img-thumbnail" /></a>
							</div>

						</div>

					</div>
				</div>
			</div>

			<div class="modal fade" id="modal_formparent" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">

						<div class="card-header bg-blue">
							<h4 class="text-white m-b-0">Upload Parent :<button  type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button></h4>



						</div>
						<form action="<?php echo base_url('Admin/img_parent')?>" method="post" enctype="multipart/form-data">
							<input type="hidden" value="" name="id" idstud="0" id="parentid"/>


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

	var save_method_parent; //for save method string
	var table_parent;




	function add_parent()
	{
		save_method_parent = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal('show'); // show bootstrap modal
		$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
	}

	function Upload_parent(id)
	{

		$('.form-group').removeClass('has-error'); // clear error class
		$('#parentid').val(id);
		$('#modal_formparent').modal('show'); // show bootstrap modal
	}

	function afficher_img_parent(srcdata)
	{

		$('.form-group').removeClass('has-error'); // clear error class
		$('#display_img_parent').modal('show'); // show bootstrap modal
		$('#display_img_p').attr('src',srcdata);

	}

	function edit_parent(id)
	{
		save_method_parent = 'update';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string


		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('Admin/ajax_editparent/')?>/" + id,
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
				$('[name="username"]').val(data.username);
				$('[name="password"]').val(data.password);
				$('[name="mail"]').val(data.mail);

				$('[name="dob"]').datepicker('update',data.dob);

				$('#firstName').attr('disabled',false);
				$('#lastName').attr('disabled',false);
				$('#gender').attr('disabled',false);
				$('#address').attr('disabled',false);
				$('#telephone').attr('disabled',false);
				$('#dob').attr('disabled',false);
								$('#mail').attr('disabled',false);


				$('#username').css('display','block');
				$('#password').css('display','block');
				$('#icon_lock1').css('display','block');
				$('#icon_lock').css('display','block');

				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}

	function view_parent(id)
	{
	
		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('Admin/ajax_viewparent/')?>/" + id,
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
				$('[name="telephone"]').val(data.telephone);
								$('[name="mail"]').val(data.mail);

				$('[name="dob"]').datepicker('update',data.dob);			

				$('#firstName').attr('disabled',true);
				$('#lastName').attr('disabled',true);
				$('#gender').attr('disabled',true);
				$('#address').attr('disabled',true);
				$('#telephone').attr('disabled',true);
								$('#mail').attr('disabled',true);

				$('#dob').attr('disabled',true);

				$('#username').css('display','none');
				$('#password').css('display','none');
				$('#icon_lock1').css('display','none');
				$('#icon_lock').css('display','none');

				$('#btnSave').css('display','none');
				
				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('View parent'); // Set title to Bootstrap modal title

			},
			
		});
	}
	function reload_table_parent()
	{
		table_parent.ajax.reload(null,false); //reload datatable ajax
	}

	function saveparent()
	{
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled',true); //set button disable
		var url;

		if(save_method_parent == 'add') {
			url = "<?php echo site_url('Admin/ajax_addparent')?>";
		} else if(save_method_parent == 'update') {
			url = "<?php echo site_url('Admin/ajax_updateparent')?>";
		}else
		{ 			url = "<?php echo site_url('Admin/ajax_uploadparent')?>";


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
					reload_table_parent();
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
				alert('Error adding / update data parent');
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable

			}
		});
	}

	function delete_parent(id)
	{
		if(confirm('Are you sure delete this data?'))
		{
			// ajax delete data to database
			$.ajax({
				url : "<?php echo site_url('Admin/ajax_deleteparent')?>/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					//if success reload ajax table
					$('#modal_form').modal('hide');
					reload_table_parent();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error deleting data');
				}
			});

		}
	}
	$(document).ready(function(){

		$('#formparent').on('submit', function(e){
			e.preventDefault();
			if($('#input-file-now').val() == '')
			{
				alert("Please Select the File");
			}
			else
			{
				$.ajax({
					url:"<?php echo base_url(); ?>main/ajax_uploadparent",
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
