<?php

namespace br\com\InstaCambio\Filesystem;

class Directory
{
    /**
     * @var string
     */
    protected $rootPath;

    /**
     * Directory constructor.
     * @param $rootPath
     */
    public function __construct($rootPath)
    {
        if (!file_exists($rootPath))
            mkdir($rootPath, 0777, true);

        $this->rootPath = $rootPath;
    }

    /**
     * @return string
     */
    public function root()
    {
        return $this->rootPath;
    }

    /**
     * @param string $rootPath
     */
    public function setRoot($rootPath)
    {
        $this->rootPath = $rootPath;
    }

}   