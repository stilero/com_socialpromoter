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
                        <?php echo JText::_('title'); ?>
                    </th>
                    <th width="20%" class="nowrap hidden-phone">
                        <?php echo JText::_('description'); ?>
                    </th>
                    <th width="20%" class="nowrap hidden-phone">
                        <?php echo JText::_('tags'); ?>
                    </tht
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JText::_('image'); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JText::_('created'); ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->items as $item) : ?>
                <tr>
                    <td>
                        <?php echo $item->title ; ?>
                    </td>
                    <td>
                        <?php echo $item->description ; ?>
                    </td>
                    <td>
                        <?php echo $item->tags ; ?>
                    </td>
                    <td>
                        <img src="<?php echo $item->url ; ?>" width="100" height="100" />
                    </td>
                    <td>
                        <?php echo $item->created ; ?>
                    </td>
                </tr>
                <? endforeach; ?>
            </tbody>
        </table>
    </form>
<?php endif; ?>