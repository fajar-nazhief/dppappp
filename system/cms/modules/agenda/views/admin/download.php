<?php 
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0"); 
 

?>

<table>
    <tr> 
        <td>Acara</td> 
        <td>Tgl</td> 
         
    </tr>
      <?php foreach($res as $i){ ?>
    <tr> 
        <td><?php echo $i->acara;?></td> 
         <td><?php echo $i->tgl_agenda;?></td> 
          
    </tr>
    
    
<?php }?>
   
</table>