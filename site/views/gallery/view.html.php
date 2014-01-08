<?php
/**
 * Gallery View Class
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2014-jan-07 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
jimport( 'joomla.plugin.helper' );
 
/**
 * HTML View class for the GALLERY Class
 */
class SocialpromoterViewGallery extends JViewLegacy{
    /**
     * Displays the items
     * @param string $tpl template to use
     */
    function display($tpl = null) {
        $model = $this->getModel('gallery');
        $items = $model->getItems();
        
        $itemsWithComments = array();
        foreach ($items as $item) {
            $dispatcher = JDispatcher::getInstance();
            JPluginHelper::importPlugin('socialpromoter', $item->plugin, false);
            $className = 'plgSocialpromoter'.ucfirst($item->plugin);
            $pluginClass = new $className($dispatcher, array());
            $response = $pluginClass->getComments($item->msg);
            if(!empty($response)){
                $item->comments = $response;
            }
            $itemsWithComments[] = $item;
        }
        $this->assignRef('items', $itemsWithComments);
        parent::display($tpl);
    }
}
