<?php


namespace EmissorNfse;


class Config
{
    private $wsdl = null;
    private $certificate = null;
    private $tmpDirectory = null;
    private $xmlDirectory = null;
    private $logDirectory = null;
    private $logMode = null;
    private $soapOptions = null;
    private $traceInBrowser = null;

    public function __construct(
        $options = null,
        Certificate $certificate = null,
        $tmpDirectory = null,
        $xmlDirectory = null,
        $logDirectory = null,
        $logMode = 'last-connection',
        $soapOptions = null,
        $traceInBrowser = false
    )
    {
        if (is_array($options)) {
            extract($options, EXTR_OVERWRITE);
        } else {
            if (is_string($options)) {
                $wsdl = $options;
            }
        }

        if (! empty($wsdl)) {
            $this->wsdl = $wsdl;
        }


        if (! empty($certificate)) {
            $this->setCertificate($certificate);
        }

        if (! empty($traceInBrowser)) {
            $this->setTraceInBrowser($traceInBrowser);
        }

        if (! empty($tmpDirectory)) {
            $tmpDirectory = preg_replace('/[\/]$/','', $tmpDirectory) . '/';
            $this->setTmpDirectory($tmpDirectory);
        }

        if (! empty($xmlDirectory)) {
            $xmlDirectory = preg_replace('/[\/]$/','', $xmlDirectory) . '/';
            $this->setXmlDirectory($xmlDirectory);
        }

        if (! empty($logDirectory)) {
            $logDirectory = preg_replace('/[\/]$/','', $logDirectory) . '/';
            $this->setLogDirectory($logDirectory);
        }

        if (! empty($logMode) && $logMode == 'all-connection') {

            $this->logMode = 'last-connection';
        }


        $this->soapOptions = [
            'style'         =>      SOAP_DOCUMENT,
            'use'           =>      SOAP_LITERAL,
           // 'http' => array( 'user_agent' => 'PHPSoapClient' ),
            'trace'         =>      true,
            'exceptions'    =>      true,
            'keep_alive'    =>      false,
            'connection_timeout' => 60,
            'cache_wsdl'    =>      WSDL_CACHE_NONE,
            'soap_version'  =>      SOAP_1_1,
            'compression'   =>      (SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP),
            'ssl' => [
                'local_cert'        =>      null,
                'local_pk'          =>      null,
                'verify_peer'       =>      true,
                'verify_host'       =>      false,
                'verify_peer_name'  =>      false,
                'allow_self_signed' =>      true,
                'ssl_method'        =>      SOAP_SSL_METHOD_TLS,
                'cafile'            =>      null
            ]
        ];

        if (! empty($soapOptions['style'])){
            $this->soapOptions['style'] = $soapOptions['style'];
        }

        if (! empty($soapOptions['use'])){
            $this->soapOptions['use'] = $soapOptions['use'];
        }

        if (! empty($soapOptions['trace'])){
            $this->soapOptions['trace'] = $soapOptions['trace'];
        }

        if (! empty($soapOptions['exceptions'])){
            $this->soapOptions['exceptions'] = $soapOptions['exceptions'];
        }

        if (! empty($soapOptions['keep_alive'])){
            $this->soapOptions['keep_alive'] = $soapOptions['keep_alive'];
        }

        if (! empty($soapOptions['connection_timeout'])){
            $this->soapOptions['connection_timeout'] = $soapOptions['connection_timeout'];
        }

        if (! empty($soapOptions['cache_wsdl'])){
            $this->soapOptions['cache_wsdl'] = $soapOptions['cache_wsdl'];
        }

        if (! empty($soapOptions['soap_version'])){
            $this->soapOptions['soap_version'] = $soapOptions['soap_version'];
        }

        if (! empty($soapOptions['compression'])){
            $this->soapOptions['compression'] = $soapOptions['compression'];
        }

        if (  isset($soapOptions['ssl']['verify_peer'])
            && (is_bool($soapOptions['ssl']['verify_peer'])
            || is_bool($soapOptions['ssl']['verify_peer']) === 0
            || is_bool($soapOptions['ssl']['verify_peer']) === 1)
        ){
            $this->soapOptions['ssl']['verify_peer'] = $soapOptions['ssl']['verify_peer'];
        }

        if ( isset($soapOptions['ssl']['verify_host'])
            && (is_bool($soapOptions['ssl']['verify_host'])
            || is_bool($soapOptions['ssl']['verify_host']) === 0
            || is_bool($soapOptions['ssl']['verify_host']) === 1)
        ){
            $this->soapOptions['ssl']['verify_host'] = $soapOptions['ssl']['verify_host'];
        }

        if ( isset($soapOptions['ssl']['verify_peer_name'])
            && (is_bool($soapOptions['ssl']['verify_peer_name'])
            || is_bool($soapOptions['ssl']['verify_peer_name']) === 0
            || is_bool($soapOptions['ssl']['verify_peer_name']) === 1)
        ){
            $this->soapOptions['ssl']['verify_peer_name'] = $soapOptions['ssl']['verify_peer_name'];
        }

        if (  isset($soapOptions['ssl']['allow_self_signed'])
            && (is_bool($soapOptions['ssl']['allow_self_signed'])
            || $soapOptions['ssl']['allow_self_signed'] === 0
            || $soapOptions['ssl']['allow_self_signed'] === 1)
        ){
            $this->soapOptions['ssl']['allow_self_signed'] = $soapOptions['ssl']['allow_self_signed'];
        }

        if (! empty($soapOptions['ssl']['ssl_method'])){
            $this->soapOptions['ssl']['ssl_method'] = $soapOptions['ssl']['ssl_method'];
        }

        if (! empty($soapOptions['ssl']['cafile'])){
            $this->soapOptions['ssl']['cafile'] = $soapOptions['ssl']['cafile'];
        }




    }

    /**
     * @return string
     */
    public function getWsdl()
    {
        return $this->wsdl;
    }

    /**
     * @param string $wsdl
     */
    public function setWsdl($wsdl)
    {
       /* if (strpos('?wsdl', $wsdl) === false) {
            $this->wsdl = preg_replace('#([/]$)|(\?)#', '', $wsdl) . '?wsdl';
        }else{
         $this->wsdl = $wsdl;
        }*/

        $this->wsdl = $wsdl;
    }

    /**
     * @return null
     */
    public function getCertificate()
    {
        return $this->certificate;
    }

    /**
     * @param null $pfxCert
     * @throws
     */
    public function setCertificate(Certificate $certificate)
    {
        $this->certificate = $certificate;
    }


    /**
     * @return null
     */
    public function getTmpDirectory()
    {
        return $this->tmpDirectory;
    }

    /**
     * @param null $tmpDirectory
     */
    public function setTmpDirectory($tmpDirectory)
    {
        $tmpDirectory = preg_replace('/[\/]$/','', $tmpDirectory) . '/';
        try{
            if (! is_dir($tmpDirectory)){
                mkdir($tmpDirectory);
            }
        }catch (\Exception $e){
            echo 'Não foi possível criar o diretório tmp em: '. $tmpDirectory ;
            echo "\n". $e->getMessage();
        }

        $this->tmpDirectory = $tmpDirectory;

    }

    /**
     * @return null
     */
    public function getXmlDirectory()
    {
        return $this->xmlDirectory;
    }

    /**
     * @param null $xmlDirectory
     */
    public function setXmlDirectory($xmlDirectory)
    {
        $xmlDirectory = preg_replace('/[\/]$/','', $xmlDirectory) . '/';

        try{
            if (! is_dir($xmlDirectory)){
                mkdir($xmlDirectory);
            }
        }catch (\Exception $e){
            echo 'Não foi possível criar o diretório xml em: '. $xmlDirectory ;
            echo "\n". $e->getMessage();
        }

        $this->xmlDirectory = $xmlDirectory;
    }

    /**
     * @return null
     */
    public function getLogDirectory()
    {
        return $this->logDirectory;
    }

    /**
     * @param null $logDirectory
     */
    public function setLogDirectory($logDirectory)
    {
        $logDirectory = preg_replace('/[\/]$/','', $logDirectory) . '/';

        try{
            if (! is_dir($logDirectory)){
                mkdir($logDirectory);
            }
        }catch (\Exception $e){
            echo utf8_encode('Não foi possível criar o diretório log em: '). $logDirectory ;
            echo "\n". $e->getMessage();
        }
        $this->logDirectory = $logDirectory;
    }

    /**
     * @return string
     */
    public function getLogMode()
    {
        return $this->logMode;
    }

    /**
     * @param string $logMode
     */
    public function setLogMode($logMode)
    {
        $this->logMode = $logMode;
    }

    /**
     * @return mixed
     */
    public function getSoapOptions()
    {
        return $this->soapOptions;
    }

    /**
     * @param mixed $soapOptions
     */
    public function setSoapOptions($soapOptions)
    {
        $this->soapOptions = $soapOptions;
    }

    /**
     * @return null
     */
    public function getTraceInBrowser()
    {
        return $this->traceInBrowser;
    }

    /**
     * @param null $traceInBrowser
     */
    public function setTraceInBrowser($traceInBrowser)
    {
        $this->traceInBrowser = $traceInBrowser;
    }




}