<?php

namespace KillSwitch;

use GuzzleHttp\Client;

class KillSwitch {

    /**
     * @var bool
     */
    private $status;

    /**
     * @var Client
     */
    private $http;

    /**
     * KillSwitch constructor.
     * @param null $url
     * @param float $timeout
     */
    public function __construct($url = null, $timeout = 1.5)
    {
        $this->status = false;

        if (!is_null($url)) {
            $this->http = new Client([
                'base_uri' => $url,
                'timeout' => $timeout
            ]);
        }
    }

    /**
     * @return bool
     * @throws BadUrlException
     */
    public function status()
    {
        if (!is_null($this->http)) {
            $this->readStatusFromHttpRequest();
        }
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function kill()
    {
        return $this->setStatus(true);
    }

    /**
     * @param $status
     * @return mixed
     */
    public function setStatus($status)
    {
        return $this->status = $status;
    }

    /**
     * @throws BadUrlException
     * @internal param $url
     */
    private function readStatusFromHttpRequest()
    {
        $body = null;

        try {
            $response = $this->http->request('GET', '/');
            $body = (string) $response->getBody();
        } catch (\Exception $e) {
            // fail silently and assume no kill switch
        }

        $this->status = (strstr($body, 'true')) ? true : false;
    }
}