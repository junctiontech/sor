	<div class="col-md-12">
		<?php //print_r($chap_list);die;
			if(count($item_list) && is_array($item_list)){
					foreach($item_list as $il){ ?>
         <div class="row">
            <div class="col-md-12">
                <div class="box ">
	<div class="box-title">
	<h3><i class="fa fa-th-list"></i><a href="javascript:;"> <?=$il->item_name?></a></h3>
	<div class="box-tool">
	
	<a href="<?=base_url()?>index.php/home/get_subitem_list/<?=$il->dep_id?>/<?=$il->chap_id?>/<?=$il->item_id?>" ><button class="btn btn-primary btn-sm "style="margin-top: -5px;
"><i class="fa fa-list"></i> SUBITEM</button></a>
	<a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
	
	</div>
	</div>

	<div class="box-content">
	<div class="row">
	<div class="col-md-12">
	<p><?=$il->item_desc?></p>
	
	</div>

	</div>
	</div>
	</div>
            </div>
            
	</div>
          <?php }?>
                <?php } else {
                           echo "<div > No record found. </div>";
                           } ?>
	</div>
