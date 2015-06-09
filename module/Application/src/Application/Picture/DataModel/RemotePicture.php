<?php

namespace Application\Picture\DataModel;

/**
 * Represents a picture, that is present on the web or another accessible server.
 */
class RemotePicture implements HtmlPictureInterface
{
    /** @var string The url of the remote picture */
    protected $webUrl;

    /**
     * @param string $webUrl
     */
    public function __construct($webUrl)
    {
        $this->webUrl = $webUrl;
    }

    /**
     * @return string
     */
    public function getWebUrl()
    {
        return $this->webUrl;
    }

    /**
     * Returns a html path, to a picture.
     *
     * @return string
     */
    public function getHtmlPath()
    {
        return $this->getWebUrl();
    }
}