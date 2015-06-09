<?php

namespace Application\Service;

use Application\Picture\DataModel\LocalPicture;

/**
 * This service finds pictures in a specific given folder. Every keyword has its own folder.
 */
class LocalFileService
{
    /** @var string The folder where pictures are stored */
    protected $storageFolder;

    public function __construct($storageFolder)
    {
        $this->storageFolder = $storageFolder;
    }


    public function fetchPictures($keyword)
    {
        $result = [];
        $realPath = realpath($this->getStorageFolder() . DIRECTORY_SEPARATOR . strtolower($keyword));
        if (!$realPath) {
            return $result;
        }
        $files = array_diff(scandir($realPath), ['..', '.']);
        foreach ($files as $file) {
            $result[] = new LocalPicture($realPath . DIRECTORY_SEPARATOR . $file, 'public');
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getStorageFolder()
    {
        return $this->storageFolder;
    }
} 