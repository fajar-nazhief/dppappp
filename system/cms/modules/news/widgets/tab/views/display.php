<?php   echo css('style_tab.css','news'); ?>
      <?php 
	        //Terkini
		$limits=Array ( '0' => 8,'1' => 0 ); 
		$news = $this->news_m->limit($limits)->get_many_by(array( 
				'status' => 'live',
				'order_by_id' => 'DESC'
			));
		 //terpopuler
		$limits=Array ( '0' => 8,'1' => 0 ); 
		$newsPop = $this->news_m->limit($limits)->get_many_by(array( 
				'status' => 'live',
				'order_by_klik' => 'DESC'
			));
		//terkomentari
		$limits=Array ( '0' => 8,'1' => 0 ); 
		$newsCom = $this->news_m->limit($limits)->get_many_by(array( 
				'status' => 'live',
				'order_by_comment' => 'DESC'
			));
		?>
      <script type="text/javascript" src="<?php  echo js_url('jquery.min.js','news')?>"></script>
      <script type="text/javascript" src="<?php  echo js_url('organictabs.jquery.js','news')?>"></script>
      <script type='text/javascript'>
        $(function() {
    
            $("#example-one").organicTabs();
            
            $("#example-two").organicTabs({
                "speed": 200
            });
    
        });
    </script> 
	     <div id="example-two" style="width:380px;padding-top:10px">
					
    		<ul class="nav">
                <li class="nav-one"><a href="#featured2" class="current" style="font-size:12px">Terkini</a></li>
                <li class="nav-two"><a href="#core2" style="font-size:12px">Terpopuler</a></li>
                <li class="nav-three"><a href="#jquerytuts2" style="font-size:12px">Terkomentari</a></li> 
            </ul>
    		
    		<div class="list-wrap" style="height:190px">
    		
    			<ul id="featured2"   >
				<?php   foreach($news as $data => $valTerkini){?>
    				<li style="border-bottom:1px solid #D5D5D5"><div style="float:right;font-size:10px;padding-top:8px"> <span style="font-size: 10px;" class="event_landing_info_time"><?php  echo date('H:i', $valTerkini->created_on)?></span></div>
					<div style="width:248px;"> <a href="<?php  echo base_url().'news/'.date('Y/m', $valTerkini->created_on) .'/'.$valTerkini->slug?>" style="border:none;font-size:11px"><?php  echo $valTerkini->title?></a></div></li>
    				<?php   }?>
    			</ul>
        		 
        		 <ul id="core2" class="hide">
                    <?php   foreach($newsPop as $dataPop => $valPop){?>
    				<li style="border-bottom:1px solid #D5D5D5"><div style="float:right;font-size:10px;padding-top:8px"> <span style="font-size: 10px;" class="event_landing_info_time"><?php  echo date('d/m/Y H:i', $valPop->created_on)?></span></div>
					<div style="width:248px;"> <a href="<?php  echo base_url().'news/'.date('Y/m', $valPop->created_on) .'/'.$valPop->slug?>" style="border:none;font-size:11px"><?php  echo $valPop->title?></a></div></li>
    				<?php   }?>
        		 </ul>
        		 
        		 <ul id="jquerytuts2" class="hide">
        		   <?php   foreach($newsCom as $dataCom => $valCom){?>
    				<li style="border-bottom:1px solid #D5D5D5"><div style="float:right;font-size:10px;padding-top:8px"> <span style="font-size: 10px;" class="event_landing_info_time"><?php  echo date('d/m/Y H:i', $valCom->created_on)?></span></div>
					<div style="width:248px;"> <a href="<?php  echo base_url().'news/'.date('Y/m', $valCom->created_on) .'/'.$valCom->slug?>" style="border:none;font-size:11px"><?php  echo $valCom->title?></a></div></li>
    				<?php   }?>
        		 </ul>
        		 
        		
    		 </div> <!-- END List Wrap -->
		 
		 </div> <!-- END Organic Tabs (Example Two) -->
	
	  