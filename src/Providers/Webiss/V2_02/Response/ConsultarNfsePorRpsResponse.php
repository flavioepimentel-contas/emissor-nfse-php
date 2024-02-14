<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 23/07/2020
 * Time: 20:45
 */

namespace EmissorNfse\Providers\Webiss\V2_02\Response;


use EmissorNfse\Response;

class ConsultarNfsePorRpsResponse extends Response
{

    public $nfse = null;

    public function __construct()
    {
        $this->nfse = new Nfse();
    }

    public function parseXml($xml){
        if (stripos($xml, 'ConsultarNfseRpsResposta') === false){
            // Significa que o servidor da Prefeitura não forneceu uma resposta válida da operação
            return false;
        }

        $this->xmlResposta = $xml;

        $dom = null;
        try{
            $dom = new \DOMDocument('1.0', 'utf-8');
            $dom->loadXML( $xml, LIBXML_NOBLANKS | LIBXML_NOEMPTYTAG);
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;


            // Verifica se tem lista de erros
            $erros = $dom->getElementsByTagName('MensagemRetorno');
            if ($erros->length > 0 ){
                foreach ($erros as $erro){
                    if (
                        $erro->getElementsByTagName('Codigo')->length > 0
                        && $erro->getElementsByTagName('Mensagem')->length > 0
                    ){
                        array_push($this->erros, [
                            'codigo' => $erro->getElementsByTagName('Codigo')->item(0)->nodeValue,
                            'mensagem' => $erro->getElementsByTagName('Mensagem')->item(0)->nodeValue,
                            'correcao'  =>  ($erro->getElementsByTagName('Correcao')->length > 0) ?
                                $erro->getElementsByTagName('Correcao')->item(0)->nodeValue : null
                        ] );
                    }
                }
            }

            $infNfse = ($dom->getElementsByTagName('InfNfse')->length > 0) ?
                $dom->getElementsByTagName('InfNfse')->item(0) : null;

            if(! empty($infNfse)){
                //Pega o Número do lote
                $this->nfse->numeroNfse = ($infNfse->getElementsByTagName('Numero')->length > 0) ?
                    $infNfse->getElementsByTagName('Numero')->item(0)->nodeValue : null;

                $this->nfse->codigoVerificacao = ($infNfse->getElementsByTagName('CodigoVerificacao')->length > 0) ?
                    $infNfse->getElementsByTagName('CodigoVerificacao')->item(0)->nodeValue : null;

                $this->nfse->dataEmissaoNfse = ($infNfse->getElementsByTagName('DataEmissao')->length > 0) ?
                    $infNfse->getElementsByTagName('DataEmissao')->item(0)->nodeValue : null;

                $this->nfse->outrasInformacoes = ($infNfse->getElementsByTagName('OutrasInformacoes')->length > 0) ?
                    $infNfse->getElementsByTagName('OutrasInformacoes')->item(0)->nodeValue : null;

                $valoresNfse = ($infNfse->getElementsByTagName('ValoresNfse')->length > 0) ?
                    $infNfse->getElementsByTagName('ValoresNfse')->item(0) : null;

                if(! empty($valoresNfse)){
                    $this->nfse->baseCalculo = ($valoresNfse->getElementsByTagName('BaseCalculo')->length > 0) ?
                        $valoresNfse->getElementsByTagName('BaseCalculo')->item(0)->nodeValue : null;

                    $this->nfse->aliquota = ($valoresNfse->getElementsByTagName('Aliquota')->length > 0) ?
                        $valoresNfse->getElementsByTagName('Aliquota')->item(0)->nodeValue : null;

                    $this->nfse->valorIss = ($valoresNfse->getElementsByTagName('ValorIss')->length > 0) ?
                        $valoresNfse->getElementsByTagName('ValorIss')->item(0)->nodeValue : null;

                    $this->nfse->valorLiquidoNfse = ($valoresNfse->getElementsByTagName('ValorLiquidoNfse')->length > 0) ?
                        $valoresNfse->getElementsByTagName('ValorLiquidoNfse')->item(0)->nodeValue : null;
                }

                $this->nfse->valorCredito = ($infNfse->getElementsByTagName('ValorCredito')->length > 0) ?
                    $infNfse->getElementsByTagName('ValorCredito')->item(0)->nodeValue : null;

                $prestadorServico = ($infNfse->getElementsByTagName('PrestadorServico')->length > 0) ?
                    $infNfse->getElementsByTagName('PrestadorServico')->item(0) : null;

                if(! empty($prestadorServico)){

                    $this->nfse->cnpjPrestador = ($prestadorServico->getElementsByTagName('Cpf')->length > 0) ?
                        $prestadorServico->getElementsByTagName('Cpf')->item(0)->nodeValue : null;

                    $this->nfse->cnpjPrestador = ($prestadorServico->getElementsByTagName('Cnpj')->length > 0) ?
                        $prestadorServico->getElementsByTagName('Cnpj')->item(0)->nodeValue : null;

                    $this->nfse->inscricaoMunicipalPrestador = ($prestadorServico->getElementsByTagName('InscricaoMunicipal')->length > 0) ?
                        $prestadorServico->getElementsByTagName('InscricaoMunicipal')->item(0)->nodeValue : null;


                    $this->nfse->razaoSocialPrestador = ($prestadorServico->getElementsByTagName('RazaoSocial')->length > 0) ?
                        $prestadorServico->getElementsByTagName('RazaoSocial')->item(0)->nodeValue : null;

                    $this->nfse->nomeFantasiaPrestador = ($prestadorServico->getElementsByTagName('NomeFantasia')->length > 0) ?
                        $prestadorServico->getElementsByTagName('NomeFantasia')->item(0)->nodeValue : null;

                    $this->nfse->enderecoPrestador = ($prestadorServico->getElementsByTagName('Endereco')->length > 0) ?
                        $prestadorServico->getElementsByTagName('Endereco')->item(0)->nodeValue : null;

                    $this->nfse->numeroEnderecoPrestador = ($prestadorServico->getElementsByTagName('Numero')->length > 0) ?
                        $prestadorServico->getElementsByTagName('Numero')->item(0)->nodeValue : null;

                    $this->nfse->bairroPrestador = ($prestadorServico->getElementsByTagName('Bairro')->length > 0) ?
                        $prestadorServico->getElementsByTagName('Bairro')->item(0)->nodeValue : null;

                    $this->nfse->codigoMunicipioPrestador = ($prestadorServico->getElementsByTagName('CodigoMunicipio')->length > 0) ?
                        $prestadorServico->getElementsByTagName('CodigoMunicipio')->item(0)->nodeValue : null;

                    $this->nfse->ufPrestador = ($prestadorServico->getElementsByTagName('Uf')->length > 0) ?
                        $prestadorServico->getElementsByTagName('Uf')->item(0)->nodeValue : null;

                    $this->nfse->codigoPaisPrestador = ($prestadorServico->getElementsByTagName('CodigoPais')->length > 0) ?
                        $prestadorServico->getElementsByTagName('CodigoPais')->item(0)->nodeValue : null;

                    $this->nfse->cepPrestador = ($prestadorServico->getElementsByTagName('Cep')->length > 0) ?
                        $prestadorServico->getElementsByTagName('Cep')->item(0)->nodeValue : null;

                    $this->nfse->telefonePrestador = ($prestadorServico->getElementsByTagName('Telefone')->length > 0) ?
                        $prestadorServico->getElementsByTagName('Telefone')->item(0)->nodeValue : null;

                    $this->nfse->emailPrestador = ($prestadorServico->getElementsByTagName('Email')->length > 0) ?
                        $prestadorServico->getElementsByTagName('Email')->item(0)->nodeValue : null;

                }

                $orgaoGerador = ($infNfse->getElementsByTagName('OrgaoGerador')->length > 0) ?
                    $infNfse->getElementsByTagName('OrgaoGerador')->item(0) : null;

                if(! empty($orgaoGerador)){

                    $this->nfse->codigoMunicipioOrgaoGerador = ($orgaoGerador->getElementsByTagName('CodigoMunicipio')->length > 0) ?
                        $infNfse->getElementsByTagName('CodigoMunicipio')->item(0)->nodeValue : null;

                    $this->nfse->ufMunicipioOrgaoGerador = ($orgaoGerador->getElementsByTagName('Uf')->length > 0) ?
                        $orgaoGerador->getElementsByTagName('Uf')->item(0)->nodeValue : null;

                }

                $declaracaoPrestacaoServico = ($infNfse->getElementsByTagName('DeclaracaoPrestacaoServico')->length > 0) ?
                    $infNfse->getElementsByTagName('DeclaracaoPrestacaoServico')->item(0) : null;

                if(! empty($declaracaoPrestacaoServico)){

                    $rps = ($declaracaoPrestacaoServico->getElementsByTagName('Rps')->length > 0) ?
                        $declaracaoPrestacaoServico->getElementsByTagName('Rps')->item(0) : null;

                    if(! empty($rps)){
                        $this->nfse->numeroRps = ($rps->getElementsByTagName('Numero')->length > 0) ?
                            $rps->getElementsByTagName('Numero')->item(0)->nodeValue : null;

                        $this->nfse->serieRps = ($rps->getElementsByTagName('Serie')->length > 0) ?
                            $rps->getElementsByTagName('Serie')->item(0)->nodeValue : null;

                        $this->nfse->tipoRps = ($rps->getElementsByTagName('Tipo')->length > 0) ?
                            $rps->getElementsByTagName('Tipo')->item(0)->nodeValue : null;

                        $this->nfse->dataEmissaoRps = ($rps->getElementsByTagName('DataEmissao')->length > 0) ?
                            $rps->getElementsByTagName('DataEmissao')->item(0)->nodeValue : null;

                        $this->nfse->statusRps = ($rps->getElementsByTagName('Status')->length > 0) ?
                            $rps->getElementsByTagName('Status')->item(0)->nodeValue : null;
                    }




                    $this->nfse->competencia = ($declaracaoPrestacaoServico->getElementsByTagName('Competencia')->length > 0) ?
                        $declaracaoPrestacaoServico->getElementsByTagName('Competencia')->item(0)->nodeValue : null;

                    $servico = ($declaracaoPrestacaoServico->getElementsByTagName('Servico')->length > 0) ?
                        $declaracaoPrestacaoServico->getElementsByTagName('Servico')->item(0) : null;

                    if(! empty($servico)){

                        $this->nfse->valorServicos = ($servico->getElementsByTagName('ValorServicos')->length > 0) ?
                            $servico->getElementsByTagName('ValorServicos')->item(0)->nodeValue : null;

                        $this->nfse->valorDeducoes = ($servico->getElementsByTagName('ValorDeducoes')->length > 0) ?
                            $servico->getElementsByTagName('ValorDeducoes')->item(0)->nodeValue : null;

                        $this->nfse->valorPis = ($servico->getElementsByTagName('ValorPis')->length > 0) ?
                            $servico->getElementsByTagName('ValorPis')->item(0)->nodeValue : null;

                        $this->nfse->valorCofins = ($servico->getElementsByTagName('ValorCofins')->length > 0) ?
                            $servico->getElementsByTagName('ValorCofins')->item(0)->nodeValue : null;

                        $this->nfse->valorInss = ($servico->getElementsByTagName('ValorInss')->length > 0) ?
                            $servico->getElementsByTagName('ValorInss')->item(0)->nodeValue : null;

                        $this->nfse->valorIr = ($servico->getElementsByTagName('ValorIr')->length > 0) ?
                            $servico->getElementsByTagName('ValorIr')->item(0)->nodeValue : null;

                        $this->nfse->valorCsll = ($servico->getElementsByTagName('ValorCsll')->length > 0) ?
                            $servico->getElementsByTagName('ValorCsll')->item(0)->nodeValue : null;

                        $this->nfse->outrasRetencoes = ($servico->getElementsByTagName('OutrasRetencoes')->length > 0) ?
                            $servico->getElementsByTagName('OutrasRetencoes')->item(0)->nodeValue : null;

                        if(empty($this->nfse->valorIss)){
                            $this->nfse->valorIss = ($servico->getElementsByTagName('ValorIss')->length > 0) ?
                                $servico->getElementsByTagName('ValorIss')->item(0)->nodeValue : null;
                        }

                        if(empty($this->nfse->aliquota)){
                            $this->nfse->aliquota = ($servico->getElementsByTagName('Aliquota')->length > 0) ?
                                $servico->getElementsByTagName('Aliquota')->item(0)->nodeValue : null;
                        }

                        $this->nfse->descontoIncondicionado = ($servico->getElementsByTagName('DescontoIncondicionado')->length > 0) ?
                            $servico->getElementsByTagName('DescontoIncondicionado')->item(0)->nodeValue : null;

                        $this->nfse->issRetido = ($servico->getElementsByTagName('IssRetido')->length > 0) ?
                            $servico->getElementsByTagName('IssRetido')->item(0)->nodeValue : null;

                        $this->nfse->responsavelRetencao = ($servico->getElementsByTagName('ResponsavelRetencao')->length > 0) ?
                            $servico->getElementsByTagName('ResponsavelRetencao')->item(0)->nodeValue : null;

                        $this->nfse->itemListaServico = ($servico->getElementsByTagName('ItemListaServico')->length > 0) ?
                            $servico->getElementsByTagName('ItemListaServico')->item(0)->nodeValue : null;

                        $this->nfse->codigoCnae = ($servico->getElementsByTagName('CodigoCnae')->length > 0) ?
                            $servico->getElementsByTagName('CodigoCnae')->item(0)->nodeValue : null;

                        $this->nfse->codigoTributacaoMunicipio = ($servico->getElementsByTagName('CodigoTributacaoMunicipio')->length > 0) ?
                            $servico->getElementsByTagName('CodigoTributacaoMunicipio')->item(0)->nodeValue : null;

                        $this->nfse->discriminacao = ($servico->getElementsByTagName('Discriminacao')->length > 0) ?
                            $servico->getElementsByTagName('Discriminacao')->item(0)->nodeValue : null;

                        $this->nfse->codigoMunicipioPrestacao = ($servico->getElementsByTagName('CodigoMunicipio')->length > 0) ?
                            $servico->getElementsByTagName('CodigoMunicipio')->item(0)->nodeValue : null;

                        $this->nfse->codigoPaisPrestacao = ($servico->getElementsByTagName('CodigoPais')->length > 0) ?
                            $servico->getElementsByTagName('CodigoPais')->item(0)->nodeValue : null;

                        $this->nfse->exigibilidadeIss = ($servico->getElementsByTagName('ExigibilidadeISS')->length > 0) ?
                            $servico->getElementsByTagName('ExigibilidadeISS')->item(0)->nodeValue : null;

                        $this->nfse->codigoMunicipioIncidencia = ($servico->getElementsByTagName('MunicipioIncidencia')->length > 0) ?
                            $servico->getElementsByTagName('MunicipioIncidencia')->item(0)->nodeValue : null;

                        $this->nfse->numeroProcesso = ($servico->getElementsByTagName('NumeroProcesso')->length > 0) ?
                            $servico->getElementsByTagName('NumeroProcesso')->item(0)->nodeValue : null;


                    }


                    $tomador = ($declaracaoPrestacaoServico->getElementsByTagName('Tomador')->length > 0) ?
                        $declaracaoPrestacaoServico->getElementsByTagName('Tomador')->item(0) : null;

                    if(! empty($tomador)){

                        $this->nfse->cpfCnpjTomador = ($tomador->getElementsByTagName('Cpf')->length > 0) ?
                            $tomador->getElementsByTagName('Cpf')->item(0)->nodeValue : null;

                        $this->nfse->cpfCnpjTomador = ($tomador->getElementsByTagName('Cnpj')->length > 0) ?
                            $tomador->getElementsByTagName('Cnpj')->item(0)->nodeValue : null;

                        $this->nfse->inscricaoMunicipalTomador = ($tomador->getElementsByTagName('InscricaoMunicipal')->length > 0) ?
                            $tomador->getElementsByTagName('InscricaoMunicipal')->item(0)->nodeValue : null;

                        $this->nfse->razaoSocialTomador = ($tomador->getElementsByTagName('RazaoSocial')->length > 0) ?
                            $tomador->getElementsByTagName('RazaoSocial')->item(0)->nodeValue : null;

                        $this->nfse->enderecoTomador = ($tomador->getElementsByTagName('Endereco')->length > 0) ?
                            $tomador->getElementsByTagName('Endereco')->item(0)->nodeValue : null;

                        $this->nfse->numeroEnderecoTomador = ($tomador->getElementsByTagName('Numero')->length > 0) ?
                            $tomador->getElementsByTagName('Numero')->item(0)->nodeValue : null;

                        $this->nfse->complementoEnderecoTomador = ($tomador->getElementsByTagName('Complemento')->length > 0) ?
                            $tomador->getElementsByTagName('Complemento')->item(0)->nodeValue : null;

                        $this->nfse->bairroTomador = ($tomador->getElementsByTagName('Bairro')->length > 0) ?
                            $tomador->getElementsByTagName('Bairro')->item(0)->nodeValue : null;

                        $this->nfse->codigoMunicipioTomador = ($tomador->getElementsByTagName('CodigoMunicipio')->length > 0) ?
                            $tomador->getElementsByTagName('CodigoMunicipio')->item(0)->nodeValue : null;

                        $this->nfse->ufTomador = ($tomador->getElementsByTagName('Uf')->length > 0) ?
                            $tomador->getElementsByTagName('Uf')->item(0)->nodeValue : null;

                        $this->nfse->codigoPaisTomador = ($tomador->getElementsByTagName('CodigoPais')->length > 0) ?
                            $tomador->getElementsByTagName('CodigoPais')->item(0)->nodeValue : null;

                        $this->nfse->cepTomador = ($tomador->getElementsByTagName('Cep')->length > 0) ?
                            $tomador->getElementsByTagName('Cep')->item(0)->nodeValue : null;

                        $this->nfse->telefoneTomador = ($tomador->getElementsByTagName('Telefone')->length > 0) ?
                            $tomador->getElementsByTagName('Telefone')->item(0)->nodeValue : null;

                        $this->nfse->emailTomador = ($tomador->getElementsByTagName('Email')->length > 0) ?
                            $tomador->getElementsByTagName('Email')->item(0)->nodeValue : null;


                    }


                    $construcao = ($declaracaoPrestacaoServico->getElementsByTagName('Tomador')->length > 0) ?
                        $declaracaoPrestacaoServico->getElementsByTagName('Tomador')->item(0) : null;

                    if(! empty($construcao)){

                        $this->nfse->codigoObra = ($construcao->getElementsByTagName('CodigoObra')->length > 0) ?
                            $construcao->getElementsByTagName('CodigoObra')->item(0)->nodeValue : null;

                        $this->nfse->artObra = ($construcao->getElementsByTagName('Art')->length > 0) ?
                            $construcao->getElementsByTagName('Art')->item(0)->nodeValue : null;

                    }



                    $this->nfse->regimeEspecialTributacao = ($declaracaoPrestacaoServico->getElementsByTagName('RegimeEspecialTributacao')->length > 0) ?
                        $declaracaoPrestacaoServico->getElementsByTagName('RegimeEspecialTributacao')->item(0)->nodeValue : null;

                    $this->nfse->optanteSimplesNacional = ($declaracaoPrestacaoServico->getElementsByTagName('OptanteSimplesNacional')->length > 0) ?
                        $declaracaoPrestacaoServico->getElementsByTagName('OptanteSimplesNacional')->item(0)->nodeValue : null;

                    $this->nfse->incentivoFiscal = ($declaracaoPrestacaoServico->getElementsByTagName('IncentivoFiscal')->length > 0) ?
                        $declaracaoPrestacaoServico->getElementsByTagName('IncentivoFiscal')->item(0)->nodeValue : null;



                } // end $declaracaoPrestacaoServico



            } // end $infNfse

            $nfseCancelamento = ($dom->getElementsByTagName('NfseCancelamento')->length > 0) ?
                $dom->getElementsByTagName('NfseCancelamento')->item(0) : null;

            if(! empty($nfseCancelamento)){

                $this->nfse->cpfCnpjCancelamento = ($nfseCancelamento->getElementsByTagName('Cpf')->length > 0) ?
                    $nfseCancelamento->getElementsByTagName('Cpf')->item(0)->nodeValue : null;

                $this->nfse->cpfCnpjCancelamento = ($nfseCancelamento->getElementsByTagName('Cnpj')->length > 0) ?
                    $nfseCancelamento->getElementsByTagName('Cnpj')->item(0)->nodeValue : null;

                $this->nfse->codigoMunicipioCancelamento = ($nfseCancelamento->getElementsByTagName('CodigoMunicipio')->length > 0) ?
                    $nfseCancelamento->getElementsByTagName('CodigoMunicipio')->item(0)->nodeValue : null;

                $this->nfse->numeroNfseCancelamento = ($nfseCancelamento->getElementsByTagName('Numero')->length > 0) ?
                    $nfseCancelamento->getElementsByTagName('Numero')->item(0)->nodeValue : null;

                $this->nfse->dataHoraCancelamento = ($nfseCancelamento->getElementsByTagName('DataHora')->length > 0) ?
                    $nfseCancelamento->getElementsByTagName('DataHora')->item(0)->nodeValue : null;

            } // end $nfseCancelamento


            $nfseSubstituicao = ($dom->getElementsByTagName('NfseSubstituicao')->length > 0) ?
                $dom->getElementsByTagName('NfseSubstituicao')->item(0) : null;

            if(! empty($nfseSubstituicao)){

                $this->nfse->nfseSubstituidora = ($nfseSubstituicao->getElementsByTagName('NfseSubstituidora')->length > 0) ?
                    $nfseSubstituicao->getElementsByTagName('NfseSubstituidora')->item(0)->nodeValue : null;

            }


        }catch (\Exception $e){
            return false;
        }

        return true;
    }
}