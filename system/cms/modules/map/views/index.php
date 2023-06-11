
<?php   if(!empty($id)){?> 
    <script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyCxvq9ysOGiSCxhfTuZlWgmy2mevcvJxys"
            type="text/javascript"></script>
 <script src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"
      type="text/javascript"></script>
<style type="text/css">
   
      #map_canvas {
        height: 400px;
        width: 500px;
        margin-top: 0.6em;
      }
    </style>

    <script type="text/javascript">
    //<![CDATA[

    var iconBlue = new GIcon(); 
    iconBlue.image = 'http://labs.google.com/ridefinder/images/mm_20_blue.png';
    iconBlue.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconBlue.iconSize = new GSize(12, 20);
    iconBlue.shadowSize = new GSize(22, 20);
    iconBlue.iconAnchor = new GPoint(6, 20);
    iconBlue.infoWindowAnchor = new GPoint(5, 1);

    var iconRed = new GIcon(); 
    iconRed.image = 'http://labs.google.com/ridefinder/images/mm_20_red.png';
    iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
    iconRed.iconSize = new GSize(12, 20);
    iconRed.shadowSize = new GSize(22, 20);
    iconRed.iconAnchor = new GPoint(6, 20);
    iconRed.infoWindowAnchor = new GPoint(5, 1);

    var customIcons = [];
    customIcons["restaurant"] = iconBlue;
    customIcons["bar"] = iconRed;

    function load() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("map"));
        map.addControl(new GSmallMapControl());
        map.addControl(new GMapTypeControl());
        map.setCenter(new GLatLng(<?php  echo $map->lat?>,<?php  echo $map->lng?>), 16);
 map.setMapType(G_HYBRID_MAP);

        GDownloadUrl("<?php  echo base_url()?>map/xmlDataArray/<?php  echo @$id?>/<?php  echo $this->uri->segment(4); ?>", function(data) {
          var xml = GXml.parse(data);
          var markers = xml.documentElement.getElementsByTagName("marker");
          for (var i = 0; i < markers.length; i++) {
            var name = markers[i].getAttribute("name");
            var address = markers[i].getAttribute("address");
            var type = markers[i].getAttribute("type");
	     var intro = markers[i].getAttribute("intro");
            var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));
            var marker = createMarker(point, name, address, intro, type);
            map.addOverlay(marker);
          }
        });
      }
    }

    function createMarker(point, name, address, intro, type) {
      var marker = new GMarker(point, customIcons[type]);
      var html = "<b>" + name + "</b> <br/>" + "<center><img src=" + address + " width=200px></center>" ;
      GEvent.addListener(marker, 'click', function() {
        marker.openInfoWindowHtml(html);
      });
      return marker;
    }
    
    //]]>
  </script>
 

  </head>

  <body onload="load()" onunload="GUnload()">
  <!--   <div>
      <input id="searchTextField" type="text" size="50">
      <input type="radio" name="type" id="changetype-all" checked="checked">
      <label for="changetype-all">All</label>

      <input type="radio" name="type" id="changetype-establishment">
      <label for="changetype-establishment">Establishments</label>

      <input type="radio" name="type" id="changetype-geocode">
      <label for="changetype-geocode">Geocodes</lable>
    </div>
    <div id="map_canvas"></div>
    -->
 
 
    <div style="padding-top:0px;padding-bottom:10px;">
     <div id="map" style="width: 620px; height: 400px;"></div>
     <div style="padding-top:3px">
     <?php   if(!empty($qfile)){?>
    <?php   foreach($qfile as $data){?>
    <a href="<?php  echo base_url()?>uploads/default/files/<?php  echo $data->filename?>" target="_blank"><img src="<?php  echo base_url()?>files/thumb/<?php  echo $data->id?>" width="100" height="75"></a>
    <?php   }?>
    <?php   }?>
     </div>
    <div style="padding-top:10px;padding-bottom:10px;">
	    <table style="width:100%;border-bottom:1px solid #dedede;padding-bottom:3px">
				<tr>
					<td width="10px">
					  <img src="<?php  echo base_url()?>uploads/peta.jpg" width="32px" border="none" title="Peta Lokasi">
					</td>
                                        <td style="text-align:left">
                                            <h2>Peta Lokasi &raquo; <a href="<?php  echo base_url()?>news/category/<?php   echo $category->slug?>"><?php   echo $category->title?></a> &raquo; <?php  echo $map->title?></h2>
                                        </td>
                                </tr>
    </table>
	<h2><a href="<?php  echo base_url()?>news/category/<?php   echo $category->slug?>"><?php   echo $category->title?> Lainnya</a></h2>
    </div>
    <table border="0" class="tbl1" width="620px">    
		<thead>
			<tr>
				<th style="width:100px;border-top:1px solid #dedede;border-bottom:1px solid #dedede;">Lihat Peta</th>
				<th style="width:200px;border-top:1px solid #dedede;border-bottom:1px solid #dedede;">Nama Tempat</th>
				<th style="width:620px;border-top:1px solid #dedede;border-bottom:1px solid #dedede;">Informasi</th> 
          </tr>
		</thead>
		<tfoot>
    <?php   foreach($news as $dataNews => $valNews){?>
    <tr>
	<td style="border-bottom:1px solid #dedede;text-align:center">
	    <?php   if($valNews->lat){?>
	    <a href="<?php  echo base_url()?>map/index/<?php  echo $valNews->id?>">
	    <img src="<?php  echo base_url()?>uploads/peta.jpg" border="none" width="36px">
	    </a>
	    <?php   }else{?>
	     <img src="<?php  echo base_url()?>uploads/nopeta.jpg" border="none" width="36px">
	    <?php   }?>
    
	</td>
	<td style="border-bottom:1px solid #dedede;text-align:center">
	    
    <?php  echo  anchor('news/' .date('Y/m', $valNews->created_on) .'/'. $valNews->slug, $valNews->title); ?>
	</td>
	<td style="border-bottom:1px solid #dedede;">
    <?php  echo $valNews->intro?>
	</td>
    </tr>
    <?php   }?>
		</tfoot>
    </table>
    </div>
    
    <div style="padding-bottom:30px;text-align:center">
	<?php  echo $pagination['links']; ?>
    </div>
     
  </body> 
<?php   }?>