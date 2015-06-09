<?php

namespace Application\Picture\DataModel;

use InvalidArgumentException;

/**
 * Represents a picture, that is present in the local file system.
 */
class LocalPicture implements HtmlPictureInterface
{
    /** @var string The path to the picture file */
    protected $filePath;
    /** @var string The path to the public folder */
    protected $publicFolderPath;

    /**
     * @param string $filePath
     * @param string $publicFolderPath
     * @throws \InvalidArgumentException
     */
    public function __construct($filePath, $publicFolderPath)
    {
        $this->filePath = realpath($filePath);
        $this->publicFolderPath = realpath($publicFolderPath);

        if (strpos($filePath, $publicFolderPath) === false) {
            $exMsg = sprintf('The file "%s" isnt located in the public folder %s', $this->filePath, $this->publicFolderPath);
            throw new InvalidArgumentException($exMsg);
        }
    }

    /**
     * Returns a html path, to a picture.
     *
     * @return string
     */
    public function getHtmlPath()
    {
        $relativePath = str_replace($this->getPublicFolderPath(), '', $this->getFilePath());
        $pathUrlNormalized = str_replace("\\", '/', $relativePath);
        return (strpos($pathUrlNormalized, '/') !== 0) ? '/' . $pathUrlNormalized : $pathUrlNormalized;
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @return string
     */
    public function getPublicFolderPath()
    {
        return $this->publicFolderPath;
    }
}