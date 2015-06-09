<?php

namespace Application\Service;

use Application\Picture\DataModel\HtmlPictureInterface;

/**
 * This service conducts all search related components.
 */
class SearchService
{
    /** @var LocalFileService */
    protected $localFileService;
    /** @var RemoteFileService */
    protected $remoteFileService;

    /**
     * @param LocalFileService $localFileService
     * @param RemoteFileService $remoteFileService
     */
    public function __construct($localFileService, $remoteFileService)
    {
        $this->localFileService = $localFileService;
        $this->remoteFileService = $remoteFileService;
    }


    /**
     * @param string $searchTerm
     * @param int $maxResults
     * @return HtmlPictureInterface[]
     */
    public function doSearch($searchTerm, $maxResults = 20)
    {
        if (!is_string($searchTerm) || strlen($searchTerm) === 0) {
            return [];
        }
        //first we search in our local file system, to prevent the usage of our api transactions
        $localPictures = $this->getLocalFileService()->fetchPictures($searchTerm);
        //we already got enough pictures
        if (count($localPictures) >= $maxResults) {
            return array_slice($localPictures, 0, $maxResults);
        }

        $webPictures = $this->getRemoteFileService()->searchRemote($searchTerm);

        return array_slice(array_merge($localPictures, $webPictures), 0, $maxResults);
    }

    /**
     * @return \Application\Service\LocalFileService
     */
    public function getLocalFileService()
    {
        return $this->localFileService;
    }

    /**
     * @return \Application\Service\RemoteFileService
     */
    public function getRemoteFileService()
    {
        return $this->remoteFileService;
    }
} 