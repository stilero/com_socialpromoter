<?php
/**
 * Menu helper class - Displays the sub menu
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

class SocialpromoterMenuhelper{
    
    private static $option = 'com_socialpromoter';
    
    /**
     * Shows the submenu
     * @param string $vName The view name
     */
    public static function addSubmenu($vName = 'dashboard'){
        
        JSubMenuHelper::addEntry(
            JText::_('Dashboard'),
            'index.php?option='.self::$option.'&view=dashboard',
            ($vName == 'dashboard')
        );
        
        JSubMenuHelper::addEntry(
            JText::_('Plugins'),
            'index.php?option='.self::$option.'&view=plugins',
            ($vName == 'plugins')
        );
    }
}
