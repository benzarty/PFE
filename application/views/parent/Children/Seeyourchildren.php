<div class="content-wrapper">


<div class="content-header sty-one">

    </div>

	<div class="col-lg-12 m-t-5">
		<div class="row">




		<?php
	foreach ($blogs as $blog) {
                 //$t=$this->db->get_where('note',array('idstudent'=>$blog->id))->result_array();
$query=$this->db->query('select avg(note.note) as tot from note where note.idstudent="'.$blog->id.'" ');
$row = $query->row();

$query2=$this->db->query('select count(note.note) as tot from note where note.idstudent="'.$blog->id.'" ');
$row2 = $query2->row();
                 
$query3=$this->db->query('select count(status) as tot from presence where id_student="'.$blog->id.'" ');
$row3 = $query3->row();



	# code...
	?>

				<div class="col-lg-6 col-xlg-3" style="padding-top: 15px";>
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username text-center"><?php echo $blog->firstName; ?> <?php echo $blog->lastName; ?></h3>
              <h6 class="widget-user-desc text-center">	<?php echo $blog->gender; ?>
</h6>
            </div>
            <div class="widget-user-image"><img src="<?php echo site_url().'uploads/'.$blog->image?>" class="img-rounded img-responsive" alt="User Image"> </div>
            <div class="box-footer">
              <div class="text-center">
                <p style="font-weight: bold">Date of Birth: <?php echo $blog->dob; ?></p>
                <a href="<?php echo base_url('Admin/SeeyourchildrenGrades/'.$blog->id);?>" class="btn btn-facebook btn-rounded margin-bottom">See Grades</a> <a href="<?php echo base_url('Admin/SeeyourchildrenPresence/'.$blog->id);?>" class="btn btn-facebook btn-rounded margin-bottom">Check presence</a></div>
              <div class="row margin-bottom">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">
                      <?php 
       if (isset($row))
{
        echo ROUND($row->tot,2);
     
}            
                  ?>
  



</h5>
                    <span class="description-text">Averge Note</span> </div>
                </div>
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">             
                      <?php 
       if (isset($row3))
{
        echo $row3->tot;
     
}   ?>    
 </h5>
                    <span class="description-text">Number of Absence</span> </div>
                </div>
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">       
                           <?php 
       if (isset($row2))
{
        echo $row2->tot;
     
}            
                  ?></h5>
                    <span class="description-text">Number Of Note Submited</span> </div>
                </div>
              </div>
            </div>

          </div>
        </div>
                	<?php
	}

	?>
		</div>
	</div>

</div>
