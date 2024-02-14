<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 24/01/2021
 * Time: 22:03
 */

namespace EmissorNfse\Providers\Webiss\V1_00\Response;


class Nfse
{
    public $numeroNfse = null;
    public $codigoVerificacao = null;
    public $dataEmissaoNfse = null;
    public $outrasInformacoes  = null;
    public $baseCalculo = null;
    public $aliquota  = null;
    public $valorIss  = null;
    public $valorIssRetido  = null;
    public $valorLiquidoNfse  = null;
    public $valorCredito = null;
    public $cnpjPrestador  = null;
    public $inscricaoMunicipalPrestador  = null;
    public $razaoSocialPrestador  = null;
    public $nomeFantasiaPrestador  = null;
    public $enderecoPrestador  = null;
    public $numeroEnderecoPrestador  = null;
    public $bairroPrestador  = null;
    public $codigoMunicipioPrestador  = null;
    public $ufPrestador  = null;
    public $cepPrestador  = null;
    public $telefonePrestador  = null;
    public $emailPrestador = null;
    public $codigoMunicipioOrgaoGerador = null;
    public $ufMunicipioOrgaoGerador  = null;
    public $numeroRps = null;
    public $serieRps  = null;
    public $tipoRps  = null;
    public $dataEmissaoRps = null;
    public $statusRps  = null;
    public $competencia  = null;
    public $valorServicos  = null;
    public $valorDeducoes  = null;
    public $valorPis  = null;
    public $valorCofins  = null;
    public $valorInss  = null;
    public $valorIr  = null;
    public $valorCsll  = null;
    public $outrasRetencoes  = null;
    public $descontoIncondicionado  = null;
    public $descontoCondicionado  = null;
    public $issRetido  = null;
    public $itemListaServico  = null;
    public $codigoCnae  = null;
    public $codigoTributacaoMunicipio  = null;
    public $discriminacao  = null;
    public $codigoMunicipioPrestacao  = null;
    public $codigoPaisPrestacao = null;
    public $naturezaOperacao  = null;
    public $cpfCnpjTomador  = null;
    public $inscricaoMunicipalTomador  = null;
    public $razaoSocialTomador  = null;
    public $enderecoTomador = null;
    public $numeroEnderecoTomador  = null;
    public $complementoEnderecoTomador  = null;
    public $bairroTomador  = null;
    public $codigoMunicipioTomador  = null;
    public $ufTomador  = null;
    public $codigoPaisTomador = null;
    public $cepTomador  = null;
    public $telefoneTomador = null;
    public $emailTomador  = null;
    public $cpfCnpjIntermediario  = null;
    public $inscricaoMunicipalIntermediario  = null;
    public $razaoSocialIntermediario  = null;

    public $codigoObra  = null;
    public $artObra  = null;
    public $regimeEspecialTributacao  = null;
    public $optanteSimplesNacional = null;
    public $incentivadorCultural  = null;
    public $cpfCnpjCancelamento  = null;
    public $codigoMunicipioCancelamento  = null;
    public $numeroNfseCancelamento = null;
    public $codigoCancelamentoNfse = null;
    public $dataHoraCancelamento  = null;
    public $numeroNfseSubstituidora  = null;

    public function __construct()
    {
    }
}