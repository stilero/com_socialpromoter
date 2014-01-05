<?php
/**
 * Description of com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2014-jan-05 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 
class SocialpromoterModelLog extends JModelItem{
    protected $_table;
    protected $_defaultSortColumn = 'created';
    static private $_tableName = '#__com_socialpromoter_logs';
    
    public function __construct($config = array()) {
        //Change the column_name1,2,3 to the column names you want sortable
        $config['filter_fields'] = array(
            'column_name_1',
            'column_name_2',
            'column_name_3'
            );
        parent::__construct($config);
    }
    /**
     * Returns an item with the id provided
     * @param integer $id
     * @return stdClass Resulting table object
     */
    public function getItem($id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*')->from(self::$_tableName)->where('id='.(int)$id);
        $db->setQuery($query);
        $result = $db->loadObject();
        if($result === null){
            JError::raiseError(500, 'Log '.$id.' Not found');
        }else{
            return $result;
        }
    }
    /**
     * Returns a new empty table object for creating new entries
     * @return stdClass Table object
     */
    function getNewItem(){
        $newItem =& $this->getTable( 'log' );
        $newItem->id = 0;
        return $newItem;
    }
    
    public function store(){
        $table = $this->getTable();
        $data = JRequest::get('post');
        jimport('joomla.utilities.date');
        $date = new JDate(JRequest::getVar('created', '', 'post'));
        $data['created'] = $date->toMySQL();
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
}