<?php
/**
 * View template com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2014-jan-05 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>
<?php if(empty($this->items)): ?>
    <h1><?php echo JText::_('No Items found'); ?></h1>
<?php else: ?>
    <form id="adminForm" method="post" name="adminForm">
            <table class="table table-striped" id="articleList">
                <thead>
                    <tr class="sortable">
                        <th width="1%" class="nowrap hidden-phone">
                            <?php echo JText::_('id'); ?>
                        </th>
                        <th width="10%" class="nowrap hidden-phone">
                            <?php echo JText::_('url'); ?>
                        </th>
                        <th width="5%" class="nowrap hidden-phone">
                            <?php echo JText::_('plugin'); ?>
                        </th>
                        <th width="1%" class="nowrap hidden-phone">
                            <?php echo JText::_('code'); ?>
                        </th>
                        <th width="10%" class="nowrap hidden-phone">
                            <?php echo JText::_('msg'); ?>
                        </th>
                        <th width="10%" class="nowrap hidden-phone">
                            <?php echo JText::_('created'); ?>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=0; ?>
                    <?php foreach ($this->items as $item) : ?>
                        <tr id='row<?php echo $i; ?>'>
                            <td>
                                <?php echo $item->id; ?>
                            </td>
                            <td>
                                <img src="<?php echo $item->url; ?>" width="100" height="100" />
                            </td>
                            <td>
                                <?php echo $item->plugin; ?>
                            </td>
                            <td>
                                <?php echo $item->code; ?>
                            </td>
                            <td>
                                <?php echo $item->msg; ?>
                            </td>
                            <td>
                                <?php echo $item->created; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </form>
<?php endif;?>
