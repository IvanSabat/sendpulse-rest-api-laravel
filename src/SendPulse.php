<?php

namespace IvanSabat\SendPulse;

use Illuminate\Support\Facades\Log;
use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\ApiClientException;
use Sendpulse\RestApi\Storage\FileStorage;

class SendPulse
{
    private ApiClient $apiClient;

    public function __construct(string $userId, string $secret)
    {
        try {
            $this->apiClient = new ApiClient($userId, $secret, new FileStorage);
        } catch (ApiClientException $e) {
            Log::error($e->getMessage(), ['userId' => $userId]);
        }
    }

    public function __call($method, $args)
    {
        return $this->apiClient->$method(...$args);
    }

    public static function getAddressBooks(): ?array
    {
        $sendPulse = app('sendpulse');
        try {
            return $sendPulse->apiClient->get('addressbooks');
        } catch (ApiClientException $e) {
            Log::error($e->getMessage(), ['method' => 'getAddressBooks']);
        }

        return null;
    }

    // Add more methods according to SendPulse API functionalities you need
}
