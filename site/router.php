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
function PanoramaBuildRoute(&$query)
{
		$segments = array();
		
			$app		= JFactory::getApplication();
	        $menu		= $app->getMenu();
	        $params		= JComponentHelper::getParams('com_panorama');
			$advanced	= $params->get('sef_advanced_link', 0);

			$menuItem = $menu->getActive();
			$mId	= (empty($menuItem->query['title'])) ? null : $menuItem->query['title'];
			$mController= (empty($menuItem->query['controller'])) ? null : $menuItem->query['controller'];

			
			
	
	if ( (isset($query['title'])) and ($mId == intval($query['title'])) and (isset($query['controller'])) and ($mController == $query['controller'])   ) {
		unset($query['title']);
		unset($query['controller']);
		return $segments;
	}	
	
		
			if ($mId != intval($query['title'])) {
				
				  if ($advanced) {
					list($tmp, $title) = explode(':', $query['title'], 2);
				  }
				   else {
					$title = $query['title'];
				  }

				$segments[] = $title;
			  
			}
			
			if ($mController != $query['controller']) {
				
				  
					$segments[] = $query['controller'];
				  
			  
			}
			
			
			
			unset($query['title']);
			unset($query['controller']);
			

		
	
		
	
		



	return $segments;


}
function PanoramaParseRoute($segments)
{
		$vars = array();
		
			$app	= JFactory::getApplication();
	        $menu	= $app->getMenu();
	        $item	= $menu->getActive();
	        $params = JComponentHelper::getParams('com_panorama');
			
		    $count = count($segments);
			
		if (!isset($item)) {
		$vars['id']		= $segments[$count - 1];
		$vars['controller']		= $segments[0];
		return $vars;
	   }
	   
		$id = (isset($item->query['title']) && $item->query['title'] >= 1) ? $item->query['title'] : 'root';
		$vars['id'] = $id;
		$controller = (isset($item->query['controller']) ) ? $item->query['controller'] : 'root';
		$vars['controller'] = $controller;
		return $vars;

}

