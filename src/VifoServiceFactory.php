<?php
namespace App\Services;


class VifoServiceFactory
{
    private $env;
    public $login;
    private $sendRequest;
    private $bank;
    private $transfer_Money;
    public $headersLogin = [
        'Accept' => 'application/json, text/plain, */*',
        'Accept-Encoding' => 'gzip, deflate',
        'Accept-Language' => '*/*',
    ];
    public $headers = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ];
    public function __construct($env = 'dev')
    {
        $this->env = $env;
        $this->login = new VifoAuthenticate();
        $this->sendRequest = new VifoSendRequest($this->env);
    }

    public function login($username, $password)
    {
        $endpoint = '/v1/clients/web/admin/login';
        $body = $this->login->login($username, $password);
        $response = $this->sendRequest->sendRequest('POST', $endpoint, $this->headersLogin, $body);
        // print_r($response);
        if ($response && isset($response['access_token'])) {
            $this->headers['Authorization'] =  'Bearer ' . $response['access_token'];

            if ($username == 'NEWSPACE_admin_demo' && $password == 'newspace@vifo123') {
                $this->headersLogin['Authorization'] =  'Bearer ' . $response['access_token'];
            }
            return $response;
        } else {
            return null;
        }
    }

    public function getHeaderBank()
    {
        return $this->bank  = new VifoBank($this->headers);
    }

    public function getHeadereTransferMoney()
    {
        return $this->bank  = new VifoTransferMoney($this->headers);
    }

    public function ApproveTransferMoney()
    {
        return $this->bank  = new VifoApproveTransferMoney($this->headersLogin);
    }

    public function OtherRequest()
    {
        return $this->bank  = new VIfoOtherRequest($this->headers);
    }
}
