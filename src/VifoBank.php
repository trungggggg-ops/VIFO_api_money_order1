<?php
namespace App\Services;

class VifoBank
{
    private $headers;
    private $sendRequest;
    public function __construct($headers)
    {
        $this->sendRequest = new VifoSendRequest();
        $this->headers = $headers;
    }

    public function getBank()
    {
        $endpoint = '/v2/data/banks/napas';
        $body = [
            "code" => "970405",
            "short_name" => "Agribank",
            "name" => "Ngân hàng Nông nghiệp và Phát triển Nông thôn Việt Nam"
        ];
        $response = $this->sendRequest->sendRequest('GET', $endpoint, $this->headers, $body);
        return $response;
    }



    public function getBeneficiaryName()
    {
        $endpoint = '/v2/finance/napas/receiver';
        $body = [
            "bank_code" => "970406",
            "account_number" => "0129837294"
        ];

        $response = $this->sendRequest->sendRequest('POST', $endpoint, $this->headers, $body);
        return $response;
    }
}
