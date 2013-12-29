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
 
// import Joomla view library
jimport('joomla.application.component.view');
 
/**
 * HTML View class for the HelloWorld Component
 */
class SocialpromoterViewQueue extends JViewLegacy{
    protected $form;
    
    public function display($tpl=null) {
        $items = $this->get('Items');
        $state = $this->get('State');
        $this->form = $this->get('Form');
        var_dump($this->form);exit;
        $this->sortDirection = $state->get('list.direction');
        $this->sortColumn = $state->get('list.ordering');
 
        parent::display($tpl);
    }
    
    function edit($id) {
        JToolBarHelper::title(JText::_('Com_socialpromoter Queue: [<small>Edit</small>]', 'generic.png'));
        JToolBarHelper::save();
        JToolBarHelper::cancel('cancel', 'Close');
        $this->form = $this->get('Form');
        $model = $this->getModel();
        $item = $model->getQueue( $id );
        $this->assignRef('item', $item);
        parent::display();
    }
}
