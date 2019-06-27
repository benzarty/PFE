<div class="content-wrapper">
	
    
    <!-- Main content -->
    <div class="content">
    	<?php if (isset($message)) { ?>
			<div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Data Updated Successfully </strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
			</div>
		<?php } ?>
      <div class="row">
        <div class="col-lg-12">
          <div class="card card-outline">
            <div class="card-header bg-black">
              <h5 class="text-white m-b-0">Convocation Form</h5>
            </div>
            <div class="card-body">

				<form method="post" enctype="multipart/form-data" action="<?php echo base_url('Admin/ConvocationPost')?>">
<div class="row">
             <div class="col-md-5">
             	                <label for="exampleInputPassword1">Date</label>

                      <input class="form-control" placeholder="dd/mm/yyyy" type="date" name="date" id="datefield">
                    </div>
                                 <div class="col-md-5">
                                 	<input type="hidden" name="idstudent" value="<?php echo $id ?>">
                                 	<input type="hidden" name="idteacher" value="<?php echo $user->id ?>" >

                <label for="exampleInputPassword1">Time</label>
                <input type="time" class="form-control" name="time">
            </div>		
              </div>
              <div class="form-group has-feedback">
                    <label class="control-label">Reason</label>
                    <textarea class="form-control" id="placeTextarea" rows="3" placeholder="Reason" name="reason"></textarea>
                  </div>
           
             <a type="button" href="<?php echo base_url('Admin/Action_par_classe/'.$idclasse->idclasse);?>" class="btn btn-secondary"><i class="icon-logout"></i> Return</a> <button type="submit" class="btn btn-success">Submit</button>
            </form>

            </div>

          </div>

        </div>
      </div>
      
  </div>

</div>
<script type="text/javascript">
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