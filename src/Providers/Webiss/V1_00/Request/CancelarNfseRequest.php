<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 24/01/2021
 * Time: 21:35
 */

namespace EmissorNfse\Providers\Webiss\V1_00\Request;


use EmissorNfse\ParseTemplate;
use EmissorNfse\Providers\Webiss\V1_00\Helpers\Signer;

class CancelarNfseRequest
{
    const SYS_DS = DIRECTORY_SEPARATOR;
    private $abrasfVersion = '1.00';
    public $action = 'CancelarNfse';
    private $soapHelper = '\\EmissorNfse\\Providers\\Webiss\\V1_00\\Helpers\\Soap';
    private $responseNamespace = '\\EmissorNfse\\Providers\\Webiss\\V1_00\\Response\\CancelarNfseResponse';
    private $templatePath = null;

    private $idInfPedidoCancelamento = null;
    private $numeroNfse = null;
    private $cnpjPrestador = null;
    private $inscricaoMunicipalPrestador = null;
    private $codigoMunicipio = null;
    private $codigoCancelamento = null;


    public function __construct()
    {
        $this->templatePath = __dir__ . self::SYS_DS . '..' . self::SYS_DS . 'Template' . self::SYS_DS . 'CancelarNfse.xml'  ;
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
    public function getIdInfPedidoCancelamento()
    {
        return $this->idInfPedidoCancelamento;
    }

    /**
     * @param null $idInfPedidoCancelamento
     */
    public function setIdInfPedidoCancelamento($idInfPedidoCancelamento)
    {
        $this->idInfPedidoCancelamento = $idInfPedidoCancelamento;
    }

    /**
     * @return null
     */
    public function getNumeroNfse()
    {
        return $this->numeroNfse;
    }

    /**
     * @param null $numeroNfse
     */
    public function setNumeroNfse($numeroNfse)
    {
        $this->numeroNfse = $numeroNfse;
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
     * @return null
     */
    public function getCodigoMunicipio()
    {
        return $this->codigoMunicipio;
    }

    /**
     * @param null $codigoMunicipio
     */
    public function setCodigoMunicipio($codigoMunicipio)
    {
        $this->codigoMunicipio = $codigoMunicipio;
    }

    /**
     * @return null
     */
    public function getCodigoCancelamento()
    {
        return $this->codigoCancelamento;
    }

    /**
     * @param null $codigoCancelamento
     */
    public function setCodigoCancelamento($codigoCancelamento)
    {
        $this->codigoCancelamento = $codigoCancelamento;
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

    /*public function toXmlSigned( $priKeyPem, $pubKeyClean){

        // TODO: Implement toXml() method.
        if(empty($this->idInfPedidoCancelamento))
            $this->idInfPedidoCancelamento = 'NFSe_'. preg_replace('/[\. ]/','',microtime(true));

        $xml = $this->toXml();
        return Signer::sign($xml, $priKeyPem, $pubKeyClean, ['InfPedidoCancelamento']);
    } */

    public function getEnvelopString(){
        return '<CancelarNfse xmlns="http://tempuri.org/">
                      <cabec><![CDATA[<cabecalho xmlns="http://www.abrasf.org.br/nfse" versao="1.00">
                            <versaoDados>1.00</versaoDados>
                        </cabecalho>]]></cabec>
                      <msg>{body}</msg>
                    </CancelarNfse>';

    }



}