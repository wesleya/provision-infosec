<?php
namespace App\Cloud;

use DigitalOceanV2\Adapter\GuzzleHttpAdapter;

class Linode
{
    const ENDPOINT = 'https://api.linode.com/v4/';

    /**
     * @var GuzzleHttpAdapter
     */
    protected $adapter;

    public function __construct($adapter)
    {
        $this->adapter = $adapter;
    }

    public function regions()
    {
        $endpoint = self::ENDPOINT . 'regions';

        $result = $this->adapter->get($endpoint);

        return collect(json_decode($result)->data);
    }

    public function types()
    {
        $endpoint = self::ENDPOINT . 'linode/types';

        $result = $this->adapter->get($endpoint);

        return collect(json_decode($result));
    }

    public function images()
    {
        $endpoint = self::ENDPOINT . 'images';

        $result = $this->adapter->get($endpoint);

        return collect(json_decode($result)->data);
    }

    public function create($size, $image, $region)
    {
        $endpoint = self::ENDPOINT . 'linode/instances';
        $data = [
            "type" => $size,
            "region" => $region,
            // "image" => $image,
            "label" => "web-goat-{$region}-{$size}"
        ];

        return $this->adapter->post($endpoint, $data);
    }
}