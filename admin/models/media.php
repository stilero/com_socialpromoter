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
 * This file is part of media.
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
jimport('joomla.application.component.modelitem');
jimport('joomla.filesystem.folder');
 
class SocialpromoterModelMedia extends JModelItem{
    protected $_table;
    protected $_defaultSortColumn = 'default_column_name';
    static private $_tableName = '#__com_socialpromoter_medias';
    
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
    
    public function getFolders($base=null){
        if($base == null){
            if( !defined('COM_MEDIA_BASE')){
                define('COM_MEDIA_BASE', JPATH_ROOT.DS.'images');
            }
            $base=COM_MEDIA_BASE;
        }
        $folders = JFolder::folders($base, '.', true, true);
        var_dump($folders);exit;
        return $folders;
    }
    protected function pathToUri($file){
        $uri = str_replace(JPATH_ROOT.DS, JUri::root(), $file);
        return $uri;
    }
    public function getMediaInFolder($base, $asUri = false){
        $files = JFolder::files($base, '.jpg', true, true);
        if($asUri){
            $convertedFiles = array_map(array($this, 'pathToUri'), $files);
        }else{
            $convertedFiles = $files;
        }
        return $convertedFiles;
    }
    
    function getNewMedia(){
        $newMedia =& $this->getTable( 'media' );
        $newMedia->id = 0;
        return $newMedia;
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