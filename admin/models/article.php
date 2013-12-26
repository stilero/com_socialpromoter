<?php
/**
 * Description of com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-26 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 * 
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.modelitem');
 
class SocialpromoterModelArticle extends JModelItem{
    protected $_table;
    protected $_defaultSortColumn = 'id';
    static private $_tableName = '#__content';
    
    public function __construct($config = array()) {
        //Change the column_name1,2,3 to the column names you want sortable
        $config['filter_fields'] = array(
            'id',
            'title',
            'created'
            );
        parent::__construct($config);
        $db = JFactory::getDbo();
        $this->_table = $db->nameQuote(self::$_tableName);
    }
    
    /**
     * Returns all published articles
     */
    public function getItems(){
        $db = JFactory::getDbo();
        $query = $this->getListQuery();
        $query->select('*');
        $query->from(self::$_tableName);
        $query->where('state=1');
        $query->where('access=1');
        $db->setQuery($query);
        $db->query();
        return $db->loadObjectList();
    }
    
    public function getArticle($id){
        $db = JFactory::getDbo();
        $key = $db->nameQuote('id');
        $query = "SELECT * FROM ".$this->_table.
                " WHERE ".$key." = ".$id;
        $db->setQuery($query);
        $articles = $db->loadObject();
        if($articles === null){
            JError::raiseError(500, 'Article '.$id.' Not found');
        }else{
            return $articles;
        }
    }
    
    function getNewArticle(){
        $newArticles =& $this->getTable( 'articles' );
        $newArticles->id = 0;
        return $newArticles;
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