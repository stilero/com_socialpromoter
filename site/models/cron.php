<?php
/**
 * Description of com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-29 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla modelitem library
jimport('joomla.application.component.model');
jimport( 'joomla.plugin.helper' );
 
class SocialpromoterModelCron extends JModelLegacy{
    
    public function getItems(){
        return JPluginHelper::getPlugin('socialpromoter');
    }
    /**
     * Sets the post as posted
     * @param int $id
     */
    public function setPosted($id){
        $date = new JDate();
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->update('#__com_socialpromoter_queue');
        $query->set('posted='.$db->q($date->toSql()));
        $query->where('id='.(int)$id);
        $db->setQuery($query);
        $db->query();
    }
    
    /**
     * Returns all unposted items from DB
     * @return object
     */
    public function getNextItem($plugin){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__com_socialpromoter_queue');
        $query->where('posted='.$db->q('0000-00-00 00:00:00'));
        if(isset($plugin)){
            $query->where('plugin='.$db->q($plugin));
        }
        $query->order('created ASC');
        $db->setQuery($query);
        $items = $db->loadObject();
        return $items;
    }
    /**
     * Adds info to log
     * @param array $data
     * @return boolean
     */
    public function log($url, $plugin, $code, $msg){
        $table = $this->getTable('log');
        //$data = JRequest::get('post');
        jimport('joomla.utilities.date');
        $date = new JDate(JRequest::getVar('created', '', 'post'));
        $data = array(
            'url' => $url,
            'plugin' => $plugin,
            'code' => $code,
            'msg' => $msg,
            'created' => $date->toSql()
        );
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
}