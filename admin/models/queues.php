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
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * 
 * This file is part of queue.
 * 
 * com_socialpromoter is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * com_socialpromoter is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with com_socialpromoter.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.model');
jimport('joomla.utilities.date');
JLoader::discover('StileroSP', JPATH_ADMINISTRATOR.'/components/com_socialpromoter/library/',true, true);
 
class SocialpromoterModelQueues extends JModelLegacy{
    protected $_items;
    private $_table;
    static private $_tableName = '#__com_socialpromoter_queue';

    public function __construct() {
        parent::__construct();
        $db = JFactory::getDbo();
        $this->_table = $db->nameQuote(self::$_tableName);
    }
    
    /**
     * Retrieves all items currently queued
     * @return stdClass Items
     */
    public function getItems(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from(self::$_tableName);
        $query->where('posted='.$db->q('0000-00-00 00:00:00'));
        $db->setQuery($query);
        $this->_items = $db->loadObjectList();
        return $this->_items;
    }
    /**
     * Retrieves all items
     * @return type
     */
    public function getAllItems(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('url');
        $query->from(self::$_tableName);
        $db->setQuery($query);
        $this->_items = $db->loadObjectList();
        return $this->_items;
    }

    public function getItem($id){
        $db = JFactory::getDbo();
        $key = $db->nameQuote('id');
        $query = "SELECT * FROM ".$this->_table.
                " WHERE ".$key." = ".$id;
        $db->setQuery($query);
        $item = $db->loadObject();
        if($item === null){
            JError::raiseError(500, 'Item '.$id.' Not found');
        }else{
            return $item;
        }
    }
    
    protected function addHashtag($keyword){
        return '#'.$keyword;
    }
    /**
     * Adds an image path to the queue
     * @param string $imagepath URL to the image
     */
    function add($imagepath){
        $Ipct = new StileroSPIptc($imagepath);
        //$Exif = new StileroSPExif($imagepath);
        $title = $Ipct->title;
        $description = $Ipct->description;
        $url = str_replace(JPATH_ROOT.'/', JUri::root(), $imagepath);
        $hashtagged = array_map(array($this, 'addHashtag'), $Ipct->keywords);
        $tags = implode(', ', $hashtagged);
        $date = new JDate();
        $data = array(
            'title' => $title,
            'description' => $description,
            'url' => $url,
            'tags' => $tags,
            'created' => $date->toSql()
        );
        $table = $this->getTable('queue');
        $table->reset();
        $table->id = 0;
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
    
//    function getNewItem(){
//        $newItem = $this->getTable( 'queue' );
//        $newItem->id = 0;
//        return $newItem;
//    }
    
//    public function store(){
//        $table = $this->getTable();
//        $data = JRequest::get('post');
//        jimport('joomla.utilities.date');
//        $date = new JDate(JRequest::getVar('created', '', 'post'));
//        $data['created'] = $date->toMySQL();
//        $table->reset();
//        if(!$table->bind($data)){
//            $this->setError($this->_db->getErrorMsg());
//            return false;
//        }
//        if(!$table->check()){
//            $this->setError($this->_db->getErrorMsg());
//            return false;
//        }
//        if(!$table->store()){
//            $this->setError($this->_db->getErrorMsg());
//            return false;
//        }
//        return true;
//    }

    public function delete($id){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->delete(self::$_tableName);
        $query->where('id='.(int)$id);
        $db->setQuery($query);
        if( !$db->query() ){
            return false;
        }else{
            return true;
        }
    }
    
//    public function unpublish($cids){
//        $db = JFactory::getDbo();
//        $id = $db->nameQuote('id');
//        $published = $db->nameQuote('published');
//        $ids = implode(', ', $cids);
//        $query = 'UPDATE '.$this->_table.
//                ' SET '.$published.' = 0'.
//                ' WHERE '.$id.' IN ('.$ids.')';
//        $db->setQuery($query);
//        if( !$db->query() ){
//            $errorMsg = $this->getDBO()->getErrorMsg();
//            JError::raiseError(500, 'Error Unpublishing: '.$errorMsg);
//        }
//    }
    
//    public function publish($cids){
//        $db = JFactory::getDbo();
//        $id = $db->nameQuote('id');
//        $published = $db->nameQuote('published');
//        $ids = implode(', ', $cids);
//        $query = 'UPDATE '.$this->_table.
//                ' SET '.$published.' = 1'.
//                ' WHERE '.$id.' IN ('.$ids.')';
//        $db->setQuery($query);
//        if( !$db->query() ){
//            $errorMsg = $this->getDBO()->getErrorMsg();
//            JError::raiseError(500, 'Error Unpublishing: '.$errorMsg);
//        }
//    }
    
    /**
     * Clears the queue and deletes all rows that hasn't been posted
     */
    public function clear(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->delete(self::$_tableName);
        $query->where('posted = '.$db->q('0000-00-00 00:00:00'));
        $db->setQuery($query);
        if( !$db->query() ){
            $errorMsg = $this->getDBO()->getErrorMsg();
            JError::raiseError(500, 'Error Clearing: '.$errorMsg);
        }
    }
    
    /**
     * Checks if an url already exists in the database
     * @param string $imagepath Path to the file
     * @return boolean True if found
     */
    public function isQueued($imagepath){
        $url = $url = str_replace(JPATH_ROOT.'/', JUri::root(), $imagepath);
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from(self::$_tableName);
        $query->where('url='.$db->q($url));
        $db->setQuery($query);
        $result = $db->loadAssoc();
        if($result){
            return true;
        }else{
            return false;
        }
    }
}