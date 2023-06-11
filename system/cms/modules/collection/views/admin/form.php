<?php  if ($this->method == 'create'): ?>
	<h3><?php  echo lang('collection_create_title');?></h3>
<?php  else: ?>
	<h3><?php  echo sprintf(lang('collection_edit_title'), $article->title);?></h3>
<?php  endif; ?>

<?php  echo form_open(uri_string(), 'class="crud"'); ?>

	<div class="tabs">

		<ul class="tab-menu">
			<li><a href="#collection-content-tab"><span><?php  echo lang('collection_content_label');?></span></a></li>
			 <li><a href="#collection-peta-tab"><span>Peta Lokasi</span></a></li>
		</ul>

		<div id="collection-content-tab">

			<ol>

				<li>
					<label for="title"><?php  echo lang('collection_title_label');?></label>
					<?php  echo form_input('title', htmlspecialchars_decode($article->title), 'maxlength="100"'); ?>
					<span class="required-icon tooltip"><?php  echo lang('required_label');?></span>
				</li>

				<li class="even">
					<label for="slug"><?php  echo lang('collection_slug_label');?></label>
					<?php  echo form_input('slug', $article->slug, 'maxlength="100" class="width-20"'); ?>
					<span class="required-icon tooltip"><?php  echo lang('required_label');?></span>
				</li>
				<li >
					<label for="slug">Caption</label>
					<?php  echo form_input('katakunci', $article->katakunci, 'maxlength="100" class="width-20"'); ?> *Penggalan Judul Berita
					 
				</li>
				<li >
					<label for="slug">Keyword</label>
					<?php  echo form_input('keyword', $article->keyword, 'maxlength="100" class="width-20"'); ?> *Penghubung untuk berita terkait
					 
				</li>
				<li>
					<label for="category_id"><?php  echo lang('collection_category_label');?></label>
					<?php  echo form_dropdown('category_id', array(lang('collection_no_category_select_label'))+$categories, @$article->category_id) ?>
					[ <?php  echo anchor('admin/collection/categories/create', lang('collection_new_category_label'), 'target="_blank"'); ?> ]
				</li>

				<li class="even date-meta">
                
            <label><?php  echo lang('collection_date_label');?></label>
                      
                      <div style="float:left;">
                                         
                      <?php 
                      if(@$article->created_on==''&& @$article->date==''){
                       $date = date('Y-m-d');
                      }
                      else{
		                $date = isset($article->created_on) ? date('Y-m-d', strtotime($article->created_on_year.'-'.$article->created_on_month.'-'.$article->created_on_day)) : date('Y-m-d');
                      }
                    //  echo date('Y-m-d', strtotime($article->created_on_year.'-'.$article->created_on_month.'-'.$article->created_on_day));
                      echo form_input('created_on', htmlspecialchars_decode($date), 'maxlength="10" id="datepicker" class="text width-20"'); ?>
                      </div>
  
            <label class="time-meta"><?php  echo lang('collection_time_label');?></label>
            <?php  echo form_dropdown('created_on_hour', $hours, !empty($article->created_on_hour) ? $article->created_on_hour : date('H')) ?>
            <?php  echo form_dropdown('created_on_minute', $minutes, !empty($article->created_on_minute) ? $article->created_on_minute : date('i')) ?>
        </li>

				<li class="even">
					<label for="status"><?php  echo lang('collection_status_label');?></label>
					<?php  echo form_dropdown('status', array('draft'=>lang('collection_draft_label'), 'live'=>lang('collection_live_label')), $article->status) ?>
				</li>
 
				<li >
					<label class="intro" for="intro"><?php  echo lang('collection_intro_label');?></label>
					<?php  echo form_textarea(array('id'=>'intro', 'name'=>'intro', 'value' => $article->intro, 'rows' => 5, 'class'=>'wysiwyg-simple')); ?>
				</li>

				<li class="even">
					<?php  echo form_textarea(array('id' => 'body', 'name' => 'body', 'value' => $article->body, 'rows' => 50, 'class' => 'wysiwyg-advanced')); ?>
					 </li>
				 
				

			</ol>
		</div>

		 
		
		<div id="collection-peta-tab">
			<ol>
			<li>
					<label for="title">Latitude</label>
					<?php  echo form_input('txtLat', !empty($article->lat)?$article->lat:"", 'maxlength="100"'); ?>
					 
				</li>

				<li class="even">
					<label for="slug">Langitude</label>
					<?php  echo form_input('txtLang', !empty($article->lng)?$article->lng:"", 'maxlength="100" class="width-20"'); ?>
					 
				</li>

				<li>
					<b>Cari Koordinat: <a href="http://itouchmap.com/latlong.html" target="_blank">coordinate</a></B>
				</li>
			</ol>
		</div>


	</div>
	

<div class="buttons float-right padding-top">
<?php  $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )); ?>
</div>
<?php  echo form_close(); ?>