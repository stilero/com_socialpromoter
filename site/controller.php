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

// no direct access
defined('_JEXEC') or die('Restricted access'); 

// import joomla controller library
jimport('joomla.application.component.controller');

class SocialpromoterController extends JControllerLegacy{
    
    public function display($cachable = false, $urlparams = false){
        $view	= JRequest::getCmd('view', 'default');
        JRequest::setVar('view', $view);        
        $layout = JRequest::getCmd('layout', 'default');
        JRequest::setVar('layout', $layout);        
        parent::display();
        return $this;
    }
    
    public function cron(){
        $view	= JRequest::getCmd('view', 'default');
        JRequest::setVar('view', $view);        
        $layout = JRequest::getCmd('layout', 'default');
        JRequest::setVar('layout', $layout);        
        parent::display();
        return $this;
    }
}
