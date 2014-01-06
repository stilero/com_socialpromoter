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
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
?>
<script type="text/javascript">
	Joomla.submitbutton = function(task)
	{
            if (task == 'cancel' || document.formvalidator.isValid(document.id('queue-form'))) {
                <?php //echo $this->form->getField('description')->save(); ?>
                Joomla.submitform(task, document.getElementById('queue-form'));
            }
	}
</script>
<form action="<?php echo JRoute::_('index.php?option=com_socialpromoter&view=queue&task=edit&id=' . (int)$this->item->id); ?>" method="post" name="adminForm" id="queue-form" class="form-validate">
    <div class="form-horizontal">
        <div class="row-fluid">
            <div class="span9">
                <div class="form-vertical">
                        <?php echo $this->form->getControlGroup('id'); ?>
                        <?php echo $this->form->getControlGroup('plugin'); ?>
                        <?php echo $this->form->getControlGroup('title'); ?>
                        <?php echo $this->form->getControlGroup('description'); ?>
                        <?php echo $this->form->getControlGroup('url'); ?>
                        <?php echo $this->form->getControlGroup('tags'); ?>
                        <?php echo $this->form->getControlGroup('created'); ?>
                </div>
            </div>
            
        </div>
    </div>
    <input type="hidden" name="task" value="" />
	<?php echo JHtml::_('form.token'); ?>
</form>
