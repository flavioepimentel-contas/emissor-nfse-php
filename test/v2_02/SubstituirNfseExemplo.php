<?php
ini_set("default_socket_timeout", 60);

define('DS', DIRECTORY_SEPARATOR);

include '../vendor/autoload.php';

use EmissorNfse\Config;
use EmissorNfse\Certificate;
use EmissorNfse\Connection;
use EmissorNfse\Providers\Webiss\V2_02\Request\SubstituirNfseRequest;


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
// Exemplo de como gerar uma nota fiscal utilizando o serviço "SubstituirNfse"
// Obs: os valores utilizados abaixo são meramente demostrativos
// Todas as opções SET disponíveis na classe SubstituirNfseRequest podem ser obtidas no manual de uso
// Sobre os possívels valores a serem informados, constam no manual da ABRASF: http://www.abrasf.org.br/arquivos/publico/NFS-e/Versao_2.02/NFSE-NACIONAL_Manual_De_Integracao%20versao%202-02.pdf
// ou nos manuais disponibilizados pelo município

$request = new SubstituirNfseRequest();

$request->setCodigoCancelamentoNfseSubstituir(1);
$request->setCodigoMunicipioPrestador('3100401');
$request->setNumeroNfseSubstituir('202000000000023');
$request->setCnpjPrestador('04339855000124');
$request->setInscricaoMunicipalPrestador('1986');
$request->setNumeroRps('21');
$request->setSerieRps('ws1');
$request->setDataEmissaoRps(date('Y-m-d'));
$request->setStatusRps(1);
$request->setCompetencia(date('Y-m-d'));
$request->setValorServicos(100.00);
$request->setValorIss(5.00);
$request->setAliquota(5.00);
$request->setIssRetido(2);
$request->setItemListaServico('0102');
$request->setCodigoTributacaoMunicipio('0102');
$request->setCodigoCnae('6190601');
$request->setCodigoMunicipioPrestacao('3100401');
$request->setCodigoPaisPrestacao('1058');
$request->setCodigoMunicipioIncidencia('3100401');
$request->setCpfCnpjTomador('31331662000178');
$request->setEmailTomador('teste@testeemail.com');
$request->setRazaoSocialTomador('Empresa de Teste de Webservice');
$request->setEnderecoTomador('Rua Breno José Coronel Machado');
$request->setNumeroEnderecoTomador('4301602');
$request->setBairroTomador('Centro');
$request->setCodigoMunicipioTomador('4301602');
$request->setUfTomador('RS');
$request->setCodigoPaisTomador('1058');
$request->setCepTomador('96419230');
$request->setOptanteSimplesNacional(2);
$request->setDiscriminacao('Esta é a descrição do serviço de teste. &lt;br&gt;Depois do ponto teve uma quebra de linha');

// cria uma conexão
$connection = new Connection($config);
// Despacha a request para o webservice e retorna um objeto do tipo Response (ver manual para verificar as opções disponívels de get nos objetos do tipo Response)
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
    if(! empty($response->nfseSubstituidora)){
        // Gerou uma NFS-e
        $numeroNfse = $response->nfseSubstituidora->numeroNfse;
        $codigoVerificacao = $response->nfseSubstituidora->codigoVerificacao;
        $inscricaoMunicipalTomador = (! empty($response->nfseSubstituidora->inscricaoMunicipalTomador)) ? $response->nfseSubstituidora->inscricaoMunicipalTomador : null;
        // etc ....
    }else{
        echo 'Erro indefinido. Verifique o trace para maiores informações';
    }
}







