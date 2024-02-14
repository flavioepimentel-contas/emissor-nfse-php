<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 24/01/2021
 * Time: 21:11
 */

namespace EmissorNfse\Providers\Webiss\V1_00\Request;


use EmissorNfse\ParseTemplate;

class ConsultarNfseRequest
{
    const SYS_DS = DIRECTORY_SEPARATOR;
    private $abrasfVersion = '1.00';
    private $action = 'ConsultarNfse';
    private $soapHelper = '\\EmissorNfse\\Providers\\Webiss\\V1_00\\Helpers\\Soap';
    private $responseNamespace = '\\EmissorNfse\\Providers\\Webiss\\V1_00\\Response\\ConsultarNfseResponse';
    private $templatePath = null;

    private $cnpjPrestador = null;
    private $inscricaoMunicipalPrestador = null;
    private $numeroNfse = null;
    private $dataInicioEmissao = null;
    private $dataFimEmissao = null;
    private $cpfCnpjTomador = null;
    private $inscricaoMunicipalTomador = null;
    private $cpfCnpjIntermediario = null;
    private $razaoSocialIntermediario = null;
    private $inscricaoMunicipalIntermediario = null;

    public function __construct()
    {
        $this->templatePath = __dir__ . self::SYS_DS . '..' . self::SYS_DS . 'Template' . self::SYS_DS . 'ConsultarNfse.xml'  ;
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
    public function getCpfCnpjTomador()
    {
        return $this->cpfCnpjTomador;
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
    public function getCpfCnpjIntermediario()
    {
        return $this->cpfCnpjIntermediario;
    }

    /**
     * @param null $cpfCnpjIntermediario
     */
    public function setCpfCnpjIntermediario($cpfCnpjIntermediario)
    {
        $this->cpfCnpjIntermediario = preg_replace('/[\.\-\/]/', '', $cpfCnpjIntermediario);
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
    public function getDataInicioEmissao()
    {
        return $this->dataInicioEmissao;
    }

    /**
     * @param null $dataInicioEmissao
     * @throws \Exception
     */
    public function setDataInicioEmissao($dataInicioEmissao)
    {
        $date = \DateTime::createFromFormat('Y-m-d', $dataInicioEmissao);

        if (empty($date)){
            throw new \Exception('Informe uma data no formato Y-m-d');
        }
        $this->dataInicioEmissao = $date->format('Y-m-d');
    }

    /**
     * @return null
     */
    public function getDataFimEmissao()
    {
        return $this->dataFimEmissao;
    }

    /**
     * @param null $dataFimEmissao
     * @throws \Exception
     */
    public function setDataFimEmissao($dataFimEmissao)
    {
        $date = \DateTime::createFromFormat('Y-m-d', $dataFimEmissao);

        if (empty($date)){
            throw new \Exception('Informe uma data no formato Y-m-d');
        }
        $this->dataFimEmissao = $date->format('Y-m-d');
    }

    /**
     * @return null
     */
    public function getInscricaoMunicipalTomador()
    {
        return $this->inscricaoMunicipalTomador;
    }

    /**
     * @param null $inscricaoMunicipalTomador
     */
    public function setInscricaoMunicipalTomador($inscricaoMunicipalTomador)
    {
        $this->inscricaoMunicipalTomador = $inscricaoMunicipalTomador;
    }

    /**
     * @return null
     */
    public function getRazaoSocialIntermediario()
    {
        return $this->razaoSocialIntermediario;
    }

    /**
     * @param null $razaoSocialIntermediario
     */
    public function setRazaoSocialIntermediario($razaoSocialIntermediario)
    {
        $this->razaoSocialIntermediario = $razaoSocialIntermediario;
    }

    /**
     * @return null
     */
    public function getInscricaoMunicipalIntermediario()
    {
        return $this->inscricaoMunicipalIntermediario;
    }

    /**
     * @param null $inscricaoMunicipalIntermediario
     */
    public function setInscricaoMunicipalIntermediario($inscricaoMunicipalIntermediario)
    {
        $this->inscricaoMunicipalIntermediario = $inscricaoMunicipalIntermediario;
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

    private function getXmlReplaceMark(){
        return [
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

    /**
     * @return mixed
     * @throws
     */
    public function toXml()
    {
        return ParseTemplate::parse($this, $this->getXmlReplaceMark());
    }

    public function getEnvelopString(){
        return '<ConsultarNfse xmlns="http://tempuri.org/">
                      <cabec><![CDATA[<cabecalho xmlns="http://www.abrasf.org.br/nfse.xsd" versao="1.00">
                            <versaoDados>1.00</versaoDados>
                        </cabecalho>]]></cabec>
                      <msg>{body}</msg>
                    </ConsultarNfse>';

    }



}