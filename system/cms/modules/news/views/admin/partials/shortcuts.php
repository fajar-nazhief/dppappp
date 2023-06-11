<div class="visible-lg visible-md">
		 <?php  echo anchor('admin/news/create', '<i class="ion-plus-circled"></i> Buat Artikel Baru', ' class="btn btn-md btn-mint"') ?> 
		 <?php  echo anchor('admin/news/resetsearch', 'List semua artikel',' class="btn btn-md btn-mint"'); ?> 
		 <?php  echo anchor('admin/news/categories/create', '<i class="ion-plus-circled"></i> Buat Kategori Baru', ' class="btn btn-md btn-mint"'); ?> 
		 <?php  echo anchor('admin/news/categories', 'List semua kategori',' class="btn btn-md btn-mint"')?> 
	 </div>

<div class="visible-sm visible-xs">
    <div class="btn-group" style="float:left">
							<button class="btn btn-danger btn-sm" data-toggle="dropdown">Menu Artikel</button>
							<button data-toggle="dropdown" class="btn btn-danger dropdown-toggle btn-sm "><span class="caret"></span></button>
							<ul class="dropdown-menu">
                                <li><?php  echo anchor('admin/news/create', 'Buat Artikel Baru') ?></li> 
                                 <li><?php  echo anchor('admin/news/resetsearch', 'List semua artikel'); ?></li>
                                 <li><?php  echo anchor('admin/news/categories/create', 'Buat Kategori Baru'); ?> </li>
                                 <li><?php  echo anchor('admin/news/categories', 'List semua kategori')?></li> 
						     </ul>
						</div>
</div>