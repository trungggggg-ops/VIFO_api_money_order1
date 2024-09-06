<?php
namespace App\Services;

class VIfoOtherRequest
{
    private $headers;
    private $sendRequest;
    public function __construct($headers)
    {
        $this->headers = $headers;
        $this->sendRequest = new VifoSendRequest();
    }
    public function checkOrderStatus($data)
    {
        $key = $data['data']['order_number'];
        $endpoint = "/v2/finance/{$key}/status";

        $response = $this->sendRequest->sendRequest("GET", $endpoint, $this->headers, $body = "");
        return $response;
    }
}
