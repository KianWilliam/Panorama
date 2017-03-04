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
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.controller');
jimport( 'joomla.application.component.helper' );


	class PanoramaControllerPanoramas extends JControllerLegacy
	{
		
		protected $items;
		protected $item;
		protected $state;
		protected $pangination;
		protected $form;
		protected $params;
		protected $task;
		
		public function __construct( $config = array() )
		{
          parent::__construct( $config );
          $this->registerTask( 'add',   'edit' );
          $this->registerTask( 'apply', 'save' );
         }
		 
		 public function setItems($items)
		 {
			 $this->items = $items;
		 }
		 public function getItems() {return $this->items;}
		 
		 public function setItem($item)
		 {
			 $this->item = $item;
		 }
		 public function getItem() {return $this->item;}
		 
		 public function setState($state)
		 {
			 $this->state = $state;
		 }
		 public function getState() {return $this->state;}
		 
		 public function setPagination($pagination)
		 {
			 $this->pagination = $pagination;
		 }
		 public function getPagination() {return $this->pagination;}
		 
		 public function setForm($form)
		 {
			 $this->form = $form;
		 }
		 public function getForm() {return $this->form;}
		 
		 public function setParams($params)
		 {
			 $this->params = $params;
		 }
		 public function getParams() {return $this->params;}
		 
		 public function setTask($task)
		 {
			 $this->task= $task;
		 }
		 public function getTask() {return $this->task;}

		public function display($cachable = false, $urlparams = false)
		{			
				$view = $this->getView('panoramas', 'html');
				$view->setLayout('list');
				$view->assign('galleries', $this->getItems() );
				$view->assign('state', $this->getState() );
				$view->assign('pagination', $this->getPagination() );
				$view->displayList();			
		}
		public function edit()
		{
			    $app = JFactory::getApplication()->input;
				$id=$app->get("id");
				if($id!=0)
				{
					$isNew = false;
				}
				else
				{
					$isNew = true;
				}
			    $view = $this->getView('panoramas', 'html');
				$view->setLayout('edit');
				$view->assign('gallery', $this->getItem() );
				$view->assign('form', $this->getForm() );
				$view->assign('isNew', $isNew );
				$view->displayEdit();
		}
		
		public function save()
		{
			$table= JTable::getInstance('Panoramas','PanoramaTable',array());
			$id=(int) $this->params['jform']['id'];
			if( $id != 0 )
			{
			   $table->load($id);
			}
			$table->title=$this->params['jform']['title'];
			$table->alias=$this->params['jform']['alias'];
			$table->published=$this->params['jform']['published'];
			$table->ordering=$this->params['jform']['ordering'];
			$table->bind(array('params'=>$this->params['jform']['params']));
			
			if(!$table->check())
			{
				echo $table->getError();
				return false;
			} 
		  
			if(!$table->store())
			{
				echo $table->getError();
				return false;
			} 
			if($this->task=="apply")
			{
			         $this->setRedirect('index.php?option=com_panorama&controller=panoramas&task=edit&id='.$table->id);
			}
			else
			{
                     $this->setRedirect('index.php?option=com_panorama&controller=panoramas');
			}

		}
		public function remove()
		{
				  $param =JFactory::getApplication()->input;
                  $id = $param->get('cid');

				foreach($id as $key=>$value)
				{
				   $table = JTable::getInstance('Panoramas', 'PanoramaTable', $config = array());
				   $table->load($value);
				   $table->delete();
				}
				$this->setRedirect('index.php?option=com_panorama&controller=panoramas');

		}
			public function publish()
		{
			$this->publishPublished(1);
		}
		public function unpublish()
		{
			$this->publishPublished(0);
		}
		public function publishPublished($flag)
		{
			      $param =JFactory::getApplication()->input;
                  $ids = $param->get('cid');
				
				foreach($ids as $key=>$value)
				{
					
				   $table = JTable::getInstance('Panoramas', 'PanoramaTable',  array());
                   $table->load($value);		
				   $table->published = $flag;
				   $table->store();
				  
				}
				
				
			$this->setRedirect('index.php?option=com_panorama&controller=panoramas');
		}
		public function cancel()
		{
			   $this->setRedirect('index.php?option=com_panorama&controller=panoramas');

		}
	}

?>