<?php  if ($this->method == 'create'): ?>
	<h3><?php  echo lang('news_create_title');?></h3>
<?php  else: ?>
	<h3><?php  echo sprintf(lang('news_edit_title'), $article->title);?></h3>
<?php  endif; ?>

<?php  echo form_open(uri_string(), 'class="crud"'); ?>

	<div class="tabs">

		<ul class="tab-menu">
			<li><a href="#news-content-tab"><span><?php  echo lang('news_content_label');?></span></a></li>
			 <li><a href="#news-peta-tab"><span>Peta Lokasi</span></a></li>
		</ul>

		<div id="news-content-tab">
		<div id="page-content">
			<ul>
				 
				
				<li class="even date-meta">
                
            <label><?php  echo lang('news_date_label');?></label>
                      
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
  
            <label class="time-meta"><?php  echo lang('news_time_label');?></label>
            <?php  echo form_dropdown('created_on_hour', $hours, ($article->created_on_hour) ? $article->created_on_hour : date('H')) ?>
            <?php  echo form_dropdown('created_on_minute', $minutes, ($article->created_on_minute) ? $article->created_on_minute : date('i')) ?>
        </li>

				<li class="even">
					<label for="status"><?php  echo lang('news_status_label');?></label>
					<?php  echo form_dropdown('status', array('draft'=>lang('news_draft_label'), 'live'=>lang('news_live_label')), $article->status) ?>
				</li>
				<li class="even">
					<label for="status">Website berita</label>
					<?php  echo form_dropdown('sumber', array('detik'=>'detik')) ?>
				</li>
 
				
				<li>
					URLs
					<?php   for($i=0;$i<=10;$i++){?>
					<div style="padding:10px">
					<?php  echo form_input('title[]', '',' placeholder="Url"'); ?>
					 
					 
					<?php  echo form_input('keyword[]', '', 'maxlength="100" class="width-20" placeholder="TAG"'); ?>  
					 <?php  echo form_dropdown('category_id[]', array(lang('news_no_category_select_label'))+$categories, @$article->category_id) ?>
				 
					</div>
					<?php   }?>
				</li>
				
				
			</ul>
			 </div>
		</div>

		 
		
		<div id="news-peta-tab">
			<ol>
			<li>
					<label for="title">Latitude</label>
					<?php  echo form_input('txtLat', ($article->lat)?$article->lat:"", 'maxlength="100"'); ?>
					 
				</li>

				<li class="even">
					<label for="slug">Langitude</label>
					<?php  echo form_input('txtLang', ($article->lng)?$article->lng:"", 'maxlength="100" class="width-20"'); ?>
					 
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

<script type="text/javascript">
	html_editor('html_editor', '100%');
	css_editor('css_editor', '100%');
	js_editor('js_editor', '100%');
</script>