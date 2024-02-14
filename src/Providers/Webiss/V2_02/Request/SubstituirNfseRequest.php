<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 23/07/2020
 * Time: 00:22
 */

namespace EmissorNfse\Providers\Webiss\V2_02\Request;


use EmissorNfse\ParseTemplate;
use EmissorNfse\Providers\Webiss\V2_02\Helpers\Signer;

class SubstituirNfseRequest
{

    const SYS_DS = DIRECTORY_SEPARATOR;
    private $abrasfVersion = '2.02';
    private $action = 'SubstituirNfse';
    private $soapHelper = '\\EmissorNfse\\Providers\\Webiss\\V2_02\\Helpers\\Soap';
    private $responseNamespace = '\\EmissorNfse\\Providers\\Webiss\\V2_02\\Response\\SubstituirNfseResponse';
    private $templatePath = null;
    private $idInfDeclaracaoPrestacaoServico = null;
    private $idSubstituicaoNfse = null;
    private $idInfPedidoCancelamento = null;
    private $numeroNfseSubstituir = null;
    private $codigoMunicipioPrestador = null;
    private $codigoCancelamentoNfseSubstituir = null;
    private $numeroRps = null;
    private $serieRps = null;
    private $tipoRps = 1;
    private $dataEmissaoRps = null;
    private $statusRps = 1;
    private $numeroRpsSubstituido = null;
    private $serieRpsSubstituido = null;
    private $tipoRpsSubstituido = null;
    private $competencia = null;
    private $valorServicos = 0.00;
    private $valorDeducoes = 0.00;
    private $valorPis = 0.00;
    private $valorCofins = 0.00;
    private $valorInss = 0.00;
    private $valorIr = 0.00;
    private $valorCsll = 0.00;
    private $outrasRetencoes = 0.00;
    private $valorIss = 0.00;
    private $aliquota = 0.00;
    private $descontoIncondicionado = 0.00;
    private $descontoCondicionado = 0.00;
    private $issRetido = 2;
    private $responsavelRetencao = null;
    private $itemListaServico = null;
    private $codigoCnae = null;
    private $codigoTributacaoMunicipio = null;
    private $discriminacao = null;
    private $codigoMunicipioPrestacao = null;
    private $codigoPaisPrestacao = 1058;
    private $exigibilidadeIss = 1;
    private $codigoMunicipioIncidencia = null;
    private $numeroProcesso = null;
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
    private $codigoPaisTomador = 1058;
    private $cepTomador = null;
    private $telefoneTomador = null;
    private $emailTomador = null;
    private $cpfCnpjIntermediario = null;
    private $inscricaoMunicipalIntermediario = null;
    private $razaoSocialIntermediario = null;
    private $codigoObra = null;
    private $artObra = null;
    private $regimeEspecialTributacao = null;
    private $optanteSimplesNacional = 2;
    private $incentivoFiscal = 2;

    /**
     * GerarNfseRequest constructor.
     * @param string $abrasfVersion
     */
    public function __construct()
    {
        $this->templatePath = __dir__ . self::SYS_DS . '..' . self::SYS_DS . 'Template' . self::SYS_DS . 'SubstituirNfse.xml'  ;
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
    public function getIdInfDeclaracaoPrestacaoServico()
    {
        return $this->idInfDeclaracaoPrestacaoServico;
    }

    /**
     * @param null $idInfDeclaracaoPrestacaoServico
     */
    public function setIdInfDeclaracaoPrestacaoServico($idInfDeclaracaoPrestacaoServico)
    {
        $this->idInfDeclaracaoPrestacaoServico = $idInfDeclaracaoPrestacaoServico;
    }

    /**
     * @return null
     */
    public function getIdSubstituicaoNfse()
    {
        return $this->idSubstituicaoNfse;
    }

    /**
     * @param null $idSubstituicaoNfse
     */
    public function setIdSubstituicaoNfse($idSubstituicaoNfse)
    {
        $this->idSubstituicaoNfse = $idSubstituicaoNfse;
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
    public function getNumeroNfseSubstituir()
    {
        return $this->numeroNfseSubstituir;
    }

    /**
     * @param null $numeroNfseSubstituir
     */
    public function setNumeroNfseSubstituir($numeroNfseSubstituir)
    {
        $this->numeroNfseSubstituir = $numeroNfseSubstituir;
    }

    /**
     * @return null
     */
    public function getCodigoMunicipioPrestador()
    {
        return $this->codigoMunicipioPrestador;
    }

    /**
     * @param null $codigoMunicipioPrestador
     */
    public function setCodigoMunicipioPrestador($codigoMunicipioPrestador)
    {
        $this->codigoMunicipioPrestador = $codigoMunicipioPrestador;
    }

    /**
     * @return null
     */
    public function getCodigoCancelamentoNfseSubstituir()
    {
        return $this->codigoCancelamentoNfseSubstituir;
    }

    /**
     * @param null $codigoCancelamentoNfseSubstituir
     */
    public function setCodigoCancelamentoNfseSubstituir($codigoCancelamentoNfseSubstituir)
    {
        $this->codigoCancelamentoNfseSubstituir = $codigoCancelamentoNfseSubstituir;
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
     * @return int
     */
    public function getTipoRps()
    {
        return $this->tipoRps;
    }

    /**
     * @param int $tipoRps
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
        $date = \DateTime::createFromFormat('Y-m-d', $dataEmissaoRps);

        if (empty($date)){
            throw new \Exception('Informe uma data no formato Y-m-d');
        }
        $this->dataEmissaoRps = $date->format('Y-m-d');
    }

    /**
     * @return int
     */
    public function getStatusRps()
    {
        return $this->statusRps;
    }

    /**
     * @param int $statusRps
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
     * @return null
     */
    public function getCompetencia()
    {
        return $this->competencia;
    }

    /**
     * @param null $competencia
     * @throws \Exception
     */
    public function setCompetencia($competencia)
    {
        $date = \DateTime::createFromFormat('Y-m-d', $competencia);

        if (empty($date)){
            throw new \Exception(utf8_encode('Informe a competência no formato Y-m-d'));
        }
        $this->competencia = $date->format('Y-m-d');
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
        $this->valorServicos = $valorServicos;
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
        $this->valorDeducoes = $valorDeducoes;
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
        $this->valorPis = $valorPis;
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
        $this->valorCofins = $valorCofins;
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
        $this->valorInss = $valorInss;
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
        $this->valorIr = $valorIr;
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
        $this->valorCsll = $valorCsll;
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
        $this->outrasRetencoes = $outrasRetencoes;
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
        $this->valorIss = $valorIss;
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
    public function getDescontoIncondicionado()
    {
        return $this->descontoIncondicionado;
    }

    /**
     * @param float $descontoIncondicionado
     */
    public function setDescontoIncondicionado($descontoIncondicionado)
    {
        $this->descontoIncondicionado = $descontoIncondicionado;
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
        $this->descontoCondicionado = $descontoCondicionado;
    }

    /**
     * @return int
     */
    public function getIssRetido()
    {
        return $this->issRetido;
    }

    /**
     * @param int $issRetido
     */
    public function setIssRetido($issRetido)
    {
        $this->issRetido = $issRetido;
    }

    /**
     * @return null
     */
    public function getResponsavelRetencao()
    {
        return $this->responsavelRetencao;
    }

    /**
     * @param null $responsavelRetencao
     */
    public function setResponsavelRetencao($responsavelRetencao)
    {
        $this->responsavelRetencao = $responsavelRetencao;
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
    public function getCodigoPaisPrestacao()
    {
        return $this->codigoPaisPrestacao;
    }

    /**
     * @param null $codigoPaisPrestacao
     */
    public function setCodigoPaisPrestacao($codigoPaisPrestacao)
    {
        $this->codigoPaisPrestacao = $codigoPaisPrestacao;
    }

    /**
     * @return int
     */
    public function getExigibilidadeIss()
    {
        return $this->exigibilidadeIss;
    }

    /**
     * @param int $exigibilidadeIss
     */
    public function setExigibilidadeIss($exigibilidadeIss)
    {
        $this->exigibilidadeIss = $exigibilidadeIss;
    }

    /**
     * @return null
     */
    public function getCodigoMunicipioIncidencia()
    {
        return $this->codigoMunicipioIncidencia;
    }

    /**
     * @param null $codigoMunicipioIncidencia
     */
    public function setCodigoMunicipioIncidencia($codigoMunicipioIncidencia)
    {
        $this->codigoMunicipioIncidencia = $codigoMunicipioIncidencia;
    }

    /**
     * @return null
     */
    public function getNumeroProcesso()
    {
        return $this->numeroProcesso;
    }

    /**
     * @param null $numeroProcesso
     */
    public function setNumeroProcesso($numeroProcesso)
    {
        $this->numeroProcesso = $numeroProcesso;
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
    public function getCodigoPaisTomador()
    {
        return $this->codigoPaisTomador;
    }

    /**
     * @param null $codigoPaisTomador
     */
    public function setCodigoPaisTomador($codigoPaisTomador)
    {
        $this->codigoPaisTomador = $codigoPaisTomador;
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
     * @return int
     */
    public function getOptanteSimplesNacional()
    {
        return $this->optanteSimplesNacional;
    }

    /**
     * @param int $optanteSimplesNacional
     */
    public function setOptanteSimplesNacional($optanteSimplesNacional)
    {
        $this->optanteSimplesNacional = $optanteSimplesNacional;
    }

    /**
     * @return int
     */
    public function getIncentivoFiscal()
    {
        return $this->incentivoFiscal;
    }

    /**
     * @param int $incentivoFiscal
     */
    public function setIncentivoFiscal($incentivoFiscal)
    {
        $this->incentivoFiscal = $incentivoFiscal;
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
        if(empty($this->idSubstituicaoNfse))
            $this->idSubstituicaoNfse = 'IDS_'. preg_replace('/[\. ]/','',microtime(true));

        if(empty($this->idInfPedidoCancelamento))
            $this->idInfPedidoCancelamento = 'IDI_'. preg_replace('/[\. ]/','',microtime(true));

        // TODO: Implement toXml() method.
        if(empty($this->idInfDeclaracaoPrestacaoServico))
            $this->idInfDeclaracaoPrestacaoServico = 'RPS_'. preg_replace('/[\. ]/','',microtime(true));

        return ParseTemplate::parse($this, $this->getXmlReplaceMark());
    }

    /**
     * @param $priKeyPem
     * @param $pubKeyClean
     * @return string
     * @throws \Exception
     */
    public function toXmlSigned($priKeyPem, $pubKeyClean){

        $xml = $this->toXml();
        return Signer::sign($xml, $priKeyPem, $pubKeyClean, ['InfPedidoCancelamento', 'InfDeclaracaoPrestacaoServico', 'SubstituicaoNfse']);
    }


    public function getEnvelopString(){
        return '<SubstituirNfseRequest xmlns="http://nfse.abrasf.org.br">
                      <nfseCabecMsg xmlns=""><![CDATA[<?xml version="1.0" encoding="UTF-8"?>
                        <cabecalho xmlns="http://www.abrasf.org.br/nfse.xsd" versao="2.02">
                            <versaoDados>2.02</versaoDados>
                        </cabecalho>]]></nfseCabecMsg>
                      <nfseDadosMsg xmlns="">{body}</nfseDadosMsg>
                    </SubstituirNfseRequest>';

    }
}