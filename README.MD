# HBank SDK PHP

Este é um SDK em PHP para interagir com a API de pagamentos da **HBank**. Ele permite criar links de pagamento e verificar o status de pagamentos de forma simples e eficiente.

---

## Instalação

Para instalar o SDK, use o **Composer**. Execute o seguinte comando no terminal:

```bash
composer require https://github.com/murillofrazaocunha/HBank-sdk-php
```

## Requisitos

- PHP 8.0 ou superior.
- Composer instalado.
- Chave de API da HBank.

---

## Configuração

### 1. **Autoloading**
O SDK usa autoloading do Composer. Certifique-se de incluir o autoloader no seu projeto:

```php
require 'vendor/autoload.php';
```

### 2. **Chave de API**
Você precisará de uma chave de API para autenticar as requisições. Configure-a ao criar uma instância do `PaymentService`:

```php
use HBank\Api\PaymentService;

$apiKey = 'sua-chave-de-api'; // Substitua pela sua chave de API
$paymentService = new PaymentService($apiKey);
```

---

## Uso Básico

Aqui está um exemplo básico de como usar o SDK para criar um link de pagamento e verificar o status:

```php
use HBank\Api\PaymentService;
use HBank\Models\Payment;

require 'vendor/autoload.php';

$apiKey = 'sua-chave-de-api'; // Substitua pela sua chave de API
$paymentService = new PaymentService($apiKey);

try {
    // Dados para criar o link de pagamento
    $paymentData = Payment::createPaymentLinkRequest(
        '100.00', // Valor do pagamento
        'Teste',  // Descrição do pagamento
        'https://hightpanel.com.br', // URL de notificação
        'https://hightpanel.com.br', // URL de redirecionamento
        ['TESTE' => '20%'] // Cupons de desconto
    );

    // Cria o link de pagamento
    $paymentLink = $paymentService->createPaymentLink($paymentData);
    echo "Link de pagamento criado: " . $paymentLink['link'] . "\n";

    // Verifica o status do pagamento
    $paymentStatus = $paymentService->getPaymentStatus($paymentLink['id']);
    echo "Status do pagamento: " . $paymentStatus['pstatus'] . "\n";
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
```

---

## Métodos Disponíveis

### 1. **`PaymentService::createPaymentLink(array $data)`**
Cria um link de pagamento.

- **Parâmetros**:
    - `$data` (array): Dados do pagamento.
        - `amount` (string): Valor do pagamento (ex: `"100.00"`).
        - `description` (string): Descrição do pagamento.
        - `notification_url` (string): URL para receber notificações.
        - `redirect` (string): URL para redirecionamento após o pagamento.
        - `cupons` (array): Cupons de desconto (opcional).
- **Retorno**:
    - Retorna um array com:
        - `status` (string): Status da operação (`"success"` ou `"error"`).
        - `link` (string): Link de pagamento gerado.
        - `id` (string): ID do pagamento.

---

### 2. **`PaymentService::getPaymentStatus(string $id)`**
Verifica o status de um pagamento.

- **Parâmetros**:
    - `$id` (string): ID do pagamento.
- **Retorno**:
    - Retorna um array com:
        - `status` (string): Status da operação (`"success"` ou `"error"`).
        - `id` (string): ID do pagamento.
        - `amount` (string): Valor do pagamento.
        - `description` (string): Descrição do pagamento.
        - `pstatus` (string): Status do pagamento.
        - `cupons` (array): Cupons aplicados.


## Tratamento de Erros

O SDK lança exceções em caso de erros. Use um bloco `try/catch` para capturar e tratar os erros:

```php
try {
    $paymentLink = $paymentService->createPaymentLink($paymentData);
    echo "Link de pagamento criado: " . $paymentLink['link'] . "\n";
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
}
```


## Contribuição

Se encontrar algum problema ou tiver sugestões, sinta-se à vontade para abrir uma **issue** ou enviar um **pull request**.

---

## Licença

Este projeto está licenciado sob a [MIT License](LICENSE).