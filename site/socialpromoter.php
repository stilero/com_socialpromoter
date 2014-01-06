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
if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}
JHTML::addIncludePath(JPATH_COMPONENT.DS.'helpers');
require_once JPATH_COMPONENT.DS.'controller.php';
$controllerName = JRequest::getWord('view');

if ( $controllerName) { 
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controllerName.'.php';
    if ( file_exists($path)) {
        require_once $path;
    } else {       
        $controllerName = '';	   
    }
}
$classname    = 'SocialpromoterController'.$controllerName;
$Controller   = new $classname();

// Perform the Request task
$Controller->execute(JRequest::getCmd('task', 'display'));
// Redirect if set by the controller
$Controller->redirect();