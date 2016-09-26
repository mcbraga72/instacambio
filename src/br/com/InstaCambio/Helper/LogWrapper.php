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

        if (strpos($error, "Could not resolve host") != false) {
            $this->message = "Falha na resolução de nomes.";
        }  else if (strpos($error, "Failed connect to") != false) {
            $this->message = "Falha ao conectar ao host.";
        } else if (strpos($error, "Failed to connect to") != false) {
            $this->message = "Falha ao conectar ao host.";
        } else if (strpos($error, "transfer closed") != false) {
            $this->message = "Transferência interrompida.";
        } else if (strpos($error, "Connection timed out") != false) {
            $this->message = "Tempo máximo de conexão esgotado.";
        } else if (strpos($error, "Operation timed out") != false) {
            $this->message = "Tempo máximo de conexão esgotado.";
        } else if (strpos($error, "SSL received a record with an incorrect Message Authentication Code") != false) {
            $this->message = "Problemas durante o SSL handshake.";
        } else if (strpos($error, "Encountered end of file") != false) {
            $this->message = "Problemas durante o SSL handshake.";
        } else if (strpos($error, "SSL received a record that exceeded the maximum permissible length") != false) {
            $this->message = "Problemas durante o SSL handshake.";
        } else if (strpos($error, "A TLS packet with unexpected length was received") != false) {
            $this->message = "Problemas durante o SSL handshake.";
        } else if (strpos($error, "Unable to communicate securely with peer") != false) {
            $this->message = "Probelmas com o certificado SSL do site.";
        } else if (strpos($error, "server certificate verification failed") != false) {
            $this->message = "Falha na verificação do certificado SSL.";
        } else if (strpos($error, "Peer's Certificate issuer is not recognized") != false) {
            $this->message = "Emissor do certificado SSL não reconhecido.";
        } else if (strpos($error, "Empty reply from server") != false) {
            $this->message = "Resposta vazia vinda do servidor.";
        } else if (strpos($error, "Recv failure: Connection reset by peer") != false) {
            $this->message = "Falha durante o recebimento de dados pela rede.";
        } else if (strpos($error, "Peer's certificate") != false) {
            $this->message = "O certificado SSL do servidor não pode ser validado por nenhuma AC reconhecida.";
        } else if (strpos($error, "cURL error 77") != false) {
            $this->message = "Problemas para ler o certificado SSL do servidor.";
        } else if (strpos($error, "401 Access Denied") != false) {
            $this->message = "Acesso negado (Erro 401).";
        } else if (strpos($error, "403 Forbidden") != false) {
            $this->message = "Acesso proibido (Erro 403).";
        } else if (strpos($error, "404 Not Found") != false) {
            $this->message = "Página não encontrada (Erro 404).";
        } else if (strpos($error, "408 Request Time-out") != false) {
            $this->message = "Tempo máximo de requisição esgotado (Erro 408).";
        } else if (strpos($error, "500 Internal Server Error") != false) {
            $this->message = "Erro interno no servidor web (Erro 500).";
        } else if (strpos($error, "500 MySQL server has gone away") != false) {
            $this->message = "Erro interno no servidor de banco de dados (Erro 500).";
        } else if (strpos($error, "502 Proxy Error") != false) {
            $this->message = "Problemas de acesso ao servidor (Erro 502)";
        } else if (strpos($error, "502 Bad Gateway") != false) {
            $this->message = "Problemas de acesso ao servidor (Erro 502)";
        } else if (strpos($error, "503 Service") != false) {
            $this->message = "Serviço temporariamente indisponível (Erro 503).";
        } else if (strpos($error, "503 Backend fetch failed") != false) {
            $this->message = "Serviço temporariamente indisponível (Erro 503).";
        } else if (strpos($error, "508 Loop Detected") != false) {
            $this->message = "Problemas de acesso ao servidor devido a um loop no roteamento (Erro 508).";
        } else if (strpos($error, "520 Origin Error") != false) {
            $this->message = "Erro no servidor web (Erro 520).";
        } else if (strpos($error, "521 Origin Down") != false) {
            $this->message = "Servidor web down (Erro 521).";
        } else if (strpos($error, "522 Origin Connection Time-out") != false) {
            $this->message = "Tempo máximo de conexão esgotado (Erro 521).";
        } else if (strpos($error, "more than 5 redirects") != false) {
            $this->message = "Falha devido a excesso de redirecionamentos.";
        } else if (strpos($error, "Undefined offset") != false) {
            $this->message = "Índice de moeda não definido.";
        } else if (strpos($error, "bin/phantomjs") != false) {
            $this->message = "O binário do PhantomJS não foi encontrado.";
        }

        //return $error;
        return $this->message;
    }
}