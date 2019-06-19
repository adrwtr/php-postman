# php-postman

Executor de APIs em PHP

# php libs
GUZZLE



# APIs

# GATEWAY

    - posta para gateway para saber qual o vid de uma fatura
    http://localhost/pm/executor.php?api=gateway-unimestre/recupera-vid

    - posta para gateway criar o formulario de pagamento
    http://localhost/pm/executor.php?api=gateway-unimestre/api-gateway-pagar
    http://localhost/pm/executor.php?api=gateway-unimestre/teste-gateway-pagar/1-fatura-simples
    http://localhost/pm/executor.php?api=gateway-unimestre/teste-gateway-pagar/2-fatura-dupla
    http://localhost/pm/executor.php?api=gateway-unimestre/teste-gateway-pagar/3-recorrencia-programada
    http://localhost/pm/executor.php?api=gateway-unimestre/teste-gateway-pagar/4-recorrencia-assinatura-mensal

    - enviado para gateway para cancelar mensalidades
    http://localhost/pm/executor.php?api=gateway-unimestre/api-gateway-cancelar

# GATEWAY > UNIMESTRE

    - enviado para o unimestre - para avisar alguma movimentação de pagamento no webhook
    http://localhost/pm/executor.php?api=unimestre/gateway/webhook-pagamento

    - enviado para o unimestre - para avisar alguma movimentação de cancelamento no webhook
    http://localhost/pm/executor.php?api=unimestre/gateway/webhook-cancelamento

# VINDI > Gateway

    - enviado pela vindi - informando que uma bill foi cancelada
    http://localhost/pm/executor.php?api=vindi/webhook-cancelar

    - enviado pela vindi - informando que uma bill foi paga
    http://localhost/pm/executor.php?api=vindi/webhook-pagamento
