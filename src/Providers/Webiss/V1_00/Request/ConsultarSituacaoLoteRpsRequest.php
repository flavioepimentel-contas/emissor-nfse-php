<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 */

namespace EmissorNfse\Providers\Webiss\V1_00\Request;


use EmissorNfse\ParseTemplate;

class ConsultarSituacaoLoteRpsRequest
{
    const SYS_DS = DIRECTORY_SEPARATOR;
    private $abrasfVersion = '1.00';
    public $action = 'ConsultarSituacaoLoteRps';
    private $soapHelper = '\\EmissorNfse\\Providers\\Webiss\\V1_00\\Helpers\\Soap';
    private $responseNamespace = '\\EmissorNfse\\Providers\\Webiss\\V1_00\\Response\\ConsultarSituacaoLoteRpsResponse';
    private $templatePath = null;

    private $cnpjPrestador = null;
    private $inscricaoMunicipalPrestador = null;
    private $protocolo = null;

    /**
     * ConsultarLoteRpsRequest constructor.
     */
    public function __construct()
    {
        $this->templatePath = __dir__ . self::SYS_DS . '..' . self::SYS_DS . 'Template' . self::SYS_DS . 'ConsultarSituacaoLoteRps.xml'  ;
    }

    /**
     * @return string
     */
    public function getAbrasfVersion()
    {
        return $this->abrasfVersion;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return string
     */
    public function getSoapHelper()
    {
        return $this->soapHelper;
    }

    /**
     * @return string
     */
    public function getResponseNamespace()
    {
        return $this->responseNamespace;
    }

    /**
     * @return string|null
     */
    public function getTemplatePath()
    {
        return $this->templatePath;
    }



    /**
     * @return null
     */
    public function getCnpjPrestador()
    {
        return $this->cnpjPrestador;
    }

    /**
     * @param null $cnpjPrestador
     */
    public function setCnpjPrestador($cnpjPrestador)
    {
        $this->cnpjPrestador = preg_replace('/[\.\-\/]/', '', $cnpjPrestador);;
    }

    /**
     * @return null
     */
    public function getInscricaoMunicipalPrestador()
    {
        return $this->inscricaoMunicipalPrestador;
    }

    /**
     * @param null $inscricaoMunicipalPrestador
     */
    public function setInscricaoMunicipalPrestador($inscricaoMunicipalPrestador)
    {
        $this->inscricaoMunicipalPrestador = $inscricaoMunicipalPrestador;
    }

    /**
     * @return null
     */
    public function getProtocolo()
    {
        return $this->protocolo;
    }

    /**
     * @param null $protocolo
     */
    public function setProtocolo($protocolo)
    {
        $this->protocolo = $protocolo;
    }

    public function getAllAttributes()
    {
        $array = [];

        foreach ($this as $key => $value) {
            if (property_exists($this, $key)) {
                array_push($array, array($key => $value));
            }
        }
        return $array;

    }

    public function toXml(){
        return ParseTemplate::parse($this);
    }

    public function getEnvelopString(){
        return '<ConsultarSituacaoLoteRps  xmlns="http://tempuri.org/">
                  <cabec xmlns=""><![CDATA[<cabecalho xmlns="http://www.abrasf.org.br/nfse.xsd" versao="1.00">
                            <versaoDados>1.00</versaoDados>
                        </cabecalho>]]>
                  </cabec>
                  <msg>{body}</msg>
                </ConsultarSituacaoLoteRps>';

    }


}