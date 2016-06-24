<?php

namespace br\com\InstaCambio\Filesystem;

class StubDirectoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCheckIfTheRootMethodReturnDefinedPath()
    {
        $urlPrefix = 'vfs://root';

        $pathFoo = date('YmdHis');
        $directory = new StubDirectory($pathFoo);
        $this->assertEquals($urlPrefix . DIRECTORY_SEPARATOR . $pathFoo, $directory->root());

        sleep(1);

        $pathBar = date('YmdHis');
        $directory->setRoot($pathBar);
        $this->assertEquals($urlPrefix . DIRECTORY_SEPARATOR . $pathBar, $directory->root());

        $this->assertNotEquals($urlPrefix . $pathFoo, $directory->root());
    }
}
