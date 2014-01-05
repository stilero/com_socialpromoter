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
        
//        JSubMenuHelper::addEntry(
//            JText::_('Articles'),
//            'index.php?option='.self::$option.'&view=article',
//            ($vName == 'article')
//        );
        JSubMenuHelper::addEntry(
            JText::_('Images'),
            'index.php?option='.self::$option.'&view=media',
            ($vName == 'media')
        );
//        JSubMenuHelper::addEntry(
//            JText::_('Dashboard'),
//            'index.php?option='.self::$option.'&view=dashboard',
//            ($vName == 'dashboard')
//        );
        JSubMenuHelper::addEntry(
            JText::_('Queue'),
            'index.php?option='.self::$option.'&view=queues',
            ($vName == 'queues')
        );
        JSubMenuHelper::addEntry(
            JText::_('Plugins'),
            'index.php?option='.self::$option.'&view=plugins',
            ($vName == 'plugins')
        );
        JSubMenuHelper::addEntry(
            JText::_('Log'),
            'index.php?option='.self::$option.'&view=logs',
            ($vName == 'logs')
        );
    }
}
