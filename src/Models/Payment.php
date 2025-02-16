<?php

namespace HBank\Models;

class Payment
{
    public static function createPaymentLinkRequest(
        string $amount,
        string $description,
        string $notificationUrl,
        string $redirectUrl,
        array $cupons = []
    ): array {
        return [
            'amount' => $amount,
            'description' => $description,
            'notification_url' => $notificationUrl,
            'redirect' => $redirectUrl,
            'cupons' => $cupons,
        ];
    }
}