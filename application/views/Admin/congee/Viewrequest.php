<div class="content-wrapper">
	<!-- Main content -->
	<div class="content">
		<div class="card">
			<div class="card-body">
				<div class="row">




					<div class="col-lg-12 m-b-2">

						<div class="table-responsive table-bordered table-hover">
							<table class="table">
								<thead class="bg-danger text-white">
								<tr>
									<th scope="col"> Full Name Teacher </th>

									<th scope="col">Started Day</th>
									<th scope="col">Finished Day</th>
									<th scope="col">Reason</th>
									<th scope="col">Date Of Publish</th>
									<th scope="col" style="padding-left: 110px">Action</th>


								</tr>
								</thead>
								<tbody>
								<?php

								foreach ($requests as $req) {
									# code...
									$t=$this->db->get_where('teacher',array('id'=>$req->idteacher))->first_row();

									?>
								<tr>

									<td> <?php echo $t->firstName.' '. $t->lastName; ?></td>
									<td> <?php echo $req->datedebut; ?></td>
									<td> <?php echo $req->datefin; ?></td>

									<td> <?php echo $req->raison; ?></td>
									<td> <?php echo $req->datedepostulation; ?></td>

									<td>
										

		<form method="post" enctype="multipart/form-data" action="<?php echo base_url('Admin/acceptconge')?>">
										<input type="hidden" name="id" value="<?php echo $req->id; ?>">
									  <input type="hidden" name="idteacher" value="<?php echo $t->id; ?>">






<div style="float: left;">	<button type="submit" name="submit" class="btn btn-outline-success"><i class="fa fa-check"></i>Accept     </button>

</div>		
</form>
		<form method="post" enctype="multipart/form-data" action="<?php echo base_url('Admin/deleteconge')?>">
			<input type="hidden" name="id" value="<?php echo $req->id; ?>">
			<input type="hidden" name="idteacher" value="<?php echo $t->id; ?>">


<div>	<button type="submit" name="submit" class="btn btn-outline-danger"><i class="fa fa-close"></i>Decline  </button></div>
</form>



									</td>


								</tr>
									<?php
								}

								?>

								</tbody>
							</table>
					</div></div></div></div></div></div>
					<script type="text/javascript">
						

		


					</script>




</div>


