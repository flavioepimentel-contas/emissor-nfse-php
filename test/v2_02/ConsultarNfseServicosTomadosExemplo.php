<?php
ini_set("default_socket_timeout", 60);

define('DS', DIRECTORY_SEPARATOR);

include '../vendor/autoload.php';

use EmissorNfse\Config;
use EmissorNfse\Certificate;
use EmissorNfse\Connection;
use EmissorNfse\Providers\Webiss\V2_02\Request\ConsultarNfseServicosTomadosRequest;

// PARA CERTIFICADO VÁLIDO
$options = [
    'soapOptions' => [

        'ssl'	=>	[
            'cafile'	=>	__dir__ . DS . 'ca_mozilla-2020-01-01.pem',
            "verify_peer" => true,
            "verify_host" => true,
            "verify_peer_name" => true,
            "ssl_method" => SOAP_SSL_METHOD_TLS,
            "soap_version" => SOAP_1_1,

        ]
    ]
];


// $certificate = new Certificate(__dir__ . DS . 'certuberaba-ura2019.pfx', 'ura2019');
$certificate = new Certificate(__dir__ . DS . 'certificado.pfx', 'senha_certificado');

$config = new Config($options);
$config->setCertificate($certificate);
$config->setTmpDirectory(__dir__ . DS . 'tmp');
$config->setWsdl('https://treinamento.webiss.com.br/ws/nfse.asmx?wsdl');

// (OPCIONAL) Faz os arquivos XML de envio e retorno serem salvos em disco
//$config->setXmlDirectory(__dir__ . DS . 'tmp' . DS . 'xml');
// (OPCIONAL) Faz o trace da conexão ser gravado em arquivo de LOG
//$config->setLogDirectory(__dir__ . DS . 'tmp' . DS . 'logs');



// Testa se a conexão com o webservice está sendo completada corretamente. Deve retornar um array contendo os serviços disponibilizados
// pelo webservice
/*
$connection = new Connection($config);
var_dump($connection->listWsOperations(true)); exit;
*/


// ###############################################
// Exemplo de como consultar notas fiscais emitidas utilizando o serviço "ConsultarNfseServicosTomados"
// Obs: os valores utilizados abaixo são meramente demostrativos
// Todas as opções SET disponíveis na classe ConsultarNfseServicosTomadosRequest podem ser obtidas no manual de uso
// Sobre os possívels valores a serem informados, constam no manual da ABRASF: http://www.abrasf.org.br/arquivos/publico/NFS-e/Versao_2.02/NFSE-NACIONAL_Manual_De_Integracao%20versao%202-02.pdf
// ou nos manuais disponibilizados pelo município

$request = new ConsultarNfseServicosTomadosRequest();

$request->setCpfCnpjConsulente('04337779000124');
$request->setInscricaoMunicipalConsulente('1986');

$request->setCnpjPrestador('04337779000124');
$request->setInscricaoMunicipalPrestador('1986');
$request->setCpfCnpjTomador('31331662000178');

$request->setInicioPeriodoEmissao('2020-07-21');
$request->setFimPeriodoEmissao('2020-07-21');
$request->setPagina(1);

$connection = new Connection($config);
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
        // Encontrou notas
        foreach ($response->listaNfse as $nfse){
            echo $nfse->numeroNfse;
            echo $nfse->codigoVerificacao;
            echo (! empty($nfse->inscricaoMunicipalTomador)) ? $nfse->inscricaoMunicipalTomador : null;

        }
    }else{
        echo 'Erro indefinido. Verifique o trace para maiores informações';
    }
}