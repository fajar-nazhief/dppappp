
	{pyro:theme:partial name="metadata"}
	

	
  <body>
    {pyro:theme:partial name="header"}
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v3.3&appId=560004114339799&autoLogAppEvents=1"></script>
     <!-- slider -->
     <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators indicator-main">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li> 
        </ol>
        <div class="carousel-inner gede" role="listbox" style="background:#000">
        <?php 
         $this->db->where('folder_id','71');
         $this->db->where('pilihan_editor','1');
          $this->db->limit('4');
          $this->db->order_by('id','DESC');
          $count=0;
          $slider = $this->db->get('files')->result();
          
           
          
            foreach($slider as $val){
              ++$count;
              $aktif='';
           if($count=='1'){
             $aktif='active';
           }
           ?>
          <div class="carousel-item <?php echo $aktif?>" style="background-image: url('uploads/default/files/<?php echo $val->filename?>')">
          </div> 
          
            <?php } ?>
      </header>
      <img class="grad" src="./assets/images/gradient.png">
         
     <!-- end slider -->
     <div class="action-widget action-col-4 pull-top">
          
          <div class="container">
            
            <!-- action-item -->
  
            <div class="action-col">
              
              <a href="./news/category/pemerintahan" class="action-item register">
                <i class="fa fa-university"></i>
                <h6 class="action-title">Pemerintahan</h6> 
              </a>
              
            </div>
  
            <!-- action-item -->
  
            <div class="action-col">
              
              <a href="./news/category/pembangunan" class="action-item event">
                <i class="fa fa-bar-chart"></i>
                <h6 class="action-title">Perekonomian & Pembangunan</h6> 
              </a>
              
            </div>
  
            <!-- action-item -->
  
            <div class="action-col">
  
              <a href="./news/category/kesejahteraan" class="action-item get-involved">
                <i class="fa fa-briefcase"></i>
                <h6 class="action-title">Administrasi & Kesra</h6> 
              </a>
              
            </div>
  
            <!-- action-item -->
  
             
  
          </div>
  
        </div>
  
        <!-- item 0-->
        <div class="row" style="margin-top:20px">  
    
    <div class="wrapper">
      <div class="wrapper_inner">
        <!-- news -->
        <section class="news" style="padding-top:20px">
        <div class="col-md-4 col-sm-3">
         
        <span class="pull-left"><h5><i class="fa fa-info-circle fa-lg"></i>  Informasi</h5></span>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" style="height:400px">
            <?php $this->db->where('folder_id','69');
               $this->db->where('pilihan_editor','1');
          $this->db->limit('3');
          $resimng = $this->db->get('files')->result();
          $count=0;
          foreach($resimng as $val){
            ++$count;
            $activer='';
            if($count=='1'){
              $activer='active';
            }
          ?>
              <div class="carousel-item <?php echo $activer?>">
                <img class="d-block w-100" src="./uploads/default/files/<?php echo $val->filename?>" alt="First slide" style="height:400px">
              </div>
          <?php }?>
            </div>
          </div>
        
          
  </div>	
  <div class="col-md-4 col-sm-3"> 
  <span class="pull-left"><h5><i class="fa fa-calendar fa-lg"></i>  Agenda Kegiatan</h5></span>
  
                  <div id="calendar" style="padding-top: 50px"></div>
  </div>	
  <div class="col-md-4 col-sm-3">
  
   
      <div class="widget-events">
       <h5 class="event-title"><i class="fa fa-calendar"></i> List Kegiatan <span class="pull-right" style="font-size:12px"><a href="./agenda"><i class="fa fa-search"></i> Agenda lainnya</a></span></h5>
       
       
       <div id="agendaresults" style="margin-top:20px">
       No Result Data   
       </div>
         
                                        
  
                  </div>
                
  
  </div>
  </section>
  </div>
  </div>
  </div >
  
  
     <!-- BERITA -->
  <div class="row" style="margin:10px">
    <h1 class="section-header">Berita Jakarta Utara</h1>
      <div class="section-header-underline" style="margin-bottom: 32px;"></div>
    
    <div class="wrapper">
      <div class="wrapper_inner">
        <!-- news -->
         
        <section class="news">
          <!-- news  item -->
          
        <?php
         
       
        $this->db->where('category_id','1'); 
        $this->db->order_by('id','DESC');
        $this->db->limit('8');
        $resnews= $this->db->get('news')->result();
       
        if(!empty($resnews)){
          
        foreach($resnews as $dnews => $valnews){
          $img = trim_image($valnews->body);
         if($img ==base_url().'images/no-image-box.png'){
          $img='http://utara.jakarta.go.id/srv-5/images/berita/'.$valnews->foto;
         }
           
         
          
        ?>
        <div class="news_item news_i">
              <!-- news  item preview -->
              <span class="news_item_preview">
                <a href="<?php echo base_url().'news/' .date('Y/m', $valnews->created_on) .'/'. $valnews->slug?>" data-js="1">
                  <div class="card-header" style="background-image:url(<?php  echo $img;?>);height:200px;width:100%">
                  
                    </div>
                  
                  <span>
                  <h3 style="margin-top:10px;font-size:15px"><?php if(strlen($valnews->title) >'54'){echo substr($valnews->title,'0','55').'...';}else{echo $valnews->title;}?></h3>
                  <p>&nbsp;</p>
                  </span></a>
  
            </span>
          </div>
        <?php }}?>
   
  
  
          <!-- news  item -->
       
        </section>
      </div>
    </div>
  </div>
  
    
  
      <!-- visi misi -->
  <div class="row">
    <h1 class="section-header">Visi & Misi</h1>
      <div class="section-header-underline" style="margin-bottom: 32px;"></div>
    
    <div class="wrapper">
      <div class="wrapper_inner">
        <!-- news -->
        <section class="news">
         <h4 style="text-align:center">{pyro:widgets:instance id="128"}</h4>
  </section>
  </div>
  </div>
  </div>


  
  
  
  <div class="row" style="background:rgb(242, 241, 239);padding-bottom:80px">
    <h1 class="section-header" style="padding-top:20px">Potret Wilayah</h1>
      <div class="section-header-underline" style="margin-bottom: 10px;"></div>
    
    <div class="wrapper" >
      <div class="wrapper_inner">
        <!-- news -->
        <section class="news">
  
        <!-- slider -->
        <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
              <div class="MultiCarousel-inner">
              <?php 
          $this->db->set_dbprefix('tbl_');
          $this->db->order_by('gall_cat_id','DESC');
          $this->db->limit(12);
          $respw = $this->db->get('gall_cat')->result();
          foreach($respw as $val){?>
   
                    <div class="item">
                      <a href="./potret_wilayah/view/<?php echo $val->gall_cat_id?>">
                       <img src="http://utara.jakarta.go.id/srv-5/images/gallery/<?php echo $val->gall_cat_cover?>" style="padding:10px;height:150px">
                       <div class="textoverlay">
      <div class="text"><?php echo $val->gall_cat_title?></div>
    </div></a>
                  </div>
          <?php }
  
          $this->db->set_dbprefix('default_');
          ?>
             
                   
              </div>
              <button class="btn btn-primary leftLst"><</button>
              <button class="btn btn-primary rightLst">></button>
          </div>
        <!-- end slider -->
          
         
      
  
        
          
  </section>
  </div>
  </div>
  </div>
  
   <!-- visi misi -->
   <div class="row">
    <h1 class="section-header">Sosialmedia</h1>
      <div class="section-header-underline" style="margin-bottom: 32px;"></div>
    
    <div class="wrapper">
      <div class="wrapper_inner">
        <!-- news -->
        <section class="news">
         
        <div class="col-md-4 col-sm-3"> 
  
  <div class="panel panel-default">
    <div class="panel-heading"><span><h5><i class="fa fa-youtube fa-lg" style="color:red"></i>  Youtube</h5></span></div>
          <div class="panel-body">
            
  <?php 
          $this->db->set_dbprefix('tbl_');
          $this->db->order_by('id','DESC');
          $this->db->limit(4);
          $respw = $this->db->get('video')->result();
          $count=0;
          foreach($respw as $val){
            ++$count;
            if($count=='1'){
            ?>
          <iframe width="320" height="250" src="<?php echo $val->url?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          <table class="table table-hover table-striped">
            <?php }else{?>
              <tr>
                <td>
                <?php echo $val->title?>
            </td>
            </tr>
          <?php }}
  
          $this->db->set_dbprefix('default_');
          ?> 
          </table>
  </div>
          </div>
          </div>
          <div class="col-md-4 col-sm-3"> 
          <div class="panel panel-default">
    <div class="panel-heading"><span><h5><i class="fa fa-facebook-official fa-lg" style="color:rgb(41, 72, 125)"></i>  Facebook</h5></span></div>
          <div class="panel-body">
  <div class="fb-page" data-href="https://www.facebook.com/Halaman-Kominfotik-JU-428823414137023/" data-tabs="timeline" data-width="" data-height="445px" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Halaman-Kominfotik-JU-428823414137023/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Halaman-Kominfotik-JU-428823414137023/">Kominfotik JU</a></blockquote></div>
            </div>
            </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-3"> 
          <div class="panel panel-default">
    <div class="panel-heading"><span><h5><i class="fa fa-twitter-square fa-lg" style="color:#1da1f2"></i>  Twitter</h5></span></div>
          <div class="panel-body">
          <a class="twitter-timeline" data-height="455" href="https://twitter.com/kominfotikJU?ref_src=twsrc%5Etfw">Tweets by kominfotikJU</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> 
            </div>
            </div>
            </div>
          </div>
  </section>
  </div>
  </div>
  </div>
  
  <div class="modal fade" id="imgmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
      <div class="modal-dialog">
          <div class="modal-content">
              
              <div class="modal-body" >
                <a href="#" id="link">
                  <img id="image-gallery-image" class="img-responsive" src="" style="width:100%">
                </a>
              </div>
             
          </div>
      </div>
  </div>		
    {pyro:theme:partial name="footer"}
    
    <script>
 $('#modal-content').on('shown.bs.modal', function() {
       $("body.modal-open").removeAttr("style");
 });
 
      function openmodal(img){
      $('#imgmodal').modal('show');
      $('#image-gallery-image').attr("src",img);
    }

    function openmodallink(img,link){
      $('#imgmodal').modal('show');
      $("#link").attr("href", link);
      $('#image-gallery-image').attr("src",img);
    }
    
      $(document).ready(function () {
        $('#myCarousel1').carousel({
          interval: 15000
        }) 
  
    
         
  
        var itemsMainDiv = ('.MultiCarousel');
      var itemsDiv = ('.MultiCarousel-inner');
      var itemWidth = "";
  
      $('.leftLst, .rightLst').click(function () {
          var condition = $(this).hasClass("leftLst");
          if (condition)
              click(0, this);
          else
              click(1, this)
      });
  
      ResCarouselSize();
  
  
  
  
      $(window).resize(function () {
          ResCarouselSize();
      });
  
      //this function define the size of the items
      function ResCarouselSize() {
          var incno = 0;
          var dataItems = ("data-items");
          var itemClass = ('.item');
          var id = 0;
          var btnParentSb = '';
          var itemsSplit = '';
          var sampwidth = $(itemsMainDiv).width();
          var bodyWidth = $('body').width();
          $(itemsDiv).each(function () {
              id = id + 1;
              var itemNumbers = $(this).find(itemClass).length;
              btnParentSb = $(this).parent().attr(dataItems);
              itemsSplit = btnParentSb.split(',');
              $(this).parent().attr("id", "MultiCarousel" + id);
  
  
              if (bodyWidth >= 1200) {
                  incno = itemsSplit[3];
                  itemWidth = sampwidth / incno;
              }
              else if (bodyWidth >= 992) {
                  incno = itemsSplit[2];
                  itemWidth = sampwidth / incno;
              }
              else if (bodyWidth >= 768) {
                  incno = itemsSplit[1];
                  itemWidth = sampwidth / incno;
              }
              else {
                  incno = itemsSplit[0];
                  itemWidth = sampwidth / incno;
              }
              $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
              $(this).find(itemClass).each(function () {
                  $(this).outerWidth(itemWidth);
              });
  
              $(".leftLst").addClass("over");
              $(".rightLst").removeClass("over");
  
          });
      }
  
  
      //this function used to move the items
      function ResCarousel(e, el, s) {
          var leftBtn = ('.leftLst');
          var rightBtn = ('.rightLst');
          var translateXval = '';
          var divStyle = $(el + ' ' + itemsDiv).css('transform');
          var values = divStyle.match(/-?[\d\.]+/g);
          var xds = Math.abs(values[4]);
          if (e == 0) {
              translateXval = parseInt(xds) - parseInt(itemWidth * s);
              $(el + ' ' + rightBtn).removeClass("over");
  
              if (translateXval <= itemWidth / 2) {
                  translateXval = 0;
                  $(el + ' ' + leftBtn).addClass("over");
              }
          }
          else if (e == 1) {
              var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
              translateXval = parseInt(xds) + parseInt(itemWidth * s);
              $(el + ' ' + leftBtn).removeClass("over");
  
              if (translateXval >= itemsCondition - itemWidth / 2) {
                  translateXval = itemsCondition;
                  $(el + ' ' + rightBtn).addClass("over");
              }
          }
          $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
      }
  
      //It is used to get some elements from btn
      function click(ell, ee) {
          var Parent = "#" + $(ee).parent().attr("id");
          var slide = $(Parent).attr("data-slide");
          ResCarousel(ell, Parent, slide);
      }
        
      var javascript_array = []; 
  
      createAgenda = function(javascript_array) {
          $('#calendar').calendar({
              // view: 'month',
              width: 350,
              height: 320,
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
              html += '<div class="event-info-item"><i class="fa fa-map-marker"></i>'+index.tempat+'</div>';
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
      var owl = $('.myCarousel2');
  owl.owlCarousel({ 
      autoplay:true,
      autoplayTimeout:1000, 
  });
       
      });
      
       
  
       </script>
         <?php 
         $this->db->where('folder_id','70');
         $this->db->where('pilihan_editor','1');
          $this->db->limit('1');
          $this->db->order_by('id','DESC');
          $respop = $this->db->get('files')->row();
          $FF = $respop->filename;
          
            if($respop->filename){?>
  <script>
    openmodallink('./uploads/default/files/<?php echo $FF?>','<?php echo $respop->description?>');
    </script>
           <?php } 
          ?>
  </body>
  </html>