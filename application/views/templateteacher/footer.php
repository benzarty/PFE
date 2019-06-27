<footer class="main-footer">
	Copyright © 2019. All rights reserved.</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Tab panes -->
	<div class="tab-content">
		<!-- Home tab content -->
		<div class="tab-pane" id="control-sidebar-home-tab"></div>
		<!-- /.tab-pane -->
	</div>
</aside>
<!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url('assets/dashboard/dist/js/jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/dashboard/dist/plugins/jquery-ui/jquery-ui.min.js')?>"></script>

<script src="<?php echo base_url('assets/dashboard/dist/plugins/popper/popper.min.js');?>"></script>
<script src="<?php echo base_url('assets/dashboard/dist/bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/rating/js/bootstrap.js');?>"></script>


<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.js')?>"></script>

<!-- template -->
<script src="<?php echo base_url('assets/dashboard/dist/js/bizadmin.js');?>"></script>

<!-- for demo purposes -->
<script src="<?php echo base_url('assets/dashboard/dist/js/demo.js');?>"></script>

<!-- jsgrid Tables -->
<script src="<?php echo base_url('assets/dashboard/dist/plugins/jsgrid/db.js');?>"></script>
<script src="<?php echo base_url('assets/dashboard/dist/plugins/jsgrid/jsgrid.min.js');?>"></script>
<script src="<?php echo base_url('assets/dashboard/dist/plugins/jsgrid/jsgrid.int.js');?>"></script>

<script src="<?php echo base_url('assets/dashboard/dist/plugins/datatables/jquery.dataTables.min.js');?>"></script>
<script src="<?php echo base_url('assets/dashboard/dist/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
    $(function () {
    $('#example3').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<!-- iCheck -->
<script src="<?php echo base_url('assets/dashboard/dist/plugins/iCheck/icheck.min.js');?>"></script>

<!-- Page Script -->
<script>
	$(function () {
		//Enable iCheck plugin for checkboxes
		//iCheck for checkbox and radio inputs
		$('.mailbox-messages input[type="checkbox"]').iCheck({
			checkboxClass: 'icheckbox_flat-blue',
			radioClass: 'iradio_flat-blue'
		});

		//Enable check and uncheck all functionality
		$(".checkbox-toggle").click(function () {
			var clicks = $(this).data('clicks');
			if (clicks) {
				//Uncheck all checkboxes
				$(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
				$(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
			} else {
				//Check all checkboxes
				$(".mailbox-messages input[type='checkbox']").iCheck("check");
				$(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
			}
			$(this).data("clicks", !clicks);
		});

		//Handle starring for glyphicon and font awesome
		$(".mailbox-star").click(function (e) {
			e.preventDefault();
			//detect type
			var $this = $(this).find("a > i");
			var glyph = $this.hasClass("glyphicon");
			var fa = $this.hasClass("fa");

			//Switch states
			if (glyph) {
				$this.toggleClass("glyphicon-star");
				$this.toggleClass("glyphicon-star-empty");
			}

			if (fa) {
				$this.toggleClass("fa-star");
				$this.toggleClass("fa-star-o");
			}
		});
	});
</script>
<script src="<?php echo base_url('assets/dashboard/dist/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');?>"></script>

<!-- Dropzone -->
<script src="<?php echo base_url('assets/dashboard/dist/plugins/dropzone-master/dropzone.js');?>"></script>
<script src="<?php echo base_url('assets/dashboard/dist/plugins/formwizard/jquery-steps.js');?>"></script>
<script src=""<?php echo base_url('assets/dashboard/dist/jquery.validate.min.js');?>"></script>
<script>
var frmRes = $('#frmRes');
var frmResValidator = frmRes.validate();

var frmInfo = $('#frmInfo');
var frmInfoValidator = frmInfo.validate();

var frmLogin = $('#frmLogin');
var frmLoginValidator = frmLogin.validate();

var frmMobile = $('#frmMobile');
var frmMobileValidator = frmMobile.validate();


</script>

<script src="<?php echo base_url('assets/dashboard/dist/plugins/dropify/dropify.min.js');?>"></script>
<script>
	$(document).ready(function(){
			// Basic
			$('.dropify').dropify();

			// Translated
			$('.dropify-fr').dropify({
				messages: {
					default: 'Glissez-déposez un fichier ici ou cliquez',
					replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
					remove:  'Supprimer',
					error:   'Désolé, le fichier trop volumineux'
				}
			});








			// Used events
			var drEvent = $('#input-file-events').dropify();

			drEvent.on('dropify.beforeClear', function(event, element){
				return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
			});

			drEvent.on('dropify.afterClear', function(event, element){
				alert('File deleted');
			});

			drEvent.on('dropify.errors', function(event, element){
				console.log('Has Errors');
			});

			var drDestroy = $('#input-file-to-destroy').dropify();
			drDestroy = drDestroy.data('dropify')
			$('#toggleDropify').on('click', function(e){
				e.preventDefault();
				if (drDestroy.isDropified()) {
					drDestroy.destroy();
				} else {
					drDestroy.init();
				}
			})
		}




	);





</script>
<style>
	.removeRow
	{
		background-color: black;
		color:#FFFFFF;
	}

		.removeRoww
	{
		background-color: #5F9EA0;
		color:#FFFFFF;
	}

</style>
<script type="text/javascript">
	$(document).ready(function(){

		$('.delete_checkbox').click(function(){
			if($(this).is(':checked'))
			{
				$(this).closest('tr').addClass('removeRow');
			}
			else
			{
				$(this).closest('tr').removeClass('removeRow');
			}
		});

		$('#delete_all').click(function(){
			var checkbox = $('.delete_checkbox:checked');
			if(checkbox.length > 0)
			{
				var checkbox_value = [];
				$(checkbox).each(function(){
					checkbox_value.push($(this).val());
				});
				$.ajax({
					url:"<?php echo base_url(); ?>Admin/delete_all",
					method:"POST",
					data:{checkbox_value:checkbox_value},
					success:function()
					{
						$('.removeRow').fadeOut(1500);

					}
				})
			}
			else
			{
				alert('Select atleast one records');
			}
		});

	});

			






$(document).ready(function(){

		$('.check_checkbox').click(function(){
			if($(this).is(':checked'))
			{
				$(this).closest('tr').addClass('removeRoww');
			}
			else
			{
				$(this).closest('tr').removeClass('removeRoww');
			}
		});

		$('#mark_all').click(function(){
			var checkbox = $('.check_checkbox:checked');
			if(checkbox.length > 0)
			{


				var checkbox_value = [];
				var datee = [];


				$(checkbox).each(function(){
					checkbox_value.push($(this).val());
					datee.push(document.getElementById("datee").value);



				});


				$.ajax({
					url:"<?php echo base_url(); ?>Admin/Mark_all",
					method:"POST",
					data:{checkbox_value:checkbox_value,datee:datee},
					success:function()
					{
						$('.removeRoww').fadeOut(1000);
						$('.removeRoww').remove();						
checkbox_value=null;
datee=null;
					}
				})
			}
			else
			{
				alert('Select atleast one records');
			}
		});

	});

</script>
<script>
	$(function () {
		$('#example1').DataTable()
		$('#example2').DataTable({
			'paging'      : true,
			'lengthChange': false,
			'searching'   : false,
			'ordering'    : true,
			'info'        : true,
			'autoWidth'   : false
		})
	})
</script>
<script src="<?php echo base_url('assets/dashboard/dist/plugins/table-expo/filesaver.min.js');?>"></script>
<script src="<?php echo base_url('assets/dashboard/dist/plugins/table-expo/xls.core.min.js');?>"></script>
<script src="<?php echo base_url('assets/dashboard/dist/plugins/table-expo/tableexport.js');?>"></script>
<script src="<?php echo base_url('assets/rating/rating.js');?>"></script>


<!--Start of Tawk.to Script-->

<!--Start of Tawk.to Script-->

<!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->
</body>

<!-- Mirrored from uxliner.com/bizadmin/demo/main/table-jsgrid.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 09:33:59 GMT -->
</html>



