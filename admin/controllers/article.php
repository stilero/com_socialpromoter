<?php
/**
 * Description of com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-26 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 * 
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 

// import joomla controller library
jimport('joomla.application.component.controller');

class SocialpromoterControllerArticle extends JControllerLegacy{
    
    public static $modelName = 'article';
    public static $viewName = 'article';
    
    public function display($cachable = false, $urlparams = false){
        //Set Default View and Model
        $view = $this->getView( self::$viewName, 'html' );
        $model = $this->getModel(  self::$modelName );
        $view->setModel( $model, true );
        $view->display();
    }
    
    public function edit(){
        $cids = JRequest::getVar('cid', null, 'default', 'array');
        if( $cids === null ){
            JError::raiseError( 500,
            'cid parameter missing from the request' );
        }
        $articlesId = (int)$cids[0];
        $view = $this->getView( JRequest::getVar( 'view',  self::$viewName ), 'html' );
        $model = $this->getModel( self::$modelName );
        $view->setModel( $model, true );
        $view->edit( $articlesId );
    }
    
    function add(){
        $view = $this->getView( self::$viewName, 'html' );
        $model = $this->getModel( self::$modelName );
        $view->setModel( $model, true );
        $view->add();
    }
    
    function save(){
        $this->apply();
        $redirectTo = JRoute::_('index.php?option='.JRequest::getVar('option').'&task=display');
        $this->setRedirect( $redirectTo, 'Saved' );
    }
    
    function apply(){
        $model = $this->getModel( self::$modelName );
        $model->store();
    }
    
    function cancel(){
        $redirectTo = JRoute::_('index.php?option='.JRequest::getVar('option').'&task=display');
        $this->setRedirect( $redirectTo, 'Cancelled' );
    }
    
    function remove(){
        $cids = JRequest::getVar('cid', null, 'default', 'array');
        if( $cids === null ){
            JError::raiseError( 500, 'Nothing were selected for removal' );
        }
        $model = $this->getModel( self::$modelName);
        $model->delete( $cids);
        $redirectTo = JRoute::_('index.php?option='.JRequest::getVar( 'option' ).'&task=display');
        $this->setRedirect( $redirectTo, 'Deleted' );
    }
}
