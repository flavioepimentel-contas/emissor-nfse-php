<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 23/07/2020
 * Time: 15:07
 */

namespace EmissorNfse\Providers\Webiss\V2_02\Request;


use EmissorNfse\ParseTemplate;
use EmissorNfse\Providers\Webiss\V2_02\Helpers\Signer;

class CancelarNfseRequest
{
    const SYS_DS = DIRECTORY_SEPARATOR;
    private $abrasfVersion = '2.02';
    private $action = 'CancelarNfse';
    private $soapHelper = '\\EmissorNfse\\Providers\\Webiss\\V2_02\\Helpers\\Soap';
    private $responseNamespace = '\\EmissorNfse\\Providers\\Webiss\\V2_02\\Response\\CancelarNfseResponse';
    private $templatePath = null;
    private $idInfPedidoCancelamento = null;
    private $numeroNfseCancelar = null;
    private $cnpjPrestador = null;
    private $inscricaoMunicipalPrestador = null;
    private $codigoMunicipioGerador = null;
    private $codigoCancelamento = null;


    /**
     * CancelarNfseRequest constructor.
     * @param string $abrasfVersion
     */
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
    public function getNumeroNfseCancelar()
    {
        return $this->numeroNfseCancelar;
    }

    /**
     * @param null $numeroNfseCancelar
     */
    public function setNumeroNfseCancelar($numeroNfseCancelar)
    {
        $this->numeroNfseCancelar = $numeroNfseCancelar;
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
    public function getCodigoMunicipioGerador()
    {
        return $this->codigoMunicipioGerador;
    }

    /**
     * @param null $codigoMunicipioGerador
     */
    public function setCodigoMunicipioGerador($codigoMunicipioGerador)
    {
        $this->codigoMunicipioGerador = $codigoMunicipioGerador;
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
        if(empty($this->idInfPedidoCancelamento))
            $this->idInfPedidoCancelamento = 'ID_'. preg_replace('/[\. ]/','',microtime(true));


        return ParseTemplate::parse($this);
    }

    /**
     * @param $priKeyPem
     * @param $pubKeyClean
     * @return string
     * @throws \Exception
     */
    public function toXmlSigned($priKeyPem, $pubKeyClean){

        $xml = $this->toXml();
        return Signer::sign($xml, $priKeyPem, $pubKeyClean, ['InfPedidoCancelamento']);
    }


    public function getEnvelopString(){
        return '<CancelarNfseRequest xmlns="http://nfse.abrasf.org.br">
                      <nfseCabecMsg xmlns=""><![CDATA[<?xml version="1.0" encoding="UTF-8"?>
                        <cabecalho xmlns="http://www.abrasf.org.br/nfse.xsd" versao="2.02">
                            <versaoDados>2.02</versaoDados>
                        </cabecalho>]]></nfseCabecMsg>
                      <nfseDadosMsg xmlns="">{body}</nfseDadosMsg>
                    </CancelarNfseRequest>';

    }


}