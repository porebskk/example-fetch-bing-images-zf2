<?php

namespace Application\Service;

use Application\Picture\DataModel\HtmlPictureInterface;
use Application\Picture\DataModel\LocalPicture;

/**
 * This service finds pictures in a specific given folder. Every keyword has its own folder.
 */
class LocalFileService
{
    /** @var string The folder where pictures are stored */
    protected $storageFolder;

    public function __construct($storageFolder, $publicFolder = 'public')
    {
        $this->storageFolder = $storageFolder;
        $this->publicFolder = $publicFolder;
    }

    /**
     * Loads pictures from the given storage folder. Only files will be loaded that can be found in a folder with the
     * same name as the keyword.
     *
     * @param string $keyword
     * @return HtmlPictureInterface[]
     */
    public function fetchPictures($keyword)
    {
        $result = [];
        $realPath = realpath($this->getStorageFolder() . DIRECTORY_SEPARATOR . strtolower($keyword));
        if (!$realPath) {
            return $result;
        }
        $files = array_diff(scandir($realPath), ['..', '.']);
        foreach ($files as $file) {
            $result[] = new LocalPicture($realPath . DIRECTORY_SEPARATOR . $file, $this->publicFolder);
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