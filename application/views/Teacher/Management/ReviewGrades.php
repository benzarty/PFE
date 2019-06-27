
<div class="content-wrapper">
	<div class="content-header sty-one">

	</div>
	<div class="content">

					<div class="card-body ">

		<div class="col-lg-5 offset-3"> 
          
          <!-- Profile Image -->

						<?php

						foreach ($students as $st) {

							# code...
							?>
          <div class="box box-primary">
            <div class="box-profile"> <img src="<?php echo site_url().'uploads/'.$st->image?>" class="img-rounded img-responsive" alt="User Image">
              <h3 class="profile-username text-center"><?php echo $st->firstName.' '.$st->lastName ?></h3>
              <ul class="nav nav-stacked sty1">
                <li><a href="#"><strong>Average Note</strong> <span class="pull-right"><strong><?php echo ROUND($mo->n,2) ?></strong></span></a></li>
                <li><a href="#">Number of Note Submited <span class="pull-right"><?php echo $moo->n ?></span></a></li>
         
              </ul>
              <a href="#example3" class="btn btn-primary btn-block">More detail</a> </div>
            <!-- /.box-body --> 
          </div>
          <?php
						}

						?></div>
          <!-- /.box --> 
        </div>
<div class="card">
			<div class="card-body ">





				<div class="col-lg-12 m-b-5">

					<h5 class="text-black">See Student Notes : </h5>



					<div class="form-group mx-sm-5 mb-2">








					</div>

					<table id="example3" class="table table-bordered table-striped table-responsive" width="100%">
						<thead>
						<tr>


							<th style="width: 13%">Libelle </th>
							<th style="width: 13%">Date
						   <th style="width: 13%">Note </th>

							<th style="width: 13%">Action </th>








						</tr>
						</thead>
						<tbody>


						<?php

						foreach ($blogs as $blog) {

							# code...
							?>

							<tr>
				         <td><?php echo $blog->remarque; ?></td>

							<td><?php echo $blog->date; ?></td>

								<td style="text-align: center;">
                        <?php  if($blog->note==1) { ?>
                    <img src="<?php echo base_url('assets/upload/1star.JPG') ?>" 
                     <?php  }  ?> 
                      <?php  if($blog->note==2) { ?>
                    <img src="<?php echo base_url('assets/upload/2star.JPG') ?>" 
                     <?php  }  ?> 
                       <?php  if($blog->note==3) { ?>
                    <img src="<?php echo base_url('assets/upload/3star.JPG') ?>" 
                     <?php  }  ?> 
                       <?php  if($blog->note==4) { ?>
                    <img src="<?php echo base_url('assets/upload/4star.JPG') ?>" 
                     <?php  }  ?> 
                       <?php  if($blog->note==5) { ?>
                    <img src="<?php echo base_url('assets/upload/5star.JPG') ?>" 
                     <?php  }  ?> 
                     </td>

							<td>	<a type="button" class="btn btn-outline-danger" href="<?php echo base_url('Admin/deletenote/'.$blog->id);?>">Delete</a></td>






							</tr>
							<?php
						}

						?>
						</tbody>


					</table>




				</div>



			</div>
		</div></div></div>
