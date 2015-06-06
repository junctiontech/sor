
<?php if(count($subitem_list) && is_array($subitem_list)){?>
<table class=" table table-striped table-bordered  table-hover fill-head" id="sample_editable_1">
									<thead>
									<tr>
									<th>#</th>
									<th>Subitem </th>
									<th>description</th>
									<th>Unit </th>
									<th>Amount</th>
									
									<th></th>
									</tr>
									</thead>

				<tbody>
				<?php foreach($subitem_list as $key=>$subil){ ?>
              <tr>
			  <!--<td><?=$key+1?></td>-->
			  <td><div class="checkbox check-default" style="margin-right:auto;margin-left:auto;">
				   <input type="checkbox" value="1" id="checkbox1">
                        <label for="checkbox1"></label>
                      </div>
               </td>       
			  <td><?=$subil->subitem_name?></td>
			  <td><?=$subil->subitem_desc?></td>
			   <?php $filter = array('unit_code'=>$subil->unit_code);
			  $unit_name= $this->utilities->get_unit_name('ssr_t_uom',$filter);
			?>
			  <td><?=($unit_name)?$unit_name[0]->unit_name:''?></td>
			  <td><?=$subil->rate?></td>
              <?php if($subil->rate==0) {?>
			   <td><a class="btn btn-inverse btn-sm" href="<?=base_url()?>index.php/home/create_sub_item/<?=$subil->dep_id?>/<?=$subil->chap_id?>/<?=$subil->item_id?>/<?=$subil->subitem_id?>"><i class="fa fa-money"></i> Calculation</a></td></tr>
				<?php } else {?>

				<td><a class="btn btn-primary btn-sm" href="<?=base_url()?>index.php/home/create_sub_item/<?=$subil->dep_id?>/<?=$subil->chap_id?>/<?=$subil->item_id?>/<?=$subil->subitem_id?>"><i class="fa fa-edit"></i>  Edit &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td></tr>
					<?php } } ?>

		
                   </tbody>
					</table>
	
	<?php } else {?>
				   <div class="alert alert-custom "><b>No Subitem record Found</b></div>
				  <?php } ?>
				  
