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
JLoader::register('SocialpromoterMenuhelper', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_socialpromoter'.DS.'helpers'.DS.'menuhelper.php'); 

 
/**
 * HTML View class for the HelloWorld Component
 */
class SocialpromoterViewQueues extends JViewLegacy{
    
    function display($tpl = null) {
        JToolBarHelper::title(JText::_('Queue'), 'queues');
        //JToolBarHelper::deleteList();
        //JToolBarHelper::editListX();
        //JToolBarHelper::addNewX();
        
        SocialpromoterMenuhelper::addSubmenu('queues');
        $js = JUri::root().'administrator/components/com_socialpromoter/assets/js/queuedelete.js';
        JHTML::script('https://code.jquery.com/jquery.js');
        JHTML::script($js);
        $model = $this->getModel('queues');
        $items = $model->getItems();
        $this->assignRef('items', $items);
        parent::display($tpl);
    }
    
    function edit($id) {
        JToolBarHelper::title(JText::_('Com_socialpromoter Queue: [<small>Edit</small>]', 'generic.png'));
        JToolBarHelper::save();
        JToolBarHelper::cancel('cancel', 'Close');
        $model = $this->getModel();
        $item = $model->getItem( $id );
        $this->assignRef('item', $item);
        parent::display();
    }
    
    
    
    function add(){
        //JToolBarHelper::title( JText::_('Com_socialpromoter Queue')
                //. ': [<small>Add</small>]' );
        //JToolBarHelper::save();
        //JToolBarHelper::cancel();
        SocialpromoterMenuhelper::addSubmenu('queues');
        $app = JFactory::getApplication();
        JSession::checkToken('get') or die( 'Invalid Token' );
        $model = $this->getModel();
        $path = $app->input->getString('path');
        $result = false;
        if(!$model->isQueued($path)){
            $result = $model->add($path);
        }
        $this->assignRef('result', $result);
        $this->setLayout('raw');
        parent::display();
    }
    function hide(){
        SocialpromoterMenuhelper::addSubmenu('queues');
        $app = JFactory::getApplication();
        JSession::checkToken('get') or die( 'Invalid Token' );
        $model = $this->getModel();
        $path = $app->input->getString('path');
        $result = false;
        if(!$model->isQueued($path)){
            $result = $model->hide($path);
        }
        $this->assignRef('result', $result);
        $this->setLayout('raw');
        parent::display();
    }
}
