
	


<div class="content-wrapper">
	

	<div class="content-header sty-one">

	</div>
	<div class="content">
		<div class="card">
			<div class="card-body">


<h3 class="text-red text-center font-weight-bold">Absence</h3>



				<div class="col-lg-12 m-b-3">
			</div>

			
				

						<table id="example2" class="table table-bordered  table-responsive">
						<thead>
						<tr>



							<th style="width: 30%">First Name </th>
							<th style="width: 30%">LastName </th>
							<th style="width: 29%">Date </th>					


							<th style="width: 30%;text-align :center; ">Presence</th>








						</tr>
						</thead>
						<tbody>


						<?php

						foreach ($blogs as $blog) {

						$t=$this->db->get_where('student',array('id'=>$blog->id_student))->first_row();

							# code...
							?>

							<tr>
																<td><?php echo $t->firstName; ?></td>
								<td><?php echo $t->lastName; ?></td>

							
								<td><?php echo $blog->datee; ?></td>
									

							<td><div style="text-align: center;"><button type="button" class="btn btn-bm btn-outline-danger btn-rounded">Absent</button>	</div></td>






							</tr>
							<?php
						}

						?>
						</tbody>


					</table>	



				</div>
			


			</div>
		</div>
	</div>


