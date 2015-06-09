<?php

namespace Application\test\ApplicationTest\Picture\Api;

use Application\Picture\Api\BingImage;

class BingImageTest extends \PHPUnit_Framework_TestCase
{
    public function testSearch()
    {
        /** @var BingImage|\PHPUnit_Framework_MockObject_MockObject $halfMock */
        $halfMock = $this->getMockBuilder(BingImage::class)->disableOriginalConstructor()->setMethods(['fetchXmlViaWebservice'])->getMock();

        $keyword = 'keyword';
        $dataFolder = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'data';
        $xml = file_get_contents(realpath($dataFolder . DIRECTORY_SEPARATOR . 'bing-image-voodoo.xml'));
        $halfMock->expects($this->once())->method('fetchXmlViaWebservice')->with($keyword)->willReturn($xml);

        $actual = $halfMock->search($keyword);

        $this->assertCount(50, $actual);
    }
}
 