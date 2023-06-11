
 <div class="panel panel-default table-responsive">
					<div class="panel-heading">
						Search
					</div>
					<div class="panel-body">
 <div class="row container">
 <?php echo form_open('admin/formgenerator/index_act', 'class="crud"'); ?>
 <div class="form-group">
    <label for="exampleInputEmail1">Table</label>
    <?php echo form_dropdown('table',$tables,@$this->uri->segment(4),'class="form-control"')?> 
  </div>
 <div class="form-group">
    <label for="exampleInputEmail1">Page to generate</label>
    <?php echo form_dropdown('page',array('index'=>'index','form'=>'form','view'=>'view','edit'=>'Alter Table'),@$this->uri->segment(5),'class="form-control"')?> 
  </div>
 <div class="form-group">
								<label class="col-lg-2 control-label"></label>
								<div class="col-lg-10">
									<input type="submit" class="btn btn-success" data-toggle="modal" value="Generate Now!"></input>
								</div><!-- /.col -->
							</div>
 <?php echo form_close(); ?>
 </div></div></div>