<div class="content-wrapper">
	<div class="content-header sty-one">
		<h1>Event List :</h1>


	</div>
	<div class="col-lg-12">
		<div class="row">

			<?php


			foreach ($blogs as $blog) {
				# code...
				?>
				<div class="col-lg-6" style="padding-top: 15px">


					<div class="card text-center">
						<div class="card-header bg-black"><?php echo $blog->titre; ?></div>

						<div class="card-header">Date : <?php echo $blog->date; ?> </div>

						<div class="card-body">
							<h4 class="card-title">Description :<?php echo $blog->description; ?></h4>
							<h4 class="card-title">Host :<?php echo $blog->host; ?></h4>

							<p class="card-text">Place :<?php echo $blog->place ?></p>
						</div>
						<div class="card-footer text-muted">Postulation :<?php echo $blog->datedecreation; ?> </div>
					</div>
				</div>

				<?php
			}

			?>
		</div>
	</div>
</div>
