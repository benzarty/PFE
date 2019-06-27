<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	

	<!-- Main content -->
	<div class="content">
		<div class="card">
			<div class="card-body">
				<div class="row">



						<div class="col-lg-12 m-b-">
						<h4 class="text-black">List of events :</h4>

					</div>
					<div class="table-responsive">
						<table id="example2" class="table table-bordered table-hover" data-name="cool-table">
							<thead>
							<tr>
								<th>Title</th>
								<th>Host</th>
								<th>Place</th>
								<th>Date</th>
								<th style="text-align: center;">Action</th>


							</tr>
							</thead>
							<tbody>
							<?php

							foreach ($events as $event) {
								?>

								<tr>

									<td><?php echo $event->titre; ?></td>
									<td><?php echo $event->host; ?></td>

									<td><?php echo $event->place; ?></td>
									<td><?php echo $event->date; ?></td>
									
									<td style="text-align: center;"><a class="btn btn-xs btn-danger" href="deleteevent/?id=<?php echo $event->id; ?>">delete</a></td>


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
	</div>




</div>
