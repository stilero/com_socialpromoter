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
$resultFail = new stdClass();
$metaFail = new stdClass();
$metaFail->code = 1;
$metaFail->error_message = 'Failed deleting from queue';
$resultFail->meta = $metaFail;

$metaSuccess = new stdClass();
$metaSuccess->code = '200';
$metaSuccess->message = 'Deleted from Queue';
$resultSuccess = new stdClass();
$resultSuccess->meta = $metaSuccess;
?>
<?php if($this->result == true) : ?>
    <?php print json_encode($resultSuccess); ?>
<?php else: ?>
    <?php print json_encode($resultFail); ?>
<?php endif; ?>


