<?php
/**
 * Description of com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2014-jan-07 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.model');
 
class SocialpromoterModelGallery extends JModelLegacy{
    protected $_gallery;
    private $_table;
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
            JError::raiseError(500, 'Gallery Not found');
        }else{
            $this->_gallery = $result;
            return $result;
        }
    }
}