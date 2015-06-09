<?php

namespace Application\test\ApplicationTest\Service;

use Application\Service\LocalFileService;

class LocalFileServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $tmpFolder;

    public function setUp()
    {
        $this->tmpFolder = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'data');
    }

    public function testFetchPicturesFindNoFilesIfFolderDoesNotExists()
    {
        $localFileService = new LocalFileService($this->tmpFolder, $this->tmpFolder);
        $actual = $localFileService->fetchPictures('folderDoesntExists');
        $this->assertCount(0, $actual);
    }

    public function testFetchPicturesFindFilesWithCamalCase()
    {
        $localFileService = new LocalFileService($this->tmpFolder, $this->tmpFolder);
        $actual = $localFileService->fetchPictures('testkeyword');
        $this->assertCount(1, $actual);

        $actual = $localFileService->fetchPictures('testKeyword');
        $this->assertCount(1, $actual);
    }
}
