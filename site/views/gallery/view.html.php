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
        $this->assignRef('items', $items);
        parent::display($tpl);
    }
}
