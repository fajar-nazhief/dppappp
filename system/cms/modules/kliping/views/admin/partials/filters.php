 
	 
<form action="<?php echo base_url()?>admin/<?php echo $this->MNAME?>/search" class="form-inline pull-left" method="post" accept-charset="utf-8">
<?php echo form_hidden('f_module', $module_details['slug']); ?>
<?php echo form_hidden('search', 'true'); ?>
 
	 
	<div class="form-group">
             
            <?php echo form_dropdown('f_category',  array('0'=>'--All--')+@$folders_tree,@$_SESSION['f_category'],' class="form-control  input-lg clearfix"'); ?>
        </div>
	<div class="form-group"><?php echo form_input('f_keywords',@$_SESSION['f_keywords'],' class="form-control input-lg"'); ?></div>
    <div class="form-group"><button type="submit" class="btn btn-success ">Search</button></div>

 
<?php echo form_close(); ?> 
 