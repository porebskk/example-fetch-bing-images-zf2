<?php

namespace Application\Service;


use Application\Picture\Api\RemoteFileProviderInterface;
use Application\Picture\DataModel\HtmlPictureInterface;

class RemoteFileService
{
    /** @var RemoteFileProviderInterface */
    protected $remoteFileProvider;

    public function __construct($remoteFileProvider)
    {
        $this->remoteFileProvider = $remoteFileProvider;
    }

    /**
     * Searches via a remote API for pictures.
     *
     * @param string $keyword
     * @return HtmlPictureInterface[]
     */
    public function searchRemote($keyword)
    {
        return $this->getRemoteFileProvider()->search($keyword);
    }

    /**
     * @return \Application\Picture\Api\RemoteFileProviderInterface
     */
    public function getRemoteFileProvider()
    {
        return $this->remoteFileProvider;
    }

} 