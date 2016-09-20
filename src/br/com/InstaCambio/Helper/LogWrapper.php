<?php

namespace br\com\InstaCambio\Helper;

use Monolog\Logger;

class LogWrapper
{
    /**
     * @var array
     */
    private $logs;

    /**
     * @var string
     */
    private $message;

    /**
     * LogWrapper constructor.
     */
    public function __construct()
    {
        $this->logs = [];
    }

    /**
     * @return array
     */
    public function getLogs()
    {
        return $this->logs;
    }

    public function addLog($message, $level = Logger::ERROR, array $context = [])
    {
        $this->logs[$level][] = [$message, $context];
    }

    public function setMessage($error)
    {
        switch ($error) {
            case "Could not resolve host":
                $this->message = "Falha na resolução de nomes.";
                break;
            case "Failed connect to":
                $this->message = "Falha ao conectar ao host.";
                break;
            case "Failed to connect to":
                $this->message = "Falha ao conectar ao host.";
                break;
            case "transfer closed":
                $this->message = "Transferência interrompida.";
                break;
            case "Connection timed out":
                $this->message = "Tempo máximo de conexão esgotado.";
                break;
            case "Operation timed out":
                $this->message = "Tempo máximo de conexão esgotado.";
                break;
            case "SSL received a record with an incorrect Message Authentication Code":
                $this->message = "Problemas durante o SSL handshake.";
                break;
            case "Encountered end of file":
                $this->message = "Problemas durante o SSL handshake.";
                break;
            case "SSL received a record that exceeded the maximum permissible length":
                $this->message = "Problemas durante o SSL handshake.";
                break;
            case "A TLS packet with unexpected length was received":
                $this->message = "Problemas durante o SSL handshake.";
                break;
            case "Unable to communicate securely with peer":
                $this->message = "Probelmas com o certificado SSL do site.";
                break;
            case "Empty reply from server":
                $this->message = "Resposta vazia vinda do servidor.";
                break;
            case "Recv failure: Connection reset by peer":
                $this->message = "Falha durante o recebimento de dados pela rede.";
                break;
            case "Peer's certificate":
                $this->message = "O certificado SSL do servidor não pode ser validado por nenhuma AC reconhecida.";
                break;
            case "cURL error 77":
                $this->message = "Problemas para ler o certificado SSL do servidor.";
                break;
            case "401 Access Denied":
                $this->message = "Acesso negado (Erro 401).";
                break;
            case "403 Forbidden":
                $this->message = "Acesso proibido (Erro 403).";
                break;
            case "404 Not Found":
                $this->message = "Página não encontrada (Erro 404).";
                break;
            case "408 Request Time-out":
                $this->message = "Tempo máximo de requisição esgotado (Erro 408).";
                break;
            case "500 Internal Server Error":
                $this->message = "Erro interno no servidor web (Erro 500).";
                break;
            case "500 MySQL server has gone away":
                $this->message = "Erro interno no servidor de banco de dados (Erro 500).";
                break;
            case "502 Proxy Error":
                $this->message = "Problemas de acesso ao servidor (Erro 502)";
                break;
            case "502 Bad Gateway":
                $this->message = "Problemas de acesso ao servidor (Erro 502)";
                break;
            case "503 Service":
                $this->message = "Serviço temporariamente indisponível (Erro 503).";
                break;
            case "503 Backend fetch failed":
                $this->message = "Serviço temporariamente indisponível (Erro 503).";
                break;
            case "508 Loop Detected":
                $this->message = "Problemas de acesso ao servidor devido a um loop no roteamento (Erro 508).";
                break;
            case "520 Origin Error":
                $this->message = "Erro no servidor web (Erro 520).";
                break;
            case "521 Origin Down":
                $this->message = "Servidor web down (Erro 521).";
                break;
            case "522 Origin Connection Time-out":
                $this->message = "Tempo máximo de conexão esgotado (Erro 521).";
                break;
            case "more than 5 redirects":
                $this->message = "Falha devido a excesso de redirecionamentos.";
                break;
            case "Undefined offset":
                $this->message = "Índice de moeda não definido.";
                break;
        }
        return $this->message;
    }
}