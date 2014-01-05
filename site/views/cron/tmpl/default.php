<?php
/**
 * View template com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-29 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
jimport( 'joomla.plugin.helper' );
$wasPosted = false;
if(isset($this->queue)){
    if(isset($this->items)){
        foreach ($this->items as $item) {
            $dispatcher = JDispatcher::getInstance();
            JPluginHelper::importPlugin($item->type, $item->name, false);
            $className = 'plgSocialpromoter'.ucfirst($item->name);
            $pluginClass = new $className($dispatcher, array());
            $result = $pluginClass->postImage($this->queue->url, $this->queue->title, $this->queue->description, $this->queue->tags);
            if($result && !$wasPosted){
                $wasPosted = true;
                $this->model->log($this->queue->url, ucfirst($item->name), 0, $result);
            }
        }
        if($wasPosted){
            $this->model->setPosted($this->queue->id);
        }
    }
}
?>