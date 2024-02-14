<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 */

namespace EmissorNfse\Providers\Webiss\V1_00\Request;


use EmissorNfse\ParseTemplate;
use EmissorNfse\Providers\Webiss\V2_02\Helpers\Signer;

class RecepcionarLoteRpsRequest
{
    const SYS_DS = DIRECTORY_SEPARATOR;
    private $abrasfVersion = '1.00';
    private $soapHelper = '\\EmissorNfse\\Providers\\Webiss\\V1_00\\Helpers\\Soap';
    private $responseNamespace = '\\EmissorNfse\\Providers\\Webiss\\V1_00\\Response\\RecepcionarLoteRpsResponse';
    public  $action = 'RecepcionarLoteRps';
    private $templatePath = null;

    private $idLoteRps = null;
    private $numeroLote = null;
    private $cnpjPrestador = null;
    private $inscricaoMunicipalPrestador = null;
    private $quantidadeRps = null;

    private $rps = [];
    private $listaRps = '';

    public function __construct()
    {
        $this->templatePath = __dir__ . self::SYS_DS . '..' . self::SYS_DS . 'Template' . self::SYS_DS . 'RecepcionarLoteRps.xml'  ;
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
     * @return string
     */
    public function getAction()
    {
        return $this->action;
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
    public function getIdLoteRps()
    {
        return $this->idLoteRps;
    }

    /**
     * @param null $idLoteRps
     */
    public function setIdLoteRps($idLoteRps)
    {
        $this->idLoteRps = $idLoteRps;
    }

    /**
     * @return null
     */
    public function getNumeroLote()
    {
        return $this->numeroLote;
    }

    /**
     * @param null $numeroLote
     */
    public function setNumeroLote($numeroLote)
    {
        $this->numeroLote = $numeroLote;
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
        $this->cnpjPrestador = $cnpjPrestador;
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
    public function getQuantidadeRps()
    {
        return $this->quantidadeRps;
    }

    /**
     * @param null $quantidadeRps
     */
    public function setQuantidadeRps($quantidadeRps)
    {
        $this->quantidadeRps = $quantidadeRps;
    }

    /**
     * @return array
     */
    public function getRps()
    {
        return $this->rps;
    }

    /**
     * @param array $rps
     */
    public function addRps(Rps $rps)
    {
        array_push($this->rps, $rps);
    }

    /**
     * @return string
     */
    public function getListaRps()
    {
        return $this->listaRps;
    }

    /**
     * @param string $listaRps
     */
    public function setListaRps($listaRps)
    {
        $this->listaRps = $listaRps;
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


    /*
     * @throws
     */
    public function toXml()
    {
        if(empty($this->rps)){
            throw new \Exception('Adicione no mínimo 1 RPS ao lote, através do método addRps');
        }

        if (empty($this->idLoteRps))
            $this->idLoteRps = 'Lote'. date('YmdHis'). rand(10, 99);

        if (empty($this->numeroLote))
            $this->numeroLote = date('ymd'). rand(10, 999);

        $xml = '';

        $i = 0;
        foreach ($this->rps as $rps){
            $xml .= str_replace('<?xml version="1.0"?>','', $rps->toXml()  );
            if (++$i == 1){
                if(empty($this->cnpjPrestador))
                    $this->cnpjPrestador = $rps->getCnpjPrestador();
                if(empty($this->inscricaoMunicipalPrestador))
                    $this->inscricaoMunicipalPrestador = $rps->getInscricaoMunicipalPrestador();
            }
        }
        if (empty($this->quantidadeRps))
            $this->quantidadeRps = count($this->rps);

        $this->listaRps = $xml;
        return ParseTemplate::parse($this);
    }

    public function toXmlSigned( $priKeyPem, $pubKeyClean){

        $xml = $this->toXml();
        return Signer::sign($xml, $priKeyPem, $pubKeyClean, ['LoteRps']);
    }




    public function getEnvelopString(){

        return '<RecepcionarLoteRps xmlns="http://tempuri.org/">
              <cabec><![CDATA[<cabecalho xmlns="http://www.abrasf.org.br/nfse" versao="1.00">
                            <versaoDados>1.00</versaoDados>
                        </cabecalho>]]>
               </cabec>
              <msg>{body}</msg>
            </RecepcionarLoteRps>';

    }



}