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
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
$cronUrl = JURI::root().'index.php?option=com_socialpromoter&view=cron';
?>
<?php if(empty($this->items)): ?>
    <h1><?php echo JText::_('Nothing queued'); ?></h1>
    <p class='lead'>Go to the media section and add images to queue.</p>
<?php else: ?>
    <h2>Queue</h2>
    <p class='lead'><?php echo count($this->items); ?> images waiting in queue. Use a cron job to send on certain times. The example below shows a cron job that posts every day at 14:00 (server time).</p>
    <pre>0 14 * * * curl --silent '<?php echo $cronUrl; ?>'</pre>
    <p><small>Ask your webhost for support and info about cron jobs. </small></p>
    <div id="social_promoter_alert"></div>
    
        <table class="table table-striped" id="articleList">
            <thead>
                <tr class="sortable">
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JText::_('image'); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JText::_('plugin'); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JText::_('title'); ?>
                    </th>
                    <th width="20%" class="nowrap hidden-phone">
                        <?php echo JText::_('description'); ?>
                    </th>
                    <th width="20%" class="nowrap hidden-phone">
                        <?php echo JText::_('tags'); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JText::_('created'); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JText::_('button'); ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0; ?>
                <?php foreach ($this->items as $item) : ?>
                <?php $editURL = JRoute::_('index.php?option=com_socialpromoter&view=queue&task=edit&id='.(int)$item->id); ?>
                <tr id='row<?php echo $i; ?>'>
                    <td>
                        <a href="<?php echo $editURL; ?>">
                            <img src="<?php echo $item->url ; ?>" width="100" height="100" />
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo $editURL; ?>">
                            <?php echo $this->escape($item->plugin); ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo $editURL; ?>">
                            <?php echo $this->escape($item->title); ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo $editURL; ?>"><?php echo $item->description ; ?></a>
                        
                    </td>
                    <td>
                        <a href="<?php echo $editURL; ?>"><?php echo $item->tags ; ?></a>
                    </td>
                    
                    <td>
                        <a href="<?php echo $editURL; ?>"><?php echo $item->created ; ?></a>
                    </td>
                    <td>
                        <form id="queueform<?php echo $i; ?>" name="queueform<?php echo $i; ?>" action="">
                            <input type="hidden" name="option" value="com_socialpromoter" />
                            <input type="hidden" name="task" value="delete" />
                            <input type="hidden" name="format" value="raw" />
                            <input type="hidden" name="view" value="queues" />
                            <input type="hidden" name="row" value="row<?php echo $i++; ?>" />
                            <input type="hidden" name="id" value="<?php echo $item->id; ?>" />
                            <?php echo JHtml::_( 'form.token' ); ?>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <? endforeach; ?>
            </tbody>
        </table>
<?php endif; ?>