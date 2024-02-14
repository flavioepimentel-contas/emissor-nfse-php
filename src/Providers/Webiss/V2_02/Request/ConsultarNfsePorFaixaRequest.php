<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 23/07/2020
 * Time: 21:00
 */

namespace EmissorNfse\Providers\Webiss\V2_02\Request;


use EmissorNfse\ParseTemplate;

class ConsultarNfsePorFaixaRequest
{
    const SYS_DS = DIRECTORY_SEPARATOR;
    private $abrasfVersion = '2.02';
    private $action = 'ConsultarNfsePorFaixa';
    private $soapHelper = '\\EmissorNfse\\Providers\\Webiss\\V2_02\\Helpers\\Soap';
    private $responseNamespace = '\\EmissorNfse\\Providers\\Webiss\\V2_02\\Response\\ConsultarNfsePorFaixaResponse';
    private $templatePath = null;
    private $cnpjPrestador = null;
    private $inscricaoMunicipalPrestador = null;
    private $numeroNfseInicial = null;
    private $numeroNfseFinal = null;
    private $pagina = null;


    /**
     * ConsultarNfsePorRps constructor.
     * @param string $abrasfVersion
     */
    public function __construct()
    {
        $this->templatePath = __dir__ . self::SYS_DS . '..' . self::SYS_DS . 'Template' . self::SYS_DS . 'ConsultarNfsePorFaixa.xml'  ;
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
    public function getNumeroNfseInicial()
    {
        return $this->numeroNfseInicial;
    }

    /**
     * @param null $numeroNfseInicial
     */
    public function setNumeroNfseInicial($numeroNfseInicial)
    {
        $this->numeroNfseInicial = $numeroNfseInicial;
    }

    /**
     * @return null
     */
    public function getNumeroNfseFinal()
    {
        return $this->numeroNfseFinal;
    }

    /**
     * @param null $numeroNfseFinal
     */
    public function setNumeroNfseFinal($numeroNfseFinal)
    {
        $this->numeroNfseFinal = $numeroNfseFinal;
    }

    /**
     * @return null
     */
    public function getPagina()
    {
        return $this->pagina;
    }

    /**
     * @param null $pagina
     */
    public function setPagina($pagina)
    {
        $this->pagina = $pagina;
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
        return '<ConsultarNfsePorFaixaRequest xmlns="http://nfse.abrasf.org.br">
                      <nfseCabecMsg xmlns=""><![CDATA[<?xml version="1.0" encoding="UTF-8"?>
                        <cabecalho xmlns="http://www.abrasf.org.br/nfse.xsd" versao="2.02">
                            <versaoDados>2.02</versaoDados>
                        </cabecalho>]]></nfseCabecMsg>
                      <nfseDadosMsg xmlns="">{body}</nfseDadosMsg>
                    </ConsultarNfsePorFaixaRequest>';

    }
}