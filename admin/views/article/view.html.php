<?php
/**
 * Description of com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-26 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
  */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// import Joomla view library
jimport('joomla.application.component.view');
JLoader::register('SocialpromoterMenuhelper', JPATH_ADMINISTRATOR.DS.'components'.DS.'com_socialpromoter'.DS.'helpers'.DS.'menuhelper.php'); 
 
/**
 * HTML View class for the HelloWorld Component
 */
class SocialpromoterViewArticle extends JViewLegacy{
    
    public function display($tpl=null) {
        JToolBarHelper::title(JText::_('Articles'), 'article');
        SocialpromoterMenuhelper::addSubmenu('article');
        $items = $this->get('Items');
        $state = $this->get('State');
        $this->sortDirection = $state->get('list.direction');
        $this->sortColumn = $state->get('list.ordering');
        $this->assignRef('items', $items);
        parent::display($tpl);
    }
    
    function edit($id) {
        JToolBarHelper::title(JText::_('Com_socialpromoter View.html: [<small>Edit</small>]', 'generic.png'));
        JToolBarHelper::save();
        JToolBarHelper::cancel('cancel', 'Close');
        $model =& $this->getModel();
        $items = $model->getArticle( $id );
        $this->assignRef('items', $items);
        parent::display();
    }
    
    function add(){
        JToolBarHelper::title( JText::_('Com_socialpromoter View.html')
                . ': [<small>Add</small>]' );
        JToolBarHelper::save();
        JToolBarHelper::cancel();
        $model =& $this->getModel();
        $items = $model->getNewArticle();
        $this->assignRef('items', $items);
        parent::display();
    }
}
