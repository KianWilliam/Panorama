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
jimport( 'joomla.application.component.view');

class PanoramaViewPanoramas extends JViewLegacy
{
	public $state;
	public $pagination;
	
	public function displayList($tpl=null)
	{
		
		$title = JText::_('COM_PANORAMA'). " - ". JText::_('COM_PANORAMA_GALLERIES');
		JToolBarHelper::title($title , 'generic.png');
		JToolBarHelper::addNew();
		JToolBarHelper::deleteList();
		JToolBarHelper::divider();
		JToolBarHelper::publishList();
		JToolBarHelper::unpublishList();
		parent::display($tpl);
	}
	public function displayEdit($tpl=null)
	{
		$app = JFactory::getApplication();
		$input = $app->input;
		$input->set('hidemainmenu', true);		
		$title = JText::_('COM_PANORAMA')." - ";
		
		if($this->isNew)
			$title .= '<small>[ ' . JText::_( 'COM_PANORAMA_NEW' ).' ]</small>'; 
		else 
			$title .= $this->gallery->title." <small>[".JText::_("COM_PANORAMA_EDIT_SETTINGS")."]</small>";
		
		   JToolBarHelper::title($title   , 'generic.png' );
		   JToolBarHelper::save();
			JToolBarHelper::spacer();
            JToolBarHelper::apply();
			JToolBarHelper::spacer();
			JToolBarHelper::cancel();
			JToolBarHelper::spacer();
			JToolBarHelper::back();			
		parent::display($tpl);
	}
}
	

?>