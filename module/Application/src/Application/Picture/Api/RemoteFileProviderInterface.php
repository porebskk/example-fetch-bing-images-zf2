<?php

namespace Application\Picture\Api;
use Application\Picture\DataModel\HtmlPictureInterface;

/**
 * Interface for Classes, that provides a search interface.
 */
interface RemoteFileProviderInterface
{
    /**
     * Searches for pictures by the given keyword.
     *
     * @param string $keyword
     * @return HtmlPictureInterface[]
     */
    public function search($keyword);
} 