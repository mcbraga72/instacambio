<?php

use br\com\InstaCambio\Shell\Task\Notifications\NotificationTask;

require dirname(__FILE__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'bootstrap.php';

$notificationsTask = new NotificationTask();
$notificationsTask->execute();
unset($notificationsTask);