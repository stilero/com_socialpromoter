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
class SocialpromoterViewCron extends JViewLegacy{
    
    protected $model;
    
    // Overwriting JView display method
    function display($tpl = null){
        $this->model = $this->getModel();
        $this->items = $this->model->getItems();
        $this->queue = $this->model->getNextItem();
        parent::display($tpl);
    }
}
