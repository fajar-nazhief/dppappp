<ul class="page-stats">
<form action="<?php echo base_url()?>admin/<?php echo $this->nama_modul?>/search" method="post" accept-charset="utf-8">
<?php echo form_hidden('f_module', $module_details['slug']); ?>
<?php echo form_hidden('search', 'true'); ?>
 
	<li> 
            <?php echo form_dropdown('f_status', array(0 => '-- Status -- ', 'draft'=>lang('blog_draft_label'), 'live'=>lang('blog_live_label'),'approval'=>'User request'),@$_SESSION['f_status'],' class="form-control"'); ?>
        </li>
	<li> 
            <?php echo form_dropdown('f_bahasa', array(0 => '-- Bahasa -- ')+$bahasadb,@$_SESSION['f_bahasa'],' class="form-control"'); ?>
        </li>
	<li style="width:400px" class="clearfix">
             
            <?php echo form_dropdown('f_category', array(0 => '-- Category --') + $folders_tree,@$_SESSION['f_category'],' class="form-control  clearfix"'); ?>
        </li>
	<li><?php echo form_input('f_keywords',@$_SESSION['f_keywords'],' class="form-control input-sm"'); ?></li>
    <li><button type="submit" class="btn btn-success btn-sm">Search</button></li>

 
<?php echo form_close(); ?> 
</ul>