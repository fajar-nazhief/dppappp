<?php   if($options['styles']=='0'){?>
		
<script>

$(document).ready(function() {

	//Speed of the slideshow
	var speed = 5000;
	
	//You have to specify width and height in #slider CSS properties
	//After that, the following script will set the width and height accordingly
	$('#mask-gallery, #gallery li').width($('#slider').width());	
	$('#gallery').width($('#slider').width() * $('#gallery li').length);
	$('#mask-gallery, #gallery li, #mask-excerpt, #excerpt li').height($('#slider').height());
	
	//Assign a timer, so it will run periodically
	var run = setInterval('collectionscoller(0)', speed);	
	
	$('#gallery li:first, #excerpt li:first').addClass('selected');

	//Pause the slidershow with clearInterval
	$('#btn-pause').click(function () {
		clearInterval(run);
		return false;
	});

	//Continue the slideshow with setInterval
	$('#btn-play').click(function () {
		run = setInterval('collectionscoller(0)', speed);	
		return false;
	});
	
	//Next Slide by calling the function
	$('#btn-next').click(function () {
		collectionscoller(0);	
		return false;
	});	

	//Previous slide by passing prev=1
	$('#btn-prev').click(function () {
		collectionscoller(1);	
		return false;
	});	
	
	//Mouse over, pause it, on mouse out, resume the slider show
	$('#slider').hover(
	
		function() {
			clearInterval(run);
		}, 
		function() {
			run = setInterval('collectionscoller(0)', speed);	
		}
	); 	
	
});


function collectionscoller(prev) {

	//Get the current selected item (with selected class), if none was found, get the first item
	var current_image = $('#gallery li.selected').length ? $('#gallery li.selected') : $('#gallery li:first');
	var current_excerpt = $('#excerpt li.selected').length ? $('#excerpt li.selected') : $('#excerpt li:first');

	//if prev is set to 1 (previous item)
	if (prev) {
		
		//Get previous sibling
		var next_image = (current_image.prev().length) ? current_image.prev() : $('#gallery li:last');
		var next_excerpt = (current_excerpt.prev().length) ? current_excerpt.prev() : $('#excerpt li:last');
	
	//if prev is set to 0 (next item)
	} else {
		
		//Get next sibling
		var next_image = (current_image.next().length) ? current_image.next() : $('#gallery li:first');
		var next_excerpt = (current_excerpt.next().length) ? current_excerpt.next() : $('#excerpt li:first');
	}

	//clear the selected class
	$('#excerpt li, #gallery li').removeClass('selected');
	
	//reassign the selected class to current items
	next_image.addClass('selected');
	next_excerpt.addClass('selected');

	//Scroll the items
	$('#mask-gallery').scrollTo(next_image, 800);		
	$('#mask-excerpt').scrollTo(next_excerpt, 800);					
	
}



</script>

<style>

#slider {

	/* You MUST specify the width and height */
	width:<?php  echo !empty($options['width'])?$options['width']:'300'?>px;
	height:<?php  echo !empty($options['height'])?$options['height']:'168'?>px;
	position:relative;	
	overflow:hidden;
}

#mask-gallery {
	
	overflow:hidden;	
}

#gallery {
	
	/* Clear the list style */
	list-style:none;
	margin:0;
	padding:0;
	
	z-index:0;
	
	/* width = total items multiply with #mask gallery width */
	width:900px;
	overflow:hidden;
}

	#gallery li {

		
		/* float left, so that the items are arrangged horizontally */
		float:left;
	}


#mask-excerpt {
	
	/* Set the position */
	position:absolute;	
	top:0;
	left:0;
	z-index:500;
	
	/* width should be lesser than #slider width */
	width:200px;
	overflow:hidden;	
	

}
	
#excerpt {
	/* Opacity setting for different browsers */
	filter:alpha(opacity=60);
	-moz-opacity:0.6;  
	-khtml-opacity: 0.6;
	opacity: 0.6;  
	
	/* Clear the list style */
	list-style:none;
	margin:0;
	padding:0;
	
	/* Set the position */
	z-index:10;
	position:absolute;
	top:0;
	left:0;
	
	/* Set the style */
	width:200px;
	background-color:#000;
	overflow:hidden;
	font-family:arial; 
	color:#fff;	
}

	#excerpt li {
		padding:5px;
	}
	


.clear {
	clear:both;	
}


</style>
<br>
<div id="slider"  >
 
	<div id="mask-gallery">
	<ul id="gallery">
	 <?php  if(is_array($categories)){ $i=0;?>
		 
			<?php 
			 
			foreach($categories as $article_widget){ ++$i;
			$intro[$i]=$article_widget->intro;
			$title[$i]=$article_widget->title;
			$slug[$i]=$article_widget->slug;
			$keyword[$i]=str_replace(',','-',$article_widget->keyword);
			$caption[$i]=$article_widget->katakunci;
				 ?>
				 <li><img src="<?php  echo str_replace('_normal','',strip_image($article_widget->body));?>"  style="width:<?php  echo !empty($options['width'])?$options['width']:'300'?>px;height:<?php  echo !empty($options['height'])?$options['height']:'186'?>px" alt=""/> </li>
						
						 
		
		<?php   }}?>
		
		 
	</ul>
	</div>
	
	<div id="mask-excerpt">
	<ul id="excerpt">
	 <?php   if(!empty($intro)){?>
	 <?php   for($a=1;$a <= $i; $a++){?>
	
		<li style="color:#FFF10C;text-shadow:none">
			 <h3 style="color:#fff"><?php  echo $options['judul']?></h3>
			<a href="<?php  echo base_url()?>collection/<?php  echo date('Y/m', $article_widget->created_on)?>/<?php  echo $slug[$a]?>" style="color:#0B9B19;font-size:16px"><?php  echo @$caption[$a];?></a>
		<div style="color:#FFF105;text-shadow:none;font-size:14px;font-weight:strong;"><b><a href="<?php  echo base_url()?>collection/<?php  echo date('Y/m', $article_widget->created_on)?>/<?php  echo $slug[$a]?>" style="color:#FFF105;font-size:16px"><?php  echo @$title[$a];?></a></b></div>
		<div  style="color:#fff;text-shadow:none"><?php  echo @$intro[$a];?></div>
		<a href="<?php  echo base_url()?>collection/keyword/<?php  echo @$keyword[$a];?>" style="color:#FF0B11;font-size:16px">#<?php  echo @$keyword[$a];?></a>
		</li>
	 <?php   }}?>
	</ul>
	</div>

</div>

<!--<div id="buttons" style="padding-bottom:10px">
	<a href="#" id="btn-prev"><i class="icon-backward"></i></a>  
	<a href="#" id="btn-next"><i class="icon-forward"></i></a>  
</div>-->
 
	 
	 
  
 
      <?php   }
      if($options['styles']=='1'){?> 
 
    
       <div class="widget" id="featured" style="background:#EFEFEF;border-top-left-radius:0px;border-top-right-radius:0px">
	<h3 class="title">&nbsp;<?php  echo $options['judul']?></h3>
	<div>
	 <!-- collection CONTENT -->
	 <div class="tab_container">
	  <div class="tab_content" id="tab1" style="display: block;padding:0px"> 
				<ul>
				 <?php  if(is_array($categories)){ $i=0; 
				   foreach($categories as $article_widget){ ++$i;
				   
				   if($i % 2 == 0){
					$class='style="vertical-align:top;border-bottom:none"';
				    }else{
					$class='class="right_col" style="border-bottom:none"';
				    }
				 ?>
					
	   				<li <?php  echo $class?>>
					<table style="border-bottom:1px dotted #c5c5c5;margin:5px" width="100%">
						<tr>
							<td >
								<a href="<?php  echo base_url().'collection/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" >
						 <img src="<?php  echo strip_image($article_widget->body);?>" alt="" style="width:100px;height:75px" />
						</a>
							</td>
							<td><span style="font-size:9px;color:#A9A9A9">
							<?php  echo anchor('collection/category/'.$article_widget->category_slug,$article_widget->category_title,' style="font-size:11px;color:#FF0B11"')?> |
							<?php  echo anchor('collection/keyword/'.str_replace(',','-',$article_widget->keyword),$article_widget->keyword,' style="font-size:11px;color:#FF0B11"')?>
							<?php //=date('M d, Y ', $article_widget->created_on)?></span>
						 <br>
						<?php   if($article_widget->katakunci){?>
						 <div style="color:green;font-size:12px;font-weight:bold"><?php  echo $article_widget->katakunci?></div> 
								<?php   }?>
								<a href="<?php  echo base_url().'collection/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" ><?php  echo $article_widget->title?></a>
						 
							</td>
						</tr>
						 
					</table>
						
						 
						

						

						
	 		
	 		 		</li>
				   <?php   }}?>
	   			 </ul>  
	  		</div>  
		</div>
	 <!-- /collection content -->
	  
         </div>
       
       </div>
      <?php   }
      
       if($options['styles']=='2'){?>
     <?php   $W= '285'; if($options['width'] <>''){ $W=$options['width'];}  ?>
      <div id="featured" class="widget" style="width:315px">
	<h3 class="title" style="width:<?php  echo $W?>px;background:#<?php  echo @$options['warna']?>"><a href="<?php  echo base_url()?>collection/category/<?php  echo @$categories[0]->category_slug?>"><?php  echo $options['judul']?></a></h3>
	<div style="margin:0px">
      <div class="section-intro clearfix" id="home-blog" style="padding-bottom:10px">
                 
                    <ul>
			<?php  if(is_array($categories)){
			 
			$img=array();
			$i=0;
			foreach($categories as $article_widget){
				++$i;
				if($i == '1'){
			 ?>
			  <li style="padding:5px 0px;height:auto">
                        <table width="100%">
			 <tr>
			  <td style="width:20px;padding-right:5px">
			    <a href="<?php  echo base_url().'collection/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>"><img  src="<?php  echo strip_image($article_widget->body);?>" alt="<?php  echo $article_widget->title?>" style="margin-bottom:0px;width:<?php  echo $W?>px;height:170px;" ></a>
			     <?php  echo anchor('/collection/category/'.str_replace(',','-',$article_widget->category_slug),$article_widget->category_title,' class="label label-important"')?> | <span style="color:#DE130C"><?php  echo anchor('/collection/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' style="color:#DE130C"')?></span>
			     <span style="font-size:9px"> | <?php  echo date('M d, Y ', $article_widget->created_on)?></span>
						<span class="comm_bubble">
						
						<a href="<?php  echo base_url().'collection/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" ><?php  echo $article_widget->klik?></a>
						</span><br>
						
						<?php   if($article_widget->katakunci){?>
						 <div style="color:green;font-size:12px;font-weight:bold"><?php  echo $article_widget->katakunci?></div> 
								<?php   }?>
			   <a href="<?php  echo base_url().'collection/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" style="font-weight:bold;font-size:15px">
			  <?php  echo $article_widget->title?>
			   </a><br>
			   <div style="color:#3C3C3C"><?php  echo $article_widget->intro?></div>
			  </td>
			 </tr>
			 
			 <tr>
				<td colspan="2">
					
				</td>
			 </tr>
			 </table>
                        
                         
			  
                      </li>
			 <?php   }else{?>
                      <li style="border-top:1px dotted #C2C2C2;padding:5px 0px;height:auto">
                        <table>
			 <tr>
			  
			  <td>
				<?php  echo anchor('/collection/category/'.str_replace(',','-',$article_widget->category_slug),$article_widget->category_title,' style="color:#C1C1C1"')?>  <span style="color:#C1C1C1">| <?php  echo anchor('/collection/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' style="color:#C1C1C1"')?></span>
			     <span style="font-size:9px;color:#C1C1C1"> | <?php  echo date('M d, Y ', $article_widget->created_on)?></span>
						<span class="comm_bubble">
						
						<a href="<?php  echo base_url().'collection/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" ><?php  echo $article_widget->klik?></a>
						</span><br>
						
						<?php   if($article_widget->katakunci){?>
						 <div style="color:green;font-size:12px;font-weight:bold"><?php  echo $article_widget->katakunci?></div> 
								<?php   }?>
			   <a href="<?php  echo base_url().'collection/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" style="font-weight:bold;font-size:12px">
			  <?php  echo $article_widget->title?>
			   </a>
			  </td>
			 </tr>
			 </table>
                        
                         
			  
                      </li>
		      <?php   }?>
		      <?php   }}?>
		       
                    </ul> 
                  
              </div>
        </div> 
              </div>
       
      <?php   }?>
      <?php   if($options['styles']==3){?>
       <!-- START -->
       <script type='text/javascript'>
//<![CDATA[
(function(d){d.tools=d.tools||{};d.tools.tabs={version:"1.0.4",conf:{tabs:"a",current:"current",onBeforeClick:null,onClick:null,effect:"default",initialIndex:0,event:"click",api:false,rotate:false},addEffect:function(e,f){c[e]=f}};var c={"default":function(f,e){this.getPanes().hide().eq(f).show();e.call()},fade:function(g,e){var f=this.getConf(),j=f.fadeOutSpeed,h=this.getPanes();if(j){h.fadeOut(j)}else{h.hide()}h.eq(g).fadeIn(f.fadeInSpeed,e)},slide:function(f,e){this.getPanes().slideUp(200);this.getPanes().eq(f).slideDown(400,e)},ajax:function(f,e){this.getPanes().eq(0).load(this.getTabs().eq(f).attr("href"),e)}};var b;d.tools.tabs.addEffect("horizontal",function(f,e){if(!b){b=this.getPanes().eq(0).width()}this.getCurrentPane().animate({width:0},function(){d(this).hide()});this.getPanes().eq(f).animate({width:b},function(){d(this).show();e.call()})});function a(g,h,f){var e=this,j=d(this),i;d.each(f,function(k,l){if(d.isFunction(l)){j.bind(k,l)}});d.extend(this,{click:function(k,n){var o=e.getCurrentPane();var l=g.eq(k);if(typeof k=="string"&&k.replace("#","")){l=g.filter("[href*="+k.replace("#","")+"]");k=Math.max(g.index(l),0)}if(f.rotate){var m=g.length-1;if(k<0){return e.click(m,n)}if(k>m){return e.click(0,n)}}if(!l.length){if(i>=0){return e}k=f.initialIndex;l=g.eq(k)}if(k===i){return e}n=n||d.Event();n.type="onBeforeClick";j.trigger(n,[k]);if(n.isDefaultPrevented()){return}c[f.effect].call(e,k,function(){n.type="onClick";j.trigger(n,[k])});n.type="onStart";j.trigger(n,[k]);if(n.isDefaultPrevented()){return}i=k;g.removeClass(f.current);l.addClass(f.current);return e},getConf:function(){return f},getTabs:function(){return g},getPanes:function(){return h},getCurrentPane:function(){return h.eq(i)},getCurrentTab:function(){return g.eq(i)},getIndex:function(){return i},next:function(){return e.click(i+1)},prev:function(){return e.click(i-1)},bind:function(k,l){j.bind(k,l);return e},onBeforeClick:function(k){return this.bind("onBeforeClick",k)},onClick:function(k){return this.bind("onClick",k)},unbind:function(k){j.unbind(k);return e}});g.each(function(k){d(this).bind(f.event,function(l){e.click(k,l);return false})});if(location.hash){e.click(location.hash)}else{if(f.initialIndex===0||f.initialIndex>0){e.click(f.initialIndex)}}h.find("a[href^=#]").click(function(k){e.click(d(this).attr("href"),k)})}d.fn.tabs=function(i,f){var g=this.eq(typeof f=="number"?f:0).data("tabs");if(g){return g}if(d.isFunction(f)){f={onBeforeClick:f}}var h=d.extend({},d.tools.tabs.conf),e=this.length;f=d.extend(h,f);this.each(function(l){var j=d(this);var k=j.find(f.tabs);if(!k.length){k=j.children()}var m=i.jquery?i:j.children(i);if(!m.length){m=e==1?d(i):j.parent().find(i)}g=new a(k,m,f);j.data("tabs",g)});return f.api?g:this}})(jQuery);
(function(b){var a=b.tools.tabs;a.plugins=a.plugins||{};a.plugins.slideshow={version:"1.0.2",conf:{next:".forward",prev:".backward",disabledClass:"disabled",autoplay:false,autopause:true,interval:3000,clickable:true,api:false}};b.prototype.slideshow=function(e){var f=b.extend({},a.plugins.slideshow.conf),c=this.length,d;e=b.extend(f,e);this.each(function(){var p=b(this),m=p.tabs(),i=b(m),o=m;b.each(e,function(t,u){if(b.isFunction(u)){m.bind(t,u)}});function n(t){return c==1?b(t):p.parent().find(t)}var s=n(e.next).click(function(){m.next()});var q=n(e.prev).click(function(){m.prev()});var h,j,l,g=false;b.extend(m,{play:function(){if(h){return}var t=b.Event("onBeforePlay");i.trigger(t);if(t.isDefaultPrevented()){return m}g=false;h=setInterval(m.next,e.interval);i.trigger("onPlay");m.next()},pause:function(){if(!h){return m}var t=b.Event("onBeforePause");i.trigger(t);if(t.isDefaultPrevented()){return m}h=clearInterval(h);l=clearInterval(l);i.trigger("onPause")},stop:function(){m.pause();g=true},onBeforePlay:function(t){return m.bind("onBeforePlay",t)},onPlay:function(t){return m.bind("onPlay",t)},onBeforePause:function(t){return m.bind("onBeforePause",t)},onPause:function(t){return m.bind("onPause",t)}});if(e.autopause){var k=m.getTabs().add(s).add(q).add(m.getPanes());k.hover(function(){m.pause();j=clearInterval(j)},function(){if(!g){j=setTimeout(m.play,e.interval)}})}if(e.autoplay){l=setTimeout(m.play,e.interval)}else{m.stop()}if(e.clickable){m.getPanes().click(function(){m.next()})}if(!m.getConf().rotate){var r=e.disabledClass;if(!m.getIndex()){q.addClass(r)}m.onBeforeClick(function(u,t){if(!t){q.addClass(r)}else{q.removeClass(r);if(t==m.getTabs().length-1){s.addClass(r)}else{s.removeClass(r)}}})}});return e.api?d:this}})(jQuery);
(function(c){var d=[];c.tools=c.tools||{};c.tools.tooltip={version:"1.1.2",conf:{effect:"toggle",fadeOutSpeed:"fast",tip:null,predelay:0,delay:30,opacity:1,lazy:undefined,position:["top","center"],offset:[0,0],cancelDefault:true,relative:false,oneInstance:true,events:{def:"mouseover,mouseout",input:"focus,blur",widget:"focus mouseover,blur mouseout",tooltip:"mouseover,mouseout"},api:false},addEffect:function(e,g,f){b[e]=[g,f]}};var b={toggle:[function(e){var f=this.getConf(),g=this.getTip(),h=f.opacity;if(h<1){g.css({opacity:h})}g.show();e.call()},function(e){this.getTip().hide();e.call()}],fade:[function(e){this.getTip().fadeIn(this.getConf().fadeInSpeed,e)},function(e){this.getTip().fadeOut(this.getConf().fadeOutSpeed,e)}]};function a(f,g){var p=this,k=c(this);f.data("tooltip",p);var l=f.next();if(g.tip){l=c(g.tip);if(l.length>1){l=f.nextAll(g.tip).eq(0);if(!l.length){l=f.parent().nextAll(g.tip).eq(0)}}}function o(u){var t=g.relative?f.position().top:f.offset().top,s=g.relative?f.position().left:f.offset().left,v=g.position[0];t-=l.outerHeight()-g.offset[0];s+=f.outerWidth()+g.offset[1];var q=l.outerHeight()+f.outerHeight();if(v=="center"){t+=q/2}if(v=="bottom"){t+=q}v=g.position[1];var r=l.outerWidth()+f.outerWidth();if(v=="center"){s-=r/2}if(v=="left"){s-=r}return{top:t,left:s}}var i=f.is(":input"),e=i&&f.is(":checkbox, :radio, select, :button"),h=f.attr("type"),n=g.events[h]||g.events[i?(e?"widget":"input"):"def"];n=n.split(/,\s*/);if(n.length!=2){throw"Tooltip: bad events configuration for "+h}f.bind(n[0],function(r){if(g.oneInstance){c.each(d,function(){this.hide()})}var q=l.data("trigger");if(q&&q[0]!=this){l.hide().stop(true,true)}r.target=this;p.show(r);n=g.events.tooltip.split(/,\s*/);l.bind(n[0],function(){p.show(r)});if(n[1]){l.bind(n[1],function(){p.hide(r)})}});f.bind(n[1],function(q){p.hide(q)});if(!c.browser.msie&&!i&&!g.predelay){f.mousemove(function(){if(!p.isShown()){f.triggerHandler("mouseover")}})}if(g.opacity<1){l.css("opacity",g.opacity)}var m=0,j=f.attr("title");if(j&&g.cancelDefault){f.removeAttr("title");f.data("title",j)}c.extend(p,{show:function(r){if(r){f=c(r.target)}clearTimeout(l.data("timer"));if(l.is(":animated")||l.is(":visible")){return p}function q(){l.data("trigger",f);var t=o(r);if(g.tip&&j){l.html(f.data("title"))}r=r||c.Event();r.type="onBeforeShow";k.trigger(r,[t]);if(r.isDefaultPrevented()){return p}t=o(r);l.css({position:"absolute",top:t.top,left:t.left});var s=b[g.effect];if(!s){throw'Nonexistent effect "'+g.effect+'"'}s[0].call(p,function(){r.type="onShow";k.trigger(r)})}if(g.predelay){clearTimeout(m);m=setTimeout(q,g.predelay)}else{q()}return p},hide:function(r){clearTimeout(l.data("timer"));clearTimeout(m);if(!l.is(":visible")){return}function q(){r=r||c.Event();r.type="onBeforeHide";k.trigger(r);if(r.isDefaultPrevented()){return}b[g.effect][1].call(p,function(){r.type="onHide";k.trigger(r)})}if(g.delay&&r){l.data("timer",setTimeout(q,g.delay))}else{q()}return p},isShown:function(){return l.is(":visible, :animated")},getConf:function(){return g},getTip:function(){return l},getTrigger:function(){return f},bind:function(q,r){k.bind(q,r);return p},onHide:function(q){return this.bind("onHide",q)},onBeforeShow:function(q){return this.bind("onBeforeShow",q)},onShow:function(q){return this.bind("onShow",q)},onBeforeHide:function(q){return this.bind("onBeforeHide",q)},unbind:function(q){k.unbind(q);return p}});c.each(g,function(q,r){if(c.isFunction(r)){p.bind(q,r)}})}c.prototype.tooltip=function(e){var f=this.eq(typeof e=="number"?e:0).data("tooltip");if(f){return f}var g=c.extend(true,{},c.tools.tooltip.conf);if(c.isFunction(e)){e={onBeforeShow:e}}else{if(typeof e=="string"){e={tip:e}}}e=c.extend(true,g,e);if(typeof e.position=="string"){e.position=e.position.split(/,?\s/)}if(e.lazy!==false&&(e.lazy===true||this.length>20)){this.one("mouseover",function(h){f=new a(c(this),e);f.show(h);d.push(f)})}else{this.each(function(){f=new a(c(this),e);d.push(f)})}return e.api?f:this}})(jQuery);
(function(b){var a=b.tools.tooltip;a.effects=a.effects||{};a.effects.slide={version:"1.0.0"};b.extend(a.conf,{direction:"up",bounce:false,slideOffset:10,slideInSpeed:200,slideOutSpeed:200,slideFade:!b.browser.msie});var c={up:["-","top"],down:["+","top"],left:["-","left"],right:["+","left"]};b.tools.tooltip.addEffect("slide",function(d){var f=this.getConf(),g=this.getTip(),h=f.slideFade?{opacity:f.opacity}:{},e=c[f.direction]||c.up;h[e[1]]=e[0]+"="+f.slideOffset;if(f.slideFade){g.css({opacity:0})}g.show().animate(h,f.slideInSpeed,d)},function(e){var g=this.getConf(),i=g.slideOffset,h=g.slideFade?{opacity:0}:{},f=c[g.direction]||c.up;var d=""+f[0];if(g.bounce){d=d=="+"?"-":"+"}h[f[1]]=d+"="+i;this.getTip().animate(h,g.slideOutSpeed,function(){b(this).hide();e.call()})})})(jQuery);
(function(d){var c=d.tools.tooltip;c.plugins=c.plugins||{};c.plugins.dynamic={version:"1.0.1",conf:{api:false,classNames:"top right bottom left"}};function b(h){var e=d(window);var g=e.width()+e.scrollLeft();var f=e.height()+e.scrollTop();return[h.offset().top<=e.scrollTop(),g<=h.offset().left+h.width(),f<=h.offset().top+h.height(),e.scrollLeft()>=h.offset().left]}function a(f){var e=f.length;while(e--){if(f[e]){return false}}return true}d.fn.dynamic=function(g){var h=d.extend({},c.plugins.dynamic.conf),f;if(typeof g=="number"){g={speed:g}}g=d.extend(h,g);var e=g.classNames.split(/\s/),i;this.each(function(){if(d(this).tooltip().jquery){throw"Lazy feature not supported by dynamic plugin. set lazy: false for tooltip"}var j=d(this).tooltip().onBeforeShow(function(n,o){var m=this.getTip(),l=this.getConf();if(!i){i=[l.position[0],l.position[1],l.offset[0],l.offset[1],d.extend({},l)]}d.extend(l,i[4]);l.position=[i[0],i[1]];l.offset=[i[2],i[3]];m.css({visibility:"hidden",position:"absolute",top:o.top,left:o.left}).show();var k=b(m);if(!a(k)){if(k[2]){d.extend(l,g.top);l.position[0]="top";m.addClass(e[0])}if(k[3]){d.extend(l,g.right);l.position[1]="right";m.addClass(e[1])}if(k[0]){d.extend(l,g.bottom);l.position[0]="bottom";m.addClass(e[2])}if(k[1]){d.extend(l,g.left);l.position[1]="left";m.addClass(e[3])}if(k[0]||k[2]){l.offset[0]*=-1}if(k[1]||k[3]){l.offset[1]*=-1}}m.css({visibility:"visible"}).hide()});j.onShow(function(){var l=this.getConf(),k=this.getTip();l.position=[i[0],i[1]];l.offset=[i[2],i[3]]});j.onHide(function(){var k=this.getTip();k.removeClass(g.classNames)});f=j});return g.api?f:this}})(jQuery);
(function(b){b.tools=b.tools||{};b.tools.scrollable={version:"1.1.2",conf:{size:5,vertical:false,speed:400,keyboard:true,keyboardSteps:null,disabledClass:"disabled",hoverClass:null,clickable:true,activeClass:"active",easing:"swing",loop:false,items:".items",item:null,prev:".prev",next:".next",prevPage:".prevPage",nextPage:".nextPage",api:false}};var c;function a(o,m){var r=this,p=b(this),d=!m.vertical,e=o.children(),k=0,i;if(!c){c=r}b.each(m,function(s,t){if(b.isFunction(t)){p.bind(s,t)}});if(e.length>1){e=b(m.items,o)}function l(t){var s=b(t);return m.globalNav?s:o.parent().find(t)}o.data("finder",l);var f=l(m.prev),h=l(m.next),g=l(m.prevPage),n=l(m.nextPage);b.extend(r,{getIndex:function(){return k},getClickIndex:function(){var s=r.getItems();return s.index(s.filter("."+m.activeClass))},getConf:function(){return m},getSize:function(){return r.getItems().size()},getPageAmount:function(){return Math.ceil(this.getSize()/m.size)},getPageIndex:function(){return Math.ceil(k/m.size)},getNaviButtons:function(){return f.add(h).add(g).add(n)},getRoot:function(){return o},getItemWrap:function(){return e},getItems:function(){return e.children(m.item)},getVisibleItems:function(){return r.getItems().slice(k,k+m.size)},seekTo:function(s,w,t){if(s<0){s=0}if(k===s){return r}if(b.isFunction(w)){t=w}if(s>r.getSize()-m.size){return m.loop?r.begin():this.end()}var u=r.getItems().eq(s);if(!u.length){return r}var v=b.Event("onBeforeSeek");p.trigger(v,[s]);if(v.isDefaultPrevented()){return r}if(w===undefined||b.isFunction(w)){w=m.speed}function x(){if(t){t.call(r,s)}p.trigger("onSeek",[s])}if(d){e.animate({left:-u.position().left},w,m.easing,x)}else{e.animate({top:-u.position().top},w,m.easing,x)}c=r;k=s;v=b.Event("onStart");p.trigger(v,[s]);if(v.isDefaultPrevented()){return r}f.add(g).toggleClass(m.disabledClass,s===0);h.add(n).toggleClass(m.disabledClass,s>=r.getSize()-m.size);return r},move:function(u,t,s){i=u>0;return this.seekTo(k+u,t,s)},next:function(t,s){return this.move(1,t,s)},prev:function(t,s){return this.move(-1,t,s)},movePage:function(w,v,u){i=w>0;var s=m.size*w;var t=k%m.size;if(t>0){s+=(w>0?-t:m.size-t)}return this.move(s,v,u)},prevPage:function(t,s){return this.movePage(-1,t,s)},nextPage:function(t,s){return this.movePage(1,t,s)},setPage:function(t,u,s){return this.seekTo(t*m.size,u,s)},begin:function(t,s){i=false;return this.seekTo(0,t,s)},end:function(t,s){i=true;var u=this.getSize()-m.size;return u>0?this.seekTo(u,t,s):r},reload:function(){p.trigger("onReload");return r},focus:function(){c=r;return r},click:function(u){var v=r.getItems().eq(u),s=m.activeClass,t=m.size;if(u<0||u>=r.getSize()){return r}if(t==1){if(m.loop){return r.next()}if(u===0||u==r.getSize()-1){i=(i===undefined)?true:!i}return i===false?r.prev():r.next()}if(t==2){if(u==k){u--}r.getItems().removeClass(s);v.addClass(s);return r.seekTo(u,time,fn)}if(!v.hasClass(s)){r.getItems().removeClass(s);v.addClass(s);var x=Math.floor(t/2);var w=u-x;if(w>r.getSize()-t){w=r.getSize()-t}if(w!==u){return r.seekTo(w)}}return r},bind:function(s,t){p.bind(s,t);return r},unbind:function(s){p.unbind(s);return r}});b.each("onBeforeSeek,onStart,onSeek,onReload".split(","),function(s,t){r[t]=function(u){return r.bind(t,u)}});f.addClass(m.disabledClass).click(function(){r.prev()});h.click(function(){r.next()});n.click(function(){r.nextPage()});if(r.getSize()<m.size){h.add(n).addClass(m.disabledClass)}g.addClass(m.disabledClass).click(function(){r.prevPage()});var j=m.hoverClass,q="keydown."+Math.random().toString().substring(10);r.onReload(function(){if(j){r.getItems().hover(function(){b(this).addClass(j)},function(){b(this).removeClass(j)})}if(m.clickable){r.getItems().each(function(s){b(this).unbind("click.scrollable").bind("click.scrollable",function(t){if(b(t.target).is("a")){return}return r.click(s)})})}if(m.keyboard){b(document).unbind(q).bind(q,function(t){if(t.altKey||t.ctrlKey){return}if(m.keyboard!="static"&&c!=r){return}var u=m.keyboardSteps;if(d&&(t.keyCode==37||t.keyCode==39)){r.move(t.keyCode==37?-u:u);return t.preventDefault()}if(!d&&(t.keyCode==38||t.keyCode==40)){r.move(t.keyCode==38?-u:u);return t.preventDefault()}return true})}else{b(document).unbind(q)}});r.reload()}b.fn.scrollable=function(d){var e=this.eq(typeof d=="number"?d:0).data("scrollable");if(e){return e}var f=b.extend({},b.tools.scrollable.conf);d=b.extend(f,d);d.keyboardSteps=d.keyboardSteps||d.size;this.each(function(){e=new a(b(this),d);b(this).data("scrollable",e)});return d.api?e:this}})(jQuery);
//]]>
</script>
    <style>
    .slide-wrapper {padding:0 auto;margin:0 auto;width:auto;float: left;
word-wrap: break-word; overflow: hidden;}
.slide ul {list-style:none;padding:0;margin:0;}
.slide .widget {margin:0px 0px 0px;padding:0}
#featuredContent {background:#eee;float:left;width:640px;padding-top:7px}
#slideshow {float:right;margin:0 10px 10px;width: 640px;height:305px; position:relative;}
#slideshow div.cover {float: left;margin:0 8px; }
 
#slideshowThumbs li {display:inline;list-style:none;float: left; margin-right: 6px; }
#slideshowThumbs li a {opacity: 1; }
#slideshowThumbs li a.current, #slideshowThumbs li a:hover {opacity: 0.5;}
#slideshowContent {height:230px; float: none; display: block; position:relative;overflow:hidden;}
#slideshow .post {padding:0 10px; border: none; }
#slideshow .featuredTitle {font:20px Oswald;color:#719429;}
#slideshow .featuredTitle a{color:#ff5901;}
#slideshow .featuredTitle a:hover{color:#333;}
#slideshowContent .featuredPost {display:none;overflow:hidden;}
#slideshowContent .featuredPost .featuredPostContent {padding: 0; }
a.readmore {float:left;border:1px solid #ff5901;background:#ff5901 url(http://2.bp.blogspot.com/-S4AKqSDPUEs/ToSYCWJy4qI/AAAAAAAAABI/conBgqSajOY/s1600/fade.png) repeat-x top;display:block;;font:bold 12px Arial;text-shadow: -1px -1px 0 #c34502;margin:10px 0 0 0;padding:4px 10px;color:#eee;-webkit-border-radius:3px;-moz-border-radius:3px;
border-radius:3px;-webkit-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.5);-moz-box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.5);box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.5);}
a.readmore:hover {color:#ff0}
#slideshowThumbs {
    background: none repeat scroll 0 0 #393939;
    height: 55px;
    margin: 0 10px;
    overflow: hidden;
    padding: 10px;
    position: absolute;
    top: 240px;
    width: 620px;
    z-index: 99;
}



    </style>
 <!-- START -->
     <div id="featuredContent">
<div id="slideshow">
<div id="slideshowThumbs">
<ul>
 <?php  if(is_array($categories)){ $i=0;?>
		 
			<?php 
			 
			foreach($categories as $article_widget){ ++$i;
			$intro[$i]=$article_widget->intro;
			$title[$i]=$article_widget->title;
			$slug[$i]=$article_widget->slug;
			$caption[$i]=$article_widget->katakunci;
			$img[$i]=str_replace('_normal','',strip_image($article_widget->body));
				 ?>
				 <li><a href="#" class=""><img src="<?php  echo $img[$i];?>"  style="height:55px;width:73px"  alt=""/> </a></li>
						
						 
		
		<?php   }}?>
     
</ul>    

</div>
<div id="slideshowContent" style="padding:0 10px; border: none; ">
	<?php   if(!empty($intro)){?>
	 <?php   for($a=1;$a <= $i; $a++){?>
	 
	  <div class="featuredPost">
		<div class="cover">
		    <a href="<?php  echo base_url()?>collection/<?php  echo date('Y/m', $article_widget->created_on)?>/<?php  echo $slug[$a]?>" >
			    <img style="height:240px;width:360px" src="<?php  echo @$img[$a]?>" class=" ">
		    </a>
		</div>
		    <div class="featuredPostContent">
			    <div class="featuredTitle" style="font:20px Oswald">
				<div style="font-size:13px"><?php  echo $caption[$a]?></div> 
				    <a href="<?php  echo base_url()?>collection/<?php  echo date('Y/m', $article_widget->created_on)?>/<?php  echo $slug[$a]?>" style="font:20px Oswald"><?php  echo @$title[$a];?></a>
			    </div>
			    <p><?php  echo @$intro[$a];?></p>
			    <a class="readmore" href="<?php  echo base_url()?>collection/<?php  echo date('Y/m', $article_widget->created_on)?>/<?php  echo $slug[$a]?>" >Read more &raquo;</a>
		    </div>
	      </div>
	  
		
	 <?php   }}?>
  </div> </div>  </div> 
<script type='text/javascript'>
$(function() {
$("#slideshowThumbs ul").tabs("#slideshowContent > div", {
effect: 'fade',
fadeOutSpeed: 500,
rotate: true
}).slideshow({
clickable: true,
autoplay: true,
interval: 6000
});
});


</script>
    <!-- END --> 
      <?php   }?>
 
 <?php   if($options['styles']==4){?>
 <?php   echo css('coda_slider/style.css','collection')?>
 
  
  <script type="text/javascript" src="<?php   echo js_url('coda_slider/jquery-easing.1.2.js','collection')?>"></script>  
  <script type="text/javascript" src="<?php   echo js_url('coda_slider/jquery-easing-compatibility.1.2.js','collection')?>"></script> 
  <script type="text/javascript" src="<?php   echo js_url('coda_slider/coda-slider.1.1.1.js','collection')?>"></script>
  <script type='text/javascript'>
		$(function () {
			$("#blogSlider").codaSlider();
		});
  </script><div id="blogSliderWrap">

		<div id="blogSlider">
			<div class="innerWrap">
				<div class="panelContainer">
					
					<div class="panel" title="PSDTUTS">
						<div class="wrapper">
					
							<ul id="psd-list">
								<li>
									
									<a href="http://feeds.feedburner.com/~r/psdtuts/~3/358205244/">We?re Changing Our Name - Meet Envato</a></li><li><a href="http://feeds.feedburner.com/~r/psdtuts/~3/357325893/">Create a Citrus Fruit Design From Scratch in Photoshop</a></li><li><a href="http://feeds.feedburner.com/~r/psdtuts/~3/356330189/">ThemeForest is Coming - Get Your Beta Invite</a></li><li><a href="http://feeds.feedburner.com/~r/psdtuts/~3/355716823/">Photo-Manipulating an Image Into a Realistic Night Scene</a></li><li><a href="http://feeds.feedburner.com/~r/psdtuts/~3/354854069/">Around the TUTS Sites - July</a></li><li><a href="http://feeds.feedburner.com/~r/psdtuts/~3/353921717/">Inspiration - Futuristic Graphic User Interface Design</a></li><li><a href="http://feeds.feedburner.com/~r/psdtuts/~3/352891988/">Best of the Web - July</a></li><li><a href="http://feeds.feedburner.com/~r/psdtuts/~3/351601770/">PSDTUTS First Tutorial Writing Contest Winners!</a></li><li><a href="http://feeds.feedburner.com/~r/psdtuts/~3/350889826/">New PLUS Tutorial - Creating Artwork For An Epic Metal Album</a></li><li><a href="http://feeds.feedburner.com/~r/psdtuts/~3/349595473/">PSDTUTS Photoshop Wiki Launch Contest!</a></li>							</ul>

					
						</div>
					</div>
	
					<div class="panel" title="NETTUTS">
						<div class="wrapper">
						
							<ul id="net-list">
								<li><a href="http://feeds.feedburner.com/~r/nettuts/~3/359454053/">Building a Better Blogroll: Dynamic Fun with SimplePie and jQuery</a></li><li><a href="http://feeds.feedburner.com/~r/nettuts/~3/358540233/">9 Web Developers That MUST Be Followed On Twitter</a></li><li><a href="http://feeds.feedburner.com/~r/nettuts/~3/358207726/">We?re Changing Our Name - Meet Envato</a></li><li><a href="http://feeds.feedburner.com/~r/nettuts/~3/357564017/">Build a collectionpaper Theme With WP_Query and the 960 CSS Framework</a></li><li><a href="http://feeds.feedburner.com/~r/nettuts/~3/356419030/">How To Implement sIFR3 Into Your Website</a></li><li><a href="http://feeds.feedburner.com/~r/nettuts/~3/356326353/">250 Beta Invites to ThemeForest to Give Away</a></li><li><a href="http://feeds.feedburner.com/~r/nettuts/~3/355689733/">Integrating and Customizing Lijit for Your Site</a></li><li><a href="http://feeds.feedburner.com/~r/nettuts/~3/354844009/">Around the TUTS Sites - July</a></li><li><a href="http://feeds.feedburner.com/~r/nettuts/~3/353605986/">The Weekend Quick Tip: Flex Your Images</a></li><li><a href="http://feeds.feedburner.com/~r/nettuts/~3/352628660/">Create a Spectacular Photo Gallery with MooTools</a></li>							</ul>

						
						</div>
					</div>
				
					<div class="panel" title="VECTORTUTS">
						<div class="wrapper">
						
							<ul id="vector-list">
								<li><a href="http://feeds.feedburner.com/~r/vectortuts/~3/359356599/">Create An Aperture Style Camera Lens Icon</a></li><li><a href="http://feeds.feedburner.com/~r/vectortuts/~3/358410357/">Turning a Photo into Lichtenstein Style Pop Art with Illustrator</a></li><li><a href="http://feeds.feedburner.com/~r/vectortuts/~3/358207955/">We?re Changing Our Name - Meet Envato</a></li><li><a href="http://feeds.feedburner.com/~r/vectortuts/~3/357320441/">Create a Stylish Sports Car Dashboard With Areas of Detailed Realism</a></li><li><a href="http://feeds.feedburner.com/~r/vectortuts/~3/356577456/">Design Gift Boxes Using Illustrator?s 3D Tools</a></li><li><a href="http://feeds.feedburner.com/~r/vectortuts/~3/355472358/">Create a Twitter Style Bird Mascot</a></li><li><a href="http://feeds.feedburner.com/~r/vectortuts/~3/354843957/">Around the TUTS Sites - July</a></li><li><a href="http://feeds.feedburner.com/~r/vectortuts/~3/352546614/">Best of the Web - July</a></li><li><a href="http://feeds.feedburner.com/~r/vectortuts/~3/351605942/">Create a 3D Push Pin and a Paper Note in Illustrator</a></li><li><a href="http://feeds.feedburner.com/~r/vectortuts/~3/350635389/">Making A TUTS Style Shield in Illustrator</a></li>							</ul>

						
						</div>
					</div>
				
					<div class="panel" title="AUDIOTUTS">
						<div class="wrapper">
						
							<ul id="audio-list">
								<li><a href="http://feeds.feedburner.com/~r/audiotuts/~3/358539233/">How to Make an Insane ?Plucky? Trance Lead</a></li><li><a href="http://feeds.feedburner.com/~r/audiotuts/~3/358207725/">We?re Changing Our Name - Meet Envato</a></li><li><a href="http://feeds.feedburner.com/~r/audiotuts/~3/356334143/">15 Totally Free Reverb Plug-ins That Rock</a></li><li><a href="http://feeds.feedburner.com/~r/audiotuts/~3/355285755/">How to Slice Audio into Tempo-Fitted Loops</a></li><li><a href="http://feeds.feedburner.com/~r/audiotuts/~3/354844148/">Around the TUTS Sites - July</a></li><li><a href="http://feeds.feedburner.com/~r/audiotuts/~3/353572903/">3 Tips to Super-charge Your Production Efficiency</a></li><li><a href="http://feeds.feedburner.com/~r/audiotuts/~3/352631440/">Create a Stereo BPM-locked Delay Effect in Reason</a></li><li><a href="http://feeds.feedburner.com/~r/audiotuts/~3/351606606/">Make a Punchy Rock Drum Beat Using Reason?s Redrum</a></li><li><a href="http://feeds.feedburner.com/~r/audiotuts/~3/350315571/">Create a Triggered Noise Gate Effect in Logic</a></li><li><a href="http://feeds.feedburner.com/~r/audiotuts/~3/348396797/">36 Reason Tutorials, Refills, Applications and Communities</a></li>							</ul>

						
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div id="push"></div>
	</div>

  
 <?php   }?>
 
 
 <?php   if($options['styles']==5){?>
 <?php   echo css('tricker/style.css','collection')?>
 
  <script type="text/javascript" src="<?php   echo js_url('tricker/jquery.ticker.min.js','collection')?>"></script>
  <script type="text/javascript">
		$(function () {
			$('#js-collection').ticker();

			// hide the release history when the page loads
			$('#release-wrapper').css('margin-top', '-' + ($('#release-wrapper').height() + 20) + 'px');	

			// show/hide the release history on click
			$('a[href="#release-history"]').toggle(function () {	
				$('#release-wrapper').animate({
					marginTop: '0px'
				}, 600, 'linear');
			}, function () {
				$('#release-wrapper').animate({
					marginTop: '-' + ($('#release-wrapper').height() + 20) + 'px'
				}, 600, 'linear');
			});	
		});
  </script>
   
  <div id="ticker-wrapper" class="no-js">
	 <div style="float: left;padding:8px 8px 0 8px;background:#000;color:#fff;height:23px"><h3 style="color:#fff"><?php  echo $options['judul']?> &raquo;</h3></div> 
	<ul id="js-collection" class="js-hidden"> 
		<?php  if(is_array($categories)){
			$i=0; 
			$img=array();
			foreach($categories as $article_widget){
			if($i>1){$hide='hide';}else{$hide='';}?>
		<li class="collection-item"><a href="<?php  echo base_url().'collection/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>"><?php  echo $article_widget->intro?></a></li>
		<?php   }}?> 
	</ul>
</div>

 
 <?php   }?>
 
 <?php   if($options['styles']=='6'){?>
     <?php   $W= '285'; if($options['width'] <>''){ $W=$options['width'];}  ?>
      <div id="featured" class="widget" style="width:<?php  echo $W?>px">
	<h3 class="title" style="width:<?php  echo $W?>px;background:#<?php  echo @$options['warna']?>"><a href="<?php  echo base_url()?>collection/category/<?php  echo @$categories[0]->category_slug?>"><?php  echo $options['judul']?></a></h3>
	<div style="margin:0px">
      <div class="section-intro clearfix" id="home-blog" style="padding-bottom:10px">
                 
                    <ul>
			<?php  if(is_array($categories)){
			 
			$img=array();
			$i=0;
			foreach($categories as $article_widget){
				++$i;
				if($i == '1'){
			 ?>
			  <li style="padding:5px 0px;height:auto">
				 <?php  echo anchor('/collection/category/'.str_replace(',','-',$article_widget->category_slug),$article_widget->category_title,' class="label label-info"')?> | <span style="color:#FF810A"><b><?php  echo anchor('/collection/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' style="color:#FF810A"')?></b></span>
			     <span style="font-size:9px;color:#C1C1C1"> | <?php  echo date('M d, Y ', $article_widget->created_on)?></span>
						<span class="comm_bubble">
						
						<a href="<?php  echo base_url().'collection/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" ><?php  echo $article_widget->klik?></a>
						</span><br>
                        <table width="100%">
			 <tr>
			  <td style="width:20px;padding-right:5px">
			    <a href="<?php  echo base_url().'collection/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>"><img  src="<?php  echo strip_image($article_widget->body);?>" alt="<?php  echo $article_widget->title?>" style="margin-bottom:0px;width:115px;height:70px;float:left;margin-right:12px" ></a>
			     
						
						<?php   if($article_widget->katakunci){?>
						 <div style="color:green;font-size:12px;font-weight:bold"><?php  echo $article_widget->katakunci?></div> 
								<?php   }?>
			   <a href="<?php  echo base_url().'collection/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" style="font-weight:bold;font-size:15px">
			  <?php  echo $article_widget->title?>
			   </a><br>
			 
			  </td>
			 </tr>
			 
			 <tr>
				<td colspan="2">
					
				</td>
			 </tr>
			 </table>
                        
                         
			  
                      </li>
			 <?php   }else{?>
                      <li style="border-top:1px dotted #C2C2C2;padding:5px 0px;height:auto">
                        <table>
			 <tr>
			  
			  <td>
				   
						<span style="color:#316560"><?php  echo anchor('/collection/keyword/'.str_replace(',','-',$article_widget->keyword),'#'.$article_widget->keyword,' style="color:#C1C1C1"')?></span><br>
						<?php   if($article_widget->katakunci){?>
						 <div style="color:green;font-size:12px;font-weight:bold"><?php  echo $article_widget->katakunci?></div> 
								<?php   }?>
			   <a href="<?php  echo base_url().'collection/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>" style="font-weight:bold;font-size:12px">
			  <?php  echo $article_widget->title?>
			
			   </a>
			  </td>
			 </tr>
			 </table>
                        
                         
			  
                      </li>
		      <?php   }?>
		      <?php   }}?>
		       
                    </ul> 
                  
              </div>
        </div> 
              </div>
       
      <?php   }?>
 <?php   if($options['styles']=='7'){?> 
 <?php  if(is_array($categories)){?>
  
<h3><?php  echo $options['judul']?></h3>
 
<div class="right_articles">
	<table style="border:none">
<?php 
			$i=0; 
			$img=array();
			foreach($categories as $article_widget){
			if($i>1){$hide='hide';}else{$hide='';}?>
			<tr>
				<td class="boxImg">
					<img src="<?php  echo strip_image($article_widget->body);?>" width="80px" style="border:1px solid #dedede;padding:2px" >
				</td>
				<td class="boxProfile" style="padding:10px 0px">
					 <a style="border: medium none; font-size: 11px;" href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><?php   echo $article_widget->intro?></a>
					 
				</td>
			</tr>
			<?php   }?>
			<tr> 
			</tr>
	</table>	
      <?php   }?>
	</div> 
			 
 <?php   }?>
 
 <?php   if($options['styles']=='8'){?> 
 <?php  if(is_array($categories)){?>
 
<div class="boxOuter">
<div class="boxInner"><h3><?php  echo strtoupper($options['judul'])?></h3></div>
<div class="boxContent">
	<table style="border:none">
<?php 
			$i=0; 
			$img=array();
			foreach($categories as $article_widget){
				++$i;
			if($i==1){?>
			<tr>
				<td class="boxImg" colspan="2" style="text-align:center;border:none;border-bottom:1px solid #dedede">
					<a href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>">
					<img src="<?php  echo strip_image($article_widget->body);?>" width="250px" style="border:1px solid #dedede;padding:2px" >
					</a>
				</td>
				 
			</tr>
			
			<?php   }else{ ?>
			<tr>
				<td class="boxImg">
					<a href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><img src="<?php  echo strip_image($article_widget->body);?>" width="80px" style="border:1px solid #dedede;padding:2px" >
					</a>
				</td>
				<td class="boxProfile">
					 <a style="border: medium none; font-size: 11px;" href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><?php   echo $article_widget->intro?></a>
					 
				</td>
			</tr>
			<?php   }}?>
			 
	</table>	
      <?php   }?>
	
</div>
</div>
<div style="padding-bottom:10px">&nbsp;</div>
			 
 <?php   }?>
 
 
<?php   if($options['styles']=='9'){?>
<?php  if(is_array($categories)){?>
<div style="background:#fff;padding:0px; display:block;position:relative;">
 <h3><?php  echo strtoupper($options['judul'])?></h3> 
<div style="padding:5px;;display:block">
	<table style="border:none">
<?php 
			$i=0; 
			$img=array();
			foreach($categories as $article_widget){
			if($i>1){$hide='hide';}else{$hide='';}?>
			<tr>
				<td style="width:50px;border:none;border-bottom:1px solid #dedede;padding:10px 0px">
					<img src="<?php  echo strip_image($article_widget->body);?>" width="55px" style="border:1px solid #dedede;padding:2px" >
				</td>
				<td style="width:100%;border:none;border-bottom:1px solid #dedede;padding:10px 0px">
					 <a style="border: medium none; font-size: 11px;" href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><?php   echo $article_widget->title?></a>
					 
				</td>
			</tr>
			<?php   }?>
	</table>	
      <?php   }?>
	
</div>
</div>
<div style="padding-bottom:10px">&nbsp;</div>
      <?php   }//print_r($options)?>
 <?php   if($options['styles']=='10'){?>
 <?php  if(is_array($categories)){?>
 <h3><?php  echo $options['judul']?></h3>
 <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #dedede;padding:7px">
  <?php   foreach($categories as $article_widget){ ?>
  <tr>
   <td align="center">
    <img src="<?php  echo strip_image($article_widget->body);?>" width="200px" height="120px" style="border:1px solid #dedede;padding:2px" >
   </td>
  </tr>
  <tr>
   <td>
    <table width="100%">
     <tr>
      <td>
        <b > <a style="border: medium none; font-size: 11px;" href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><?php   echo $article_widget->title?></a></b>
      </td>
     </tr>
     <tr>
      <td>
       <?php  echo $article_widget->intro?>
      </td>
     </tr>
    </table>
   </td>
  </tr>
  <?php   }?>
 </table>
 <?php   }?>
 <?php   }?>
 
  
 <?php   if($options['styles']=='11'){?>
     <?php   $W= '640'; if($options['width'] <>''){ $W=$options['width'];}  ?>
      <div id="featured" class="widget" style="width:<?php  echo $W?>px">
	<h3 class="title" style="width:<?php  echo $W?>px;background:#<?php  echo @$options['warna']?>"><a href="<?php  echo base_url()?>collection/category/<?php  echo @$categories[0]->category_slug?>"><?php  echo $options['judul']?></a></h3>
	<div style="margin:0px">
		
      <div class="section-intro clearfix" id="home-blog" style="padding-bottom:10px">
	
	 <?php  if(is_array($categories)){ $i=0;?>
		 
			<?php 
			 $jml=count($categories);
			 $i=0;
			foreach($categories as $article_widget){ ++$i;
			$intro[$i]=$article_widget->intro;
			$body[$i]=$article_widget->body;
			$title[$i]=$article_widget->title;
			$klik[$i]=$article_widget->klik;
			$slug[$i]=$article_widget->slug;
			$cslug[$i]=$article_widget->category_slug;
			$ctitle[$i]=$article_widget->category_title;
			$date[$i]=date('Y/m',$article_widget->created_on);
			$dates[$i]=$article_widget->created_on;
			$keyword[$i]=str_replace(',','-',$article_widget->keyword);
			$caption[$i]=$article_widget->katakunci;
			 
				 ?>
				 
						
						 
		
		<?php   }}?>
                 
                       <table width="100%">
			 <tr>
			  <td style="width:330px;padding-right:5px">
				<?php  echo anchor('/collection/category/'.str_replace(',','-',$slug[1]),$ctitle[1],' style="color:#c1c1c1"')?>  <span style="color:#c1c1c1"> | <?php  echo anchor('/collection/keyword/'.$keyword[1],'#'.$keyword[1],' style="color:#c1c1c1"')?></span>
			     <span style="font-size:9px"> | <?php  echo date('M d, Y ', $dates[1])?></span>
						<span class="comm_bubble">
						
						<a href="<?php  echo base_url().'collection/'.$date[1] .'/'.$slug[1]?>" ><?php  echo $klik[1]?></a>
						</span><br>
			    <a href="<?php  echo base_url().'collection/'.$date[1] .'/'.$slug[1]?>"><img  src="<?php  echo strip_image($body[1]);?>" alt="<?php  echo $title[1]?>" style="margin-bottom:0px;width:115px;height:90px;float:left;margin-right:12px" ></a>
			     
						
						<?php   if($caption[1]){?>
						 <div style="color:green;font-size:12px;font-weight:bold"><?php  echo $caption[1]?></div> 
								<?php   }?>
			   <a href="<?php  echo base_url().'collection/'.$date[1] .'/'.$slug[1]?>" style="font-weight:bold;font-size:15px">
			  <?php  echo $title[1]?>
			   </a><br>
			 			  <?php  echo $intro[1]?>
			  </td>
			 
				<td style="padding-right:0px">
					<ul style="width:100%">
					<?php   for($as=2;$as <= $jml;$as++){?>
					<li style="border-bottom:1px dotted #C2C2C2;padding:5px 0px;height:auto">
						 
						
						<?php   if($caption[$as]){?>
						 <div style="color:green;font-size:12px;font-weight:bold"><?php  echo $caption[$as]?></div> 
								<?php   }?>
			   <a href="<?php  echo base_url().'collection/'.$date[$as] .'/'.$slug[$as]?>" style="font-weight:bold;font-size:12px">
			  <?php  echo $title[$as]?>
			   </a>
					</li>
					<?php   }?>
					</ul>
				</td>
			 </tr>
			 </table>
                  
              </div>
        </div> 
              </div>
       
      <?php   }?>
 
 <?php   if($options['styles']=='12'){?>
 <style>
 
 </style>
 <div style="position: relative; display: block;" id="carousel" class="jcarousel jcarousel-container jcarousel-container-horizontal">
	<div class="rounded">
 	 	<div style="overflow: hidden; position: relative;" class="jcarousel-clip jcarousel-clip-horizontal">
		 <ul  class="jcarousel-list jcarousel-list-horizontal">
	 
 <?php  if(is_array($categories)){ $i=0;?>
<?php   foreach($categories as $article_widget){ ++$i; ?>
				<li jcarouselindex="<?php  echo $i?>" style="float: left; list-style: none outside none; width: 189px;" class="jcarousel-item jcarousel-item-horizontal jcarousel-item-<?php  echo $i?> jcarousel-item-<?php  echo $i?>-horizontal">
				<div class="thumb">
				 <a style="border: medium none;" href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>" title="<?php   echo $article_widget->title?>">
												  <img src="<?php  echo strip_image($article_widget->body);?>" style="width:83px;height:89px"   ></a>
				
				</div>
				<div style="font:11px Oswald;color:#719429;"><?php   echo $article_widget->katakunci?></div>
				<a style="border: medium none;" href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>" title="<?php   echo $article_widget->title?>"><?php   echo $article_widget->title?></a>
				 
				 
				</li>				
				 
				<?php   }?>
				 
 <?php   }?>
		 </ul>
		</div>
 </div><!-- /.rounded --> 
 </div><!-- /#carousel --> 
 <?php   }?>
 
   <?php   if($options['styles']=='13'){?>
   <?php // print_r($categories)?>
 <?php  if(is_array($categories)){ ?>
 <div id="slipfire-tabber-3" class="widget tabbertabs">
	<div class="tabber">
		 <div id="wpzoom-popular-collection-2" class="tabbertab popular-collection"><h2 class="widgettitle">Popular</h2>
<ul class="feature-posts-list">
 <?php    
 $datpop=$this->db->where('status','live')->limit($options['limits'])->order_by('klik','desc')->get('collection')->result();
 if($datpop){
  foreach($datpop as $dap => $valp){
 ?> <li>
  <a href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$valp->created_on)?>/<?php  echo $valp->slug?>" rel="nofollow" title="<?php  echo $valp->title?>"><img src="<?php  echo strip_image($valp->body);?>" alt="<?php  echo $valp->title?>" style="height:50px;width:50px" /></a>
					
				<small> <?php  echo date('M d, Y, H:i:s',$valp->created_on)?> <span class="comm_bubble"><a href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$valp->created_on)?>/<?php  echo $valp->slug?>" class=" "  title="<?php  echo $valp->title?>"><?php  echo $valp->klik?></a></span> </small>
				 
				<div><span style="font: 11px; color: #E33F15;"><?php  echo $valp->keyword?></span> <span style="font: 11px Oswald; color: rgb(113, 148, 41);"> &raquo; <?php  echo $valp->katakunci?></span></div>
  <a href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$valp->created_on)?>/<?php  echo $valp->slug?>"><?php  echo $valp->title?></a><br /><div class="clear"></div>
 
 </li>
 
 <?php   }}?>
</ul>
</div>
		<div id="wpzoom-feature-posts-2" class="tabbertab feature-posts"><h2 class="widgettitle">Terbaru</h2>
<ul class="feature-posts-list">
 <?php   foreach($categories as $article_widget){ ?>
 <li>
  <a href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>" rel="nofollow" title="<?php  echo $article_widget->title?>"><img src="<?php  echo strip_image($article_widget->body);?>" alt="<?php  echo $article_widget->title?>" style="height:50px;width:50px" /></a>
					
				<small> <?php  echo date('M d, Y, H:i:s',$article_widget->created_on)?> <span class="comm_bubble"><a href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>" class=" "  title="<?php  echo $article_widget->title?>"><?php  echo $article_widget->klik?></a></span> </small><br />
				<div><span style="font: 11px; color: #E33F15;"><?php  echo $article_widget->keyword?></span> <span style="font: 11px Oswald; color: rgb(113, 148, 41);"> &raquo; <?php  echo $article_widget->katakunci?></span></div>
  <a href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>"><?php  echo $article_widget->title?></a><br /><div class="clear"></div>
 
 </li>
  <?php   }?>
</ul><div class="clear"></div>
 </div>
 

  
 

	</div>
 </div> 

<?php   }?>
<?php   }?>
 

 

 				
 <?php   if($options['styles']=='14'){?> 
	<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
    
  <script type="text/javascript">
 
	$(document).ready(function(){
	   
		$("#myform").validate({
			debug: false,
			rules: {
				title_en: "required",
				category_id: "required"
			},
			messages: {
				name: "Kolom ini tidak boleh kosong.",
				category_id: "Kolom ini tidak boleh kosong",
			},
			submitHandler: function(form) {
				// do other stuff for a valid form
				 $('#results').html('<br> <img src="<?php  echo base_url()?>loading17.gif">');
				$.post('http://www.twittland.com/twitter_collection/submit', $("#myform").serialize(), function(data) {
					 
					$('#results').html(data);
					 
				});
				document.getElementById('title_en').value='';
			}
		});
	});
 
	</script>
 <?php 
 $this->load->model('collection/collection_categories_m');
 $file_folders = $this->collection_categories_m->get_folders();
		$folders_tree = array();
		foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth-1);
			$folders_tree[$folder->id] = $indent . $folder->title;
		}
		unset($folders_tree['420']);
		 
 ?>
 <div class="widget">
					<h3 class="title"> Paste Url Chirpstory-mu Kesini</h3>
					<div class="padder"> 
					 
					<div style="">
					 <form name="myform" id="myform" action="" method="POST"> 
			<ul>
				<li>
					<label for="title">Paste Url tanpa http://</label>
				</li>
				<li>
					<?php  echo form_input('title_en', '', 'maxlength="100" id="title_en" placeholder="contoh: chirpstory.com/li/1234" size="36"'); ?>
					<span class="required-icon tooltip"><?php  echo lang('required_label');?></span>
				</li> 
				<li>
					<label for="category_id"><br></label> 
					<?php  echo form_dropdown('category_id', array('--PILIH KATEGORI--') + $folders_tree, ''); ?>
					 
				</li>
				<li>
				 <div class="form-submit">
				  <br><br>
				 <input type="submit"  style="padding:5px"  value="Submit" class="button" name="submit">
				 </div>
				 <div id="results"><br>
				  Kumpulin Chirpstory kamu disini,jangan lupa <a href="<?php  echo base_url()?>twittero/index"><b>login</b></a> dulu yah!
				  <div>
				</li>
				 
			</ul>
			

<?php  echo form_close(); ?>
<span class="meta" style="font-size:10px">
<a href="<?php  echo base_url()?>twittero/create" target="_blank">Atau Anda bisa membuat StoryTwit baru disini</a>
</span>
					</div>
					</div>
 </div>
		 
 
 <?php   }?>
 
 
 <?php 
 //berita style 3
 if($options['styles']=='15'){?>
  <div class="headings">
			
			<ul>
 <?php  if(is_array($categories)){ ?>
<?php   foreach($categories as $article_widget){ ?>
								
				<li style="margin-bottom:0px;padding-bottom:0px">
					
					
					 
					 
					 <h2><a style="border: medium none;" href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>" title="<?php   echo $article_widget->title?>"><?php   echo strtoupper($article_widget->title)?></a></h2>
					<span class="meta">
						 <?php  echo date('M d, Y, H:i:s',$article_widget->created_on)?> 
					<span class="comm_bubble"><a href="<?php  echo base_url()?>collection/<?php  echo date('Y/m',$article_widget->created_on)?>/<?php  echo $article_widget->slug?>" class=" " title="<?php   echo $article_widget->title?>"><?php   echo $article_widget->klik?></a></span>	 
					</span>
					
					  

				</li>
				<?php   }?>
				 
 <?php   }?>
 
				</ul>
				</div>
 <?php   }?>
 
<?php 
//berita list kanan
if($options['styles']=='16'){?>
     
      <div id="featured" class="widget" style="width:320px">
	<h3 class="title" style="width:auto"><a href="<?php  echo base_url()?>collection/category/<?php  echo @$categories[0]->category_slug?>"><?php  echo $options['judul']?></a></h3>
	<div style="margin:10px">
      <div class="section-intro clearfix" id="home-blog" style="padding-bottom:10px">
                 
                    <ul>
			<?php  if(is_array($categories)){
			 
			$img=array();
			foreach($categories as $article_widget){
			 ?>
                      <li style="border-bottom:1px solid #dedede;padding:5px 0px;height:auto">
                        <table>
			 <tr>
			  <td style="width:20px;padding-right:5px">
			    <a href="<?php  echo base_url().'collection/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>"><img   class="imageB" src="<?php  echo strip_image($article_widget->body);?>" alt="<?php  echo $article_widget->title?>" style="margin-bottom:0px" ></a> 
			  </td>
			  <td>
			   <a href="<?php  echo base_url().'collection/'.date('Y/m', $article_widget->created_on) .'/'.$article_widget->slug?>">
			   <?php  echo $article_widget->title?>
			   </a>
			  </td>
			 </tr>
			 </table>
                        
                         
			  
                      </li>
		      <?php   }}?>
		       
                    </ul> 
                  
              </div>
      <div style="text-align:center"><a href="<?php  echo base_url()?>collection/category/<?php  echo @$categories[0]->category_slug?>">MORE</a></div>
       </div> 
              </div>
       
      <?php   }?>
      
      
      			
 <?php   if($options['styles']=='17'){?> 
	<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
    
  <script type="text/javascript">
 
	$(document).ready(function(){
	   
		$("#myform").validate({
			debug: false,
			rules: {
				title_en: "required",
				category_id: "required"
			},
			messages: {
				name: "Kolom ini tidak boleh kosong.",
				category_id: "Kolom ini tidak boleh kosong",
			},
			submitHandler: function(form) {
				// do other stuff for a valid form
				 $('#results').html('<br> <img src="<?php  echo base_url()?>loading17.gif">');
				$.post('http://www.twittland.com/twitter_collection/submit', $("#myform").serialize(), function(data) {
					 
					$('#results').html(data);
					 
				});
				document.getElementById('title_en').value='';
			}
		});
	});
 
	</script>
 <?php 
 $this->load->model('collection/collection_categories_m');
 $file_folders = $this->collection_categories_m->get_folders();
		$folders_tree = array();
		foreach($file_folders as $folder)
		{
			$indent = repeater('&raquo; ', $folder->depth-1);
			$folders_tree[$folder->id] = $indent . $folder->title;
		}
		unset($folders_tree['420']);
		 
 ?>
 
<div id="featured" style="padding-bottom:25px">

	<h3 class="title">Copy Chirpstory-mu Kesini</h3>
	<div class="rounded" >
		<div> 
					  
					 <form name="myform" id="myform" action="" method="POST"> 
			<table>
			 <tr>
				<td>
					<span class="meta" style="font-size:10px">Paste Url tanpa http://</span>
				</td>
				<td colspan="2">
					<span class="meta" style="font-size:10px">Kategori</span>
				</td>
			 </tr>
			 <tr>
				<td>
					<?php  echo form_input('title_en', '', 'maxlength="100" id="title_en" placeholder="contoh: chirpstory.com/li/1234" size="36"'); ?>
					 
				</td> 
				<td>
					 
					<?php  echo form_dropdown('category_id', array('--PILIH KATEGORI--') + $folders_tree, ''); ?>
					 
				</td>
				<td>
				 <div class="form-submit">
				 
				 <input type="submit"  style="padding:5px"  value="Submit" class="button" name="submit">
				 </div>
				</td>
			 </tr>
			 <tr>
			  
				<td colspan="3">
				 
				 <div id="results"><br>
				  Kumpulin Chirpstory kamu disini,jangan lupa <a href="<?php  echo base_url()?>twittero/index"><b>login</b></a> dulu yah!
				  <div>
				</td>
			 </tr>
			</table>
			

<?php  echo form_close(); ?>
<span class="meta" style="font-size:10px">
 *Fasilitas ini untuk meng-copy kultwit anda yg ada di chirpstory.com ke twittland.com
<a href="<?php  echo base_url()?>twittero/create" target="_blank"> Atau Anda bisa membuat StoryTwit baru disini</a>
</span>
					</div>
					</div>
 </div>
		 
 
 <?php   }?>
 
