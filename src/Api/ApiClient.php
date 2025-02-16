<?php

namespace HBank\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use HBank\Utils\ErrorHandler;

class ApiClient
{
    private $client;
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => 'https://hight.me', // URL fixa da API
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'verify' => false, // Desabilita a verificação do certificado SSL
        ]);
    }

    public function post(string $url, array $data): array
    {
        try {
            $response = $this->client->post($url, [
                'json' => $data,
            ]);

            $responseData = json_decode($response->getBody(), true);

            // Verifica se a API retornou um erro
            if (isset($responseData['status']) && $responseData['status'] === 'error') {
                throw new \Exception($responseData['message'] ?? 'Erro desconhecido');
            }

            return $responseData;
        } catch (GuzzleException $e) {
            ErrorHandler::handle($e);
        }

    }
}