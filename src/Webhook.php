<?php

namespace App\Services;

class Webhook
{
    public function handle($data, $requestSignature, $signature)
    {
        $data = json_decode($data, true);

        if ($signature !== $requestSignature) {
            echo "no";
        } else {
            echo "yes";
        }
    }
}

$test = new Webhook();
$signature = 1;
$requestSignature = 1;

$test->handle($data, $signature, $requestSignature);
