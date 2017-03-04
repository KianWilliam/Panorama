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
$galleries=$this->galleries;
$count=count($galleries);
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canOrder = true; 
$saveOrder = $listOrder == 'a.ordering';
?>

<form action="index.php?option=com_panorama&controller=panoramas" method="post" name="adminForm" id="adminForm">

<table class="adminlist">

	<thead>
		<tr>
                <th width="1%">
                    <input type="checkbox" name="checkall-toggle" value="" onclick="Joomla.checkAll(this)" />
                </th>
                <th width="3%">
                    <?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
                </th>
                								
                <th width="1%">
                    <?php echo JHtml::_('grid.sort', 'JPUBLISHED', 'a.published', $listDirn, $listOrder); ?>
                </th>
                <th width="1%">
                    <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ORDERING', 'a.ordering', $listDirn, $listOrder); ?>
                    <?php if ($canOrder && $saveOrder) : ?>
                        <?php echo JHtml::_('grid.order', $galleries, 'filesave.png', 'items.saveorder'); ?>
                    <?php endif; ?>
                </th>
                <th width="1%">
                    <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                </th>
            </tr>
	 </thead>
	 <tfoot>
            <tr>
                <td colspan="10">
                     <?php echo $this->pagination->getListFooter(); ?>
                </td>
            </tr>
     </tfoot>
	 <tbody>
	 <?php foreach($galleries as $i => $gallery) { ?>
	 <?php 
	       $canChange = true;
		   $ordering = ($listOrder == 'a.ordering');
	 ?>
				<tr class="row<?php echo $i % 2; ?>">
					<td class="center">
                       <?php echo JHtml::_('grid.id', $i, $gallery->id); ?>
                    </td>
					<td style="width:1%; text-align:center">
                        <a href="<?php echo JRoute::_('index.php?option=com_panorama&controller=panoramas&task=edit&id='.(int) $gallery->id); ?>"><?php echo $gallery->title ?></a>
                        <p class="smallsub">
                        <?php echo JText::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($gallery->alias)); ?>
                        </p>
                    </td>
					<td class="center">
                       <?php echo JHtml::_('jgrid.published', $gallery->published, $i); ?>
                    </td>
					<td class="order" style="text-align:center">
                        <?php if ($canChange) : ?>
                               <?php if ($saveOrder) : ?>
                                <?php if ($listDirn == 'asc') : ?>
                                    <span><?php echo $this->pagination->orderUpIcon($i, ($gallery->ordering == @$this->galleries[$i - 1]->ordering), 'panoramas.orderup', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
                                    <span><?php echo $this->pagination->orderDownIcon($i, $count, ($gallery->ordering == @$this->galleries[$i + 1]->ordering), 'panoramas.orderdown', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
                                <?php elseif ($listDirn == 'desc') : ?>
                                    <span><?php echo $this->pagination->orderUpIcon($i, ($gallery->ordering == @$this->galleries[$i - 1]->ordering), 'panoramas.orderdown', 'JLIB_HTML_MOVE_UP', $ordering); ?></span>
                                    <span><?php echo $this->pagination->orderDownIcon($i, $count, ($gallery->ordering == @$this->galleries[$i + 1]->ordering), 'panoramas.orderup', 'JLIB_HTML_MOVE_DOWN', $ordering); ?></span>
                                <?php endif; ?>
                        <?php endif; ?>
                            <?php $disabled = $saveOrder ? '' : 'disabled="disabled"'; ?>
                            <input  type="text" name="order[]" size="5" value="<?php echo $gallery->ordering; ?>" <?php echo $disabled ?> class="text-area-order" />
                        <?php else : ?>
                            <?php echo $gallery->ordering; ?>
                        <?php endif; ?>
                   </td>
				   <td align="center">
                        <?php echo $gallery->id; ?>
                   </td>
				</tr>
	 <?php  } ?>
     </tbody>
</table>
<div>
        <input type="hidden" name="task" value="" />
        <input type="hidden" name="boxchecked" value="0" />
        <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>" />
        <?php echo JHtml::_('form.token'); ?>
</div>


</form>


