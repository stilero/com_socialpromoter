<?php
/**
 * Importer Class
 * A quick way to import entire folders with classes. All classes must be named accordinggly:
 * the_filename.php => ClassprefixThe_filename
 * For example
 * posttypes.php must have the class name SocialpromoterPosttypes
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
if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}
define('PATH_SOCIALPROMOTER', dirname(__FILE__).DS);
define('PATH_SOCIALPROMOTER_LIBRARY', PATH_SOCIALPROMOTER.'library'.DS);
define('PATH_SOCIALPROMOTER_HELPERS', PATH_SOCIALPROMOTER.'helpers'.DS);

class SocialpromoterImporter{
    
    const SOCIALPROMOTER_CLASSPREFIX = 'Socialpromoter';
    
    /**
     * Imports all classes from the library folder
     */
    public static function importLibrary(){
        JLoader::discover(self::SOCIALPROMOTER_CLASSPREFIX, PATH_SOCIALPROMOTER_LIBRARY);
    }
    
    /**
     * Imports all helper classes
     */
    public static function importHelpers(){
        JLoader::discover(self::SOCIALPROMOTER_CLASSPREFIX, PATH_SOCIALPROMOTER_HELPERS);
    }
}
