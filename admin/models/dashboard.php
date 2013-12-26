<?php
/**
 * Description of com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-25 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2 
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 
class SocialpromoterModelDashboard extends JModelItem{
    protected $_table;
    static private $_tableName = '#__com_socialpromoter_dashboard';
    
    public function __construct() {
        parent::__construct();
        $db = JFactory::getDbo();
        $this->_table = $db->nameQuote(self::$_tableName);
    }
    
    public function getDefault($id){
        $db = JFactory::getDbo();
        $key = $db->nameQuote('id');
        $query = "SELECT * FROM ".$this->_table.
                " WHERE ".$key." = ".$id;
        $db->setQuery($query);
        $default = $db->loadObject();
        if($default === null){
            JError::raiseError(500, 'Default '.$id.' Not found');
        }else{
            return $default;
        }
    }
    
    function getNewDefault(){
        $newDefault = $this->getTable( 'default' );
        $newDefault->id = 0;
        return $newDefault;
    }
    
    public function store(){
        $table = $this->getTable();
        $data = JRequest::get('post');
        jimport('joomla.utilities.date');
        $date = new JDate(JRequest::getVar('created', '', 'post'));
        $data['created'] = $date->toMySQL();
        $table->reset();
        //$table->set('row', $value);
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
}