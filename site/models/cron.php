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
 * This file is part of cron.
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
    public function getNextItem(){
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from('#__com_socialpromoter_queue');
        $query->where('posted='.$db->q('0000-00-00 00:00:00'));
        $query->order('created ASC');
        $db->setQuery($query);
        $items = $db->loadObject();
        return $items;
    }
}