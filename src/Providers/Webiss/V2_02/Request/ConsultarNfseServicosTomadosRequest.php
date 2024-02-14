<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 23/07/2020
 * Time: 19:14
 */

namespace EmissorNfse\Providers\Webiss\V2_02\Request;


use EmissorNfse\ParseTemplate;

class ConsultarNfseServicosTomadosRequest
{
    const SYS_DS = DIRECTORY_SEPARATOR;
    private $abrasfVersion = '2.02';
    private $action = 'ConsultarNfseServicoTomado';
    private $soapHelper = '\\EmissorNfse\\Providers\\Webiss\\V2_02\\Helpers\\Soap';
    private $responseNamespace = '\\EmissorNfse\\Providers\\Webiss\\V2_02\\Response\\ConsultarNfseServicosTomadosResponse';
    private $templatePath = null;
    private $cpfCnpjConsulente = null;
    private $inscricaoMunicipalConsulente = null;
    private $cnpjPrestador = null;
    private $inscricaoMunicipalPrestador = null;
    private $numeroNfse = null;
    private $inicioPeriodoEmissao = null;
    private $fimPeriodoEmissao = null;
    private $inicioPeriodoCompetencia = null;
    private $fimPeriodoCompetencia = null;
    private $cpfCnpjTomador = null;
    private $inscricaoMunicipalTomador = null;
    private $cpfCnpjIntermediario = null;
    private $inscricaoMunicipalIntermediario = null;
    private $pagina = 1;

    /**
     * ConsultarNfseServicosTomadosRequest constructor.
     */
    public function __construct()
    {
        $this->templatePath = __dir__ . self::SYS_DS . '..' . self::SYS_DS . 'Template' . self::SYS_DS . 'ConsultarNfseServicosTomados.xml'  ;
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
     * @return null
     */
    public function getTemplatePath()
    {
        return $this->templatePath;
    }


    public function getSoapHelper(){
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
    public function getCpfCnpjConsulente()
    {
        return $this->cpfCnpjConsulente;
    }

    /**
     * @param null $cpfCnpjConsulente
     */
    public function setCpfCnpjConsulente($cpfCnpjConsulente)
    {
        $this->cpfCnpjConsulente = $cpfCnpjConsulente;
    }

    /**
     * @return null
     */
    public function getInscricaoMunicipalConsulente()
    {
        return $this->inscricaoMunicipalConsulente;
    }

    /**
     * @param null $inscricaoMunicipalConsulente
     */
    public function setInscricaoMunicipalConsulente($inscricaoMunicipalConsulente)
    {
        $this->inscricaoMunicipalConsulente = $inscricaoMunicipalConsulente;
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
    public function getInicioPeriodoEmissao()
    {
        return $this->inicioPeriodoEmissao;
    }

    /**
     * @param null $inicioPeriodoEmissao
     * @throws \Exception
     */
    public function setInicioPeriodoEmissao($inicioPeriodoEmissao)
    {
        $date = \DateTime::createFromFormat('Y-m-d' , $inicioPeriodoEmissao );
        if ($date == null){
            throw new \Exception('A data de inicio do periodo de emissão precisa estar no formato YYYY-MM-DD. Valor informado: '. $inicioPeriodoEmissao);
        }

        $this->inicioPeriodoEmissao = $date->format('Y-m-d');
    }

    /**
     * @return null
     */
    public function getFimPeriodoEmissao()
    {
        return $this->fimPeriodoEmissao;
    }

    /**
     * @param null $fimPeriodoEmissao
     * @throws \Exception
     */
    public function setFimPeriodoEmissao($fimPeriodoEmissao)
    {
        $date = \DateTime::createFromFormat('Y-m-d' , $fimPeriodoEmissao );
        if ($date == null){
            throw new \Exception('A data do fim do periodo de emissão precisa estar no formato YYYY-MM-DD. Valor informado: '. $fimPeriodoEmissao);
        }

        $this->fimPeriodoEmissao = $date->format('Y-m-d');
    }

    /**
     * @return null
     */
    public function getInicioPeriodoCompetencia()
    {
        return $this->inicioPeriodoCompetencia;
    }

    /**
     * @param null $inicioPeriodoCompetencia
     * @throws \Exception
     */
    public function setInicioPeriodoCompetencia($inicioPeriodoCompetencia)
    {
        $date = \DateTime::createFromFormat('Y-m-d' , $inicioPeriodoCompetencia );
        if ($date == null){
            throw new \Exception('A data de inicio do periodo de competência precisa estar no formato YYYY-MM-DD. Valor informado: '. $inicioPeriodoCompetencia);
        }
        $this->inicioPeriodoCompetencia = $date->format('Y-m-d');
    }

    /**
     * @return null
     */
    public function getFimPeriodoCompetencia()
    {
        return $this->fimPeriodoCompetencia;
    }

    /**
     * @param null $fimPeriodoCompetencia
     * @throws \Exception
     */
    public function setFimPeriodoCompetencia($fimPeriodoCompetencia)
    {
        $date = \DateTime::createFromFormat('Y-m-d' , $fimPeriodoCompetencia );
        if ($date == null){
            throw new \Exception('A data de inicio do periodo de competência precisa estar no formato YYYY-MM-DD. Valor informado: '. $fimPeriodoCompetencia);
        }
        $this->fimPeriodoCompetencia = $date->format('Y-m-d');
    }

    /**
     * @return null
     */
    public function getCpfCnpjTomador()
    {
        return $this->CpfCnpjTomador;
    }

    /**
     * @param null $cpfCnpjTomador
     */
    public function setCpfCnpjTomador($cpfCnpjTomador)
    {
        $this->cpfCnpjTomador = preg_replace('/[\.\-\/]/', '', $cpfCnpjTomador);
    }

    /**
     * @return null
     */
    public function getInscricaoMunicipalTomador()
    {
        return $this->inscricaoMunicipalTomador;
    }

    /**
     * @param null $inscricaoTomador
     */
    public function setInscricaoMunicipalTomador($inscricaoMunicipalTomador)
    {
        $this->inscricaoMunicipalTomador = $inscricaoMunicipalTomador;
    }

    /**
     * @return null
     */
    public function getCpfCnpjIntermediario()
    {
        return $this->cpfCnpjIntermediario;
    }

    /**
     * @param null $cnpjIntermediario
     */
    public function setCpfCnpjIntermediario($cnpjIntermediario)
    {
        $this->cpfCnpjIntermediario = preg_replace('/[\.\-\/]/', '', $cnpjIntermediario);;
    }

    /**
     * @return null
     */
    public function getInscricaoMunicipalIntermediario()
    {
        return $this->inscricaoMunicipalIntermediario;
    }

    /**
     * @param null $inscricaoIntermediario
     */
    public function setInscricaoIntermediario($inscricaoMunicipalIntermediario)
    {
        $this->inscricaoMunicipalIntermediario = $inscricaoMunicipalIntermediario;
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

    private function getXmlReplaceMark(){
        return [
            [
                'mark' =>  '{cpxCpfCnpjConsulente}',
                'value' =>  (strlen($this->cpfCnpjConsulente) == 14) ? '<Cnpj>{cpfCnpjConsulente}</Cnpj>' : '<Cpf>{cpfCnpjConsulente}</Cpf>'
            ],
            [
                'mark' =>  '{cpxCpfCnpjTomador}',
                'value' =>  (strlen($this->cpfCnpjTomador) == 14) ? '<Cnpj>{cpfCnpjTomador}</Cnpj>' : '<Cpf>{cpfCnpjTomador}</Cpf>'
            ],
            [
                'mark' =>  '{cpxCpfCnpjIntermediario}',
                'value' =>  (strlen($this->cpfCnpjIntermediario) == 14) ? '<Cnpj>{cpfCnpjIntermediario}</Cnpj>' : '<Cpf>{cpfCnpjIntermediario}</Cpf>'
            ],
        ];
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
        return ParseTemplate::parse($this, $this->getXmlReplaceMark());
    }

    public function getEnvelopString(){
        return '<ConsultarNfseServicoTomadoRequest xmlns="http://nfse.abrasf.org.br">
                  <nfseCabecMsg xmlns=""><![CDATA[<?xml version="1.0" encoding="UTF-8"?>
                        <cabecalho xmlns="http://www.abrasf.org.br/nfse.xsd" versao="2.02">
                            <versaoDados>2.02</versaoDados>
                        </cabecalho>]]></nfseCabecMsg>
                  <nfseDadosMsg xmlns="">{body}</nfseDadosMsg>
                </ConsultarNfseServicoTomadoRequest>';

    }
}