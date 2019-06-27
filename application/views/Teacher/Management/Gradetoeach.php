






<div class="content-wrapper">
		<?php if (isset($message)) { ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Data Updated Successfully </strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
			</div>
		<?php } ?>



	

	


	<div class="content">
					


		<?php
		foreach ($blogs as $blog) {
		# code...
		?>
	<div class="col-lg-8 offset-2">
		<div class="card text-white bg-secondary mb-3">
			<div class="card-body ">
				<div class="row">
					<div class="col-lg-3">
						<div class="user-img pull-left"> <img src="<?php echo site_url().'uploads/'.$blog->image?>" class="img-rounded img-responsive" alt="User Image"> </div>
					</div>

					<div class="col-lg-9">
							<form method="post" enctype="multipart/form-data" action="<?php echo base_url('Admin/countgrade')?>">

						<div class="mail-contnet">
							<h4 class="text-black text-center"><?php echo $blog->firstName; ?> 	<?php echo $blog->lastName; ?></h4>
							<p>Student</p>
							<div class="form-group">

                     <select class="form-group custom-select" name="idmatiere" id="name2" required>
                      	<option >Select Subject......</option>
                      	<?php 
									
									foreach ($matieres as $matiere) {
										$t=$this->db->get_where('matiere',array('id'=>$matiere->idmatiere))->first_row();

		# code...
		?>
                        <option value="<?php echo $t->id ?>"><?php echo $t->libelle; ?></option>


                        		<?php 
							}

								?>

                      </select>
                  </div>
							<div style="text-align: center;">
							<span  onmouseover="starmark(this)" onclick="starmark(this)" id="1one" style="font-size:40px;cursor:pointer;"  class="fa fa-star checked"></span>
							<span onmouseover="starmark(this)" onclick="starmark(this)" id="2one"  style="font-size:40px;cursor:pointer;" class="fa fa-star "></span>
							<span onmouseover="starmark(this)" onclick="starmark(this)" id="3one"  style="font-size:40px;cursor:pointer;" class="fa fa-star "></span>
							<span onmouseover="starmark(this)" onclick="starmark(this)" id="4one"  style="font-size:40px;cursor:pointer;" class="fa fa-star"></span>
							<span onmouseover="starmark(this)" onclick="starmark(this)" id="5one"  style="font-size:40px;cursor:pointer;" class="fa fa-star"></span></div>
							<br/>
							<textarea  style="margin-top:5px;" class="form-control" rows="3" id="comment" name="remarque" placeholder="Enter your review" required="true"></textarea>
							<input type="hidden" id="id1" value="0" name="count" />
							<br>
							<?php $firstName=$user->firstName;
							$lastName=$user->lastName;
							?>

							<input class="form-control" id="datefield" type="date" name="date" required="true">
							<!--<input class="form-control" value="<?php echo  $firstName." ".$lastName ?>" type="hidden" name="firstName" required="true"> -->
							<input class="form-control" value="<?php echo $id; ?>" type="hidden" name="idstudent" required="true">
							<input class="form-control" value="<?php echo $user->id; ?>" type="hidden" name="idteacher" required="true">






							





						</div><br>
						<div class="text-right"> <button type="submit" class="btn btn-success">Submit</button></div>
					</form>

					</div>

				</div>
			</div></div>
	</div>
			<?php
		}

		?>
		<!--<div style="padding-left: 1050px"><a type="button" class="btn btn-outline-success" href="<?php echo base_url('Admin/Action_par_classe/'.$id->id);?>"><i class="icon-logout">  Return To List</a></div>-->
</div>


	<script>
		var count;
		function starmark(item)
		{
			count=item.id[0];
			sessionStorage.starRating = count;
			var subid= item.id.substring(1);
			for(var i=0;i<5;i++)
			{
				if(i<count)
				{
					document.getElementById((i+1)+subid).style.color="orange";
				}
				else
				{
					document.getElementById((i+1)+subid).style.color="black";
				}
			}
			document.getElementById("id1").value=count;


		}
		var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

today = yyyy+'-'+mm+'-'+dd;
document.getElementById("datefield").setAttribute("min", today);






	</script>
</div>


