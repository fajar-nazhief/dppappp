<div class="container" style="padding-top:50px">
<?php  
if ($this->session->flashdata('error')){?>
<div class="closable notification error alert alert-danger">
	<?php echo $this->session->flashdata('error'); ?> Nama,e-mail,subject dan pesan tidak boleh kosong
</div>
<?php } ?>
<?php  
if ($this->session->flashdata('success')){?>
<div class="closable notification error alert alert-success">
	<?php echo $this->session->flashdata('success'); ?> Pesan anda sudah kami terima.
</div>
<?php } ?>
<div class="panel panel-default">
					<div class="panel-heading">
					 
					</div>
					<div class="panel-body">
						<form action="buku_tamu/create" id="formToggleLine" class="form-horizontal no-margin form-border" method="POST">
                        <div class="form-group">
								<label class="col-lg-2 control-label">Nama</label>
								<div class="col-lg-10">
									<input class="form-control" name="name" type="text" placeholder=""  >
									 
								</div><!-- /.col -->
                            </div>
                            <div class="form-group">
								<label class="col-lg-2 control-label">E-Mail</label>
								<div class="col-lg-10">
									<input class="form-control" name="email" type="text" placeholder="">
									 
								</div><!-- /.col -->
                            </div>
                            <div class="form-group">
								<label class="col-lg-2 control-label">Subject</label>
								<div class="col-lg-10">
									<input class="form-control" name="title" type="text" placeholder="">
									 
								</div><!-- /.col -->
                            </div>
                            <div class="form-group">
								<label class="col-lg-2 control-label">Pesan</label>
								<div class="col-lg-10">
									<textarea class="form-control" name="pesan" rows="3"></textarea>
								</div><!-- /.col -->
														</div>
														<div class="form-group">
								<label class="col-lg-2 control-label">Captcha</label>
								<div class="col-lg-10">
									1 + 1
									<input>
								</div><!-- /.col -->
                            </div>
                            <div class="form-group">
                            <label class="col-lg-2 control-label">&nbsp;</label>
								<div class="col-lg-10" style="padding:10px">
                                <input class="btn btn-info" type="submit" value="KIRIM">
								</div><!-- /.col -->
                           
</div>
						</form>
					</div>
				</div>
</div>
<style>
    .form-group{
      margin-bottom:10px !important;
      width:50%;
    }
    </style>