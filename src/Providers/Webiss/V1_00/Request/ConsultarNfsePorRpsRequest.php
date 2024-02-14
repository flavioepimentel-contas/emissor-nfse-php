<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 */

namespace EmissorNfse\Providers\Webiss\V1_00\Request;


use EmissorNfse\ParseTemplate;

class ConsultarNfsePorRpsRequest
{
    const SYS_DS = DIRECTORY_SEPARATOR;
    private $abrasfVersion = '1.00';
    public $action = 'ConsultarNfsePorRps';
    private $soapHelper = '\\EmissorNfse\\Providers\\Webiss\\V1_00\\Helpers\\Soap';
    private $responseNamespace = '\\EmissorNfse\\Providers\\Webiss\\V1_00\\Response\\ConsultarNfsePorRpsResponse';
    private $templatePath = null;

    private $numeroRps = null;
    private $serieRps = null;
    private $tipoRps = 1;
    private $cnpjPrestador = null;
    private $inscricaoMunicipalPrestador = null;


    /**
     * ConsultarNfsePorRps constructor.
     * @param string $abrasfVersion
     */
    public function __construct()
    {
        $this->templatePath = __dir__ . self::SYS_DS . '..' . self::SYS_DS . 'Template' . self::SYS_DS . 'ConsultarNfsePorRps.xml'  ;
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
    public function getNumeroRps()
    {
        return $this->numeroRps;
    }

    /**
     * @param null $numeroRps
     */
    public function setNumeroRps($numeroRps)
    {
        $this->numeroRps = $numeroRps;
    }

    /**
     * @return null
     */
    public function getSerieRps()
    {
        return $this->serieRps;
    }

    /**
     * @param null $serieRps
     */
    public function setSerieRps($serieRps)
    {
        $this->serieRps = $serieRps;
    }

    /**
     * @return null
     */
    public function getTipoRps()
    {
        return $this->tipoRps;
    }

    /**
     * @param null $tipoRps
     */
    public function setTipoRps($tipoRps)
    {
        $this->tipoRps = $tipoRps;
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
        $this->cnpjPrestador = preg_replace('/[\.\-\/]/', '', $cnpjPrestador);
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
     * @return mixed
     */
    public function getAllAttributes()
    {
        // TODO: Implement getAllAttributes() method.
        $array = [];

        foreach ($this as $key => $value) {
            if (property_exists($this, $key)) {
                array_push($array, array($key => $value));
            }
        }
        return $array;
    }


    /**
     * @return mixed
     * @throws
     */
    public function toXml()
    {
        return ParseTemplate::parse($this);
    }

    public function getEnvelopString(){
        return '<ConsultarNfsePorRps xmlns="http://tempuri.org/">
                      <cabec><![CDATA[<cabecalho xmlns="http://www.abrasf.org.br/nfse.xsd" versao="1.00">
                            <versaoDados>1.00</versaoDados>
                        </cabecalho>]]></cabec>
                      <msg>{body}</msg>
                    </ConsultarNfsePorRps>';

    }

}