<?php
namespace App\Services;

class VifoApproveTransferMoney
{
    private $headers;
    private $sendRequest;

    public function __construct($headers)
    {
        $this->headers = $headers;
        $this->sendRequest = new VifoSendRequest();
    }

    private function createSignature($body, $secretKey, $timestamp)
    {
        ksort($body);
        $payload = json_encode($body);
        $signatureString = $timestamp . $payload;

        return hash_hmac('sha256', $signatureString, $secretKey);
    }

    public function approveTransfers($data)
    {
        $endpoint = '/v2/finance/confirm';
        $timestamp = date('Y-m-d H:i:s');
        $secretKey = 'Uz7xYpuH0DFcET8NZ9egdhCujJzJvYl2';

        $body = [
            "status" => 6,
            "ids" => [$data['data']['id']]
        ];

        $requestSignature = $this->createSignature($body, $secretKey, $timestamp);

        $this->headers = array_merge($this->headers, [
            'x-request-timestamp' => $timestamp,
            'x-request-signature' => $requestSignature
        ]);

        $response = $this->sendRequest->sendRequest('POST', $endpoint, $this->headers, $body);

        return $response;
    }
}
