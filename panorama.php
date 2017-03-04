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
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.framework');
JHtml::_('bootstrap.framework');
JModelLegacy::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_panorama/models');
$mainframe = JFactory::getApplication()->input;
$task = $mainframe->get("task");
$controller = $mainframe->getString('controller');

if(isset($controller)){
include (JPATH_ADMINISTRATOR . '/components/com_panorama/controllers/'.$controller.'.php');
$controller = ucfirst($controller);
$classname = 'PanoramaController'.$controller;
}
else
{
	 include (JPATH_ADMINISTRATOR . '/components/com_panorama/controllers/panoramas.php');
	$classname = 'PanoramaControllerPanoramas';

}
$mycontroller = new $classname();
$mycontroller->setParams($mainframe->post->getArray(array()));

if( $task == "add" || $task == "apply" || $task=="edit" )
{
	
	$mymodel = JModelLegacy::getInstance('Panorama','PanoramaModel');

	$item = $mymodel->getItem();
	$form = $mymodel->getForm();
	$mycontroller->setItem($item);
	$mycontroller->setForm($form);
	$mycontroller->setTask($task);
	
	
}
else
{
	$mymodel = JModelLegacy::getInstance('Panoramas', 'PanoramaModel');
	$state = $mymodel->getState();
	$pagination = $mymodel->getPagination();
	$items = $mymodel->getItems();
	$mycontroller->setItems($items);
	$mycontroller->setState($state);
	$mycontroller->setPagination($pagination);
}
$mycontroller->execute($task);
$mycontroller->redirect();	

