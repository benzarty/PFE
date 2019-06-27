<div class="content-wrapper">
	<!-- Main content -->
	<div class="content">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="example2" class="table table-bordered table-hover" data-name="cool-table">
						<thead>
						<tr>
							<th scope="col">First Name</th>
							<th scope="col">Last Name</th>
							<th scope="col">Started Day</th>
							<th scope="col">Finished Day</th>
							<th scope="col">State</th>

						</tr>
						</thead>
						<tbody>

						<?php

						foreach ($requests as $req) {
							# code...
							$t=$this->db->get_where('teacher',array('id'=>$req->idteacher))->first_row();
							?>
							<tr>


								<td> <?php echo $t->firstName; ?></td>
								<td> <?php echo $t->lastName  ; ?></td>
								<td> <?php echo $req->datedebut; ?></td>
								<td> <?php echo $req->datefin; ?></td>


								<td><span class="btn btn-success">Accepted</span></td>

							</tr>

							<?php
						}

						?>
						<?php

						foreach ($requestss as $reqq) {
							# code...
							$t=$this->db->get_where('teacher',array('id'=>$req->idteacher))->first_row();
							?>
							<tr>


								<td> <?php echo $t->firstName; ?></td>
								<td> <?php echo $t->lastName  ; ?></td>
								<td> <?php echo $reqq->datedebut; ?></td>
								<td> <?php echo $reqq->datefin; ?></td>


								<td><span class="btn btn-danger">Refused</span></td>
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


