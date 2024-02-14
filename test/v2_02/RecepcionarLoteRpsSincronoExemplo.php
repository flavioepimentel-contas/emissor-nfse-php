<?php
ini_set("default_socket_timeout", 60);

define('DS', DIRECTORY_SEPARATOR);

include '../vendor/autoload.php';

use EmissorNfse\Config;
use EmissorNfse\Certificate;
use EmissorNfse\Connection;
use EmissorNfse\Providers\Webiss\V2_02\Request\RecepcionarLoteRpsSincronoRequest;
use EmissorNfse\Providers\Webiss\V2_02\Request\Rps;

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

$config->setTraceInBrowser(false);

// Testa se a conexão com o webservice está sendo completada corretamente. Deve retornar um array contendo os serviços disponibilizados
// pelo webservice
/*
$connection = new Connection($config);
var_dump($connection->listWsOperations(true)); exit;
*/


// ###############################################
// Exemplo de como gerar uma nota fiscal utilizando o serviço "RecepcionarLoteRpsSincrono"
// Obs: os valores utilizados abaixo são meramente demostrativos
// Todas as opções SET disponíveis na classe GerarNfseRequest podem ser obtidas no manual de uso
// Sobre os possívels valores a serem informados, constam no manual da ABRASF: http://www.abrasf.org.br/arquivos/publico/NFS-e/Versao_2.02/NFSE-NACIONAL_Manual_De_Integracao%20versao%202-02.pdf
// ou nos manuais disponibilizados pelo município



// No caso de envio em lote, a Request não contém o RPS (Dados da nota), portanto é necessário adicionar um ou vários RPS a ela
$request = new RecepcionarLoteRpsSincronoRequest();
$request->setCnpjPrestador('04331119000124');
$request->setInscricaoMunicipalPrestador('1986');
$request->setNumeroLote(4);


$rps = new Rps();

$rps->setCnpjPrestador('04331119000124');
$rps->setInscricaoMunicipalPrestador('1986');
$rps->setNumeroRps('25');
$rps->setSerieRps('ws1');
$rps->setDataEmissaoRps(date('Y-m-d'));
$rps->setStatusRps(1);
$rps->setCompetencia(date('Y-m-d'));
$rps->setValorServicos(100.00);
$rps->setValorIss(5.00);
$rps->setAliquota(5.00);
$rps->setIssRetido(2);
$rps->setItemListaServico('0102');
$rps->setCodigoTributacaoMunicipio('0102');
$rps->setCodigoCnae('6190601');
$rps->setCodigoMunicipioPrestacao('3100401');
$rps->setCodigoPaisPrestacao('1058');
$rps->setCodigoMunicipioIncidencia('3100401');
$rps->setCpfCnpjTomador('31331662000178');
$rps->setEmailTomador('teste@testeemail.com');
$rps->setRazaoSocialTomador('Empresa de Teste de Webservice');
$rps->setEnderecoTomador('Rua Breno José Coronel Machado');
$rps->setNumeroEnderecoTomador('4301602');
$rps->setBairroTomador('Centro');
$rps->setCodigoMunicipioTomador('4301602');
$rps->setUfTomador('RS');
$rps->setCodigoPaisTomador('1058');
$rps->setCepTomador('96419230');
$rps->setOptanteSimplesNacional(2);
$rps->setDiscriminacao('Esta é a descrição do serviço de teste. &lt;br&gt;Depois do ponto teve uma quebra de linha');

// Adiciona o RPS ao lote ($request)
$request->addRps($rps);
// Você pode adicionar mais RPS (Entre em contato com o município para saber qual é a quantidade máxima)
// $rps = new Rps()
// $rps->setCnpjPrestador()
// .....
// $request->add($rps);


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
    // Para o serviço RecepcionarLoteRpsSincrono é retornado em caso de sucesso, o XML das notas fiscais geradas
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
