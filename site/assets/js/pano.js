/*
* @package component panorama for Joomla! 3.x
 * @version $Id: com_panorama 1.0.0 2016-08-20 23:26:33Z $
 * @author Kian William Nowrouzian
 * @copyright (C) 2015- Kian William Nowrouzian
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 
 This file is part of panorama.
    panorama is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    panorama is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with panorama.  If not, see <http://www.gnu.org/licenses/>.
*/
(function($)
{
			var config = {};
		    var global = {selected:'', selector:''};			
			var counter = 0;
			var startAngle = 0;
			var endAngle = 180;
			var distance = 0;
			var gallerywidth, galleryheight;
			var finalAngle ;
			var flag = 0;
			var returnflag = 0;
			
			
        var init = $.prototype.init;
		$.prototype.init = function (selector, context)
	    {
		   var r = init.apply(this, arguments);
		   if(selector && selector.selector)
		   {
			r.context = selector.context;
			r.selector = selector.selector;
		   }
		   if(typeof selector == 'string')
		   {
			r.context = context || document,r.selector = selector,global.selector = r.selector;
		   }
		   global.selected = r;
		   return r;
	   }
	   	$.prototype.init.prototype = $.prototype;
		
		$.fn.luminationgallery = {
			config: function(args){
														
				setConfig($.extend({}, $.fn.luminationgallery.defaults, args));


			},
			init:function(){

				 gallerywidth = ( parseInt(config.width) * parseInt(config.cols) ) + 10;
				 galleryheight = ( parseInt(config.height) * (parseInt(config.images.length)/parseInt(config.cols) ));
				global.selected.css({marginTop:'-121px',paddingBottom:'121px', display:'block', position:'relative', marginLeft:'auto', marginRight:'auto', width:gallerywidth+'px', height:galleryheight+'px', backgroundColor:config.backgroundColor});
				var counter = 0;
										console.log('loser');

				global.selected.css({  transition:'all 1s ease' , transform:'perspective('+config.persp+'px) rotateX(30deg)', mozTransform:'perspective('+config.persp+'px) rotateX(30deg)', webkitTransform:'perspective('+config.persp+'px)  rotateX(30deg)', msTransform:'perspective('+config.persp+'px) rotateX(30deg)',webkitTransformStyle:'preserve-3d',transformStyle:'preserve-3d', mozTransformStyle:'preserve-3d' , msTransformStyle:'preserve-3d', overflow:'hidden'})
						console.log('loser');

				for(var i=0; i<parseInt(config.cols); i++)
				{
					$('<div id="vg'+i+'"></div>').css({'float':'left', width:parseInt(config.width)+'px', marginTop:'5px',  transfrom:'rotateX(30deg)', mozTransfrom:'rotateX(30deg)', webkitTransform:' rotateX(30deg)', msTransform:'rotateX(30deg)'}).appendTo('#p3D');
					if(i==0)
						$('#vg0').css({marginLeft:'5px'})
					for(var l=0; l<parseInt(config.images.length)/parseInt(config.cols); l++)
					{
						$('<img src="'+config.images[counter]+'" title="'+config.descs[counter++]+'" width="'+parseInt(config.width)+'px" height="'+parseInt(config.height)+'px" />').appendTo('#vg'+i)
					}
				}
				var rollerheight = galleryheight + 5;
				var rollerwidth = parseInt(config.width) ;
			  $('<div id="roller"></div>').css({ webkitTransformOrigin:'right',transformOrigin:'right', mozTransformOrigin:'right', msTransformOrigin:'right',opacity:0.5, position:'absolute', left:'5px', top:0, height:rollerheight+'px', width:rollerwidth+'px',backgroundColor:'red', transfrom:'rotateX(30deg)', mozTransfrom:'rotateX(30deg)', webkitTransform:'rotateX(30deg)', msTransform:'rotateX(30deg)'}).appendTo('#p3D');
		       $.fn.luminationgallery.firstRotate();
			},
			firstRotate: function(){
   				
				if(counter<3)
					finalAngel = 180;
				else
					finalAngel = 86;
					
				
				$({deg:0}).animate({deg:finalAngel}, { duration:5000, step:function(n){
					$('#roller').css({transform:' rotateX(30deg) rotateY('+n+'deg)   ', webkitTransform:'   rotateY('+n+'deg)    ', mozTransform:' rotateX(30deg) rotateY('+n+'deg)', msTransform:' rotateX(30deg) rotateY('+n+'deg)'});
                }, complete:function(){					
                        
						$.fn.luminationgallery.verticalDown(); 					
				} });				
			},
			verticalDown: function(){
				$('#p3D').children('div').eq(counter).animate({marginTop:'+='+(parseInt(config.height)/(1.3))}, parseInt(config.speed), function(){ 
				if(parseInt($(this).css('marginTop'))<galleryheight)
				{
				 var inter = setInterval(function(){
					     global.selected.luminationgallery.verticalDown();
						 clearInterval(inter);
				 }, 1000);
				}
				else
				{
					
					global.selected.luminationgallery.verticalUp();

				}
				
				});
				
			},
			verticalUp:function(){
				
				$('#p3D').children('div').eq(counter).animate({marginTop:'5px'}, 1000, function(){ 
				if(counter<3)
				{
					counter++;
					if(flag==0)
					{
					  distance+=(parseInt(config.width)) +5;
					  flag=1;
					}
					else
					{
					   distance+=(parseInt(config.width));

					}
					
						
					$('#roller').css({left:distance+'px'});
					global.selected.luminationgallery.firstRotate();

				    
				}
				else
				{
					
				    global.selected.luminationgallery.returnRotate();

				}
				
				});
				
			},
			returnRotate:function(){
			if(returnflag==0)
			{
				$({deg:finalAngel}).animate({deg:0}, { duration:1500, step:function(n){
					$('#roller').css({transform:' rotateX(30deg) rotateY('+-n+'deg)   ', webkitTransform:'   rotateY('+-n+'deg)    ', mozTransform:' rotateX(30deg) rotateY('+-n+'deg)', msTransform:' rotateX(30deg) rotateY('+-n+'deg)'});
                }, complete:function(){					
                        				
						$('#roller').css({webkitTransformOrigin:'left',transformOrigin:'left', mozTransformOrigin:'left', msTransformOrigin:'left'});
						$.fn.luminationgallery.returnRotate(); 					
				} });
				returnflag=1;
			}
			else
			{
				$({deg:0}).animate({deg:-180}, { duration:1500, step:function(n){
					$('#roller').css({transform:' rotateX(30deg) rotateY('+-n+'deg)   ', webkitTransform:'   rotateY('+-n+'deg)    ', mozTransform:' rotateX(30deg) rotateY('+-n+'deg)', msTransform:' rotateX(30deg) rotateY('+-n+'deg)'});
                }, complete:function(){
						if(counter>0)
						{
                          distance-=parseInt(config.width);					
						  $('#roller').css({left:distance+'px'});
						  $.fn.luminationgallery.returnRotate(); 
						  counter--;
						}
						else
						{
							returnflag=0;
							$('#roller').css({webkitTransformOrigin:'right',transformOrigin:'right', mozTransformOrigin:'right', msTransformOrigin:'right'});

						   $.fn.luminationgallery.firstRotate(); 

						}
				} });
			}
				
			}
			
		}
	//	$.fn.luminationgallery.defaults={width:'210', height:'135', images:['1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg','7.jpg','8.jpg','9.jpg','10.jpg','11.jpg','12.jpg','13.jpg','14.jpg','15.jpg','16.jpg'], descs:['Eva Green','Sophie Marceaux','Alicia Witt','Amy Adams','Brittany Spears','Liver Liver','Emily Blunt','Gywinett Palterou','Paris & Helen','Julie Delpie','Kate Winslet','Debura Carr','Mareline Monroe','Natalie Riouet','Emily Blunt','Natasha Mclod'],cols:4, backgroundColor:'#BA18CE'};
		
	   function setConfig(value){config = value;}
	   function getConfig() {return config;}
	   



}(jQuery))