<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 09/02/2020
 * Time: 18:19
 */

namespace EmissorNfse\Providers\Webiss\V2_02\Request;


use EmissorNfse\ParseTemplate;

class Rps
{
    const SYS_DS = DIRECTORY_SEPARATOR;
    private $abrasfVersion = '2.02';
    private $templatePath = null;
    private $idInfDeclaracaoPrestacaoServico = null;
    private $numeroRps = null;
    private $serieRps = null;
    private $tipoRps = 1;
    private $idInfRps = null;
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
    private $optanteSimplesNacional = 2;
    private $incentivoFiscal = 2;
    private $regimeEspecialTributacao = null;


    /**
     * RpsFragmento constructor.
     */
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
            throw new \Exception('Informe a competencia no formato Y-m-d');
        }
        $this->competencia = $competencia;
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
     * @return int
     */
    public function getCodigoPaisPrestacao()
    {
        return $this->codigoPaisPrestacao;
    }

    /**
     * @param int $codigoPaisPrestacao
     */
    public function setCodigoPaisPrestacao($codigoPaisPrestacao)
    {
        $this->codigoPaisPrestacao = $codigoPaisPrestacao;
    }

    /**
     * @return null
     */
    public function getExigibilidadeIss()
    {
        return $this->exigibilidadeIss;
    }

    /**
     * @param null $exigibilidadeIss
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
     * @param null $municipioIncidencia
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
        $this->cnpjPrestador =  preg_replace('/[\.\-\/]/', '',  $cnpjPrestador);
    }

    /**
     * @return int
     */
    public function getCodigoPaisTomador()
    {
        return $this->codigoPaisTomador;
    }

    /**
     * @param int $paisTomador
     */
    public function setCodigoPaisTomador($codigoPaisTomador)
    {
        $this->codigoPaisTomador = $codigoPaisTomador;
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
     * @param null $dataEmissao
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
     * Indica se a empresa é optante pelo simples nacional
     * Informar conforme solicitado pelo manual da prefeitura
     *
     * @param null $optanteSimplesNacional Int aceita os valores 1 para Sim e 2 Para Não
     */
    public function setOptanteSimplesNacional($optanteSimplesNacional)
    {
        $this->optanteSimplesNacional = $optanteSimplesNacional;
    }

    /**
     * @return null
     */
    public function getIncentivoFiscal()
    {
        return $this->incentivoFiscal;
    }

    /**
     * Indica se a empresa participa de algum programa de incentivo cultural
     * @param null $incentivadorCultural Int Aceita os valores 1 para Sim e 2 para Não
     */
    public function setIncentivoFiscal($incentivoFiscal)
    {
        $this->incentivoFiscal = $incentivoFiscal;
    }

    /**
     * @return null
     */
    public function getStatusRps()
    {
        return $this->status;
    }

    /**
     * Informa se deverá ser emitida uma nota fiscal com o status normal ou cancelada
     * @param null $status Int Status do RPS: 1 para Sim e 2 para Não
     */
    public function setStatusRps($status)
    {
        $this->statusRps = $status;
    }

    /**
     * @return null
     */
    public function getNumeroRpsSubstituido()
    {
        return $this->numeroRpsSubstituido;
    }

    /**
     * (OPCIONAL)
     * Indica a nota fiscal a ser gerada deverá substitui a nota com o número do RPS passado
     *
     * @param null $numeroRpsSubstituido  Int Número do RPS que será substituído
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
     * (OPCIONAL) quando numeroRpsSubstituido for null
     * Informa a série do RPS a ser substituído
     *
     * @param null $serieRpsSubstituido String Série do RPS a ser substituído
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
     * (OPCIONAL) quando numeroRpsSubstituído for null
     * Informa o tipo do RPS a ser substituído
     *
     * @param null $tipoRpsSubstituido String Tipo do RPS a ser substituído
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
     * (OPCIONAL)
     * Valor das Deduções
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
     * (OPCIONAL)
     * Valor do PIS
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
     * (OPCIONAL)
     * Valor do Cofins
     * @param float $valorCofins
     */
    public function setValorCofins($valorCofins)
    {
        $this->valorCofins = number_format($valorCofins, 2, '.', '');;
    }

    /**
     * @return float
     */
    public function getValorInss()
    {
        return $this->valorInss;
    }

    /**
     * (Opcional)
     * Valor do INSS
     * @param float $valorInss
     */
    public function setValorInss($valorInss)
    {
        $this->valorInss = number_format($valorInss, 2, '.', '');;
    }

    /**
     * @return float
     */
    public function getValorIr()
    {
        return $this->valorIr;
    }

    /**
     * (OPCIONAL)
     * Valor do IR
     * @param float $valorIr
     */
    public function setValorIr($valorIr)
    {
        $this->valorIr = number_format($valorIr, 2, '.', '');;
    }

    /**
     * @return float
     */
    public function getValorCsll()
    {
        return $this->valorCsll;
    }

    /**
     * (OPCIONAL)
     * Valor do CSLL
     * @param float $valorCsll
     */
    public function setValorCsll($valorCsll)
    {
        $this->valorCsll = number_format($valorCsll, 2, '.', '');;
    }

    /**
     * @return int
     */
    public function getIssRetido()
    {
        return $this->issRetido;
    }

    /**
     * Indica se o imposto será retido
     *
     * @param int $issRetido 1 - Sim; 2 - Não
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
     * (OPCIONAL) Somente quando o imposto for retido
     * Informa o valor do imposto
     *
     * @param float $valorIss
     */
    public function setValorIss($valorIss)
    {
        $this->valorIss = number_format($valorIss, 2, '.', '');;
    }


    /**
     * @return float
     */
    public function getOutrasRetencoes()
    {
        return $this->outrasRetencoes;
    }

    /**
     * (OPCIONAL)
     * @param float $outrasRetencoes
     */
    public function setOutrasRetencoes($outrasRetencoes)
    {
        $this->outrasRetencoes = number_format($outrasRetencoes, 2, '.', '');;
    }

    /**
     * @return float
     */
    public function getAliquota()
    {
        return $this->aliquota;
    }

    /**
     * Aliquota em percentual. 0.05 indica 5% e 5.00 indica 500%
     * @param float $aliquota
     */
    public function setAliquota($aliquota)
    {
        $this->aliquota = number_format($aliquota, 4, '.', '');;
    }



    /**
     * @return float
     */
    public function getDescontoIncondicionado()
    {
        return $this->descontoIncondicionado;
    }

    /**
     * (OPCIONAL)
     * @param float $descontoIncondicionado
     */
    public function setDescontoIncondicionado($descontoIncondicionado)
    {
        $this->descontoIncondicionado = number_format($descontoIncondicionado, 2, '.', '');;
    }

    /**
     * @return float
     */
    public function getDescontoCondicionado()
    {
        return $this->descontoCondicionado;
    }

    /**
     * (OPCIONAL)
     * @param float $descontoCondicionado
     */
    public function setDescontoCondicionado($descontoCondicionado)
    {
        $this->descontoCondicionado = number_format($descontoCondicionado, 2, '.', '');;
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
     * Código IBGE de 7 digitos do município onde o serviço foi prestado
     *
     * @param string $codigoMunicipioPrestacao
     */
    public function setCodigoMunicipioPrestacao($codigoMunicipioPrestacao)
    {
        $this->codigoMunicipioPrestacao = $codigoMunicipioPrestacao;
    }




    /**
     * @return null
     */
    public function getInscricaoMunicipalPrestador()
    {
        return $this->inscricaoMunicipalPrestador;
    }

    /**
     * @param string $inscricaoMunicipalPrestador
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
        $this->cpfCnpjTomador =  preg_replace('/[\.\-\/]/', '',  $cpfCnpjTomador);
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
     * (OPCIONAL)
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
     * (OPCIONAL)
     * @param null $cpfCnpjIntermediario
     */
    public function setCpfCnpjIntermediario($cpfCnpjIntermediario)
    {
        $this->cpfCnpjIntermediario =  preg_replace('/[\.\-\/]/', '',  $cpfCnpjIntermediario);
    }

    /**
     * (OPCIONAL)
     * @return null
     */
    public function getInscricaoMunicipalIntermediario()
    {
        return $this->inscricaoMunicipalIntermediario;
    }

    /**
     * (OPCIONAL)
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
     * (OPCIONAL)
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
        return $this->art;
    }

    /**
     * (OPCIONAL)
     * @param null $art
     */
    public function setArtObra($art)
    {
        $this->art = $art;
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
     * Utilizado para substituir TAGs que podem ter mais de um nome, como ocorre por exemplo com a CPFCNPJ
     * na qual pode assumir tanto o valor CNPJ quanto o valor CPF
     * @return array
     */
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