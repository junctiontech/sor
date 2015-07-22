<footer style="text-align: center;color:#fff;">
<p>2015 © <?php if(isset($namehome)==1){echo $namehome[170]->text;}else{echo "Junction Tech.All Rights Reserved.";}?></p>
</footer>
	<a id="btn-scrollup" class="btn btn-circle btn-lg" href="#"><i class="fa fa-chevron-up"></i></a>

</div>


<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-cookie/jquery.cookie.js"></script>
<script src="<?php echo base_url(); ?>assets/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/jquery-validation/dist/additional-methods.min.js" type="text/javascript"></script>


		<script src="<?php echo base_url(); ?>js/flaty.js"></script>
		<script src="<?php echo base_url(); ?>js/flaty-demo-codes.js"></script>
<!--page specific plugin scripts for materail table added by palak on 22apr15-->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/jquery.dataTables.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/DT_bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/chosen-bootstrap/chosen.jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
       
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
  
<script>
$(document).ready(function(){
    var next = 1;
    $(".add-more").click(function(e){
        e.preventDefault();
        var addto = "#field" + next;
        var addRemove = "#field" + (next);
        next = next + 1;
        var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="field' + next + '" type="text">';
        var newInput = $(newIn);
        var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
        var removeButton = $(removeBtn);
        $(addto).after(newInput);
        $(addRemove).after(removeButton);
        $("#field" + next).attr('data-source',$(addto).attr('data-source'));
        $("#count").val(next);  
        
            $('.remove-me').click(function(e){
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length-1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
			});
    });
    
</script>

</body>

</html>
       