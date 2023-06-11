 



<div class="row">
				<aside class="col-lg-4 add_bottom_30">
        <div class="box_style_1">
        <div id="calendar" style="margin:0 auto"></div>
</div>
</aside>
 
 
<div class="col-lg-8 col-sm-3">

<div class="box_style_1">
     
<div id="agendaresults" style="margin-top:20px">
     <?php
     
     if($data){
         $htmlx='';

     foreach($data as $val){
      $htmlx .= '<h4><img src='.base_url().'fav.png height=25px> Agenda Kegiatan</h4>';
      $htmlx .='<div> <b>Tanggal:</b> '.$val['tgl'].'</div>';
      $htmlx .='<div> <b>Jam:</b> '.$val['jam'].'</div>';
      $htmlx .='<div> <b>Tempat:</b> '.$val['tempat'].'</div>';
      $htmlx .='<div> <b>Dihadiri:</b> '.$val['dihadiri'].'</div>';
      $htmlx .='<div> <b>Pendamping:</b> '.$val['pendamping'].'</div>';
      $htmlx .='<div> <b>Acara:</b> '.$val['acara'].'</div>'; 
       ?>
     <a href="javascript:void(0)" onClick="modalpop('<?php echo $htmlx?>')">
 <div class="event-item">
                     <div class="event-date" style="width: auto;height: auto;">
                    <div class="event-day"><?php echo $val['tanggal']; ?></div>
                    <div class="event-month"><?php echo $val['bulan']; ?></div>
                    <div class="event-year"><?php echo $val['tahun']; ?></div>
                    </div>
                    <div class="event-info">
                    <h6 class="event-link"><?php echo $val['acara']; ?></h6>
                    <div class="event-info-item">Lokasi: <?php echo $val['tempat']; ?></div>
                    </div>
                   
                    </div>
     </a>

     <?php $htmlx='';}}else{?>
     No Result Data   
     <?php }?>
     </div>
       
                                      

                </div>
                </div>
              

</div>  
</div >

<script>


    	var javascript_array = []; 

createAgenda = function(javascript_array) {
$('#calendar').calendar({
    // view: 'month',
   // width: 350,
   // height: 320,
    // startWeek: 0,
    // selectedRang: [new Date(), null],
    data: javascript_array,
    onSelected: function (view, date, data) {
        var dd = date.getDate();
        var mm = date.getMonth() + 1; //January is 0!
        var yyu = date.getFullYear();
        getAgenda(dd + '-' + mm + '-' + yyu);
    },
    viewChange: function (view, yearx, monthx) {

        getAgendaM(monthx,yearx);
    }
});
}


getAgenda = function(date) {
$('#agendaresults').html('No Result Data');
// $('.agendaresults-tanggal').html(date);
$.ajax({
   url: './agenda/agendalist',
   type: 'post',
   data: {
             date: date
         },
    beforeSend:function(){
        $('.agendaresults-loading').append('<i class="agendaresults-loading-i fa fa-spinner fa-spin"></i>');
    },
    success: function (data) {
        $('.agendaresults-loading-i').remove();
        if(data.hasil=='true'){
          var html='';
          var htmlx='';
          $.each(data.data,function(val,index){
            htmlx +='<div> <b>Tanggal:</b> '+index.tgl+'</div>';
            htmlx +='<div> <b>Jam:</b> '+index.jam+'</div>';
            htmlx +='<div> <b>Tempat:</b> '+index.tempat+'</div>';
            htmlx +='<div> <b>Dihadiri:</b> '+index.dihadiri+'</div>';
            htmlx +='<div> <b>Pendamping:</b> '+index.pendamping+'</div>';
            htmlx +='<div> <b>Acara:</b> '+index.acara+'</div>';

            html += '<div class="event-item">';
            html += '<a href="javascript:void(0);" onClick="modalpop(\''+htmlx+'\')">';
            html += '<div class="event-date" style="width: auto;height: auto;">';
            html += '<div class="event-day">'+index.tanggal+'</div>';
            html += '<div class="event-month">'+index.bulan+'</div>';
            html += '<div class="event-year">'+index.tahun+'</div>';
            html += '</div>';
            html += '<div class="event-info">';
            html += '<h6 class="event-link">'+index.acara+'</h6>';
            html += '<div class="event-info-item">Lokasi : '+index.tempat+'</div>';
            html += '</div>';
            html += '</a>';
            html += '</div>';
            htmlx = '';
          })
        }
        $('#agendaresults').html(html);
   },
   error: function(xhr, Status, err) {
    $('.agendaresults-loading-i').remove();
     $('#agendaresults').html('Error : ' + Status);
   }
});
}


getAgendaM = function(monthx,yearx) {

$.ajax({
   url: './agenda/agendalistm',
   type: 'post',
   dataType: 'json',
   data: {
             monthx: monthx,
             yearx: yearx
         },
    beforeSend:function(){
        
    },
    success: function (data) {
        //createAgenda(data);
        
        $('#calendar').calendar('setData', data);
        //$('#agendaresults').html(monthx + '-' + yearx +  JSON.stringify(data));
   },
   error: function(xhr, Status, err) {
     
     $('#agendaresults').html('Error : ' + Status);
   }
});
}


createAgenda(javascript_array);
getAgendaM();
    </script>