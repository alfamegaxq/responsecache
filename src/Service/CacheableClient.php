<?php

namespace Hopinspace\Service;

use GuzzleHttp\Client;

class CacheableClient extends Client
{
    /**
     * @var string
     */
    private $requestCacheDirectory = '/var/www/html/var/cache/responseCache';

    public function __construct(array $config = [])
    {
        if (isset($config['requestCacheDirectory'])) {
            $this->requestCacheDirectory = $config['requestCacheDirectory'];
        }

        parent::__construct($config);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array  $options
     *
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function request($method, $uri = '', array $options = [])
    {
        $cacheKey = \md5($method . $uri . \json_encode($options));
        if (!mkdir($concurrentDirectory = $this->requestCacheDirectory) && !is_dir($concurrentDirectory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
        }

        $cacheFile = $this->requestCacheDirectory . '/' . $cacheKey;
        if (\file_exists($cacheFile)) {
            return \file_get_contents($cacheFile);
        }

        $response = parent::request($method, $uri, $options);
        $content = $response->getBody()->getContents();

        \file_put_contents($cacheFile, $content);

        return $content;
    }
}
