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
?>
<div id="social_promoter_alert"></div>
        <table class="table table-striped" id="articleList">
            <thead>
                <tr class="sortable">
                    <th width="1%" class="nowrap hidden-phone">
                        <?php echo JText::_('image'); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JText::_('url'); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JText::_('button'); ?>
                    </th>
                </tr>
            </thead>
        <?php $i=0; ?>
        <?php foreach ($this->items as $item) : ?>
                <tr id="row<?php echo $i; ?>">
                    <td>
                        <?php $url = str_replace(JPATH_ROOT.'/', JURI::root(), $item); ?>
                        <img src="<?php echo $url; ?>" width='100' height='100' />
                    </td>
                    <td>
                        <?php echo $item; ?>
                    </td>
                    <td>
                        <form id="queueform<?php echo $i; ?>" name="queueform<?php echo $i; ?>" action="">
                            <input type="hidden" name="option" value="com_socialpromoter" />
                            <input type="hidden" name="task" value="add" />
                            <input type="hidden" name="format" value="raw" />
                            <input type="hidden" name="view" value="queues" />
                            <input type="hidden" name="row" value="row<?php echo $i++; ?>" />
                            <input type="hidden" name="path" value="<?php echo $item; ?>" />
                            <?php echo JHtml::_( 'form.token' ); ?>
                            <button type="submit" class="btn">Add To Queue</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
                </table>