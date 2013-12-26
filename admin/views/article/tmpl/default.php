<?php
/**
 * View template com_socialpromoter
 *
 * @version  1.0
 * @author Daniel Eliasson <daniel at stilero.com>
 * @copyright  (C) 2013-dec-26 Stilero Webdesign (http://www.stilero.com)
 * @category Components
 * @license	GPLv2
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//var_dump($this->items);exit;
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
?>
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
                        <?php echo JHTML::_( 'grid.sort', 'Id', 'id', $this->sortDirection, $this->sortColumn); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JHTML::_( 'grid.sort', 'Title', 'title', $this->sortDirection, $this->sortColumn); ?>
                    </th>
                    <th width="10%" class="nowrap hidden-phone">
                        <?php echo JHTML::_( 'grid.sort', 'Create Date', 'created', $this->sortDirection, $this->sortColumn); ?>
                    </th>
                </tr>
            </thead>
            <?php            foreach ($this->items as $item) : ?>
                <tr>
                    <td>
                        <?php echo $item->id; ?>
                    </td>
                    <td>
                        <?php echo $item->title; ?>
                    </td>
                    <td>
                        <?php echo $item->created; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            
            
        </table>
 
        <input type="hidden" name="filter_order" value="<?php echo $this->sortColumn; ?>" />
        <input type="hidden" name="filter_order_Dir" value="<?php echo $this->sortDirection; ?>" />
</form>