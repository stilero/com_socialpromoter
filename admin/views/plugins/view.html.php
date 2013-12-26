<?php
/**
 * Description of com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-25 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
jimport( 'joomla.plugin.helper' );

JLoader::register('SocialpromoterHelper', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_socialpromoter'.DS.'helpers'.DS.'socialpromoter.php'); 
JLoader::register('SocialpromoterMenuhelper', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_socialpromoter'.DS.'helpers'.DS.'menuhelper.php'); 
/**
 * HTML View class for the HelloWorld Component
 */
class SocialpromoterViewPlugins extends JViewLegacy{
    
    function display($tpl = null){
        //JToolBarHelper::title(JText::_('Not Authorized'), 'user');
        //JToolBarHelper::preferences('com_socialpromoter');
        JToolBarHelper::title(JText::_('Plugins'), 'plugins');
        SocialpromoterMenuhelper::addSubmenu('plugins');
        //$params = JComponentHelper::getParams('com_socialpromoter');
        
        //JHtml::stylesheet(JURI::root().'administrator/components/com_instaboard/assets/css/style.css');
        JHtml::stylesheet(JURI::root().'administrator/components/com_instaboard/assets/bootstrap/css/bootstrap-grid.min.css');
        JHtml::stylesheet(JURI::root().'administrator/components/com_instaboard/assets/bootstrap/css/bootstrap-icon.min.css');
        JHtml::stylesheet(JURI::root().'administrator/components/com_instaboard/assets/bootstrap/css/bootstrap-thumbs.min.css');
        //JHtmlBehavior::framework(true);
        JHtml::_('behavior.framework'); 
        JHtml::script(JURI::root().'administrator/components/com_instaboard/assets/js/lazyload.js');
        JHTML::_('behavior.modal'); 
        $model = $this->getModel('plugins');
        $items = $model->getPlugins();
        $this->assignRef('items', $items);
        parent::display($tpl);
    }
    
    
}
