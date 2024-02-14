<?php


ini_set("default_socket_timeout", 60);

define('DS', DIRECTORY_SEPARATOR);

include '../../vendor/autoload.php';

use EmissorNfse\Config;
use EmissorNfse\Certificate;
use EmissorNfse\Connection;
use EmissorNfse\Providers\Webiss\V2_02\Request\CancelarNfseRequest;

// PARA CERTIFICADO VÁLIDO
$options = [
    'soapOptions' => [

        'ssl'	=>	[
            'cafile'	=>	__dir__ . DS . '..'. DS . 'ca_mozilla-2020-12-08.pem',
            "verify_peer" => true,
            "verify_host" => true,
            "verify_peer_name" => true,
            "ssl_method" => SOAP_SSL_METHOD_TLS,
//            'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT,
            "soap_version" => SOAP_1_1,

        ]
    ]
];


// $certificate = new Certificate(__dir__ . DS . 'certuberaba-ura2019.pfx', 'ura2019');
$certificate = new Certificate(__dir__ . DS . '..' . DS . 'certificado.pfx', 'senha_certificado');

$config = new Config($options);
$config->setCertificate($certificate);
$config->setTmpDirectory(__dir__ . DS . '..'. DS . 'tmp');
$config->setWsdl('https://feiradesantanaba.webiss.com.br/servicos/wsnfse_homolog/NfseServices.svc?wsdl');

// (OPCIONAL) Faz os arquivos XML de envio e retorno serem salvos em disco
//$config->setXmlDirectory(__dir__ . DS . 'tmp' . DS . 'xml');
// (OPCIONAL) Faz o trace da conexão ser gravado em arquivo de LOG
//$config->setLogDirectory(__dir__ . DS . 'tmp' . DS . 'logs');

//$config->setTraceInBrowser(false);

// Testa se a conexão com o webservice está sendo completada corretamente. Deve retornar um array contendo os serviços disponibilizados
// pelo webservice

$connection = new Connection($config);
var_dump($connection->listWsOperations(true)); exit;

