<!-- item 0-->
<div class="row">
				<aside class="col-lg-4 add_bottom_30">
        <div class="box_style_1">
        <div id="calendar" style="margin:0 auto"></div>
</div>
</aside>
<div class="col-lg-8">
					 
            <div class="row magnific-gallery" id="klipingresults" style="margin-top:20px">
     <?php
     
     if($data){
         $htmlx='';

     foreach($data as $val){
      // $htmlx ='<div> <img src=\"http://utara.jakarta.go.id/srv-5/kliping_source/'.$val['source'].'\"></div>'; 
       ?>
      <div class="col-sm-4"> 
        <!-- news  item preview -->
        <span class="news_item_preview">
          <a href="http://utara.jakarta.go.id/srv-5/kliping_source/<?php echo $val['source']?>" data-js="1" >
            <img src="http://utara.jakarta.go.id/srv-5/kliping_source/<?php echo $val['source']?>"   style="width:100%"><span>
            <h3 style="font-size:11px;margin-top:10px">
            <?php echo $val['title']?>  </h3>
            <p></p>

            </span>
          </a>

        </span>
      </div>

     <?php $htmlx='';}}?>
   
       
                                      
 
</div>
</div>
          
        
        
         


<script>
 function openmodal(img){
		$('#imgmodal').modal('show');
		$('#image-gallery-image').attr("src",img);
  }

    	var javascript_array = []; 

createkliping = function(javascript_array) {
$('#calendar').calendar({
    // view: 'month',
    //width: 350,
    //height: 320,
    // startWeek: 0,
    // selectedRang: [new Date(), null],
    data: javascript_array,
    onSelected: function (view, date, data) {
        var dd = date.getDate();
        var mm = date.getMonth() + 1; //January is 0!
        var yyu = date.getFullYear();
        getkliping(dd + '-' + mm + '-' + yyu);
    },
    viewChange: function (view, yearx, monthx) {

        getklipingM(monthx,yearx);
    }
});
}


getkliping = function(date) {
$('#klipingresults').html('No Result Data');
// $('.klipingresults-tanggal').html(date);
$.ajax({
   url: './kliping/klipinglist',
   type: 'post',
   data: {
             date: date
         },
    beforeSend:function(){
        $('.klipingresults-loading').append('<i class="klipingresults-loading-i fa fa-spinner fa-spin"></i>');
    },
    success: function (data) {
        $('.klipingresults-loading-i').remove();
        if(data.hasil=='true'){
          var html='';
          var htmlx='';
          $.each(data.data,function(val,index){
            if(index.source =='array'){
              
              $.each(JSON.parse(index.source_array),function(val,indexs){
                
                html +='<div class="col-sm-4"> ';
            html +='<span class="news_item_preview">';
            html +='<a href="http://utara.jakarta.go.id/srv-5/kliping_source/'+indexs.name+'" data-js="1">';
            html +='<img src="http://utara.jakarta.go.id/srv-5/kliping_source/'+indexs.name+'" alt="" style="width:100%"><span>';
            html +='<h3 style="font-size:11px;margin-top:10px">';
            html +=index.title+'  </h3>';
            html +='<p></p>';

            html +='</span>';
            html +='</a>';

            html +='</span>';
            html +='</div>';

              });
            }else{
            html +='<div class="col-sm-4"> ';
            html +='<span class="news_item_preview">';
            html +='<a href="http://utara.jakarta.go.id/srv-5/kliping_source/'+index.source+'" data-js="1">';
            html +='<img src="http://utara.jakarta.go.id/srv-5/kliping_source/'+index.source+'" alt="" style="width:100%"><span>';
            html +='<h3 style="font-size:11px;margin-top:10px">';
            html +=index.title+'  </h3>';
            html +='<p></p>';

            html +='</span>';
            html +='</a>';

            html +='</span>';
            html +='</div>';
            }
           
          })
        }
        $('#klipingresults').html(html);
   },
   error: function(xhr, Status, err) {
    $('.klipingresults-loading-i').remove();
     $('#klipingresults').html('Error : ' + Status);
   }
});
}


getklipingM = function(monthx,yearx) {

$.ajax({
   url: './kliping/klipinglistm',
   type: 'post',
   dataType: 'json',
   data: {
             monthx: monthx,
             yearx: yearx
         },
    beforeSend:function(){
        
    },
    success: function (data) {
        //createkliping(data);
        
        $('#calendar').calendar('setData', data);
        //$('#klipingresults').html(monthx + '-' + yearx +  JSON.stringify(data));
   },
   error: function(xhr, Status, err) {
     
     $('#klipingresults').html('Error : ' + Status);
   }
});
}


createkliping(javascript_array);
getklipingM();
    </script>