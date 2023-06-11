<style>
     button, input, optgroup, select, textarea{
          margin-right:10px;
          margin-top:10px;
     }
</style>
<div style="padding:30px">
<?php if ($this->session->flashdata('success')): ?>
<div class="closable notification success alert alert-success">
	<?php echo $this->session->flashdata('success'); ?>
</div>
<?php endif; ?>
<?php if ($this->session->flashdata('error')): ?>
<div class="closable notification error">
	<?php echo $this->session->flashdata('error'); ?>
</div>
<?php endif; ?>
<form id="FormSearch" role="form" method="post" action="<?php echo base_url()?>pemohon/send">
     <div class="row gutter-40 col-mb-80">
						<div class="postcontent col-lg-6">
 
                              <h4>Identitas Pemohon</h4>
                              <div class="form-group">
                            <label>Nama lengkap</label>
                            <input type="text" class="form-control" required="required" name="title" value="">
                                                    </div>
                                                    <?php $this->db->order_by('title','ASC');
                                                    $this->db->where('navigation_group_id','1');

$res = $this->db->get('pemohon_categories')->result(); 

foreach($res as $dat => $val){

$resdata[$val->id] = $val->title;

}

?>

<div class="form-group">

<label for="status">Kategori Permohonan </label>

<?php echo form_dropdown('category_id', $resdata , '',' class="form-control input-sm"') ?>

</div>
                        <div class="pilihan_kategori">
                            
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea rows="3" class="form-control" required="required" name="alamat"></textarea>
                                                    </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" required="required" name="email" value="">
                                                    </div>
                        <div class="form-group">
                            <label>No Telepon</label>
                            <input class="form-control" required="required" name="no_telepon" value="">
                                                    </div>
                        <div class="form-group">
                            <label>Pekerjaan</label>
                            <input class="form-control" required="required" name="pekerjaan" value="">
                                                    </div>
						</div>

						<!-- Sidebar
						============================================= -->
						<div class="postcontent col-lg-6">
                              <h4>Data Permohonan</h4>
                        <div class="form-group">
                            <label>Rincian Informasi</label>
                            <textarea rows="3" required="required" class="form-control" name="rincian_informasi"></textarea>
                                                    </div>
                        <div class="form-group">
                            <label>Tujuan Penggunaan Informasi</label>
                            <textarea rows="3" required="required" class="form-control" name="tujuan"></textarea>
                                                    </div>
                        <div class="form-group">
                            <label>Cara Memperoleh Informasi</label><br>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="melihat" name="cara_memperoleh">Melihat
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="membaca" name="cara_memperoleh">Membaca
                            </label>
                            <br>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="mendengarkan" name="cara_memperoleh">Mendengarkan
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="mencatat" name="cara_memperoleh">Mencatat
                            </label>
                                                    </div>
                        <div class="form-group">
                            <label>Mendapatkan Salinan Informasi</label><br>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="softcopy" name="mendapatkan_salinan">Softcopy
                            </label>
                            <label class="radio-inline">
                                <input type="radio" required="required" value="hardcopy" name="mendapatkan_salinan">Hardcopy
                            </label>
                                                    </div>
                        <div class="form-group">
                            <label>Cara Mendapatkan Salinan Informasi</label>
                            <div class="radio">
                                <label>
                                    <input type="radio" required="required" value="mengambil_langsung" name="cara_mendapatkan">Mengambil Langsung
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" required="required" value="faksimili" name="cara_mendapatkan">Faksimili
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" required="required" value="email" name="cara_mendapatkan">Email
                                </label>
                            </div>
                                                    </div>
                        <button class="btn btn-primary" type="submit">Simpan</button>
						</div><!-- .sidebar end -->
                         </div>
</form>
</div>
<script>
$('#judul').html('Permohonan Informasi Publik');
</script>