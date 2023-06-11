 
  <div>
<?php    
    if($options['txtStyle'] == 'vertical'){
        $this->load->model('polling/poll_m');
        $pollidg=$options['txtCat'];
          $query=$this->db->query('select count(*) as vote,qid,title,b.link_file from default_log_polling as a,default_banner as b where a.qid = b.id and a.idpolling='.$pollidg.' and b.simpan=0 group by a.qid order by b.urutan ASC');
		
		if ($query->num_rows() > 0) {
			$datas= $query->result();
			foreach($datas as $dat => $val){
			 
			     $hasil[$val->vote]=$val->link_file;
			}
		    } else {
			return FALSE;
		    }
		     
ksort($hasil); 
$num=0;
foreach ($hasil as $key => $val) {
       ++$num;
    //echo "$key = $val\n";
    $peringkat[$num]= $val;
}
 $peringkat[$options['txtLimit']];
		    
        ?>
     

<?php   }?>
<img src="<?php  echo base_url()?>uploads/banner/<?php  echo $peringkat[$options['txtLimit']]?>" width="80px" height="80px">
 </div>