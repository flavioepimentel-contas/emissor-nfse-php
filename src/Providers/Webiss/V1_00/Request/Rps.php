<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 24/01/2021
 * Time: 16:12
 */

namespace EmissorNfse\Providers\Webiss\V1_00\Request;


use EmissorNfse\ParseTemplate;

class Rps
{
    const SYS_DS = DIRECTORY_SEPARATOR;
    private $abrasfVersion = '1.00';
    private $templatePath = null;

    private $idInfRps = null;
    private $numeroRps = null;
    private $serieRps = null;
    private $tipoRps = 1;
    private $dataEmissaoRps = null;
    private $naturezaOperacao = null;
    private $regimeEspecialTributacao = null;
    private $optanteSimplesNacional = null;
    private $incentivadorCultural = null;
    private $statusRps = null;
    private $numeroRpsSubstituido = null;
    private $serieRpsSubstituido = null;
    private $tipoRpsSubstituido = null;
    private $valorServicos = 0.00;
    private $valorDeducoes = 0.00;
    private $valorPis = 0.00;
    private $valorCofins = 0.00;
    private $valorInss = 0.00;
    private $valorIr = 0.00;
    private $valorCsll = 0.00;
    private $issRetido = null;
    private $valorIss = 0.00;
    private $valorIssRetido = 0.00;
    private $outrasRetencoes = 0.00;
    private $baseCalculo = 0.00;
    private $aliquota = 0.00;
    private $valorLiquidoNfse = 0.00;
    private $descontoIncondicionado = 0.00;
    private $descontoCondicionado = 0.00;
    private $itemListaServico = null;
    private $codigoCnae = null;
    private $codigoTributacaoMunicipio = null;
    private $discriminacao = null;
    private $codigoMunicipioPrestacao = null;
    private $cnpjPrestador = null;
    private $inscricaoMunicipalPrestador = null;
    private $cpfCnpjTomador = null;
    private $inscricaoMunicipalTomador = null;
    private $razaoSocialTomador = null;
    private $enderecoTomador = null;
    private $numeroEnderecoTomador = null;
    private $complementoEnderecoTomador = null;
    private $bairroTomador = null;
    private $codigoMunicipioTomador = null;
    private $ufTomador = null;
    private $cepTomador = null;
    private $telefoneTomador = null;
    private $emailTomador = null;
    private $razaoSocialIntermediario = null;
    private $cpfCnpjIntermediario = null;
    private $inscricaoMunicipalIntermediario = null;
    private $codigoObra = null;
    private $artObra = null;


    public function __construct()
    {
        $this->templatePath = __dir__ . self::SYS_DS . '..' . self::SYS_DS . 'Template' . self::SYS_DS . 'Rps.xml'  ;
    }

    /**
     * @return string
     */
    public function getAbrasfVersion()
    {
        return $this->abrasfVersion;
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
    public function getIdInfRps()
    {
        return $this->idInfRps;
    }

    /**
     * @param null $idInfRps
     */
    public function setIdInfRps($idInfRps)
    {
        $this->idInfRps = $idInfRps;
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
    public function getDataEmissaoRps()
    {
        return $this->dataEmissaoRps;
    }

    /**
     * @param null $dataEmissaoRps
     * @throws \Exception
     */
    public function setDataEmissaoRps($dataEmissaoRps)
    {
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $dataEmissaoRps);

        if (empty($date)){
            throw new \Exception('Informe uma data no formato Y-m-d H:i:s');
        }
        $this->dataEmissaoRps = $date->format('Y-m-d\TH:i:s');
    }

    /**
     * @return null
     */
    public function getNaturezaOperacao()
    {
        return $this->naturezaOperacao;
    }

    /**
     * @param null $naturezaOperacao
     */
    public function setNaturezaOperacao($naturezaOperacao)
    {
        $this->naturezaOperacao = $naturezaOperacao;
    }

    /**
     * @return null
     */
    public function getRegimeEspecialTributacao()
    {
        return $this->regimeEspecialTributacao;
    }

    /**
     * @param null $regimeEspecialTributacao
     */
    public function setRegimeEspecialTributacao($regimeEspecialTributacao)
    {
        $this->regimeEspecialTributacao = $regimeEspecialTributacao;
    }

    /**
     * @return null
     */
    public function getOptanteSimplesNacional()
    {
        return $this->optanteSimplesNacional;
    }

    /**
     * Informa se o prestador do serviço é optante pelo simples nacional
     * @param null $optanteSimplesNacional Int aceita os valores 1 para Sim e 2 Para Não
     *
     */
    public function setOptanteSimplesNacional($optanteSimplesNacional)
    {
        $this->optanteSimplesNacional = $optanteSimplesNacional;
    }

    /**
     * @return null
     */
    public function getIncentivadorCultural()
    {
        return $this->incentivadorCultural;
    }

    /**
     * Indica se o prestador participa de algum programa de incentivo cultural
     * @param null $incentivadorCultural Int Aceita os valores 1 para Sim e 2 para Não
     */
    public function setIncentivadorCultural($incentivadorCultural)
    {
        $this->incentivadorCultural = $incentivadorCultural;
    }

    /**
     * @return null
     */
    public function getStatusRps()
    {
        return $this->statusRps;
    }

    /**
     * @param null $statusRps Int Status do RPS: 1 para Sim e 2 para Não
     */
    public function setStatusRps($statusRps)
    {
        $this->statusRps = $statusRps;
    }

    /**
     * @return null
     */
    public function getNumeroRpsSubstituido()
    {
        return $this->numeroRpsSubstituido;
    }

    /**
     * @param null $numeroRpsSubstituido
     */
    public function setNumeroRpsSubstituido($numeroRpsSubstituido)
    {
        $this->numeroRpsSubstituido = $numeroRpsSubstituido;
    }

    /**
     * @return null
     */
    public function getSerieRpsSubstituido()
    {
        return $this->serieRpsSubstituido;
    }

    /**
     * @param null $serieRpsSubstituido
     */
    public function setSerieRpsSubstituido($serieRpsSubstituido)
    {
        $this->serieRpsSubstituido = $serieRpsSubstituido;
    }

    /**
     * @return null
     */
    public function getTipoRpsSubstituido()
    {
        return $this->tipoRpsSubstituido;
    }

    /**
     * @param null $tipoRpsSubstituido
     */
    public function setTipoRpsSubstituido($tipoRpsSubstituido)
    {
        $this->tipoRpsSubstituido = $tipoRpsSubstituido;
    }

    /**
     * @return float
     */
    public function getValorServicos()
    {
        return $this->valorServicos;
    }

    /**
     * @param float $valorServicos
     */
    public function setValorServicos($valorServicos)
    {
        $this->valorServicos = number_format($valorServicos, 2, '.', '');
    }

    /**
     * @return float
     */
    public function getValorDeducoes()
    {
        return $this->valorDeducoes;
    }

    /**
     * @param float $valorDeducoes
     */
    public function setValorDeducoes($valorDeducoes)
    {
        $this->valorDeducoes = number_format($valorDeducoes, 2, '.', '');
    }

    /**
     * @return float
     */
    public function getValorPis()
    {
        return $this->valorPis;
    }

    /**
     * @param float $valorPis
     */
    public function setValorPis($valorPis)
    {
        $this->valorPis = number_format($valorPis, 2, '.', '');
    }

    /**
     * @return float
     */
    public function getValorCofins()
    {
        return $this->valorCofins;
    }

    /**
     * @param float $valorCofins
     */
    public function setValorCofins($valorCofins)
    {
        $this->valorCofins = number_format($valorCofins, 2, '.', '');
    }

    /**
     * @return float
     */
    public function getValorInss()
    {
        return $this->valorInss;
    }

    /**
     * @param float $valorInss
     */
    public function setValorInss($valorInss)
    {
        $this->valorInss = number_format($valorInss, 2, '.', '');
    }

    /**
     * @return float
     */
    public function getValorIr()
    {
        return $this->valorIr;
    }

    /**
     * @param float $valorIr
     */
    public function setValorIr($valorIr)
    {
        $this->valorIr = number_format($valorIr, 2, '.', '');
    }

    /**
     * @return float
     */
    public function getValorCsll()
    {
        return $this->valorCsll;
    }

    /**
     * @param float $valorCsll
     */
    public function setValorCsll($valorCsll)
    {
        $this->valorCsll = number_format($valorCsll, 2, '.', '');
    }

    /**
     * @return null
     */
    public function getIssRetido()
    {
        return $this->issRetido;
    }

    /**
     * @param null $issRetido Int Indica se o Imposto será retido. 1 para SIM e 2 para NÃO
     */
    public function setIssRetido($issRetido)
    {
        $this->issRetido = $issRetido;
    }

    /**
     * @return float
     */
    public function getValorIss()
    {
        return $this->valorIss;
    }

    /**
     * @param float $valorIss
     */
    public function setValorIss($valorIss)
    {
        $this->valorIss = number_format($valorIss, 2, '.', '');
    }

    /**
     * @return float
     */
    public function getValorIssRetido()
    {
        return $this->valorIssRetido;
    }

    /**
     * @param float $valorIssRetido
     */
    public function setValorIssRetido($valorIssRetido)
    {
        $this->valorIssRetido = number_format($valorIssRetido, 2, '.', '');
    }

    /**
     * @return float
     */
    public function getOutrasRetencoes()
    {
        return $this->outrasRetencoes;
    }

    /**
     * @param float $outrasRetencoes
     */
    public function setOutrasRetencoes($outrasRetencoes)
    {
        $this->outrasRetencoes = number_format($outrasRetencoes, 2, '.', '');
    }

    /**
     * @return float
     */
    public function getBaseCalculo()
    {
        return $this->baseCalculo;
    }

    /**
     * @param float $baseCalculo
     */
    public function setBaseCalculo($baseCalculo)
    {
        $this->baseCalculo = number_format($baseCalculo, 2, '.', '');
    }

    /**
     * @return float
     */
    public function getAliquota()
    {
        return $this->aliquota;
    }

    /**
     * @param float $aliquota
     */
    public function setAliquota($aliquota)
    {
        $this->aliquota = $aliquota;
    }

    /**
     * @return float
     */
    public function getValorLiquidoNfse()
    {
        return $this->valorLiquidoNfse;
    }

    /**
     * @param float $valorLiquidoNfse
     */
    public function setValorLiquidoNfse($valorLiquidoNfse)
    {
        $this->valorLiquidoNfse = number_format($valorLiquidoNfse, 2, '.', '');
    }

    /**
     * @return float
     */
    public function getDescontoIncondicionado()
    {
        return $this->descontoIncondicionado;
    }

    /**
     * @param float $descontoIncondicionado
     */
    public function setDescontoIncondicionado($descontoIncondicionado)
    {
        $this->descontoIncondicionado = number_format($descontoIncondicionado, 2, '.', '');
    }

    /**
     * @return float
     */
    public function getDescontoCondicionado()
    {
        return $this->descontoCondicionado;
    }

    /**
     * @param float $descontoCondicionado
     */
    public function setDescontoCondicionado($descontoCondicionado)
    {
        $this->descontoCondicionado = number_format($descontoCondicionado, 2, '.', '');
    }

    /**
     * @return null
     */
    public function getItemListaServico()
    {
        return $this->itemListaServico;
    }

    /**
     * @param null $itemListaServico
     */
    public function setItemListaServico($itemListaServico)
    {
        $this->itemListaServico = $itemListaServico;
    }

    /**
     * @return null
     */
    public function getCodigoCnae()
    {
        return $this->codigoCnae;
    }

    /**
     * @param null $codigoCnae
     */
    public function setCodigoCnae($codigoCnae)
    {
        $this->codigoCnae = $codigoCnae;
    }

    /**
     * @return null
     */
    public function getCodigoTributacaoMunicipio()
    {
        return $this->codigoTributacaoMunicipio;
    }

    /**
     * @param null $codigoTributacaoMunicipio
     */
    public function setCodigoTributacaoMunicipio($codigoTributacaoMunicipio)
    {
        $this->codigoTributacaoMunicipio = $codigoTributacaoMunicipio;
    }

    /**
     * @return null
     */
    public function getDiscriminacao()
    {
        return $this->discriminacao;
    }

    /**
     * @param null $discriminacao
     */
    public function setDiscriminacao($discriminacao)
    {
        $this->discriminacao = $discriminacao;
    }

    /**
     * @return null
     */
    public function getCodigoMunicipioPrestacao()
    {
        return $this->codigoMunicipioPrestacao;
    }

    /**
     * @param null $codigoMunicipioPrestacao
     */
    public function setCodigoMunicipioPrestacao($codigoMunicipioPrestacao)
    {
        $this->codigoMunicipioPrestacao = $codigoMunicipioPrestacao;
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
    public function getCpfCnpjTomador()
    {
        return $this->cpfCnpjTomador;
    }

    /**
     * @param null $cpfCnpjTomador
     */
    public function setCpfCnpjTomador($cpfCnpjTomador)
    {
        $this->cpfCnpjTomador = preg_replace('/[\.\-\/]/', '',  $cpfCnpjTomador);
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
    public function getRazaoSocialTomador()
    {
        return $this->razaoSocialTomador;
    }

    /**
     * @param null $razaoSocialTomador
     */
    public function setRazaoSocialTomador($razaoSocialTomador)
    {
        $this->razaoSocialTomador = $razaoSocialTomador;
    }

    /**
     * @return null
     */
    public function getEnderecoTomador()
    {
        return $this->enderecoTomador;
    }

    /**
     * @param null $enderecoTomador
     */
    public function setEnderecoTomador($enderecoTomador)
    {
        $this->enderecoTomador = $enderecoTomador;
    }

    /**
     * @return null
     */
    public function getNumeroEnderecoTomador()
    {
        return $this->numeroEnderecoTomador;
    }

    /**
     * @param null $numeroEnderecoTomador
     */
    public function setNumeroEnderecoTomador($numeroEnderecoTomador)
    {
        $this->numeroEnderecoTomador = $numeroEnderecoTomador;
    }

    /**
     * @return null
     */
    public function getComplementoEnderecoTomador()
    {
        return $this->complementoEnderecoTomador;
    }

    /**
     * @param null $complementoEnderecoTomador
     */
    public function setComplementoEnderecoTomador($complementoEnderecoTomador)
    {
        $this->complementoEnderecoTomador = $complementoEnderecoTomador;
    }

    /**
     * @return null
     */
    public function getBairroTomador()
    {
        return $this->bairroTomador;
    }

    /**
     * @param null $bairroTomador
     */
    public function setBairroTomador($bairroTomador)
    {
        $this->bairroTomador = $bairroTomador;
    }

    /**
     * @return null
     */
    public function getCodigoMunicipioTomador()
    {
        return $this->codigoMunicipioTomador;
    }

    /**
     * @param null $codigoMunicipioTomador
     */
    public function setCodigoMunicipioTomador($codigoMunicipioTomador)
    {
        $this->codigoMunicipioTomador = $codigoMunicipioTomador;
    }

    /**
     * @return null
     */
    public function getUfTomador()
    {
        return $this->ufTomador;
    }

    /**
     * @param null $ufTomador
     */
    public function setUfTomador($ufTomador)
    {
        $this->ufTomador = $ufTomador;
    }

    /**
     * @return null
     */
    public function getCepTomador()
    {
        return $this->cepTomador;
    }

    /**
     * @param null $cepTomador
     */
    public function setCepTomador($cepTomador)
    {
        $this->cepTomador = $cepTomador;
    }

    /**
     * @return null
     */
    public function getTelefoneTomador()
    {
        return $this->telefoneTomador;
    }

    /**
     * @param null $telefoneTomador
     */
    public function setTelefoneTomador($telefoneTomador)
    {
        $this->telefoneTomador = $telefoneTomador;
    }

    /**
     * @return null
     */
    public function getEmailTomador()
    {
        return $this->emailTomador;
    }

    /**
     * @param null $emailTomador
     */
    public function setEmailTomador($emailTomador)
    {
        $this->emailTomador = $emailTomador;
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
    public function getCpfCnpjIntermediario()
    {
        return $this->cpfCnpjIntermediario;
    }

    /**
     * @param null $cpfCnpjIntermediario
     */
    public function setCpfCnpjIntermediario($cpfCnpjIntermediario)
    {
        $this->cpfCnpjIntermediario = preg_replace('/[\.\-\/]/', '',  $cpfCnpjIntermediario);
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
     * @return null
     */
    public function getCodigoObra()
    {
        return $this->codigoObra;
    }

    /**
     * @param null $codigoObra
     */
    public function setCodigoObra($codigoObra)
    {
        $this->codigoObra = $codigoObra;
    }

    /**
     * @return null
     */
    public function getArtObra()
    {
        return $this->artObra;
    }

    /**
     * @param null $artObra
     */
    public function setArtObra($artObra)
    {
        $this->artObra = $artObra;
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
        // TODO: Implement toXml() method.
        if(empty($this->idInfDeclaracaoPrestacaoServico))
            $this->idInfDeclaracaoPrestacaoServico = 'RPS_'. preg_replace('/[\. ]/','',microtime(true));

        return ParseTemplate::parse($this, $this->getXmlReplaceMark());
    }




}