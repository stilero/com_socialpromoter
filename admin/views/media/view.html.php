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
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
JLoader::import('joomla.application.component.model');
JLoader::register('SocialpromoterMenuhelper', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_socialpromoter'.DS.'helpers'.DS.'menuhelper.php'); 
JModelLegacy::addIncludePath (JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_media' . DS . 'models');
//JLoader::register('MediaModelList', JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_media' . DS . 'models' . DS . 'list.php');
/**
 * HTML View class for the HelloWorld Component
 */
class SocialpromoterViewMedia extends JViewLegacy{
    function display($tpl = null) {
        JToolBarHelper::title(JText::_('MEdia'), 'media');
        SocialpromoterMenuhelper::addSubmenu('media');
        //$model = JModelLegacy::getInstance('List');
        //$model = JModelLegacy::getInstance('manager', 'MediaModel');
        //$items = $model->getFolderList();
        $js = JUri::root().'administrator/components/com_socialpromoter/assets/js/queue.js';
        JHTML::script('https://code.jquery.com/jquery.js');
        JHTML::script($js);
        $model = $this->getModel();
        $items=$model->getMediaInFolder(JPATH_ROOT.DS.'images', false);
        $this->assignRef('items', $items);
        parent::display($tpl);
    }
}
