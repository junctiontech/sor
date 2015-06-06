<?php //print_r($chap_list);die;
	if(count($chap_list) && is_array($chap_list)){
					foreach($chap_list as $cl){ ?>
		<div class="row">
			<div class="col-md-4">			
				<a href="<?=base_url()?>index.php/home/item/<?=$cl->dep_id?>/<?=$cl->chap_id?>">
					<div class="tile-title tile-primary">
						<div class="icon">
						<i class="glyphicon glyphicon-random"></i>
						</div>
						<div class="title">
						<h3><a href="<?=base_url()?>index.php/home/item/<?=$cl->dep_id?>/<?=$cl->chap_id?>"><?=$cl->chap_name?></a></h3>
						<p ><a class="pull-right" style=" margin-right: 9px; color: #fff;"href="<?=base_url()?>index.php/home/add_chapter/<?=$cl->dep_id?>/<?=$cl->chap_id?>"><i class="fa fa-edit"></i> Edit </a></p>
						</div>
					</div>
				</a>
			</div>
		</div>				
			
	<?php }?>
		<?php } else {
				   echo "<div > No record found. </div>";
				   } ?>
