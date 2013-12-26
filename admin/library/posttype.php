<?php
/**
 * Posttype class
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

class SocialpromoterPosttype{
    
    const LINK = 'link';
    const IMAGE = 'image';
    
    /**
     * Returns all posttypes
     * @return array Array with all the constants
     */
    public static function getAll(){
        $constants = array(self::LINK, self::IMAGE);
        return $constants;
    }
}
