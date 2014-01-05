<?php
/**
 * Description of com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2014-jan-05 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
  */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
class TableLog extends JTable{
    var $id = 0;
    var $url = '';
    var $plugin = '';
    var $code = '';
    var $msg = '';
    var $created = '';
    
    function __construct( &$db ){
        parent::__construct('#__com_socialpromoter_logs','id',$db);
    }
}