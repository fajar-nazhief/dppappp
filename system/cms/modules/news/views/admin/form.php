



<?php  echo form_open_multipart(uri_string(), 'class="crud panel-body form-horizontal form-padding"'); ?>

<div class="panel">

					            <div class="panel-heading">

					                <h3 class="panel-title">

										<?php  if ($this->method == 'create'): ?>

 <?php  echo lang('news_create_title');?> 

<?php  else: ?>

 <?php  echo sprintf(lang('news_edit_title'), $article->title);?> 

<?php  endif; ?>

									</h3>

					            </div>

								<div class="panel-body">

									 



				<div class="form-group">

					<label class="col-sm-2 control-label" for="title"><?php  echo lang('news_title_label');?></label>

					<div class="col-sm-4">

					<?php  echo form_input('title', htmlspecialchars_decode($article->title), 'class="form-control"'); ?>

					<span class="required-icon tooltip"><?php  echo lang('required_label');?></span>

					</div>

				</div>

				

				<div class="form-group">

					<label class="col-sm-2 control-label" ><?php  echo lang('news_category_label');?></label>

					<div class="col-sm-4">

					<?php  echo form_dropdown('category_id',$folders_tree, @$article->category_id,'class="form-control"') ?>

					 

					</div>

				</div>



				 <?php  echo form_hidden('slug', $article->slug, ' class="width-20 form-control"'); ?>

				 

				<div class="form-group">

					<label class="col-sm-2 control-label" >Tags</label>

					<div class="col-sm-4">

					<?php  echo form_input('keyword', $article->keyword, 'maxlength="100" class="width-20 form-control"'); ?>

					<span class="text-sm text-success">*Penghubung untuk berita terkait </span>

					</div>

				</div>

				

				



				<div class="form-group">

                

            <label class="col-sm-2 control-label" ><?php  echo lang('news_date_label');?></label>

                      

                            <div class="col-sm-4">       

                      <?php

					   

                      if(@$article->created_on==''){

                       $date = date('Y-m-d');

                      }

                      else{

		                $date = isset($article->created_on) ? date('Y-m-d', ($article->created_on)) : date('Y-m-d');

                      }

                    //  echo date('Y-m-d', strtotime($article->created_on_year.'-'.$article->created_on_month.'-'.$article->created_on_day));

                      echo form_input('created_on', htmlspecialchars_decode($date), 'maxlength="10" id="datepicker" class=" form-control"'); ?>

							</div>

				</div>

				<div class="form-group">

            <label class="col-sm-2 control-label" >Jam : Menit</label>

			<div class="col-sm-1">

				 

            <?php  echo form_dropdown('created_on_hour', $hours, (date('H',$article->created_on)) ? date('H',$article->created_on) : date('H'),' class="form-control"') ?>

			</div>

			<div class="col-sm-1">

			<?php  echo form_dropdown('created_on_minute', $minutes, ($article->created_on_minute) ? $article->created_on_minute : date('i'),' class="form-control"') ?>

			</div>

			</div>



				<div class="form-group">

					<label class="col-sm-2 control-label" ><?php  echo lang('news_status_label');?></label>

					<div class="col-sm-2">

					<?php  echo form_dropdown('status', array('live'=>lang('news_live_label'),'draft'=>lang('news_draft_label')), $article->status,'class="form-control"') ?>

					</div>

					</div>
					<div class="form-group">

<label class="col-sm-2 control-label" >Arsipkan yang lama?</label>

<div class="col-sm-4">

<?php  echo form_dropdown('arsipkan',array('1'=>'Tidak','2'=>'Ya'), '1','class="form-control"') ?>

 

</div>

</div>
 

				 

				 <div class="form-group btm_border" style="display:none">

											<div class="row">

											<label class="col-sm-2 control-label" for="demo-hor-12">Foto</label>

											<div class="col-sm-6">

											<span class="pull-left btn btn-default btn-file"> Pilih file

											<input type="file" name="foto" onchange="preview(this);" id="demo-hor-12" class="form-control required" >

								

											</span>

											<br><br>

											<span id="previewImg"><?php if($article->foto){echo '<img src="'.base_url().'uploads/default/files/'.$article->foto.'" width="100px">';}?></span>

											</div>

											</div>

										</div>



				<div class="form-group" style="display:none">

					<label class="col-sm-2 control-label" >Caption Foto</label>

					<div class="col-sm-4">

					<?php  echo form_input('title_en', $article->title_en, 'maxlength="100" class="width-20 form-control"'); ?>

					</div>

					 

				</div>

				<div class="form-group">

					<label class="col-sm-2 control-label" >isi Berita : </label>

					<div class="col-sm-9"> 

					<?php  echo form_textarea(array('id' => 'body', 'name' => 'body', 'value' => $article->body, 'rows' => 50, 'class' => 'wysiwyg-advanced')); ?>



					</div> 

					</div>

				<hr>

				 <div class="form-group" style="display:none">

					<label class="col-sm-2 control-label" >Latitude</label>

					<div class="col-sm-2">

					<?php  echo form_input('txtLat', ($article->lat)?$article->lat:"", 'class="form-control"'); ?>

					</div>

				</div>



				 <div class="form-group" style="display:none">

					<label class="col-sm-2 control-label" >Longitude</label>

					<div class="col-sm-2">

					<?php  echo form_input('txtLang', ($article->lng)?$article->lng:"", 'class="form-control"'); ?>

					</div>

					 

				</div>



				<div class="form-group">

					<label class="col-sm-2 control-label" >Google Map</label>

					<div class="col-sm-2">

					<?php  echo form_textarea(array('id' => 'google', 'name' => 'google', 'value' => $article->google, 'rows' => 5)); ?>

					</div>

					 

				</div>



				<div class="form-group">

					<label class="col-sm-2 control-label" > </label>

					<div class="col-sm-2">

					<span class="text-sm"> <a href="https://www.google.com/maps" target="_blank">Buka Google Map</a>					</span>

					</div>

					

				</div>

			 

				



			 

								</div>

</div>

	 

	



<div class="buttons float-right padding-top">

<?php  $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )); ?>

</div>

<?php  echo form_close(); ?>



<style>

	#cke_body{

		padding:10px;

		background: #f0f0f0;

		border:1px solid #CECECE;

	}

</style>

<script type="text/javascript">

	html_editor('html_editor', '100%');

	css_editor('css_editor', '100%');

	js_editor('js_editor', '100%');

</script>

<script type="text/javascript">

    $(document).ready(function() {

      $('.summernote').summernote({

        height: 300,

        tabsize: 2

      });

    });

  </script>