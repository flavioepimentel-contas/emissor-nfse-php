<?php


ini_set("default_socket_timeout", 60);

define('DS', DIRECTORY_SEPARATOR);

include '../../vendor/autoload.php';

use EmissorNfse\Config;
use EmissorNfse\Certificate;
use EmissorNfse\Connection;
use EmissorNfse\Providers\Webiss\V1_00\Request\ConsultarNfsePorRpsRequest;

// PARA CERTIFICADO VÁLIDO
$options = [
    'soapOptions' => [

        'ssl'	=>	[
            'cafile'	=>	__dir__ . DS . '..'. DS . 'ca_mozilla-2020-12-08.pem',
            "verify_peer" => true,
            "verify_host" => true,
            "verify_peer_name" => true,
            "ssl_method" => SOAP_SSL_METHOD_TLS,
            "soap_version" => SOAP_1_1,

        ]
    ]
];



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


$connection = new Connection($config);

$request = new ConsultarNfsePorRpsRequest();

$request->setInscricaoMunicipalPrestador('101010');
$request->setCnpjPrestador('18291875000166');
$request->setInscricaoMunicipalPrestador('101010');
$request->setNumeroRps(1);
$request->setSerieRps(1);


$response = $connection->dispatch($request);

var_dump($response);
exit;

// Conforme os atributos da Response (Ver manual). Você pode capturar os resultados da seguinte forma
if(! empty($response->erros)){
    // Possui erros
    foreach ($response->erros as $erro){
        print_r($erro['codigo']);
        print_r($erro['mensagem']);
        print_r($erro['correcao']);
    }
}else{
    if(! empty($response->listaNfse)){
        foreach ($response->listaNfse as $nfse){
            echo 'Numero da nota: ' . $nfse->numeroNfse;
            echo 'Codigo de verificação: '. $nfse->codigoVerificacao;
            echo 'Valor da base de cálculo: '. $nfse->baseCalculo;

            if(! empty($nfse->dataHoraCancelamento)){
                echo 'Esta nota está cancelada';
            }

            if(! empty($nfse->numeroNfseSubstituidora)){
                echo 'Esta nota foi substituída pela nota número '. $nfse->numeroNfseSubstituidora;
            }

            // O que mais desejar fazer .....................
        }

    }else{
        echo 'Erro indefinido. Verifique o trace para maiores informações';
    }
}


