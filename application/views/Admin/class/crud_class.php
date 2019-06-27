<div class="content-wrapper">
	<!-- Content Header (Page header) -->


	<!-- Main content -->
	<div class="content">
		<div class="card">

			<div class="card-body">


				<h3>Class List :</h3><div class="text-right"><div style="margin-top: -40px;margin-right: 140px";><a href="<?php echo base_url('Admin/teacher2');?>" class="btn btn-rounded btn-danger"><i class="icon-plus">  Teacher Affectation</i></a></div> <button  style="margin-top: -62px;" onclick="add_Class()" class="btn btn-rounded btn-danger"><i class="icon-plus"> Add Class</i></button></div>



				<table id="table_class" class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
					<thead>
					<tr>

						<th style="width: 70%;text-align: center;">Name of Class</th>



			<th style="text-align: center;width: 100%">Action</th>
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
						<h4 class="text-white m-b-0">Class Data :<button  type="button" class="close" data-dismiss="modal" aria-label="Close" ><span aria-hidden="true">&times;</span></button></h4>



					</div>
					<form action="#" id="form" class="" enctype="multipart/form-data" >

						<div class="modal-body form">
							<input type="hidden" value="-1" name="id"/>
							<div class="form-body">
								<div class="form-group has-feedback">
									<input class="form-control" placeholder="Name of class" type="text" name="nomclasse">
									<span class="help-block"></span>
									 </div>









							</div>

						</div>
						<div class="modal-footer">
							<button type="button" id="btnSave" onclick="saveclass()" class="btn btn-primary">Save</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>






	</div></div>

</div>
<script type="text/javascript">

	var save_method_class; //for save method string
	var table_class;



	function add_Class()
	{
		save_method_class = 'add';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#modal_form').modal('show'); // show bootstrap modal
	}




	function edit_class(id)
	{
		save_method_class = 'update';
		$('#form')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string


		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('Admin/ajax_editclass/')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="id"]').val(data.id);
				$('[name="nomclasse"]').val(data.nomclasse);


				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}

	function reload_table_class()
	{
		table_class.ajax.reload(null,false); //reload datatable ajax
	}

	function saveclass()
	{
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled',true); //set button disable
		var url;

		if(save_method_class == 'add') {
			url = "<?php echo site_url('Admin/ajax_addclass')?>";
		} else if(save_method_class == 'update') {
			url = "<?php echo site_url('Admin/ajax_updateclass')?>";
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
					reload_table_class();
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

	function delete_class(id)
	{
		if(confirm('Are you sure delete this data?'))
		{
			// ajax delete data to database
			$.ajax({
				url : "<?php echo site_url('Admin/ajax_deleteclass')?>/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					//if success reload ajax table
					$('#modal_form').modal('hide');
					reload_table_class();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error deleting data');
				}
			});

		}
	}


</script>
