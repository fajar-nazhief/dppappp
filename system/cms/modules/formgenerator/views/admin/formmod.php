  <div class="row">
		 	
		<div class="panel panel-default ">
			<div class="panel-heading">
			Create Module
			</div>
			<div class="panel-body">
			<?php echo form_open('admin/formgenerator/moduleFrmAct', 'class="crud"'); ?>
			<div class="form-group">
				<label><span class="required">*</span>Enter Module name:</label>
				<input name="name" class="form-control new-column-name input-sm" type="text">
			</div>
			<div class="form-group">
				<label><span class="required">*</span>Enter Module Description:</label>
				<input name="description" class="form-control new-column-name input-sm" type="text">
			</div>
			<div class="form-group">
			<label><span class="required">*</span>Menu</label>
				<select name="menu" class="form-control new-column-type input-sm">
				    
				        <option value="application">Application</option>
					  <option value="Pemerintahan">pemerintahan</option>
					  <option value="content">Content</option>
					  <option value="Publikasi">Publikasi</option>
					  <option value="MASTER">Master</option>
					  <option value="design">Design</option>
					  <option value="users">Users</option>
					  <option value="utilities">Utilities</option> 
				    
				     
				</select>
		      </div>
			<div class="form-group">
			<label><span class="required">*</span>Module Type</label>
				<select name="type" class="form-control new-column-type input-sm typeinput">
				    
				    <optgroup label="Style">
					  <option value="mastermodule">With Category</option>
					  <option value="mastermoduleo">No Category</option>
					  <option value="noinput">With Category no input</option>
				    </optgroup>
				     
				</select>
		      </div>
					<div class="form-group">
			<label><span class="required">*</span>Menu</label>
				<select name="tabelnya" class="form-control new-column-type input-sm">
				    
				        <option value="no">Pakai Tabel relasi</option>
					  <option value="yes">Buat tabel baru</option> 
				    
				     
				</select>
		      </div>
			<div class="form-group relasi">
				<label><span class="required">*</span>Tabel relasi :</label>
				  <?php echo form_dropdown('relasi',$table,"",'class="form-control "')?> 
			</div>
			</div>
			<div class="panel-footer text-left">
			<input type="submit"  class="btn btn-sm btn-info" value="Submit"> 
			</div>
			<?php echo form_close()?>
		</div>
		 
	</div>
  
   