<div class="content-wrapper">
	<div class="content-header sty-one">
		<h4 class="text-black">Mail Detail	</h4>

	</div>
	
	<?php

	foreach ($blogs as $blog) {
	?>





	<div class="col-lg-12 m-t-2">
		<div class="card">
			<div class="card-header"><div style="font-weight: bold;color: red" >Subject :</div> <?php echo $blog->sujet; ?> </div>
			<div class="card-header"><div style="font-weight: bold;color: red" >From :</div><?php echo $blog->destinataire; ?></div>
			<div class="card-header"><div style="font-weight: bold;color: red">Message :</div><?php echo $blog->message; ?></div>
		</div>
		<?php
		}
		?>
	</div>
</div>
