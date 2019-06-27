<div class="content-wrapper">

	<div class="content">
		<div class="card">
			<div class="card-body bg-primary">
						<div class="row">

					<?php 
									
										foreach ($blogs as $blog) {



											# code...
					$t=$this->db->get_where('student',array('id'=>$blog->idstudent))->first_row();
					$te=$this->db->get_where('teacher',array('id'=>$blog->idteacher))->first_row();
					




										?>

							
								



<div class="col-sm-10 offset-1" style="padding-top: 15px">
                <div class="card">
                  <div class="card-body">
                    <h4 class="text-center "><div class="card-header">Convocation Request</div></h4>
                    <div style="float: left">
                    	<img  class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets/dashboard/dist/img/logo-mini.png');?>">

                    </div>
                    <p class="card-text">Sorry to bother you,seems like we got some problem with your kid  <?php echo $t->firstName.' '.$te->lastName   ?>.  We will appreciate that you come at <?php echo $blog->date ?> <?php echo $blog->time ?>   to meet  <?php echo $te->firstName.' '.$t->lastName   ?>   to solve the issue  </p>
                   <div style="text-align: center;"> <a href="#" class="btn btn-primary ">Thanks for your time</a> </div></div>
                                       <h7 class="text-center "><div class="card-footer"><?php echo $blog->datedepostulation ?></div></h7>

                </div>
              </div>



								<?php 
							}

								?>
              </div>
          </div>


      </div>
</div>
</div>          
