<div class="container" style="transform: none;">
        <div class="row" style="transform: none;">
        <table class="table table-striped ">
					<thead>
					<tr>
						<th>
							  No. 
						</th>
						<th>
							 Nama File
						</th>
					 
					</tr>
					</thead>
					<tbody>
    <?php
    if($res){
        $no=0;
        foreach($res as $dat=>$val){?>
<tr>
						<td>
                        	  <?php echo ++$no;?>. 
							
						</td>
						<td>
                           <a href="<?php base_url()?>uploads/default/files/<?php echo $val->filename?> " style="color:#000" target="_BLANK"> 
                       <?php echo str_replace('_',' ',$val->name)?> 
                            </a>
        
							 
						</td>
						 
					</tr>

        <?php }
    }
    ?>
        </tbody>
</table>
</div>
</div>

<script>
    $('#judul').html('PRODUK HUKUM');
    </script>