<?php
/**
 * View template com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2014-jan-07 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 */
// DOWNLOAD AND ADD LIGHTBOX LIBRARY:
// http://jasonbutz.info/bootstrap-lightbox/assets/bootstrap-lightbox.zip
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
JHtml::_('bootstrap.framework');
JHtml::_('jquery.ui');
JHtml::script(JUri::root().'media/socialpromoter/assets/js/bootstrap-lightbox.min.js');
JHTML::stylesheet(JUri::root().'media/socialpromoter/assets/css/bootstrap-lightbox.min.css');
?>
<?php if(empty($this->items)): ?>
    <h1><?php echo JText::_('No Items found'); ?></h1>
<?php else: ?>
    <div class="row">
        <?php $i=0; ?>
        <?php foreach ($this->items as $item) : ?>
            <div class=""col-xs-6 col-md-3">
                 <div class="thumbnail">
                 <a data-toggle="lightbox" href="#demoLightbox<?php echo $i; ?>">
                    <img src="<?php echo $item->url; ?>" class="img-responsive"/>
                </a>
                <?php echo $item->msg; ?>
                </div>
            </div>
            <div id="demoLightbox<?php echo $i++; ?>" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
                <div class='lightbox-content'>
                        <img src="<?php echo $item->url; ?>">
                        <div class="lightbox-caption"><p><span class="glyphicon glyphicon-thumbs-up"></span><span class="glyphicon glyphicon-comment"></span><?php echo $item->url; ?></p></div>
                </div>
            </div>
        <?php endforeach; ?>  
    </div>             
<?php endif;?>