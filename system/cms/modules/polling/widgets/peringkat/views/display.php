 
<div class="widget">
					<h3 class="title">Calon Pemenang </h3>
					<div class="padder" style="padding-left:25px"> 
<?php    
    if($options['txtStyle'] == 'vertical'){
        $this->load->model('polling/poll_m');
        $pollidg=$options['txtCat'];
          $query=$this->db->query('select count(*) as vote,qid,title,b.link_file from default_log_polling as a,default_banner as b where a.qid = b.id and a.idpolling='.$pollidg.' and b.simpan=0 group by a.qid order by vote DESC');
		
		if ($query->num_rows() > 0) {
			$datas= $query->result();
			$i=0;
			foreach($datas as $dat => $val){
			 ++$i;
			     $hasil[$i]=$val->link_file;
			     $hasilpol[$i]=$val->vote;
			}
		    } else {
			return FALSE;
		    }
  
		    
        ?>
     

<?php   }?>
<table style="border:0px">
    <tr>
	<td style="border:0px">
	    <a href="<?php  echo base_url()?>polling/poll_result" class="g2" accesskey="p"><img src="<?php  echo base_url()?>uploads/Banner/<?php  echo $hasil[1]?>" width="80px" height="80px"></a>
	    </td>
	<td style="border:0px;font-size:30px;vertical-align:middle">
	    <?php 

		$this->load->model('polling/poll_m');
		$this->load->model('polling/banner_categories_m');
                $dataK = $this->banner_categories_m->getPollCat(); 
		$pollidg=$dataK->id;
		$sumpoll= $this->poll_m->sumpoll($pollidg);
		$rt=$sumpoll->vote;
		$width2=($hasilpol[1] *1)/50 ; /// change here the multiplicaiton factor //////////
			 $cta=($hasilpol[1]/$rt)*100;
			echo $ct=sprintf ("%01.2f", $cta).' %'; // number formating
			 //echo $per=$ct*100;
?>
	    </td>
	</tr>
    </table>
</div>
</div>