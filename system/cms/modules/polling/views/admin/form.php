 
 
	 
	
 
 
<?php  echo  form_open_multipart($this->uri->uri_string()); ?>
	 
	 <table>
		<tr>
			<td>
				Pertanyaan 
			</td>
			<td>
				: <?php   echo form_input('title', !empty($category->title)?$category->title:"", 'class="text"'); ?>
			</td>
		</tr>
		<tr>
			<td>
				Polling Kategori
			</td>
			<td>
				: <?php   echo form_dropdown('txtCat',$resCat,!empty($category->category_id)?$category->category_id:"");?>
			</td>
		</tr>
		<tr>
			<td>
				Image
			</td>
			<td>
				: <?php   if(!empty($category->link_file)){;?>
				<img src="<?php  echo base_url()?>uploads/Banner/<?php  echo $category->link_file?>">
				<?php  echo form_hidden('txtImg',$category->link_file);?>
				<?php   }?>
			</td>
		</tr>
		<tr>
			<td>
				Upload
			</td>
			<td>
				: <?php  echo form_upload('userfile'); ?>
			</td>
		</tr>
		<tr>
			<td>
				Url
			</td>
			<td>
				: <?php   echo form_input('txtUrl', !empty($category->link_url)?$category->link_url:"-", 'class="text" size="50"'); ?> &nbsp;&nbsp;*Isi Apabila foto memiliki halaman
			</td>
		</tr>
		<tr>
			<td>
				Urutan
			</td>
			<td>
				: <?php   echo form_input('txtUrut', !empty($category->urutan)?$category->urutan:"", 'class="text" size="5"'); ?>
			</td>
		</tr>
		<tr>
			<td>
				Simpan
			</td>
			<td>
				: <?php   echo form_dropdown('txtSimpan',array('0'=>'Tidak','1'=>'Ya') ,!empty($category->simpan)?$category->simpan:""); ?>
			</td>
		</tr>
	 </table>
	<?php  echo form_hidden('user', $user->id);?>
	<?php   $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
<?php  echo  form_close(); ?>

<?php 

?>