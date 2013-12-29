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
?>
<?php if(empty($this->items)): ?>
    <h2><?php echo JText::_('Nothing queued'); ?></h2>
<?php else: ?>
    <form id="adminForm" method="post" name="adminForm">
        <table class="table table-striped" id="articleList">
            <thead>
                <tr class="sortable">
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JText::_('image'); ?>
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
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->items as $item) : ?>
                <?php $editURL = JRoute::_('index.php?option=com_socialpromoter&view=queue&task=edit&id='.(int)$item->id); ?>
                <tr>
                    <td>
                        <a href="<?php echo $editURL; ?>">
                            <img src="<?php echo $item->url ; ?>" width="100" height="100" />
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
                </tr>
                <? endforeach; ?>
            </tbody>
        </table>
    </form>
<?php endif; ?>