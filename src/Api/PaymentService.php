<?php

namespace HBank\Api;

use HBank\Models\Payment;

class PaymentService
{
    private $apiClient;

    public function __construct(string $apiKey)
    {
        $this->apiClient = new ApiClient($apiKey);
    }

    public function createPaymentLink(array $data): array
    {
        return $this->apiClient->post('/api/createPaymentLink', $data);
    }

    public function getPaymentStatus(string $id): array
    {
        return $this->apiClient->post('/api/getPayment', ['id' => $id]);
    }
}