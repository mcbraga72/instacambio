<?php

use Rocketeer\Abstracts\AbstractTask;

return [

    // Tasks
    //
    // Here you can define in the `before` and `after` array, Tasks to execute
    // before or after the core Rocketeer Tasks. You can either put a simple command,
    // a closure which receives a $task object, or the name of a class extending
    // the Rocketeer\Abstracts\AbstractTask class
    //
    // In the `custom` array you can list custom Tasks classes to be added
    // to Rocketeer. Those will then be available in the command line
    // with all the other tasks
    //////////////////////////////////////////////////////////////////////

    // Tasks to execute before the core Rocketeer Tasks
    'before' => [
        'setup' => [],
        'dependencies' => [
            function (AbstractTask $task) {
                return $task->share('tmp');
            },
            function (AbstractTask $task) {
                $pwdCR = $task->runForCurrentRelease('pwd');
                $task->removeFolder($pwdCR . '/tmp/pages');
                $task->removeFolder($pwdCR . '/tmp/not-scraper');
            },
            function (AbstractTask $task) {
                $pwdCR = $task->runForCurrentRelease('pwd');
                $task->createFolder($pwdCR . '/tmp/pages', true);
                $task->createFolder($pwdCR . '/tmp/logs', true);
                $task->createFolder($pwdCR . '/tmp/scraper', true);
                $task->createFolder($pwdCR . '/tmp/not-scraper', true);
            },
        ],
        'deploy' => [
            'sudo service monit stop'
        ],
        'cleanup' => [],
    ],

    // Tasks to execute after the core Rocketeer Tasks
    'after' => [
        'setup' => [],
        'dependencies' => [
            function (AbstractTask $task) {
                $phantomJsPath = $task->paths->getPath('phantomjs');
                $binFolder = $task->runForCurrentRelease('pwd') . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR;
                return $task->run("ln -s {$phantomJsPath} {$binFolder}");
            },
            'buildProject',
        ],
        'deploy' => [
            'sudo service monit start'
        ],
        'cleanup' => [],
    ],

    // Custom Tasks to register with Rocketeer
    'custom' => [],

];
