<div class="content-wrapper">

    <div class="content">
      <div class="row">
        <div class="col-lg-4 col-xs-6 m-b-3">
          <div class="card">
            <div class="card-body"><span class="info-box-icon bg-aqua"><i class="icon-plane"></i></span>
              <div class="info-box-content"> <span class="info-box-number"><?php echo $congee->n; ?></span> <span class="info-box-text">Leave Request Accepted</span> </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6 m-b-3">
          <div class="card">
            <div class="card-body"><span class="info-box-icon bg-green"><i class="icon-pencil"></i></span>
              <div class="info-box-content"> <span class="info-box-number"><?php echo $convocation->n ?></span> <span class="info-box-text">Number of Convocatio Send</span></div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xs-6 m-b-3">
          <div class="card">
            <div class="card-body"><span class="info-box-icon bg-yellow"><i class="icon-home"></i></span>
              <div class="info-box-content"> <span class="info-box-number"><?php echo $classe->n ?></span> <span class="info-box-text">Number of classes Affected </span></div>
            </div>
          </div>
        </div>
       
      </div>
      <!-- /.row -->
      
      <div class="row">
        <div class="col-lg-8">
          <div class="info-box">
            <div class="col-12">
              <h5>Events</h5>
              	<div class="table-responsive">
						<table class="table">
							<thead class="bg-success text-white">
							<tr>
								<th scope="col">Title</th>
								<th scope="col">Host</th>
								<th scope="col">Place</th>
               <th scope="col">Date</th>

							</tr>
							</thead>
							<tbody>
							<?php

							foreach ($annonces as $annonce) {
							# code...
							?>
							<tr>
	<th><?php echo $annonce->titre; ?></th>
 <th><?php echo $annonce->host; ?></th>
 <th><?php echo $annonce->place; ?></th>
  <th><?php echo $annonce->date; ?></th>


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
        <div class="col-lg-4">
         
          <div class="card m-b-3 bg-fuchsia">
            <div class="card-body text-white">
              <div class="m-b-3 font-weight-bold">
                <h5 class="text-white">Averge Note Attributed
                </h5>
              </div>
              <div class="m-b-2 f-25"><?php echo $avergenote->n ; ?> </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <div class="row">
    
   
        
      </div></div>
</div>