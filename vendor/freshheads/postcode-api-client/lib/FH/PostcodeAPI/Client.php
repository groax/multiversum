<?php

namespace FH\PostcodeAPI;

use FH\PostcodeAPI\Exception\CouldNotParseResponseException;
use FH\PostcodeAPI\Exception\InvalidApiKeyException;
use FH\PostcodeAPI\Exception\ServerErrorException;
use GuzzleHttp\Psr7\Request;
use Http\Client\HttpClient;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Client library for postcodeapi.nu 2.0 web service.
 *
 * @author Gijs Nieuwenhuis <gijs.nieuwenhuis@freshheads.com>
 * @author Evert Harmeling <evert@freshheads.com>
 */
class Client
{
    const POSTCODES_SORT_DISTANCE = 'distance';

    /**
     * @var null|string
     */
    private $url = 'https://postcode-api.apiwise.nl';

    /**
     * @var string
     */
    private $version = 'v2';

    /**
     * @var HttpClient
     */
    private $httpClient;


    public function __construct(HttpClient $httpClient, $url = null)
    {
        if (null !== $url) {
            $this->url = $url;
        }

        $this->httpClient = $httpClient;
    }

    /**
     * @param string|null $postcode
     * @param string|null $number
     * @param int $from
     *
     * @return \stdClass
     */
    public function getAddresses($postcode = null, $number = null, $from = 0)
    {
        return $this->get('/addresses/', [
            'postcode' => $postcode,
            'number' => $number,
            'from' => $from
        ]);
    }

    /**
     * @param string $id
     *
     * @return \stdClass
     */
    public function getAddress($id)
    {
        return $this->get(sprintf('/addresses/%s', $id));
    }

    /**
     * @param string $latitude
     * @param string $longitude
     * @param string $sort
     *
     * @return \stdClass
     */
    public function getPostcodesByCoordinates($latitude, $longitude, $sort = self::POSTCODES_SORT_DISTANCE)
    {
        return $this->get('/postcodes/', [
            'coords' => [
                'latitude' => $latitude,
                'longitude' => $longitude
            ],
            'sort' => $sort
        ]);
    }

    /**
     * @param string $path
     * @param array $params
     *
     * @return \stdClass
     *
     * @throws RequestException
     */
    private function get($path, array $params = [])
    {
        $request = $this->createHttpGetRequest($this->buildUrl($path), $params);

        $response = $this->httpClient->sendRequest($request);

        return $this->parseResponse($response, $request);
    }

    /**
     * @param string $path
     * @return string
     */
    private function buildUrl($path)
    {
        return sprintf('%s/%s%s', $this->url, $this->version, $path);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $queryParams
     *
     * @return Request
     */
    private function createHttpGetRequest($url, array $params = [])
    {
        $url .= (count($params) > 0 ? '?' . http_build_query($params, null, '&', PHP_QUERY_RFC3986) : '');

        return new Request('GET', $url);
    }

    /**
     * @param ResponseInterface $response
     *
     * @return \stdClass
     *
     * @throws CouldNotParseResponseException
     */
    private function parseResponse(ResponseInterface $response, RequestInterface $request)
    {
        $result = json_decode((string) $response->getBody()->getContents());

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new CouldNotParseResponseException('Could not parse response', $response);
        }

        if (property_exists($result, 'error')) {
            switch ($result->error) {
                case 'API key is invalid.':
                    throw new InvalidApiKeyException();
                case 'An unknown server error occured.':
                    throw ServerErrorException::fromRequest($request);
            }
        }

        return $result;
    }
}
