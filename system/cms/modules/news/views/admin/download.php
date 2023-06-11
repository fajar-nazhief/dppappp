<?php 
 header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0"); 
 

?>

<table>
    <tr>
    <td>Kategori</td>
        <td>Judul</td> 
        <td>Tgl</td> 
         
    </tr>
      <?php foreach($res as $i){ ?>
    <tr>
    <td><?php echo $i->category_title;?></td>
        <td><?php echo $i->title;?></td> 
         <td><?php echo date('d-m-Y H:i:s',$i->created_on);?></td> 
          
    </tr>
    
    
<?php }?>
   
</table>