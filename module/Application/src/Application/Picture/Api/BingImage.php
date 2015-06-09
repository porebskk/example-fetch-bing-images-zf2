<?php

namespace Application\Picture\Api;


use Application\Picture\DataModel\RemotePicture;

class BingImage
{
    /** @var string Request-Url */
    protected $webUrl = 'https://api.datamarket.azure.com/Bing/Search/v1/Image?Query=\'%s\'&Market=\'en-GB\'&Adult=\'Strict\'';
    /** @var string Username for HTTP authentication */
    protected $username;
    /** @var string Password for HTTP authentication */
    protected $password;

    public function __construct($username, $password, $webUrl = null)
    {
        $this->username = $username;
        $this->password = $password;
        if (null !== $webUrl) {
            $this->webUrl = $webUrl;
        }
    }

    public function search($keyword)
    {
        $content = $this->fetchXmlViaWebservice($keyword);
        $xml = new \SimpleXMLElement($content);
        $xml->registerXPathNamespace('d', 'http://schemas.microsoft.com/ado/2007/08/dataservices');
        $thumbnailUrls = $xml->xpath('//d:Thumbnail/d:MediaUrl');
        $result = [];
        foreach ($thumbnailUrls as $urlTextNode) {
            $result[] = new RemotePicture((string)$urlTextNode);
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getWebUrl()
    {
        return $this->webUrl;
    }

    /**
     * @param string $keyword
     * @return string XML as string
     */
    public function fetchXmlViaWebservice($keyword)
    {
        $context = stream_context_create(array(
            'http' => array(
                'header' => 'Authorization: Basic ' . base64_encode(sprintf('%s:%s', $this->getUsername(), $this->getPassword()))
            )
        ));
        $content = file_get_contents(sprintf($this->getWebUrl(), $keyword), false, $context);
        return $content;
    }
} 