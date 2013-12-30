<?php
/**
 * @version  1.0
 * @author Daniel Eliasson - joomla at stilero.com
 * @copyright  (C) 2012-okt-21 Stilero Webdesign http://www.stilero.com
 * @category Components
 * @license	GPLv2
  */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
//var_dump($this->items);
JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
jimport( 'joomla.plugin.helper' );
    
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');
?>
<script type="text/javascript">
	Joomla.orderTable = function()
	{
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
		dirn = 'asc';
		Joomla.tableOrdering(order, dirn, '');
	}
</script>
<h1>Published Social Promoter plugins</h1>
<form action="<?php echo JRoute::_('index.php?option=com_socialpromoter&view=plugins'); ?>" method="post" name="adminForm" id="adminForm">
	<div id="main-container">
		<table class="table table-striped" id="articleList">
			<thead>
				<tr>
					<th width="1%" class="nowrap hidden-phone">
                                            Name
					</th>
					<th width="10%" class="nowrap hidden-phone">
						Description
					</th>
					
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="12">
						<?php //echo $this->pagination->getListFooter(); ?>
					</td>
				</tr>
			</tfoot>
			<tbody>
			<?php foreach ($this->items as $i => $item) : ?>
                            <?php
                            $dispatcher = JDispatcher::getInstance();
                            JPluginHelper::importPlugin($item->type, $item->name, false);
                            $className = 'plgSocialpromoter'.ucfirst($item->name);
                            $name = 'name';
                            $desc = 'desc';
                            
                                $pluginClass = new $className($dispatcher, array());
                                $name = $pluginClass::SP_NAME;
                                $desc = $pluginClass::SP_DESCRIPTION;
                            
                            
                            ?>
				<tr class="row<?php echo $i % 2; ?>" sortable-group-id="<?php echo $item->type?>">
					<td class="nowrap small hidden-phone">
						<?php echo $this->escape($name);?>
					</td>
					<td class="nowrap small hidden-phone">
						<?php echo $this->escape($desc);?>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>