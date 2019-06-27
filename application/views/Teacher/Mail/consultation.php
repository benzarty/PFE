<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header sty-one">
		<h1>Mailbox</h1>

	</div>

	<!-- Main content -->
	<div class="content">
		<div class="row">
			<div class="col-lg-2"> <a href="<?php echo base_url('Admin/ajoutmailteacher');?>" class="btn btn-danger btn-block margin-bottom">Compose</a>

				<!-- /. box -->

				<!-- /.box -->
			</div>
			<div class="col-lg-10">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Inbox : </h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<div class="mailbox-controls">
							<!-- Check all button -->
							<div class="btn-group">
								<button  class="btn btn-default btn-sm" name="delete_all" id="delete_all"" ><i class="fa fa-trash-o"> </i></button>
								<button type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
							</div>
							<!-- /.btn-group -->

							<!-- /.pull-right -->
						</div>
						<div class="table-responsive">
							<table class="table table-bordered">
								<thead>
      <tr>
          <th width="50px"></th>
          <th>Subject</th>

		  <th>Mail Sender</th>
		  <th>Description</th>
		  <th>Date</th>
		  <th>More detail</th>




	  </tr>
  </thead>
								<tbody>
									<?php 
									
										foreach ($blogs as $blog) {
											# code...
										?>

								<tr>
									<td><input type="checkbox" class="delete_checkbox " value="<?php echo $blog->id; ?>"></td>
									<td><?php echo $blog->sujet; ?></td>
									<td><?php echo $blog->destinataire; ?></td>
									<td><?php echo $blog->message; ?></td>
									<td><?php echo $blog->date; ?></td>
									<td><a type="button" class="btn btn-outline-secondary" href="<?php echo base_url('Admin/detailmailteacher/'.$blog->id);?>"> See Message</a></td>

								</tr>
								<?php 
							}

								?>


								</tbody>
							</table> 
							<!-- /.table -->
						</div>
						<!-- /.mail-box-messages -->
					</div>
					<!-- /.box-body -->
					<div class="box-footer no-padding m-b-2">

					</div>
				</div>
				<!-- /. box -->
			</div>

		</div>
		<!-- Main row -->
	</div>



	<!-- /.content -->
</div>

