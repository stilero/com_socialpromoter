<?php
/**
 * Queue Table Class
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
 
class TableQueue extends JTable{
    var $id = 0;
    var $title = '';
    var $description = '';
    var $url = '';
    var $tags = '';
    var $created = '';
    var $posted = '';
    
    function __construct( &$db ){
        parent::__construct('#__com_socialpromoter_queue','id',$db);
    }
}