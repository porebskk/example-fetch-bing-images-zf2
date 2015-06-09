<?php

use Application\Picture\Api\BingImage;
use Application\Service\LocalFileService;
use Application\Service\RemoteFileService;
use Application\Service\SearchService;
use Zend\ServiceManager\ServiceLocatorInterface;

return [
    'abstract_factories' => [
        'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
        'Zend\Log\LoggerAbstractServiceFactory',
    ],
    'factories' => [
        BingImage::class => function (ServiceLocatorInterface $sl) {
                $config = $sl->get('config')['api']['bing'];
                return new BingImage($config['username'], $config['password']);
            },
        SearchService::class => function (ServiceLocatorInterface $sl) {
                return new SearchService($sl->get(LocalFileService::class), $sl->get(RemoteFileService::class));
            },
        LocalFileService::class => function () {
                return new LocalFileService('public' . DIRECTORY_SEPARATOR . 'data');
            },
        RemoteFileService::class => function (ServiceLocatorInterface $sl) {
                return new RemoteFileService($sl->get(BingImage::class));
            },
    ],
    'aliases' => [
        'translator' => 'MvcTranslator',
    ],
];