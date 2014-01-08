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
JHTML::stylesheet(JUri::root().'administrator/components/com_socialpromoter/assets/bootstrap/css/bootstrap.min.css');
?>
<?php if(empty($this->items)): ?>
    <h1><?php echo JText::_('No Items found'); ?></h1>
<?php else: ?>
    <div class="row">
        <?php $i=0; ?>
        <?php foreach ($this->items as $item) : ?>
            <div>
                 <div class="thumbnail">
                 <a data-toggle="lightbox" href="#imgLightbox<?php echo $i; ?>">
                    <img src="<?php echo $item->url; ?>" class="img-responsive"/>
                </a>
                     <p></p>
                <p class="text-center">
                    
                    <i class="icon-thumbs-up"></i> 34  <i class="icon-comment"></i> <?php if (isset($item->comments)) echo count($item->comments); ?>  <a  class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?php echo $i; ?>" href="#socLightbox<?php echo $i; ?>"><i class="icon-resize-full"></i> Read Comments
                    </a>
                </p>
                <div id="socLightbox<?php echo $i; ?>" class="accordion-body collapse">
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th><i class="icon-time"> </i></th>
                                <th><i class="icon-user"> </i></th>
                                <th><i class="icon-comment"> </i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($item->comments as $comment) : ?>
                                <tr>
                                    <td><?php echo $comment->time; ?></td>
                                    <td><?php echo $comment->name; ?></td>
                                    <td><?php echo $comment->text; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
            </div>
            </div>
            <div id="imgLightbox<?php echo $i++; ?>" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
                <div class='lightbox-content'>
                    <div>
                        <img src="<?php echo $item->url; ?>">
                        <div class="lightbox-caption"><p><strong><?php echo $item->title; ?></strong></p><p><?php echo $item->description; ?></p></div>
                    </div>
                </div>  
            </div>
            
            
        <?php endforeach; ?>  
    </div>             
<?php endif;?>