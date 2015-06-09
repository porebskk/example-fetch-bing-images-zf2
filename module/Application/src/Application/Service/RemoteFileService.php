<?php

namespace Application\Service;


use Application\Picture\Api\RemoteFileProviderInterface;

class RemoteFileService
{
    /** @var RemoteFileProviderInterface */
    protected $remoteFileProvider;

    public function __construct($remoteFileProvider)
    {
        $this->remoteFileProvider = $remoteFileProvider;
    }

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