<?php

namespace HBank\Utils;

class ErrorHandler
{
    public static function handle(\Throwable $e): void
    {
        error_log('Erro: ' . $e->getMessage());
        throw new \RuntimeException('Erro na API: ' . $e->getMessage());
    }
}