<?php 
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
?>
<?php
defined('_JEXEC') or die;
JHtml::_('jquery.framework');
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::Base()."components/com_panorama/assets/css/pano.css");
if($this->item->params->get('lib')==1)
{
   $document->addScript(JURI::Base()."components/com_panorama/assets/js/jquery.js");
}
  $document->addScript(JURI::Base()."components/com_panorama/assets/js/pano.js");
  $noConflict = "var pa = jQuery.noConflict()";
  $document->addScriptDeclaration($noConflict);
  
  $items = json_decode(str_replace("|qq|", "\"", $this->item->params->get('slides')));
   foreach($items as $i=>$item)
   { 
	
		$images[] = JURI::base().$item->imgname;	
		$texts[]=$item->imgtext;
	
   }
    $mypano = "
	pa(document).ready(function(){
		pa('#p3D').luminationgallery.config({width:'".$this->item->params->get('image_width')."', height:'".$this->item->params->get('image_height')."',  speed:'".$this->item->params->get('gallery_speed')."',  backgroundColor:'".$this->item->params->get('backgroundcolor')."', cols:'".$this->item->params->get('gallery_cols')."',  persp:'".$this->item->params->get('gallery_perspective')."'});
		pa('#p3D').luminationgallery.init();	

	});
	pa.fn.luminationgallery.defaults = {};
	pa.fn.luminationgallery.defaults.images = [];
	pa.fn.luminationgallery.defaults.descs= [];
	pa.fn.luminationgallery.defaults.width=170;
	pa.fn.luminationgallery.defaults.height=170;
	pa.fn.luminationgallery.defaults.cols=4;
	pa.fn.luminationgallery.defaults.backgroundColor='#eb1bcd';
	pa.fn.luminationgallery.defaults.speed=1500;
    pa.fn.luminationgallery.defaults.persp=250;

	

	var myimages = ".json_encode($images).";
	var mydescs = ".json_encode($texts).";
	for(var g=0; g<myimages.length; g++)
	{
	    pa.fn.luminationgallery.defaults.images[g] = myimages[g];	
		pa.fn.luminationgallery.defaults.descs[g] = mydescs[g];	
	}
	
  ";
  $document->addScriptDeclaration($mypano);
  $myimg = "
#p3D div img { 
width:".$this->item->params->get('image_width')."px;
height:".$this->item->params->get('image_height')."px;
}
";
$document->addStyleDeclaration($myimg);
?>
<div class="mpanogal<?php echo $this->pageclass_sfx?>">

	<div class="mpanogal<?php echo $this->pageclass_sfx?>">
         		 
	     <?php if ($this->item->title) : ?>
		    <h2>
			     <span class="panorama3D-name"><?php echo $this->item->title; ?></span>
		    </h2>
	     <?php endif;  ?>
		 <div id="p3D" class="panogal">
		 </div>

		 
	</div>

</div>
