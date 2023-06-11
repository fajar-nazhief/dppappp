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
        <td>Deskripsi</td>
        <td>Tgl Mulai</td>
        <td>Tgl Berakhir</td>
        <td>Alamat</td>
        <td>Phone</td>
        <td>E-mail</td>
        <td>Website</td>
        <td>Author</td>
    </tr>
      <?php foreach($blog as $i){ ?>
    <tr>
    <td><?php echo $i->category_title;?></td>
        <td><?php echo $i->title;?></td>
         <td><?php echo $body = trim(strip_tags(text_only($i->body), '<p><a><br />'));?></td>
         <td><?php echo $i->date_from;?></td>
         <td><?php echo $i->date_end;?></td>
          <td><?php echo $i->alamat;?></td>
           <td><?php echo $i->phone;?></td>
            <td><?php echo $i->email;?></td>
             <td><?php echo $i->website;?></td>
             <td><?php echo $i->first_name;?></td>
    </tr>
    
    
<?php }?>
   
</table>