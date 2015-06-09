<?php

namespace Application\test\ApplicationTest\Service;

use Application\Service\LocalFileService;
use Application\Service\RemoteFileService;
use Application\Service\SearchService;

class SearchServiceTest extends \PHPUnit_Framework_TestCase
{
    public function testDoSearchStopsIfEnoughLocalFilesAreFound()
    {
        $keyword = 'test';
        $localFileServiceMock = $this->getMockBuilder(LocalFileService::class)->disableOriginalConstructor()->getMock();
        $expected = [1, 2, 3, 4, 5, 6];
        $localFileServiceMock->expects($this->once())
            ->method('fetchPictures')
            ->with($keyword)
            ->willReturn($expected);
        $remoteFileServiceMock = $this->getMockBuilder(RemoteFileService::class)->disableOriginalConstructor()->getMock();
        $remoteFileServiceMock->expects($this->never())
            ->method('searchRemote');
        $obj = new SearchService($localFileServiceMock, $remoteFileServiceMock);
        $actual = $obj->doSearch($keyword, 2);

        $this->assertSame([1, 2], $actual);
    }

    public function testDoSearchInvokesRemoteFileServiceIfNotEnoughFilesAreFoundLocal()
    {
        $keyword = 'test';
        $localFileServiceMock = $this->getMockBuilder(LocalFileService::class)->disableOriginalConstructor()->getMock();
        $localFileServiceMock->expects($this->once())
            ->method('fetchPictures')
            ->with($keyword)
            ->willReturn([1]);
        $remoteFileServiceMock = $this->getMockBuilder(RemoteFileService::class)->disableOriginalConstructor()->getMock();
        $remoteFileServiceMock->expects($this->once())
            ->method('searchRemote')
            ->with($keyword)
            ->willReturn([2, 3, 4, 5]);
        $obj = new SearchService($localFileServiceMock, $remoteFileServiceMock);
        $actual = $obj->doSearch($keyword, 2);

        $this->assertSame([1, 2], $actual);
    }
}
 