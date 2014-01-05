<?php
/**
 * Logs View Class
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2014-jan-05 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
JLoader::register('SocialpromoterMenuhelper', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_socialpromoter'.DS.'helpers'.DS.'menuhelper.php'); 
 
/**
 * HTML View class for the LOGS Class
 */
class SocialpromoterViewLogs extends JViewLegacy{
    /**
     * Displays the items
     * @param string $tpl template to use
     */
    function display($tpl = null) {
        SocialpromoterMenuhelper::addSubmenu('logs');
        $model = $this->getModel('logs');
        $items = $model->getItems();
        $this->assignRef('items', $items);
        parent::display($tpl);
    }
}
