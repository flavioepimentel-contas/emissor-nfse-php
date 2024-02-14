<?php

namespace EmissorNfse;


use EmissorNfse\Config;
use EmissorNfse\Response;


class Connection
{
    const SYS_DS = DIRECTORY_SEPARATOR;
    private $config;
    private $certsDirectory = null;
    private $lastResponse = null;
    private $logger = null;

    public function __construct(Config $config )
    {
       /* if (! is_object($config) || get_class($config) !=  'Phpnfsews\Config' ){
            throw  new \Exception('O parâmetro passado para o construtor precisa ser do tipo: Phpnfsews\Config');
        }*/

        $this->config = $config;

        if(empty($this->config->getTmpDirectory())){
            throw new \Exception(utf8_encode('Nenhum diretório para arquivos temporários foi definido'));
        }

        if (! is_dir($this->config->getTmpDirectory())){
            mkdir($this->config->getTmpDirectory());
        }
        if (! is_dir($this->config->getTmpDirectory(). 'certs')){
            mkdir($this->config->getTmpDirectory(). 'certs');
        }
        $this->certsDirectory = $this->config->getTmpDirectory() . 'certs/';

        //$this->certificate = $certificate;
        /*if(! empty($config->getLogDirectory())){
            $filePath = $config->getLogDirectory() . SYS_DS . date('Y-m-d') . '_trace.log';

            $this->monoLogger = new Logger('TraceSoapCall');
            $formatter = new LineFormatter(
                null, // Format of message in log, default [%datetime%] %channel%.%level_name%: %message% %context% %extra%\n
                null, // Datetime format
                true, // allowInlineLineBreaks option, default false
                true  // ignoreEmptyContextAndExtra option, default false
            );
            $streamHandler = new StreamHandler($filePath, Logger::DEBUG);
            $streamHandler->setFormatter($formatter);
            $this->monoLogger->pushHandler($streamHandler);
        }*/
    }

    private function setLastResponse($var){

        if (is_object($var) ){
            $this->lastResponse = $var;
        }else{
            if (is_string($var)){
                $this->lastResponse = new Response();
                $this->lastResponse->xmlResposta = $var;
                $this->lastResponse->exception = $var;
            }else{
                if (is_array($var)){
                    $this->lastResponse = new Response();
                    if (isset($var[0])){
                        $this->lastResponse->xmlResposta = $var[0];
                    }
                    if (isset($var[1])){
                        $this->lastResponse->trace = $this->getTrace($var[1]);
                    }
                    if (isset($var[2])){
                        $this->lastResponse->exception = $var[2];
                    }
                }else{
                    // Resposta indefinida
                    $this->lastResponse = $var;
                }
            }
        }
    }


    /**
     * @return null
     */
    public function getLastResponse(){
        return $this->lastResponse;
    }


    private function getTrace($soap){
        if (is_object($soap)){
            $soapDebug = '<h3>Request</h3>';
            //$soapDebug .= "\n" . $soapFault;
            $soapDebug.= "\n" . $soap->__getLastRequestHeaders();
            $soapDebug .= "\n" . $soap->__getLastRequest();
            $soapDebug .= "\n" . '<h3>Response</h3>';
            $soapDebug.= "\n" . $soap->__getLastResponseHeaders();
            $soapDebug .= "\n" . $soap->__getLastResponse();
        }else{
            $soapDebug = date('Y-m-d H:i:s') . ' - $soap não é um objeto';
        }

        return $soapDebug;
    }

    public function listWsOperations($returnTrace = false){
        if(empty($this->config->getCertificate())){
            return 'O certificado digital não foi informado';
        }


        $localPk = $this->certsDirectory . uniqid(). '_priKey.pem';
        $localCert = $this->certsDirectory. uniqid(). '_priKey.pem';

        file_put_contents( $localPk, $this->config->getCertificate()->getPriKey()) ;
        file_put_contents( $localCert, $this->config->getCertificate()->getPubKey()) ;
        $options = $this->config->getSoapOptions();

        $options['ssl']['local_pk'] = $localPk;
        $options['ssl']['local_cert'] = $localCert;
        $options['ssl']['passphrase'] = $this->config->getCertificate()->getPassword();

        use_soap_error_handler(true);
        $soap = null;
        $response = null;

        $logDirectory = $this->config->getLogDirectory();
        try {
            //libxml_disable_entity_loader(false);
            //$options = $this->config->getSoapOptions();
            //var_dump($options); exit;

            /*$options['stream_context'] = [
                'ssl' => $options['ssl']
            ];

            var_dump($options); exit; */

            $options['stream_context'] = @stream_context_create([
                 'ssl' => $options['ssl']
            ]);

            use_soap_error_handler(true);
            libxml_disable_entity_loader(false);
            $soap = new \SoapClient($this->config->getWsdl(), $options);
            $response = $soap->__getFunctions();

        }catch (\SoapFault $e){
            $response = new Response($soap, $logDirectory);
            echo $e->getMessage();
            exit;
        }catch (\Exception $e){
            $response = new Response($soap, $logDirectory);
            echo $e->getMessage();
            exit;
        }

        $this->deleteTmpCertFile([$localPk, $localCert]);
        if ($returnTrace)
            return [$response, $this->getTrace($soap)];
        else
            return $response;
    }


    public function dispatch($request, $returnXml = false){

        $wsdl = $this->config->getWsdl();
        $logDirectory = $this->config->getLogDirectory();

        if(empty($this->config->getCertificate())){
            return 'O certificado digital não foi informado';
        }


        $localPk = $this->certsDirectory . uniqid(). '_priKey.pem';
        $localCert = $this->certsDirectory. uniqid(). '_priKey.pem';

        file_put_contents( $localPk, $this->config->getCertificate()->getPriKey()) ;
        file_put_contents( $localCert, $this->config->getCertificate()->getPubKey()) ;

        $config = $this->config;
        $options = $config->getSoapOptions();
        $options['ssl']['local_pk'] = $localPk;
        $options['ssl']['local_cert'] = $localCert;
        $options['ssl']['passphrase'] = $config->getCertificate()->getPassword();
        $options['stream_context'] = @stream_context_create([
            'ssl' => $options['ssl']
        ]);

        $nameSoapHelper = $request->getSoapHelper();
        if (! class_exists($nameSoapHelper)){
            throw new \Exception('Um HELPER parece não ser uma classe. Nome do HELPER: '. $nameSoapHelper);
        }

        $soap = new $nameSoapHelper($wsdl, $options, $config->getTraceInBrowser(), $logDirectory);
        $response = $soap->send($request);

        $this->deleteTmpCertFile([$localPk, $localCert]);

        $this->setLastResponse($response);

        if(! empty($config->getXmlDirectory())){
            $this->saveXml($request->getAction());
        }



        if ($returnXml == true)
            return $this->lastResponse->xmlResposta ;
        else
            return $this->lastResponse;

    }


    private function saveXml($name){
        $name = ucwords(strtolower(str_replace('envio','',$name)));
        $rand = date('YmdHis') . rand(10, 99);
        $nameRequest = $name. 'Envio_' . $rand . '.xml';
        $nameResponse = $name. 'Resposta_' . $rand . '.xml';

        if ( empty($this->lastResponse->exception) ){
            XmlTools::saveXml($this->lastResponse->xmlEnvio, $nameRequest,$this->config->getXmlDirectory() . 'envio');
            XmlTools::saveXml($this->lastResponse->xmlResposta, $nameResponse,$this->config->getXmlDirectory() . 'resposta');
        }
    }

    private function deleteTmpCertFile($files){
        /*$files = glob($this->certsDirectory . '/*.pem'); // get all file names
        foreach($files as $file){ // iterate files
            if(is_file($file))
                @unlink($file); // delete file
        } */

        if(! empty($files) && is_array($files)){
            foreach($files as $file){ // iterate files
                if(is_file($file))
                    @unlink($file); // delete file
            }
        }


    }


}
