<?php
/**
 * Description of com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-29 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 * 
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
//jimport('joomla.application.component.modelitem');
 
class SocialpromoterModelQueue extends JModelAdmin{
    protected $_table;
    protected $_defaultSortColumn = 'default_column_name';
    static private $_tableName = '#__com_socialpromoter_queue';
    
    public function __construct($config = array()) {
        //Change the column_name1,2,3 to the column names you want sortable
        $config['filter_fields'] = array(
            'column_name_1',
            'column_name_2',
            'column_name_3'
            );
        parent::__construct($config);
        $db = JFactory::getDbo();
        $this->_table = $db->nameQuote(self::$_tableName);
    }
    
    public function getQueue($id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from(self::$_tableName);
        $query->where('id='.(int)($id));
        $db->setQuery($query);
        $queue = $db->loadObject();
        if($queue === null){
            JError::raiseError(500, 'Queue with id: '.$id.' Not found');
        }else{
            return $queue;
        }
    }
    
    function getNewQueue(){
        $newQueue =& $this->getTable( 'queue' );
        $newQueue->id = 0;
        return $newQueue;
    }
    
    public function store(){
        $table = $this->getTable('queue');
        $post = JRequest::get('post');
        $data = $post['jform'];
        jimport('joomla.utilities.date');
        $date = new JDate(JRequest::getVar('created', '', 'post'));
        $data['created'] = $date->toSql();
        $table->reset();
        if(!$table->bind($data)){
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        if(!$table->check()){
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        if(!$table->store()){
            $this->setError($this->_db->getErrorMsg());
            return false;
        }
        return true;
    }
    /**
     * The first thing you need to do is to populate the order state of your model. 
     * Change 'default_column_name' to the name of the column you want to use as 
     * the default sort, and change the second parameter to DESC if you wish 
     * the default order direction to be descending. Calling the parents 
     * populateState method will make sure that the State object is filled and 
     * accessible to all of the code that might need it.
     */
    protected function populateState($ordering = null, $direction = null) {
        parent::populateState($this->_defaultSortColumn, 'ASC');
    }
    
    /**
     * Method adds sorting to the query
     */
    public function getListQuery() {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
 
        $query->order($db->escape($this->getState('list.ordering', $this->_defaultSortColumn)).' '.
                $db->escape($this->getState('list.direction', 'ASC')));
        return $query;
    }
    
    public function getForm($data = array(), $loadData = true)
	{
		// Get the form.
		$form = $this->loadForm('com_socialpromoter.queue', 'queue', array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

//		// Determine correct permissions to check.
//		if ($this->getState('queue.id'))
//		{
//			// Existing record. Can only edit in selected categories.
//			$form->setFieldAttribute('catid', 'action', 'core.edit');
//		}
//		else
//		{
//			// New record. Can only create in selected categories.
//			$form->setFieldAttribute('catid', 'action', 'core.create');
//		}

//		// Modify the form based on access controls.
//		if (!$this->canEditState((object) $data))
//		{
//			// Disable fields for display.
//			$form->setFieldAttribute('ordering', 'disabled', 'true');
//			$form->setFieldAttribute('state', 'disabled', 'true');
//			$form->setFieldAttribute('publish_up', 'disabled', 'true');
//			$form->setFieldAttribute('publish_down', 'disabled', 'true');
//
//			// Disable fields while saving.
//			// The controller has already verified this is a record you can edit.
//			$form->setFieldAttribute('ordering', 'filter', 'unset');
//			$form->setFieldAttribute('state', 'filter', 'unset');
//			$form->setFieldAttribute('publish_up', 'filter', 'unset');
//			$form->setFieldAttribute('publish_down', 'filter', 'unset');
//		}

		return $form;
	}
        
        protected function loadFormData()
	{
            $app = JFactory::getApplication();
        $id = $app->input->getInt('id');
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_socialpromoter.edit.queue.data', array());

		if (empty($data))
		{
			$data = $this->getQueue($id);

		}

		$this->preprocessData('com_socialpromoter.queue', $data);

		return $data;
	}
}