<div class="content-wrapper">
	<!-- Main content -->
	<div class="content">
		<?php echo form_open('Admin/saveadmin'); ?>
		<?php if (isset($message)) { ?>
			<div class="alert alert-success" role="alert">Operation is done Correctly</div>
		<?php } ?>
		<div class="row">

			<div class="col-lg-12">
				<div class="box box-primary">

					<div class="box-header with-border">
						<h3 class="box-title">Compose New Message</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body pad-10">
					



											<div class="form-group">
												<div class="row">


                                  <div class="col-md-6">

                                  	<input type="checkbox" class="subject-list" id="chkddl" onclick="Enableddl(this)"  />
                                  <label>For Teachers </label>





                     <select class="form-group custom-select" name="idteacher" id="DDL" disabled="disabled" >
                      	<option selected disabled>Select mail......</option>
                      	<?php 
									
										foreach ($bs as $b) {
											# code...
										?>
                        <option value="<?php echo $b->id ?>"><?php echo $b->mail; ?></option>


                        		<?php 
							}

								?>

                      </select>
                  </div>
                   <div class="col-md-6">
                                  	<input type="checkbox" class="subject-list" id="chkddl2" onclick="Enableddl2(this)" />
                                  	                                  <label>For Parents </label>





                     <select class="form-group custom-select" name="idparent" id="DDL2" disabled="disabled" >
                      	<option selected disabled>Select mail......</option>
                      	<?php 
									
										foreach ($bss as $bs) {
											# code...
										?>
                        <option value="<?php echo $b->id ?>"><?php echo $bs->mail; ?></option>


                        		<?php 
							}

								?>

                      </select>
                  </div>
             
              </div>
                  </div>

						<div class="form-group">
							<input class="form-control" placeholder="Subject:" name="sujet" id="sujet" required>
							<?php echo form_error('sujet'); ?>



						</div>

						<div class="form-group">
							<textarea id="compose-textarea" class="form-control" style="height: 300px" name="message" id="message" required></textarea>
							<?php echo form_error('message'); ?>

						</div>

					</div>
					<input type="hidden" value="<?php echo $user->firstName." ".$user->lastName."" ?>" name="destinataire" id="destinataire"/>

					<?php echo form_close(); ?>

					<div id="fugo">

					</div>
					<!-- /.box-body -->
					<div class="box-footer m-b-2">
						<div class="pull-right">
							<button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o" id="submit"></i> Send</button>
						</div>
					</div>
					<!-- /.box-footer -->
				</div>
				<!-- /. box -->
			</div>
		</div>
		<!-- Main row -->
	</div>
	<!-- /.content -->
</div>

<script type="text/javascript">
	function Enableddl(chkddl)
	{
		var ddl=document.getElementById("DDL");
		ddl.disabled=chkddl.checked ? false : true;
		if(!ddl.disabled)
		{
			ddl.focus();
		}
	}

	function Enableddl2(chkddl2)
	{
		var ddl2=document.getElementById("DDL2");
		ddl2.disabled=chkddl2.checked ? false : true;
		if(!ddl2.disabled)
		{
			ddl2.focus();
		}
	}

	 

</script>