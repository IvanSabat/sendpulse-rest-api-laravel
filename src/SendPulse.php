<?php

namespace IvanSabat\SendPulse;

use Illuminate\Support\Facades\Log;
use IvanSabat\SendPulse\Contracts\SendPulseContract;
use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\ApiClientException;
use Sendpulse\RestApi\Storage\FileStorage;

class SendPulse implements SendPulseContract
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
    public static function listAddressBooks(): ?array
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
    public static function addEmails(int $bookId, array $emails, array $additionalParams = []): ?array
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

    /**
     * @throws ApiClientException
     */
    public static function updateEmailVariables(int $bookId, string $email, array $vars): ?array
    {
        try {
            $data = ['email' => $email, 'variables' => []];
            foreach ($vars as $name => $val) {
                $data['variables'][] = ['name' => $name, 'value' => $val];
            }

            return app('sendpulse')->apiClient->post('addressbooks/' . $bookId . '/emails/variable', $data);
        } catch (ApiClientException $e) {
            throw new ApiClientException($e->getMessage());
        }
    }

    // Add more methods according to SendPulse API functionalities you need
}
