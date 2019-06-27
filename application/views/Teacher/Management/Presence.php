
	


<div class="content-wrapper">
	

	<div class="content-header sty-one">

	</div>
	<div class="content">
		<div class="card">
			<div class="card-body">


<h3>Absence Check </h3>
<div style="text-align: right"><button type="submit" class="btn-sm btn-primary" name="mark_all" id="mark_all"><i class="fa fa-check"></i> Check </button></div>



				<div class="col-lg-12 m-b-3">
			</div>

			<?php  $datee=$response['datee']; ?>
			<input type="hidden" name="datee" id="datee" class="datee" value="<?php echo $response['datee'];; ?>" class="datee">
				

						<table id="example3" class="table table-bordered  table-responsive" width="100%">
						<thead>
						<tr>

							<th style="width: 16%">Picture </th>


							<th style="width: 13%">First Name </th>
							<th style="width: 13%">LastName </th>
							<th style="width: 13%">Date of Birth </th>					


							<th style="width: 25%;text-align :center; ">Action </th>








						</tr>
						</thead>
						<tbody>


						<?php

						foreach ($blogs as $blog) {
							# code...
							?>

							<tr>
								<td><img src="<?php echo site_url().'uploads/'.$blog->image?>" class="user-image" alt="User Image" width="70%"></td>

								<td><?php echo $blog->firstName; ?></td>
								<td><?php echo $blog->lastName; ?></td>
								<td><?php echo $blog->dob; ?></td>
									

							<td>	

								<div class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input check_checkbox"  value="<?php echo $blog->id; ?>" id="<?php echo $blog->id; ?>">
    <label class="custom-control-label" for="<?php echo $blog->id ; ?>">Absent </label>
</div>
		

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


