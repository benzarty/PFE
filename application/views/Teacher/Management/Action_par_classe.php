
<div class="content-wrapper">
	<div class="content-header sty-one">

	</div>
	<div class="content">
		<div class="card">
			<div class="card-body">





				<div class="col-lg-12 m-b-5">

					<h4 class="text-black">Student in this Class : </h4> 

			</div>
					<div class="form-group mx-sm-5 mb-2">


						<div class="form-group mx-sm-2 mb-2">
								<p class="text-black">Check Presence :   </p> 
				 <form class="form-inline" method="post"  action="<?php  echo base_url('Admin/load_table')?>"> 
				 	



							<input class="form-control" placeholder="dd/mm/yyyy" type="date" name="datee">
							<input type="hidden" value="<?php echo $id?>" name="id"/>
						<button type="submit" class="sm btn btn-info"> GO</button>
					</form>

						</div>





					</div>

						<table id="example2" class="table table-bordered table-striped table-responsive" width="100%">
						<thead>
						<tr>
							<th style="width: 16%">Picture </th>


							<th style="width: 13%">First Name Last Name  </th>
							<th style="width: 13%">Date of Birth </th>
							<th style="width: 25%">Action </th>








						</tr>
						</thead>
						<tbody>


						<?php

						foreach ($blogs as $blog) {
							# code...
							?>

							<tr>
								<td><img src="<?php echo site_url().'uploads/'.$blog->image?>" class="user-image" alt="User Image" width="70%"></td>

								<td><?php echo $blog->firstName.' '.$blog->lastName; ?></td>
								<td><?php echo $blog->dob; ?></td>
							<td>	<a type="button" class="btn btn-outline-dark" href="<?php echo base_url('Admin/Gradetoeach/'.$blog->id);?>">Add Note</a>
								<a type="button" class="btn btn-outline-success" href="<?php echo base_url('Admin/ReviewGrades/'.$blog->id);?>">Review Grade</a>
								<a type="button" class="btn btn-outline-danger" href="<?php echo base_url('Admin/Convocation/'.$blog->id);?>">Convocation</a>

							</td>






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

