<?php
namespace App\Services;

class VifoTransferMoney
{
    private $headers;
    private $sendRequest;
    public function __construct($headers)
    {
        $this->headers = $headers;
        $this->sendRequest = new VifoSendRequest();
    }

    public function createTransferMoney()
    {
        $endpoint = '/v2/finance';
        $body = [
            "product_code" => "SEVAVF240101",
            "phone" => "01235324",
            "fullname" => "Dai Vu",
            "final_amount" => 18000000,
            "distributor_order_number" => "XXXXXXX192",
            "benefiary_bank_code" => "970406",
            "benefiary_account_no" => "0214599002",
            "comment" => "Dai test",
            "source account no" => "543534253425"
        ];

        $response = $this->sendRequest->sendRequest('POST', $endpoint, $this->headers, $body);

        return $response;
    }
}
