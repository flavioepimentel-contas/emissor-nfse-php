<?php


ini_set("default_socket_timeout", 60);

define('DS', DIRECTORY_SEPARATOR);

include '../../vendor/autoload.php';

use EmissorNfse\Config;
use EmissorNfse\Certificate;
use EmissorNfse\Connection;
use EmissorNfse\Providers\Webiss\V1_00\Request\RecepcionarLoteRpsRequest;
use EmissorNfse\Providers\Webiss\V1_00\Request\Rps;

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


$connection = new Connection($config);

$request = new RecepcionarLoteRpsRequest();

$request->setInscricaoMunicipalPrestador('101010');
$request->setCnpjPrestador('18765369000166');
//$request->setNumeroLote(1);

$rps = new Rps();
$rps->setCnpjPrestador('18765369000166');
$rps->setInscricaoMunicipalPrestador('101010');
/*
 * Tenha em mente que o sistema webiss utiliza a combinação da serie e do numero do RPS para identificar se o mesmo já foi emitido.
 * Neste sentido, por exemplo, se a nota fiscal referente ao RPS 1 da Série 1 for emitido COM SUCESSO, então estes números
 * não poderão mais ser usados para emitir uma nova nota fiscal. O ideal é que para as demais notas você vá incrementando
 * o número do RPS
 */
$rps->setSerieRps('1');
$rps->setNumeroRps('1');
$rps->setTipoRps('1');

$rps->setStatusRps(1);
$rps->setDataEmissaoRps(date('Y-m-d H:i:s'));
$rps->setNaturezaOperacao(1);
$rps->setOptanteSimplesNacional(2);
$rps->setIncentivadorCultural(2);

$rps->setCpfCnpjTomador('63.502.676/0001-01');
$rps->setRazaoSocialTomador('Tomador teste');
$rps->setCodigoMunicipioTomador('3100401');
$rps->setEnderecoTomador('Avenida xxxx');
$rps->setNumeroEnderecoTomador('10');
$rps->setBairroTomador('Centro');
$rps->setCepTomador('35438000');
$rps->setUfTomador('MG');
$rps->setEmailTomador('emailtomadorteste@teste.com');

$rps->setValorServicos(100.00);
$rps->setAliquota(0.0200);
$rps->setIssRetido(2);
$rps->setValorIss(2.00);
$rps->setValorIssRetido(0.00);

$rps->setItemListaServico('0701');
$rps->setCodigoTributacaoMunicipio('0701');
$rps->setCodigoMunicipioPrestacao('3100401');

$rps->setDiscriminacao('Descrição da nota fiscal');

$request->addRps($rps);


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
    if(! empty($response->protocolo)){
        echo 'Nota enviada com sucesso. Número do protocolo: '. $response->protocolo;
    }else{
        echo 'Erro indefinido. Verifique o trace para maiores informações';
    }
}


