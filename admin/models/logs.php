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
jimport('joomla.application.component.model');
 
class SocialpromoterModelLogs extends JModelLegacy{
    protected $_logs;
    static private $_tableName = '#__com_socialpromoter_logs';

    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Returns all Items found in table
     * @return stdClass Table object
     */
    public function getItems(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(TRUE);
        $query->select('*')->from(self::$_tableName);
        $db->setQuery($query);
        $result = $db->loadObjectList();
        if($result === null){
            JError::raiseError(500, 'Logs Not found');
        }else{
            $this->_logs = $result;
            return $result;
        }
    }
    /**
     * Deletes rows from the table
     * @param array $cids Array of ID's to delete
     */
    public function delete($cids){
        $db = JFactory::getDbo();
        $query = $db->getQuery(TRUE);
        $ids = implode(', ', $cids);
        $query->delete(self::$_tableName)->where('id IN ('.$ids.')');
        $db->setQuery($query);
        if( !$db->query() ){
            $errorMsg = $this->getDBO()->getErrorMsg();
            JError::raiseError(500, 'Error deleting: '.$errorMsg);
        }
    }
    /**
     * Unpublished items
     * @param array $cids Array of IDs to unpublish
     */
    public function unpublish($cids){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $ids = implode(', ', $cids);
        $query->update(self::$_tableName)->set('published = 0')->where('id IN ('.$ids.')');
        $db->setQuery($query);
        if( !$db->query() ){
            $errorMsg = $this->getDBO()->getErrorMsg();
            JError::raiseError(500, 'Error Unpublishing: '.$errorMsg);
        }
    }
    /**
     * Publish Items
     * @param array $cids Array of Items to Publish
     */
    public function publish($cids){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $ids = implode(', ', $cids);
        $query->update(self::$_tableName)->set('published = 1')->where('id IN ('.$ids.')');
        $db->setQuery($query);
        if( !$db->query() ){
            $errorMsg = $this->getDBO()->getErrorMsg();
            JError::raiseError(500, 'Error Publishing: '.$errorMsg);
        }
    }
}