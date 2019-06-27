<div class="content-wrapper">
	<div class="content-header sty-two">

	</div>

	<div class="content">
		<div class="row">
			<div class="col-lg-4 col-sm-6 col-xs-12 m-b-3">
				<div class="bg-primary">
					<div class="card-body"> <span class="info-box-icon bg-transparent"><i class="ti-stats-up text-white"></i></span>
						<div class="info-box-content">
							<h6 class="info-box-text text-white">Number of Students Enrolled</h6>
							<h1 class="text-white"><?php echo $count->n ; ?></h1>
										 </div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 col-xs-12 m-b-3">
				<div class="bg-danger">
					<div class="card-body"> <span class="info-box-icon bg-transparent"><i class="ti-stats-up text-white"></i></span>
						<div class="info-box-content">
							<h6 class="info-box-text text-white">Number of Teachers </h6>
							<h1 class="text-white"><?php echo $countteacher->n ; ?></h1>
							</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-sm-6 col-xs-12 m-b-3">
				<div class="bg-blue">
					<div class="card-body"> <span class="info-box-icon bg-transparent"><i class="ti-stats-up text-white"></i></span>
						<div class="info-box-content">
							<h6 class="info-box-text text-white">Absence marked Today</h6>
							<h1 class="text-white"><?php echo $absence->n ; ?></h1>
					 </div>
					</div>
				</div>
			</div>
			
		</div>
		<div class="card">
			<div class="card-body">
			<div class="row">


				<div class="col-lg-6 m-b-3">
					<h4 style="float: left" class="text-black">Announcement</h4><div style="float: right;"><a type="button" class="btn btn-primary" href="<?php echo base_url('Admin/upcoming');?>"><i class=" ti-arrow-right"></i>   More Detail</a></div>
					<div class="table-responsive">
						<table class="table">
							<thead class="bg-primary text-white">
							<tr>
								<th scope="col">Titre</th>
								<th scope="col">Type</th>
								<th scope="col">Host</th>
								<th scope="col">place</th>

							</tr>
							</thead>
							<tbody>
							<?php

							foreach ($annonces as $blog) {
								# code...
								?>
								<tr>
									<td><?php echo $blog->titre; ?></td>

									<td><?php echo $blog->typeee; ?></td>
									<td><?php echo $blog->host; ?></td>
									<td><?php echo $blog->place; ?></td>

								</tr>
								<?php
							}

							?>

							</tbody>
						</table>
					</div>
				</div>
				<div class="col-lg-6 m-b-3">
					<h4 style="float: left" class="text-black">Mail</h4><div style="float: right;"><a type="button" href="<?php echo base_url('Admin/Consultationmail/'.$user->id);?>" class="btn btn-success"><i class=" ti-arrow-right" ></i>   More Detail</a></div>
					<div class="table-responsive">
						<table class="table">
							<thead class="bg-success text-white">
							<tr>
								<th scope="col">Subject</th>
								<th scope="col">From</th>
								<th scope="col">Date</th>
							</tr>
							</thead>
							<tbody>
							<?php

							foreach ($mails as $mail) {
							# code...
							?>
							<tr>
								<th><?php echo $mail->sujet; ?></th>

		  <th><?php echo $mail->destinataire; ?></th>
		  <th><?php echo $mail->date; ?></th>

							</tr>
								<?php
							}

							?>
							</tbody>
						</table>
					</div>
				</div></div></div></div>


</div>

</div>
