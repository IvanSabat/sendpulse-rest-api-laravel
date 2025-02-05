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

    /**
     * @throws ApiClientException
     */
    public static function listAddressBooks()
    {
        try {
            return app('sendpulse')->apiClient->get('addressbooks');
        } catch (ApiClientException $e) {
            throw new ApiClientException($e->getMessage());
        }
    }

    /**
     * @throws ApiClientException
     */
    public static function addEmails(int $bookId, array $emails, array $additionalParams = [])
    {
        if (empty($bookId) || empty($emails)) {
            throw new ApiClientException('Empty book id or emails');
        }

        try {
            $data = [
                'emails' => $emails,
            ];

            if ($additionalParams) {
                $data = array_merge($data, $additionalParams);
            }

            return app('sendpulse')->apiClient->post('addressbooks/' . $bookId . '/emails', $data);
        } catch (ApiClientException $e) {
            throw new ApiClientException($e->getMessage());
        }
    }

    // Add more methods according to SendPulse API functionalities you need
}
