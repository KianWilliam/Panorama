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
defined( '_JEXEC' ) or die('Restricted access');
jimport('joomla.application.component.controller');

class PanoramaControllerPanoramas extends JControllerLegacy
{
	protected $item;
	public function setItem($item)
	{
		$this->item = $item;
	}
	public function getItem() {return $this->item;}
	
	public  function display($cachable = false, $urlparams = false)
	{
				$view = $this->getView('panorama','html');
				$view->assign("item", $this->getItem());
				$view->display();
				
	}

}