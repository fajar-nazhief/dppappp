/*
 * jquery.tools 1.1.2 - The missing UI library for the Web
 * 
 * [tools.tabs-1.0.4, tools.scrollable-1.1.2, tools.scrollable.circular-0.5.1, tools.scrollable.autoscroll-1.0.1, tools.scrollable.mousewheel-1.0.1]
 * 
 * Copyright (c) 2009 Tero Piirainen
 * http://flowplayer.org/tools/
 *
 * Dual licensed under MIT and GPL 2+ licenses
 * http://www.opensource.org/licenses
 * 
 * -----
 * 
 * jquery.event.wheel.js - rev 1 
 * Copyright (c) 2008, Three Dub Media (http://threedubmedia.com)
 * Liscensed under the MIT License (MIT-LICENSE.txt)
 * http://www.opensource.org/licenses/mit-license.php
 * Created: 2008-07-01 | Updated: 2008-07-14
 * 
 * -----
 * 
 * File generated: Mon Dec 28 07:37:31 GMT 2009
 */
(function(d){d.tools=d.tools||{};d.tools.tabs={version:"1.0.4",conf:{tabs:"a",current:"current",onBeforeClick:null,onClick:null,effect:"default",initialIndex:0,event:"click",api:false,rotate:false},addEffect:function(e,f){c[e]=f}};var c={"default":function(f,e){this.getPanes().hide().eq(f).show();e.call()},fade:function(g,e){var f=this.getConf(),j=f.fadeOutSpeed,h=this.getPanes();if(j){h.fadeOut(j)}else{h.hide()}h.eq(g).fadeIn(f.fadeInSpeed,e)},slide:function(f,e){this.getPanes().slideUp(200);this.getPanes().eq(f).slideDown(400,e)},ajax:function(f,e){this.getPanes().eq(0).load(this.getTabs().eq(f).attr("href"),e)}};var b;d.tools.tabs.addEffect("horizontal",function(f,e){if(!b){b=this.getPanes().eq(0).width()}this.getCurrentPane().animate({width:0},function(){d(this).hide()});this.getPanes().eq(f).animate({width:b},function(){d(this).show();e.call()})});function a(g,h,f){var e=this,j=d(this),i;d.each(f,function(k,l){if(d.isFunction(l)){j.bind(k,l)}});d.extend(this,{click:function(k,n){var o=e.getCurrentPane();var l=g.eq(k);if(typeof k=="string"&&k.replace("#","")){l=g.filter("[href*="+k.replace("#","")+"]");k=Math.max(g.index(l),0)}if(f.rotate){var m=g.length-1;if(k<0){return e.click(m,n)}if(k>m){return e.click(0,n)}}if(!l.length){if(i>=0){return e}k=f.initialIndex;l=g.eq(k)}if(k===i){return e}n=n||d.Event();n.type="onBeforeClick";j.trigger(n,[k]);if(n.isDefaultPrevented()){return}c[f.effect].call(e,k,function(){n.type="onClick";j.trigger(n,[k])});n.type="onStart";j.trigger(n,[k]);if(n.isDefaultPrevented()){return}i=k;g.removeClass(f.current);l.addClass(f.current);return e},getConf:function(){return f},getTabs:function(){return g},getPanes:function(){return h},getCurrentPane:function(){return h.eq(i)},getCurrentTab:function(){return g.eq(i)},getIndex:function(){return i},next:function(){return e.click(i+1)},prev:function(){return e.click(i-1)},bind:function(k,l){j.bind(k,l);return e},onBeforeClick:function(k){return this.bind("onBeforeClick",k)},onClick:function(k){return this.bind("onClick",k)},unbind:function(k){j.unbind(k);return e}});g.each(function(k){d(this).bind(f.event,function(l){e.click(k,l);return false})});if(location.hash){e.click(location.hash)}else{if(f.initialIndex===0||f.initialIndex>0){e.click(f.initialIndex)}}h.find("a[href^=#]").click(function(k){e.click(d(this).attr("href"),k)})}d.fn.tabs=function(i,f){var g=this.eq(typeof f=="number"?f:0).data("tabs");if(g){return g}if(d.isFunction(f)){f={onBeforeClick:f}}var h=d.extend({},d.tools.tabs.conf),e=this.length;f=d.extend(h,f);this.each(function(l){var j=d(this);var k=j.find(f.tabs);if(!k.length){k=j.children()}var m=i.jquery?i:j.children(i);if(!m.length){m=e==1?d(i):j.parent().find(i)}g=new a(k,m,f);j.data("tabs",g)});return f.api?g:this}})(jQuery);
(function(b){b.tools=b.tools||{};b.tools.scrollable={version:"1.1.2",conf:{size:5,vertical:false,speed:400,keyboard:true,keyboardSteps:null,disabledClass:"disabled",hoverClass:null,clickable:true,activeClass:"active",easing:"swing",loop:false,items:".items",item:null,prev:".prev",next:".next",prevPage:".prevPage",nextPage:".nextPage",api:false}};var c;function a(o,m){var r=this,p=b(this),d=!m.vertical,e=o.children(),k=0,i;if(!c){c=r}b.each(m,function(s,t){if(b.isFunction(t)){p.bind(s,t)}});if(e.length>1){e=b(m.items,o)}function l(t){var s=b(t);return m.globalNav?s:o.parent().find(t)}o.data("finder",l);var f=l(m.prev),h=l(m.next),g=l(m.prevPage),n=l(m.nextPage);b.extend(r,{getIndex:function(){return k},getClickIndex:function(){var s=r.getItems();return s.index(s.filter("."+m.activeClass))},getConf:function(){return m},getSize:function(){return r.getItems().size()},getPageAmount:function(){return Math.ceil(this.getSize()/m.size)},getPageIndex:function(){return Math.ceil(k/m.size)},getNaviButtons:function(){return f.add(h).add(g).add(n)},getRoot:function(){return o},getItemWrap:function(){return e},getItems:function(){return e.children(m.item)},getVisibleItems:function(){return r.getItems().slice(k,k+m.size)},seekTo:function(s,w,t){if(s<0){s=0}if(k===s){return r}if(b.isFunction(w)){t=w}if(s>r.getSize()-m.size){return m.loop?r.begin():this.end()}var u=r.getItems().eq(s);if(!u.length){return r}var v=b.Event("onBeforeSeek");p.trigger(v,[s]);if(v.isDefaultPrevented()){return r}if(w===undefined||b.isFunction(w)){w=m.speed}function x(){if(t){t.call(r,s)}p.trigger("onSeek",[s])}if(d){e.animate({left:-u.position().left},w,m.easing,x)}else{e.animate({top:-u.position().top},w,m.easing,x)}c=r;k=s;v=b.Event("onStart");p.trigger(v,[s]);if(v.isDefaultPrevented()){return r}f.add(g).toggleClass(m.disabledClass,s===0);h.add(n).toggleClass(m.disabledClass,s>=r.getSize()-m.size);return r},move:function(u,t,s){i=u>0;return this.seekTo(k+u,t,s)},next:function(t,s){return this.move(1,t,s)},prev:function(t,s){return this.move(-1,t,s)},movePage:function(w,v,u){i=w>0;var s=m.size*w;var t=k%m.size;if(t>0){s+=(w>0?-t:m.size-t)}return this.move(s,v,u)},prevPage:function(t,s){return this.movePage(-1,t,s)},nextPage:function(t,s){return this.movePage(1,t,s)},setPage:function(t,u,s){return this.seekTo(t*m.size,u,s)},begin:function(t,s){i=false;return this.seekTo(0,t,s)},end:function(t,s){i=true;var u=this.getSize()-m.size;return u>0?this.seekTo(u,t,s):r},reload:function(){p.trigger("onReload");return r},focus:function(){c=r;return r},click:function(u){var v=r.getItems().eq(u),s=m.activeClass,t=m.size;if(u<0||u>=r.getSize()){return r}if(t==1){if(m.loop){return r.next()}if(u===0||u==r.getSize()-1){i=(i===undefined)?true:!i}return i===false?r.prev():r.next()}if(t==2){if(u==k){u--}r.getItems().removeClass(s);v.addClass(s);return r.seekTo(u,time,fn)}if(!v.hasClass(s)){r.getItems().removeClass(s);v.addClass(s);var x=Math.floor(t/2);var w=u-x;if(w>r.getSize()-t){w=r.getSize()-t}if(w!==u){return r.seekTo(w)}}return r},bind:function(s,t){p.bind(s,t);return r},unbind:function(s){p.unbind(s);return r}});b.each("onBeforeSeek,onStart,onSeek,onReload".split(","),function(s,t){r[t]=function(u){return r.bind(t,u)}});f.addClass(m.disabledClass).click(function(){r.prev()});h.click(function(){r.next()});n.click(function(){r.nextPage()});if(r.getSize()<m.size){h.add(n).addClass(m.disabledClass)}g.addClass(m.disabledClass).click(function(){r.prevPage()});var j=m.hoverClass,q="keydown."+Math.random().toString().substring(10);r.onReload(function(){if(j){r.getItems().hover(function(){b(this).addClass(j)},function(){b(this).removeClass(j)})}if(m.clickable){r.getItems().each(function(s){b(this).unbind("click.scrollable").bind("click.scrollable",function(t){if(b(t.target).is("a")){return}return r.click(s)})})}if(m.keyboard){b(document).unbind(q).bind(q,function(t){if(t.altKey||t.ctrlKey){return}if(m.keyboard!="static"&&c!=r){return}var u=m.keyboardSteps;if(d&&(t.keyCode==37||t.keyCode==39)){r.move(t.keyCode==37?-u:u);return t.preventDefault()}if(!d&&(t.keyCode==38||t.keyCode==40)){r.move(t.keyCode==38?-u:u);return t.preventDefault()}return true})}else{b(document).unbind(q)}});r.reload()}b.fn.scrollable=function(d){var e=this.eq(typeof d=="number"?d:0).data("scrollable");if(e){return e}var f=b.extend({},b.tools.scrollable.conf);d=b.extend(f,d);d.keyboardSteps=d.keyboardSteps||d.size;this.each(function(){e=new a(b(this),d);b(this).data("scrollable",e)});return d.api?e:this}})(jQuery);
(function(b){var a=b.tools.scrollable;a.plugins=a.plugins||{};a.plugins.circular={version:"0.5.1",conf:{api:false,clonedClass:"cloned"}};b.fn.circular=function(e){var d=b.extend({},a.plugins.circular.conf),c;b.extend(d,e);this.each(function(){var i=b(this).scrollable(),n=i.getItems(),k=i.getConf(),f=i.getItemWrap(),j=0;if(i){c=i}if(n.length<k.size){return false}n.slice(0,k.size).each(function(o){b(this).clone().appendTo(f).click(function(){i.click(n.length+o)}).addClass(d.clonedClass)});var l=b.makeArray(n.slice(-k.size)).reverse();b(l).each(function(o){b(this).clone().prependTo(f).click(function(){i.click(-o-1)}).addClass(d.clonedClass)});var m=f.children(k.item);var h=k.hoverClass;if(h){m.hover(function(){b(this).addClass(h)},function(){b(this).removeClass(h)})}function g(o){var p=m.eq(o);if(k.vertical){f.css({top:-p.position().top})}else{f.css({left:-p.position().left})}}g(k.size);b.extend(i,{move:function(s,r,p,q){var u=j+s+k.size;var t=u>i.getSize()-k.size;if(u<=0||t){var o=j+k.size+(t?-n.length:n.length);g(o);u=o+s}if(q){m.removeClass(k.activeClass).eq(u+Math.floor(k.size/2)).addClass(k.activeClass)}if(u===j+k.size){return self}return i.seekTo(u,r,p)},begin:function(p,o){return this.seekTo(k.size,p,o)},end:function(p,o){return this.seekTo(n.length,p,o)},click:function(p,r,q){if(!k.clickable){return self}if(k.size==1){return this.next()}var s=p-j,o=k.activeClass;s-=Math.floor(k.size/2);return this.move(s,r,q,true)},getIndex:function(){return j},setPage:function(p,q,o){return this.seekTo(p*k.size+k.size,q,o)},getPageAmount:function(){return Math.ceil(n.length/k.size)},getPageIndex:function(){if(j<0){return this.getPageAmount()-1}if(j>=n.length){return 0}var o=(j+k.size)/k.size-1;return o},getVisibleItems:function(){var o=j+k.size;return m.slice(o,o+k.size)}});i.onStart(function(p,o){j=o-k.size;return false});i.getNaviButtons().removeClass(k.disabledClass)});return d.api?c:this}})(jQuery);
(function(b){var a=b.tools.scrollable;a.plugins=a.plugins||{};a.plugins.autoscroll={version:"1.0.1",conf:{autoplay:true,interval:3000,autopause:true,steps:1,api:false}};b.fn.autoscroll=function(d){if(typeof d=="number"){d={interval:d}}var e=b.extend({},a.plugins.autoscroll.conf),c;b.extend(e,d);this.each(function(){var g=b(this).scrollable();if(g){c=g}var i,f,h=true;g.play=function(){if(i){return}h=false;i=setInterval(function(){g.move(e.steps)},e.interval);g.move(e.steps)};g.pause=function(){i=clearInterval(i)};g.stop=function(){g.pause();h=true};if(e.autopause){g.getRoot().add(g.getNaviButtons()).hover(function(){g.pause();clearInterval(f)},function(){if(!h){f=setTimeout(g.play,e.interval)}})}if(e.autoplay){setTimeout(g.play,e.interval)}});return e.api?c:this}})(jQuery);
(function(b){b.fn.wheel=function(e){return this[e?"bind":"trigger"]("wheel",e)};b.event.special.wheel={setup:function(){b.event.add(this,d,c,{})},teardown:function(){b.event.remove(this,d,c)}};var d=!b.browser.mozilla?"mousewheel":"DOMMouseScroll"+(b.browser.version<"1.9"?" mousemove":"");function c(e){switch(e.type){case"mousemove":return b.extend(e.data,{clientX:e.clientX,clientY:e.clientY,pageX:e.pageX,pageY:e.pageY});case"DOMMouseScroll":b.extend(e,e.data);e.delta=-e.detail/3;break;case"mousewheel":e.delta=e.wheelDelta/120;break}e.type="wheel";return b.event.handle.call(this,e,e.delta)}var a=b.tools.scrollable;a.plugins=a.plugins||{};a.plugins.mousewheel={version:"1.0.1",conf:{api:false,speed:50}};b.fn.mousewheel=function(f){var g=b.extend({},a.plugins.mousewheel.conf),e;if(typeof f=="number"){f={speed:f}}f=b.extend(g,f);this.each(function(){var h=b(this).scrollable();if(h){e=h}h.getRoot().wheel(function(i,j){h.move(j<0?1:-1,f.speed||50);return false})});return f.api?e:this}})(jQuery);