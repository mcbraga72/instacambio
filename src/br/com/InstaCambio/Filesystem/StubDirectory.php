<?php

namespace br\com\InstaCambio\Filesystem;

use org\bovigo\vfs\vfsStream;

class StubDirectory extends Directory
{
    private $vfsStreamDirectory;

    /** @noinspection PhpMissingParentConstructorInspection */
    /**
     * StubDirectory constructor.
     * @param string $rootPath
     */
    public function __construct($rootPath)
    {
        $this->rootPath = $rootPath;
    }


    public function root()
    {
        if (is_null($this->vfsStreamDirectory))
            $this->vfsStreamDirectory = vfsStream::setup('root', 0777, [$this->rootPath => []]);

        return $this->vfsStreamDirectory->url() . DIRECTORY_SEPARATOR . $this->rootPath;
    }

    public function setRoot($rootPath)
    {
        parent::setRoot($rootPath);
        $this->vfsStreamDirectory = vfsStream::setup('root', 0777, [$this->rootPath => []]);
    }


}
