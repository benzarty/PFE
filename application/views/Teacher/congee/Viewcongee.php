<div class="content-wrapper">
	<div class="content-header sty-one">


	</div>

	<!-- Main content -->
	<div class="content">
		<div class="card">
			<div class="card-body">

				<div class="table-responsive">
					<table id="example3" class="table table-bordered table-hover" data-name="cool-table">
						<thead>
						<tr>
							<th scope="col">Started Date</th>
							<th scope="col">Finished Date</th>
														<th scope="col">Etat</th>




						</tr>
						</thead>
						<tbody>

						<?php

						foreach ($requestss as $req) {
							# code...

							
							?>
							<tr>




								<td> <?php echo $req->datedebut; ?></td>

							    <td> <?php echo $req->datefin; ?></td>
								<td> 
									<?php  if($req->etat=='accepted') { ?> 
										<span class="label label-success">Accepted</span>
										 <?php }; ?> 
										 <?php  if($req->etat=='refused') { ?> 
										<span class="label label-danger">Refused</span>
										 <?php }; ?> 

										 <?php  if($req->etat=='padding') { ?> 
										<span class="label label-default">Padding</span>
										 <?php }; ?>
							</td>







							</tr>

							<?php
						}

						?>


						</tbody>

					</table>
				</div>
			</div></div>



	</div>

</div>


