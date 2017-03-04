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

$row=$this->gallery;
$galleryID = $row->id;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>

<form action="<?php echo JRoute::_('index.php?option=com_panorama&controller=panoramas') ?>" method="post" name="adminForm" id="panoramas-form" class="form-validate">

              <div class="width-60 fltlft">
				    <fieldset class="adminform">
						<legend><?php echo empty($galleryID) ? JText::_('COM_PANORAMA_NEW') : JText::sprintf('COM_PANORAMA_SETTINGS', $galleryID); ?></legend>
						<ul class="adminformlist">
								<li><?php echo $this->form->getLabel('title'); ?>
				                <?php echo $this->form->getInput('title'); ?></li>

				                <li><?php echo $this->form->getLabel('alias'); ?>
				                <?php echo $this->form->getInput('alias'); ?></li>
				                
				                <li><?php echo $this->form->getLabel('published'); ?>
				                <?php echo $this->form->getInput('published'); ?></li>				             

				                <li><?php echo $this->form->getLabel('id'); ?>
				                  <?php echo $this->form->getInput('id'); ?></li>
						</ul>
						
					</fieldset>
			   </div>
			   	<div class="width-40 fltrt">
				<?php
				   $fieldSets = $this->form->getFieldsets('params');
                       foreach ($fieldSets as $name => $fieldSet) :
	                      echo JHtml::_('sliders.panel', JText::_($fieldSet->label), $name.'-params');
	                          if (isset($fieldSet->description) && trim($fieldSet->description)) :
		                              echo '<p class="tip">'.$this->escape(JText::_($fieldSet->description)).'</p>';
	                           endif;
	           ?>
			   	                <fieldset class="panelform">
		                             <ul class="adminformlist">
		                                 <?php foreach ($this->form->getFieldset($name) as $field) : ?>
			                                <li><?php echo $field->label; ?>
			                                <?php 
												
											    echo $field->input; 
												?>
											</li>
		                                  <?php endforeach; ?>
		                             </ul>
	                            </fieldset>
				<?php endforeach; ?>
			   <input type="hidden" name="task" value="" />
			   <input type="hidden" name="id" value="<?php echo $galleryID; ?>">
	           <?php echo JHtml::_('form.token'); ?>				
               </div>

</form>