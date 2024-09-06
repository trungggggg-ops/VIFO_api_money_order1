<?php
namespace App\Services;

class Webhook
{
    public function handle($data, $requestSignature, $signature)
    {
        $data = json_decode($data, true);

        if ($signature !== $requestSignature) {
            return "no";
        } else {
            return "yes";
        }
    }
}



