
<div class="container margin_60"> 
	<div style="margin:30px">
	<?php  if (validation_errors()){?>
<div class="alert alert-danger">
	<?php  echo validation_errors(); ?>
</div>
<?php  }elseif(($messages['error'])){ ?>
<div class="alert alert-danger">
	<?php  echo $messages['error']; ?>
</div>
<?php  }elseif(($messages['success'])){ ?> 
	<div class="alert alert-success" role="alert">
  Terimakasih sudah menghubungi kami,pesan anda akan segera kami balas!
</div>
	<?php }  ?>
</div>
    <div class="row">
      <div class="col-md-8">
        <div class="form_title">
          <h3><strong><i class="icon-pencil"></i></strong>Isi Form Dibawah Ini</h3>
          <p>
           Kami akan segera menghubungi anda kembali.
          </p>
        </div>
        <div class="step">

          <div id="message-contact"></div>
          <form method="post" action="<?php echo base_url()?>contact" id="contactform" onSubmit="return cek();">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>First Name</label>
                  <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Enter Name">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" class="form-control" id="lastname_contact" name="lastname_contact" placeholder="Enter Last Name">
                </div>
              </div>
            </div>
            <!-- End row -->
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" id="contact_email" name="contact_email" class="form-control" placeholder="Enter Email">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Phone</label>
                  <input type="text" name="subject" value="support" style="display:none">
                  <input type="text" id="company_name" name="company_name" class="form-control" placeholder="Enter Phone number">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Message</label>
                  <textarea rows="5" id="message" name="message" class="form-control" placeholder="Write your message" style="height:200px;"></textarea>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <label>Human verification</label>
                <input type="text" id="verify_contact" class=" form-control add_bottom_30" placeholder="Berapakah? 3 + 1 =">
                <input type="submit" value="Submit" class="btn_1" id="submit-contact">
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- End col-md-8 -->

      <div class="col-md-4">
        <div class="box_style_1">
          <span class="tape"></span>
          <h4>Alamat <span><i class="icon-pin pull-right"></i></span></h4>
          <p>
		  Jl. Jenderal A. Yani Kav 64<br>
			Cempaka Putih, Jakarta Pusat<br>
			DKI Jakarta, 10510<br>
			
          </p>
          <hr>
          <h4>Help center <span><i class="icon-help pull-right"></i></span></h4>
          <p>
            Jika ada pertanyaan lebih lanjut silahkan menghubungi Help Center kami. Terimakasih!
          </p>
          <ul id="contact-info">
            <li>+ 62 424 64 70</li>
            <li><a href="#">dppapp@jakarta.go.id</a>
            </li>
          </ul>
        </div>
        <div class="box_style_4">
          <i class="icon_set_1_icon-57"></i>
          <h4>Butuh <span>Bantuan?</span></h4>
          <a href="tel://0214246470" class="phone">+62 424 64 70</a>
          <small>Senin - Jumat 8.00 wib - 16.30 wib</small>
        </div>
      </div>
      <!-- End col-md-4 -->
    </div>
    <!-- End row -->
  </div>