<?php
error_reporting(0);
?>
<div id="main-content">
	<div class="page-title">
		<div>
		<h1><i class="fa fa-search"></i><?php if(isset($namehome)==1){echo $namehome[77]->text;}else{echo "Search";}?> </h1>
		</div>
	</div>
	<div id="breadcrumbs">
		<ul class="breadcrumb">
		<li class="active"><?php echo($this->breadcrumb->output());?> </li>
		</ul>
	</div>
<div class="row">
	<div class="col-md-12">
		<div class="box box-blue">
			<div class="box-title">
				<h3><i class="fa fa-search"></i><?php if(isset($namehome)==1){echo $namehome[77]->text;}else{echo "Search";}?> </h3>
			</div>
			<div class="box-content">
				<!-- BEGIN Tab Content -->
				<div class="tab-content">
					<div class="tab-pane active" id="search-default">
					<!-- BEGIN Default Search Result -->
						<div class="btn-toolbar">
						 
						 <!-- Filter Search Code Start !! code implement by Ankit on 8 may-->
						 
						 	<form  method="POST" action="<?php echo base_url(); ?>index.php/home/search_keyword"  class="search-form form-horizontal">
								<div class="btn-group">
									<span class="search-pan">
										<input type="text" name="search" class="form-control " placeholder="Search ..." autocomplete="off" required  
											  />
									</span>
								</div>
								<div class="btn-group">
										<select class="span12 chosen" name="dep_id" id="dep_id" data-placeholder="Choose a Department" tabindex="1" data-rule-required="" onChange="show_chapter(this.value,0)">
											<option value=""></option>
												<?php foreach($dipartments as $dipartment)
													  { ?>
											<option value="<?php echo $dipartment->dep_id; ?>"><?php echo $dipartment->dep_name; ?> </option>
												<?php } ?>
										</select>
								</div>
								<div class="btn-group" id="show_chap">
										<select name="chap_id" id="chap_id" class="span12 chosen" data-placeholder="Choose a Chapter" tabindex="1" >
											<option value=""></option>
												<?php foreach($chapters as $chapter)
													  { ?>
											<option value="<?php echo $chapter->chap_id; ?>"><?php echo $chapter->chap_name; ?></option>
												<?php } ?>
										</select>
								</div>
								<div class="btn-group" id="show_item">
									<select name="item_id" id="item_id" class="span12 chosen" data-placeholder="Choose a Item" tabindex="1">
										<option value=""> </option>
											<?php foreach($items as $item)
												  { ?>
										<option value="<?php echo $item->item_id; ?>"><?php echo $item->item_name; ?></option>
											<?php } ?>
									</select>
								</div>
								<div class="btn-group">
									<button type="submit" name="submit" class="btn btn-primary show-tooltip"  ><i class="fa fa-search"></i><?php if(isset($namehome)==1){echo $namehome[77]->text;}else{echo "Search";}?></button>
								</div>
							</form>
						</div>
						<br>
						<div class="search-results search-results-advance" >
							<ul class="clearfix">
								<li>
							<!-- Filter Search Result -->
									<?php
									if($this->input->post('search'))
									{
										if($this->input->post('item_id') && $this->input->post('search') && $this->input->post('chap_id'))
										{	
											$a = count($sub_items_drop);
											if($a!==0)
											{
											?>
												<span style="color: #6600CC; font-weight:bold; margin-bottom:5pxpx;">Total Number Of Row  <?php echo $a; ?></span><br>
											<?php
											}
											else
											{
											?>
												<div class="img-thumbnail" style="background-color: #eee;">
													<img src="<?=base_url()?>img/sorry.png" alt="Placeholder">
												</div>
											<?php											
											}
											?>
											<?php
											foreach($sub_items_drop as $sub)
											{
											?>
												<div class="img-thumbnail" style="background-color: #eee;">
													<img src="<?=base_url()?>img/search.png" alt="Placeholder">
												</div>
												<div class="info">
													<a href="<?=base_url()?>index.php/home/get_subitem_list/<?php echo $sub->dep_id ?>/<?php echo $sub->chap_id ?>/<?php echo $sub->item_id ?>"> <?php echo $sub->subitem_name; ?></a>
													<span style="color: #660033; font-weight: bold;">Sub Item</span>
													<p><?php foreach($dipartments as $dipartment){if($sub->dep_id==$dipartment->dep_id) echo $dipartment->dep_name;}?></p>
												</div>
											<?php
											}
										}
										elseif($this->input->post('chap_id') && $this->input->post('search'))
										{	
											$a = count($dropdown_item);
											$b = count($dropdown_subitem);
											$c=$a+$b;
											if($c!==0)
											{
											?>
												<p style="color: #6600CC; font-weight:bold; margin-bottom:5pxpx;">Total Number Of Row  <?php echo $c; ?></p>
											<?php
											}
											else
											{
											?>
												<div class="img-thumbnail" style="background-color: #eee;">
													<img src="<?=base_url()?>img/sorry.png" alt="Placeholder">
												</div>
											<?php											
											}
											foreach($dropdown_item as $item_drop)
											{
											?>
												<div class="img-thumbnail" style="background-color: #eee;">
													<img src="<?=base_url()?>img/search.png" alt="Placeholder">
												</div>
												<div class="info">
													<a href="<?=base_url()?>index.php/home/item/<?php echo $item_drop->dep_id ?>/<?php echo $item_drop->chap_id ?>"> <?php echo $item_drop->item_name; ?> </a>
													<span style="color: #660033; font-weight: bold;">Item</span>
													<p><?php foreach($dipartments as $dipartment){if($item_drop->dep_id==$dipartment->dep_id) echo $dipartment->dep_name;}?></p>
												</div>
											<?php
											}
											foreach($dropdown_subitem as $sub_drop)
											{
											?>
											<div class="img-thumbnail" style="background-color: #eee;">
												<img src="<?=base_url()?>img/search.png" alt="Placeholder">
											</div>
											<div class="info">
												<a href="<?=base_url()?>index.php/home/get_subitem_list/<?php echo $sub_drop->dep_id ?>/<?php echo $sub_drop->chap_id ?>/<?php echo $sub_drop->item_id ?>"> <?php echo $sub_drop->subitem_name; ?> </a>
												<span style="color: #660033; font-weight: bold;">Sub Item</span>
												<p><?php foreach($dipartments as $dipartment){if($sub_drop->dep_id==$dipartment->dep_id) echo $dipartment->dep_name;}?></p>
											</div>
											<?php
											}
										}
										elseif($this->input->post('dep_id') && $this->input->post('search'))
										{	
											$a = count($dep_dropdown_item);
											$b = count($dep_dropdown_subitem);
											$c=$a+$b;
											if($c!==0)
											{
											?>
												<p style="color: #6600CC; font-weight:bold; margin-bottom:5pxpx;">Total Number Of Row  <?php echo $c; ?></p>
											<?php
											}
											else
											{
											?>
												<div class="img-thumbnail" style="background-color: #eee;">
													<img src="<?=base_url()?>img/sorry.png" alt="Placeholder">
												</div>
											<?php											
											}
											foreach($dep_dropdown_item as $item_drop)
											{
											?>
												<div class="img-thumbnail" style="background-color: #eee;">
													<img src="<?=base_url()?>img/search.png" alt="Placeholder">
												</div>
												<div class="info">
													<a href="<?=base_url()?>index.php/home/item/<?php echo $item_drop->dep_id ?>/<?php echo $item_drop->chap_id ?>"> <?php echo $item_drop->item_name; ?> </a>
													<span style="color: #660033; font-weight: bold;">Item</span>
													<p><?php foreach($dipartments as $dipartment){if($item_drop->dep_id==$dipartment->dep_id) echo $dipartment->dep_name;}?></p>
												</div>
											<?php
											}
											foreach($dep_dropdown_subitem as $sub_drop)
											{
											?>
											<div class="img-thumbnail" style="background-color: #eee;">
												<img src="<?=base_url()?>img/search.png" alt="Placeholder">
											</div>
											<div class="info">
												<a href="<?=base_url()?>index.php/home/get_subitem_list/<?php echo $sub_drop->dep_id ?>/<?php echo $sub_drop->chap_id ?>/<?php echo $sub_drop->item_id ?>"> <?php echo $sub_drop->subitem_name; ?> </a>
												<span style="color: #660033; font-weight: bold;">Sub Item</span>
												<p><?php foreach($dipartments as $dipartment){if($sub_drop->dep_id==$dipartment->dep_id) echo $dipartment->dep_name;}?></p>
											</div>
											<?php
											}
										}
										else
										{	$a=count($items);
											$b=count($sub_items);
											$c=$a+$b;
											if($c!==0)
											{
											?>
												<p style="color: #6600CC; font-weight:bold; margin-bottom:5pxpx;">Total Number Of Row  <?php echo $c; ?></p>
											<?php
											}
											else
											{
											?>
												<div class="img-thumbnail" style="background-color: #eee;">
													<img src="<?=base_url()?>img/sorry.png" alt="Placeholder">
												</div>
											<?php
											}
											foreach($items as $item)
											{
											?>
												<div class="img-thumbnail" style="background-color: #eee;">
													<img src="<?=base_url()?>img/search.png" alt="Placeholder">
												</div>
												<div class="info">
													<a href="<?=base_url()?>index.php/home/item/<?php echo $item->dep_id ?>/<?php echo $item->chap_id ?>"> <?php echo $item->item_name; ?> </a>
													<span style="color: #660033; font-weight: bold;">Item</span>
													<p><?php foreach($dipartments as $dipartment){if($item->dep_id==$dipartment->dep_id) echo $dipartment->dep_name;}?></p>
												</div>
											<?php
											}
											foreach($sub_items as $sitem)
											{
											?>
												<div class="img-thumbnail" style="background-color: #eee;">
													<img src="<?=base_url()?>img/search.png" alt="Placeholder">
												</div>
												<div class="info">
													<a href="<?=base_url()?>index.php/home/get_subitem_list/<?php echo $sitem->dep_id ?>/<?php echo $sitem->chap_id ?>/<?php echo $sitem->item_id ?>"> <?php echo $sitem->subitem_name; ?> </a>
													<span style="color: #660033; font-weight: bold;">Sub Item</span>
													<p><?php foreach($dipartments as $dipartment){if($sitem->dep_id==$dipartment->dep_id) echo $dipartment->dep_name;}?></p>
												</div>
											<?php
											}
										}
									}
									?>
								<!-- Filter Search Result End -->
								<!-- Filter Search Code Start code End implement by Ankit on 8 may-->
								</li>
							</ul>
						</div><!-- END Default Search Result -->
					</div>
				</div>
				<!-- END Tab Content -->
			</div>
		</div>
	</div>
</div>