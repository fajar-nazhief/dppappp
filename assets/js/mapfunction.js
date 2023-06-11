var map='';
var control='';
var layernya=[];


function empty(str){
  return !str || !/[^\s]+/.test(str);
}

function getLocation() {
  if (navigator.geolocation) {
     
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    alert ( "Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
}

function initmap(){
  
  navigator.geolocation.getCurrentPosition(function(location) {
    mylat = location.coords.latitude;
    myLng = location.coords.longitude;
    if(!empty(mylat)){

      var lat =mylat;
      var lng =myLng;
    }else{

      var lat =-6.21462;
      var lng =  106.84513;
    }

    localStorage.setItem('lat',lat);
    localStorage.setItem('lng',lng); 

    var latlng = new L.LatLng(lat, lng);
  var zoom =  11;
   
   
    map = new L.Map('mapid');
   
   var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
   var osmAttrib='Map data &copy; OpenStreetMap contributors';
   var osm = new L.TileLayer(osmUrl, {minZoom: 5, maxZoom: 18, attribution: osmAttrib});
   
   map.addLayer(osm);
   map.setView(new L.LatLng(lat, lng), zoom);
   
  

   var pulsingIcon = L.icon.pulse({iconSize:[20,20],color:'red'});
  
   
  L.marker([mylat, myLng], {icon: pulsingIcon}).addTo(map);
    
   
  });

   
}

function buatlayer(url,namalayer){
	 
  var arrMarker = [];
  var point ='';
  if(localStorage.lat){
    point = localStorage.lat+','+localStorage.lng;
  }
  
  var dis = $('#radiusdata').val();
	$.ajax({
        url: url+'/?point='+point+'&radius=500', 
        cache: false,
        dataType: 'json',
        type: 'get', 
        data: '', 
        crossDomain: true,
        success: function( data, textStatus, jQxhr ){
            
             
                 if(!empty(data.result)){
                   var jml = data.result;
                   $('#'+namalayer+'badge').html(jml.length);
               //    var pulsingIcon = L.icon.pulse({iconSize:[8,8],color:'blue'});
               var LeafIcon = L.Icon.extend({
                options: { 
                  iconSize:     [25, 25]
                }
              });
            
              var iconsmarker = new LeafIcon({iconUrl: 'images/icon/'+data.marker});


					$.each(data.result,function(index,value){

						var markernya = L.marker([value.lat,value.lng], {icon: iconsmarker}).bindPopup(value.title+'<br>'+value.content);
						arrMarker.push(markernya); 
					}); 
				 layernya[namalayer] = L.layerGroup(arrMarker);
					map.addLayer(layernya[namalayer]);
				 }
                  
           
             
        },
        error: function( jqXhr, textStatus, errorThrown ){
            alert('Oops! koneksi internet anda terlalu lambat!');
            
        }
    });
	 
    
  }

  
 
   
  function kliklayer(namalayer,url){
	  
    if(map.hasLayer(layernya[namalayer])) {
      //  $(this).removeClass(layernya[namalayer]);
        map.removeLayer(layernya[namalayer]);
        $('#'+namalayer+'badge').html('0');
      } else { 

        buatlayer(url,namalayer);
       // map.addLayer(layernya[namalayer]);        
       // $(this).addClass(layernya[namalayer]);
       }
  }

  function ruting(lat,lng){ 
    $('.leaflet-routing-container').hide();
    var mylat = localStorage.lat;
    var myLng = localStorage.lng;  
    L.Routing.control({
      waypoints: [
          L.latLng(mylat, myLng),
          L.latLng(lat, lng)
      ],
      routeWhileDragging: false
  }).addTo(map);
  }
   
  
 function carimap(){
var arrMarker=[];

if(map.hasLayer(layernya['cari'])) {
  //  $(this).removeClass(layernya[namalayer]);
    map.removeLayer(layernya['cari']);
    $('#caribadge').html('0');
  }

  var postForm = { //Fetch form data
    'cari'     : $('#search').val() //Store name fields value
};

  $.ajax({
    url: 'akomodasi/cari', 
    cache: false,
    dataType: 'json',
    type: 'post', 
    data: postForm, 
    crossDomain: true,
    success: function( data, textStatus, jQxhr ){
        
             if(!empty(data.result)){
               var jml = data.result;
               $('#caribadge').html(jml.length);
               var pulsingIcon = L.icon.pulse({iconSize:[8,8],color:'blue'});
      $.each(data.result,function(index,value){
        //kedutaan
        var LAT='';
        var LNG='';
        var TITLE=''; 
        var CONTENT='';
        if(value.label=='default_app_kedutaan_besar'){ 
            TITLE = 'Embassy Of '+value.value.NAMA_NEGARA;
            CONTENT = '<br>'+value.value.ALAMAT+'<br> Phone : '+value.value.NO_TLP;
            LAT = value.value.lat;
            LNG = value.value.lng;
        }else if(value.label=='default_app_kesehatan_puskesmas'){
          TITLE = ''+value.value.NAMA_PUSKESMAS;
          CONTENT = '<br>'+value.value.ALAMAT+'<br>Phone : '+value.value.NO_TELP;
          LAT = value.value.LAT;
          LNG = value.value.LNG;
        }else if(value.label=='default_app_parbud_museum'){
          TITLE = '<b>'+value.value.NAMA+'</b>';
          CONTENT = '<br>'+value.value.ALAMAT+'<br><b>Description :</b> <br>'+value.value.DESCRIPTION;
          LAT = value.value.LAT;
          LNG = value.value.LNG;
        }else if(value.label=='default_app_kumkmp_pasar'){
          TITLE = '<b>'+value.value.nama+'</b>';
          CONTENT = '<br>'+value.value.alamat+'<br>';
          LAT = value.value.lat;
          LNG = value.value.lng;
        }else if(value.label=='default_app_olahraga_gor'){
          TITLE = '<b>'+value.value.NAMA_GEDUNG+'</b>';
          CONTENT = '<br>'+value.value.ALAMAT+'<br> Telp : '+value.value.NOMOR_TELEPON+' <br> FACILITIES : <br>'+value.value.FASILITAS;
          LAT = value.value.LAT;
          LNG = value.value.LNG;
        }else if(value.label=='default_app_tic'){
          TITLE = '<b>'+value.value.NAMA+'</b>';
          CONTENT = '<br>'+value.value.ALAMAT+'<br>';
          CONTENT += 'Officer : '+value.value.petugas;
          LAT = value.value.LAT;
          LNG = value.value.LNG;
        }       

        
        
        var markernya = L.marker([LAT,LNG], {icon: pulsingIcon}).bindPopup(TITLE+'<br>'+CONTENT);
        arrMarker.push(markernya); 
      }); 
     layernya['cari'] = L.layerGroup(arrMarker);
      map.addLayer(layernya['cari']);
     }
              
       
         
    },
    error: function( jqXhr, textStatus, errorThrown ){
        alert('Oops! koneksi internet anda terlalu lambat!');
        
    }
});
 }