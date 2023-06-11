<div class="panel panel-default">
					 
					<div class="panel-body">
<form class="form-inline no-margin" action="<?php echo base_url()?>admin/news/download" method="post" accept-charset="utf-8">
 <div class="row">
		<div class="col-md-9">
			<div class="input-group">
		<?php
 
		
		//$this->db->where('nama_modul',$this->nama_modul);
	 $res = $this->db->get('profiles')->result();
		foreach($res as $userkey => $userdata){
			$userd[$userdata->user_id] = $userdata->first_name;
		}
		?>
            <?php echo form_dropdown('user', array('0'=>'-- Pilih User--')+$userd,'',' class="form-control" style="width:200px"'); ?>
        </div>
 
	<div class="input-group">
            <?php echo form_dropdown('bulan',bln(),'',' class="form-control" style="width:200px"'); ?>
        </div>
	
	<div class="input-group">
		<button type="submit" class="btn btn-success btn-sm">Download Laporan Xls</button>
	</div>
	</div></div>
	</form>
	</div>
					</div>
<!-- Ditambahkan Buat download excel berdasarkan Kalender Event -->
 

 
 

	 <div class="panel panel-default">
							<div class="panel-body">
								<div class="pad-btm form-inline">
					            <div class="row">
					                <div class="col-sm-6 table-toolbar-left">
					                     <span>Total</span> <span class="badge badge-success m-left-xs"><?php echo $total?></span>
					                </div>
					                <div class="col-sm-6 table-toolbar-right">
						<div class="btn-group">
						 <a href="<?php echo base_url()?>admin/news/resetsearch" class="btn btn-default add-tooltip" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Reset Search"><i class="demo-pli-download-from-cloud"></i></a>
						</div>
					                    <div class="form-group">
						
						<?php  echo form_open('admin/news/search'); ?>
						<?php $ct = $this->db->where('show','1')->order_by('title','ASC')->get('news_categories')->result();
						foreach($ct as $vt){
							$options[$vt->id]= $vt->title;
						}
						?>
						<?php echo form_dropdown('category', array(''=>'Pilih Kategori')+$folders_tree,@$_SESSION['category'],' class="form-control" style="width:200px"'); ?>
											<input placeholder="Search" name="search" class="form-control" value="<?php echo @$_SESSION['cari']?>" type="text">
											<input type="submit" value="Search" class="btn btn-success">
											<?php echo form_close()?>
					                    </div> 
					                </div>
					            </div>
					        </div>
								 
								<br>
<?php  if ( ($news)): ?>
<?php  echo form_open('admin/news/action');?>
		<table class="table table-bordered table-condensed table-hover table-striped" >
		<thead>
			<tr>
				 
				<th><?php  echo lang('news_post_label');?></th>
				<th class="width-10 visible-lg visible-md"><?php  echo lang('news_category_label');?></th>
				<th class="width-10 visible-lg visible-md"><?php  echo lang('news_date_label');?></th>
				<th class="width-5 visible-lg visible-md"><?php  echo lang('news_status_label');?></th>
				<th class="visible-lg visible-md">Created</th>
				<th class="visible-lg visible-md">Updated</th>
				<th class="width-5 visible-lg visible-md">Dibaca</th> 
				<th class="width-10"><span><?php  echo lang('news_actions_label');?></span></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="6">
					<div class="inner"><?php  $this->load->view('admin/partials/pagination'); ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php  foreach ($news as $article): ?>
				<tr>
					
					<td><?php  echo $article->title;?>
					<?php if($article->pilihan_editor =='1'){?>
					<span class="label label-mint">Pilihan Editor</span>
					<?php }?>
					<?php if($article->headline =='1'){?>
					<span class="label label-success">HEADLINE</span>
					<?php }?>
					<div class="text-thin text-xs" style="color:#6D6C6C">
					<a href="<?php   echo base_url().'admin/news/setnav/'. $article->id.'/'.$article->category_id;?>" onClick="return setnav()"><?php   echo 'news/' .date('Y/m', $article->created_on) .'/'. $article->slug;?></a>
					</div></td>
					<td class="visible-lg visible-md"><?php  echo $article->category_title;?><div class="text-thin text-xs" style="color:#6D6C6C">
					<a href="<?php   echo base_url().'admin/news/setnavcat/'. $article->category_id;?>" onClick="return setnav()"><?php   echo 'news/category/'. $article->category_slug;?></a>
					</div></td>
					<td class="visible-lg visible-md"><?php  echo date('M d, Y', $article->created_on);?></td>
					<td class="visible-lg visible-md"><?php  echo lang('news_'.$article->status.'_label');?></td>
					<td class="visible-lg visible-md">
					<?php  if ($article->author): ?>
						<?php  echo anchor('user/' . $article->createdby, $article->author->display_name, 'target="_blank"'); ?>
					<?php  else: ?>
						<?php  echo lang('blog_author_unknown'); ?>
					<?php  endif; ?>
					</td>
					<td class="visible-lg visible-md">
					<?php  if ($article->updated): ?>
						<?php  echo anchor('user/' . $article->updateby, $article->author->display_name, 'target="_blank"'); ?>
					<?php  else: ?>
						<?php  echo lang('blog_author_unknown'); ?>
					<?php  endif; ?>
					</td>
					<td class="visible-lg visible-md"><?php  echo $article->klik;?></td>
					 
					<td>
						
						<div class="btn-group">
							<button class="btn btn-danger btn-sm" data-toggle="dropdown">Action</button>
							 
							<ul class="dropdown-menu">
						<?php   if($article->pilihan_editor == '1'){?>
						<li><?php  echo anchor('admin/news/selesai/' . $article->id, 'Stop Pilihan Editor');?></li>
						<?php   }else{?>
						<li><?php  echo anchor('admin/news/pilih/' . $article->id, 'Pilihan Editor');?></li>
						<?php   }?>
						 
						<?php   if($article->headline == '1'){?>
						<li><?php  echo anchor('admin/news/headline_selesai/' . $article->id, 'Stop Headline');?></li>
						<?php   }else{?>
						<li><?php  echo anchor('admin/news/headline/' . $article->id, 'Jadikan Headline');?></li>
						<?php   }?>
						
						<li><?php  echo anchor('admin/news/preview/' . $article->id, lang($article->status == 'live' ? 'news_view_label' : 'news_preview_label'), 'rel="modal-large" class="iframe" target="_blank"') ; ?></li>
						<li><?php  echo anchor('admin/news/edit/' . $article->id, lang('news_edit_label'));?> </li>
						<li><?php  echo anchor('admin/news/delete/' . $article->id, lang('news_delete_label'), array('class'=>'confirm')); ?></li>
							</ul>
						</div>
					</td>
				</tr>
			<?php  endforeach; ?>
		</tbody>
	</table>
<?php  echo form_close();?>
	 

<?php  else: ?>
	<p><?php  echo lang('news_no_articles');?></p>
<?php  endif; ?>


							</div>
							</div>
							</div>

							<script>
								function setnav(){  
  if (confirm("Tautkan ke navigasi menu?!")) {
    return true;
  } else {
   return false;
  }  
								}
								</script>