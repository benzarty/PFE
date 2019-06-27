  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    
    <div class="content"> 
<div class="card m-t-3">
      <div class="card-body">
      <h4 class="text-black">Notes Of Your Children</h4>
      <div class="table-responsive">
                  <table id="example3" class="table table-bordered ">
                <thead>
                <tr>
                  <th>Teacher Name</th>
                  <th>Subject</th>

                  <th>Date </th>
                  <th>Remarque</th>
                  <th style="text-align: center;">Note</th>
                </tr>
                </thead>
                <?php 
                  
                    foreach ($blogs as $blog) {
                                $t=$this->db->get_where('teacher',array('id'=>$blog->idteacher))->first_row();
                                $m=$this->db->get_where('matiere',array('id'=>$blog->idmatiere))->first_row();

                    ?>

                <tr>

                  <td><?php echo $t->firstName.' '.$t->lastName; ?></td>
                                    <td><?php echo $m->libelle; ?></td>

                  <td><?php echo $blog->date; ?></td>
                  <td><?php echo $blog->remarque; ?></td>
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


                </tr>
                <?php 
              }

                ?>
               
             
              </table>
                  </div>
      </div></div>

    </div></div>