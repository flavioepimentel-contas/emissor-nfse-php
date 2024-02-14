<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 22/07/2020
 * Time: 23:12
 */

namespace EmissorNfse\Providers\Webiss\V2_02\Request;


use EmissorNfse\ParseTemplate;
use EmissorNfse\Providers\Webiss\V2_02\Helpers\Signer;

class RecepcionarLoteRpsSincronoRequest
{
    const SYS_DS = DIRECTORY_SEPARATOR;
    private $abrasfVersion = '2.02';
    private $soapHelper = '\\EmissorNfse\\Providers\\Webiss\\V2_02\\Helpers\\Soap';
    private $responseNamespace = '\\EmissorNfse\\Providers\\Webiss\\V2_02\\Response\\RecepcionarLoteRpsSincronoResponse';
    private $templatePath = null;
    private $action = 'RecepcionarLoteRpsSincrono';

    private $idLoteRps = null;
    private $numeroLote = null;
    private $cnpjPrestador = null;
    private $inscricaoMunicipalPrestador = null;
    private $quantidadeRps = null;
    private $rps = [];
    private $listaRps = '';


    /**
     * PedidoEnvioLoteRps constructor.
     */
    public function __construct()
    {
        $this->templatePath = __dir__ . self::SYS_DS . '..' . self::SYS_DS . 'Template' . self::SYS_DS . 'RecepcionarLoteRpsSincrono.xml'  ;
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
        $this->cnpjPrestador = preg_replace('/[\.\-\/]/', '',  $cnpjPrestador);
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
    public function getRps($position)
    {
        if(isset($this->rps[$position])){
            return $this->rps[$position];
        }else
            return null;
    }

    /**
     * @param array $rpsFragmento
     */
    public function addRps(Rps $rps)
    {
        array_push($this->rps, $rps);
    }




    /**
     * @return string|null
     */
    public function getTemplatePath()
    {
        return $this->templatePath;
    }



    public function getAction()
    {
        // TODO: Implement getAction() method.
        return $this->action;

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



    public function toXml()
    {
        if (empty($this->idLoteRps))
            $this->idLoteRps = 'Lote'. date('YmdHis'). rand(10, 99);

        if (empty($this->numeroLote))
            $this->numeroLote = date('ymdHis'). rand(10, 99);

        $xml = '';

        $i = 0;
        foreach ($this->rps as $rps){
            $xml .= str_replace('<?xml version="1.0"?>','', $rps->toXml()  );
            if (++$i == 1){
                if(empty($this->cpfCnpjPrestador))
                    $this->cpfCnpjPrestador = $rps->getCnpjPrestador();
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
        return Signer::sign($xml, $priKeyPem, $pubKeyClean, ['InfDeclaracaoPrestacaoServico','LoteRps']);
    }


    public function getEnvelopString(){

        return '<RecepcionarLoteRpsSincronoRequest xmlns="http://nfse.abrasf.org.br">
              <nfseCabecMsg xmlns=""><![CDATA[<?xml version="1.0" encoding="UTF-8"?>
                        <cabecalho xmlns="http://www.abrasf.org.br/nfse.xsd" versao="2.02">
                            <versaoDados>2.02</versaoDados>
                        </cabecalho>]]></nfseCabecMsg>
              <nfseDadosMsg xmlns="">{body}</nfseDadosMsg>
            </RecepcionarLoteRpsSincronoRequest>';

    }

}