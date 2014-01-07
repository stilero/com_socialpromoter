<?php
/**
 * Description of com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2014-jan-07 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2 
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

// import joomla controller library
jimport('joomla.application.component.controller');

class SocialpromoterControllerGallery extends JControllerLegacy{
    
    public static $modelName = 'gallery';
    public static $viewName = 'gallery';
    
    public function display($cachable = false, $urlparams = false){
        //Set Default View and Model
        $view = $this->getView( self::$viewName, 'html' );
        $model = $this->getModel(  self::$modelName );
        $view->setModel( $model, true );
        $view->display();
    }
    
}
