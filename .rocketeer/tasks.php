<?php

use Rocketeer\Facades\Rocketeer;

Rocketeer::task('test', function ($task) {
    /* @var $task \Rocketeer\Abstracts\AbstractTask */
    $phpunit = $task->binary('phpunit');
    $phpunit->setParent($task->binary('php'));
    return $task->runForCurrentRelease($phpunit->getCommand(null, '--stop-on-failure'));
});
Rocketeer::task('buildProject', function ($task) {
    /* @var $task \Rocketeer\Abstracts\AbstractTask */
    $phing = $task->paths->getPath('phing');
    return $task->runForCurrentRelease($phing);
});