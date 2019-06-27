<div class="content-wrapper">
	<div class="content-header sty-one">
    
    </div>
    <div>
    <!-- Main content -->
    <div class="content"> 
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <h4 class="text-black m-b-1"> Notification List</h4>
             
                <div class="box-body">
                <div class="table-responsive">
                  <table id="example3" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Title</th>
                        <th>Message</th>
                        <th>Date</th>
                        


                 
                      </tr>
                    </thead>
                    <tbody>
                    	<?php 

										foreach ($blogss as $blog) {
											# code...
										?>

<tr>
								
									<td><?php echo $blog->title; ?></td>
									<td><?php echo $blog->message; ?></td>
								  <td>  <?php echo $blog->datee; ?></td>


							

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
        </div>
      </div>
      <!-- Main row --> 
    </div>
    <!-- /.content --> 
  </div>


	

</div>
