# APIs

# posta para gateway para saber qual o vid de uma fatura
http://localhost/pm/executor.php?api=gateway-unimestre/recupera-vid

# enviado para gateway para cancelar mensalidades
http://localhost/pm/executor.php?api=gateway-unimestre/api-gateway-cancelar

# enviado para o unimestre - para avisar alguma movimentação no webhook
http://localhost/pm/executor.php?api=unimestre/gateway/ApiUnimestreGatewayWebhook

# enviado pela vindi - informando que uma bill foi cancelada
http://localhost/pm/executor.php?api=vindi/webhook-cancelar