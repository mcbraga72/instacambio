<?php

namespace br\com\InstaCambio\Filesystem;

class DirectoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCheckIfTheRootMethodReturnDefinedPath()
    {
        $prefix = 'vfs://root/';
        $pathFooBar = 'bar';
        $stubDirectory = new StubDirectory($pathFooBar);

        $directory = new Directory($stubDirectory->root());
        $this->assertEquals($prefix . $pathFooBar, $directory->root());

        $pathBarFoo = 'foo';
        $stubDirectory->setRoot($pathBarFoo);

        $directory->setRoot($stubDirectory->root());
        $this->assertNotEquals($prefix . $pathFooBar, $directory->root());
        $this->assertEquals($prefix . $pathBarFoo, $directory->root());
    }
}
