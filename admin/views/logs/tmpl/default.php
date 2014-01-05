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
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
?>
<?php if(empty($this->items)): ?>
    <h1><?php echo JText::_('No Items found'); ?></h1>
<?php else: ?>
    <script language="javascript" type="text/javascript">
        function tableOrdering( order, dir, task ){
            var form = document.adminForm;
            form.filter_order.value = order;
            form.filter_order_Dir.value = dir;
            document.adminForm.submit( task );
        }
    </script>
    <form id="adminForm" method="post" name="adminForm">
            <table class="table table-striped" id="articleList">
                <thead>
                    <tr class="sortable">
                        <th width="1%" class="nowrap hidden-phone">
                            <?php echo JHTML::_( 'grid.sort', 'Name', 'DbNameColumn', $this->sortDirection, $this->sortColumn); ?>
                        </th>
                        <th width="10%" class="nowrap hidden-phone">
                            <?php echo JHTML::_( 'grid.sort', 'Description', 'DbDescriptionColumn', $this->sortDirection, $this->sortColumn); ?>
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
                                <?php echo $item->created; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <input type="hidden" name="filter_order" value="<?php echo $this->sortColumn; ?>" />
            <input type="hidden" name="filter_order_Dir" value="<?php echo $this->sortDirection; ?>" />
    </form>
<?php endif;?>
