<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 20/01/2019
 * Time: 17:58
 */

namespace EmissorNfse\Providers\Webiss\V2_02\Helpers;

use EmissorNfse\Response;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Soap extends Response
{
    private $wsdl = null;
    private $options = null;
    private $logDirectory = null;
    private $priKeyPem = null;
    private $pubKeyClean = null;
    private $logger = null;
    private $traceInBrowser = false;

    public function __construct($wsdl,  $options, $traceInBrowser, $logDirectory)
    {
        $this->wsdl = $wsdl;
        $this->options = $options;
        $this->logDirectory = $logDirectory;
        $this->traceInBrowser = $traceInBrowser;

        if (file_exists($options['ssl']['local_pk']))
            $this->priKeyPem = file_get_contents($options['ssl']['local_pk']);

        if(file_exists($options['ssl']['local_cert'])){
            $pem = file_get_contents($options['ssl']['local_cert']);
            $clean = $this->cleanKeyPem($pem);
            $this->pubKeyClean = $clean;
        }

        if (! empty($logDirectory) && ! is_dir($logDirectory)){
            mkdir($logDirectory);
        }

        if ( ! empty($logDirectory) && is_dir($logDirectory)){
            // the default date format is "Y-m-d H:i:s"
            $dateFormat = "Y-m-d H:i:s";
            // the default output format is "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n"
            $output = "%datetime% %level_name% %context% %extra%" . PHP_EOL . "%message%" . PHP_EOL . PHP_EOL;
            // finally, create a formatter
            $formatter = new LineFormatter($output, $dateFormat, true, true);

            $this->logger = new Logger('log');
            $rotation = new RotatingFileHandler($logDirectory . 'trace.log', null, Logger::DEBUG);
            $rotation->setFilenameFormat('{date}-{filename}', 'Y-m-d');

            $rotation->setFormatter($formatter);
            // $stream = new StreamHandler($rotation );
            // $stream->setFormatter($formatter);
            $this->logger->pushHandler($rotation);
            //$this->logger->pushHandler(new FirePHPHandler());

        }


    }

    private function cleanKeyPem($pem){
        $ret = preg_replace('/-----.*[\n]?/', '', $pem);
        return preg_replace('/[\n\r]/', '', $ret);
    }

    public function send($request){
        // Obtem a string de envelopamento conforme o WSDL do servidor da Prefeitura especifica
        $envelop = $request->getEnvelopString();

        $xml = '';
        // verifica se existe o método toXmlSigned e o chama, senão chama o método toXml a fim de obter o XML a ser enviado
        if (method_exists($request, 'toXmlSigned')){
            if (empty($this->priKeyPem) || empty($this->pubKeyClean) ){
                throw new \Exception('Para esta operação é obrigatório informar a chave privada e publica do certificado digital');
            }
            $xml = $request->toXmlSigned($this->priKeyPem, $this->pubKeyClean );
        }else{
            $xml = $request->toXml();
        }
        // Substitui o {body} da string de envelope pelo o XML a ser enviado
        $message = str_replace('{body}', '<![CDATA['. $xml . ']]>', $envelop);

        $soap = null;
        $callResult = null;
        try {
            libxml_disable_entity_loader(false);
            $soap = new \SoapClient($this->wsdl , $this->options);
            // obtem o action name para chamada do método do webservice
            $actionName = $request->getAction();
            // Configura a string XML para o formato do soapclient
            $envelopedMessage = new \SoapVar($message, XSD_ANYXML);
            // faz o envio do xml para servidor da prefeitura
            $callResult = $soap->$actionName($envelopedMessage);
            // Se callResult estiver no formato de objeto, o transforma em string
            if (is_object($callResult) && ! empty($callResult->outputXML) && is_string($callResult->outputXML))
                $callResult = $callResult->outputXML;
            else{
                if ( stripos($soap->__getLastResponse(), 'soap:Envelope') !== false)
                    $callResult = $soap->__getLastResponse();
            }
            // var_dump($callResult); exit;

            // cria uma response
            if (! empty($request->getResponseNamespace())) {
                $nameSpaceResponse = $request->getResponseNamespace();
                $objResponse = new $nameSpaceResponse();

                if (!$objResponse->parseXml($callResult)) {
                    // Se houver algum problema com a resposta do servidor da prefeitura e consequentemente não ser
                    // possível converter a string retorno em um objeto do tipo Response será retornado um array
                    $response = [$callResult, $soap];
                } else {
                    $response = $objResponse;
                    if($this->traceInBrowser){
                        @$response->trace = $this->getTrace($soap);
                    }
                    // adiciona o XML de envio na Response
                    @$response->xmlEnvio = $xml;
                    if(! empty($this->logger)){
                        $this->logger->debug(print_r($response->trace, true));
                    }
                }
            }else
                $response = [$callResult, $soap];

        }catch (\SoapFault $e){
            $response = [$callResult, $soap, $e->getMessage()];
            if(! empty($this->logger)){
                $this->logger->debug(print_r($e->getMessage(). PHP_EOL . $e->getTraceAsString(), true));
            }
        }catch (\Exception $e){
            //throw new \Exception($e->getTraceAsString());
            $response = [$callResult, $soap, $e->getMessage()];
            if(! empty($this->logger)){
                $this->logger->debug(print_r($e->getMessage(). PHP_EOL . $e->getTraceAsString(), true));
            }
        }



        return $response;

    }

    private function getTrace($soap){
        $soapDebug = '';
        if (is_object($soap)){
            $soapDebug = 'REQUEST';
            //$soapDebug .= "\n" . $soapFault;
            $soapDebug.=  $soap->__getLastRequestHeaders();
            $soapDebug .= PHP_EOL . $soap->__getLastRequest();
            $soapDebug .= PHP_EOL . '<h3>Response</h3>';
            $soapDebug.= PHP_EOL . $soap->__getLastResponseHeaders();
            $soapDebug .= PHP_EOL . $soap->__getLastResponse();
        }else{
            $soapDebug =  '$soap não é um objeto';
        }

        return $soapDebug;
    }
}
