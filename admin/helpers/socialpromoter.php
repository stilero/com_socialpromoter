<?php
/**
 * Helper Class for Social Promoter
 *
 * @version  1.0
 * @package Stilero
 * @subpackage com_socialpromoter
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-26 Stilero Webdesign (http://www.stilero.com)
 * @license	GNU General Public License version 2 or later.
 * @link http://www.stilero.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access'); 
jimport( 'joomla.plugin.helper' );
class SocialpromoterHelper{
    /**
     * Checks if the main component is installed and runable
     * @return boolean
     */
    public static function canRun(){
        return file_exists(JPATH_ADMINISTRATOR.DS.'components'.DS.'com_socialpromoter'.DS.'helpers'.DS.'socialpromoter.php');
    }
    
    /**
     * Returns a list with all Social Promoter plugins installed
     * @return array Array with all the plugins
     */
    public static function getPlugins(){
        return ;
    }
}
