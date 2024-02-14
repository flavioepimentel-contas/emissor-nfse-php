<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 25/01/2021
 * Time: 13:11
 */

namespace EmissorNfse\Providers\Webiss\V1_00\Response;


use EmissorNfse\Response;

class ConsultarNfsePorRpsResponse extends Response
{
    public $listaNfse = [];

    public function parseXml($xml){

        if (stripos($xml, 'ConsultarNfseRpsResposta') === false){
            // Significa que o servidor da Prefeitura não forneceu uma resposta válida da operação
            return false;
        }

        $this->xmlResposta = $xml;

        $dom = null;
        try{
            $dom = new \DOMDocument('1.0', 'utf-8');
            @$dom->loadXML( $xml, LIBXML_NOBLANKS | LIBXML_NOEMPTYTAG);
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


            $compNfse = ($dom->getElementsByTagName('CompNfse')->length > 0) ?
                $dom->getElementsByTagName('CompNfse') : null;

            if(! empty($compNfse)){

                foreach ($compNfse as $nfse){
                    $nota = new Nfse();

                    $infNfse = ($nfse->getElementsByTagName('InfNfse')->length > 0) ?
                        $nfse->getElementsByTagName('InfNfse')->item(0) : null;

                    if(! empty($infNfse)) {

                        $nota->numeroNfse = ($infNfse->getElementsByTagName('Numero')->length > 0) ?
                            $infNfse->getElementsByTagName('Numero')->item(0)->nodeValue : null;

                        $nota->codigoVerificacao = ($infNfse->getElementsByTagName('CodigoVerificacao')->length > 0) ?
                            $infNfse->getElementsByTagName('CodigoVerificacao')->item(0)->nodeValue : null;

                        $nota->dataEmissaoNfse = ($infNfse->getElementsByTagName('DataEmissao')->length > 0) ?
                            $infNfse->getElementsByTagName('DataEmissao')->item(0)->nodeValue : null;

                        $rps = ($infNfse->getElementsByTagName('IdentificacaoRps')->length > 0) ?
                            $infNfse->getElementsByTagName('IdentificacaoRps')->item(0) : null;

                        if(! empty($rps)){
                            $nota->numeroRps = ($rps->getElementsByTagName('Numero')->length > 0) ?
                                $rps->getElementsByTagName('Numero')->item(0)->nodeValue : null;

                            $nota->serieRps = ($rps->getElementsByTagName('Serie')->length > 0) ?
                                $rps->getElementsByTagName('Serie')->item(0)->nodeValue : null;

                            $nota->tipoRps = ($rps->getElementsByTagName('Tipo')->length > 0) ?
                                $rps->getElementsByTagName('Tipo')->item(0)->nodeValue : null;

                        }

                        $nota->dataEmissaoRps = ($infNfse->getElementsByTagName('DataEmissaoRps')->length > 0) ?
                            $infNfse->getElementsByTagName('DataEmissaoRps')->item(0)->nodeValue : null;

                        $nota->naturezaOperacao = ($infNfse->getElementsByTagName('NaturezaOperacao')->length > 0) ?
                            $infNfse->getElementsByTagName('NaturezaOperacao')->item(0)->nodeValue : null;

                        $nota->regimeEspecialTributacao = ($infNfse->getElementsByTagName('RegimeEspecialTributacao')->length > 0) ?
                            $infNfse->getElementsByTagName('RegimeEspecialTributacao')->item(0)->nodeValue : null;

                        $nota->optanteSimplesNacional = ($infNfse->getElementsByTagName('OptanteSimplesNacional')->length > 0) ?
                            $infNfse->getElementsByTagName('OptanteSimplesNacional')->item(0)->nodeValue : null;

                        $nota->incentivadorCultural = ($infNfse->getElementsByTagName('IncentivadorCultural')->length > 0) ?
                            $infNfse->getElementsByTagName('IncentivadorCultural')->item(0)->nodeValue : null;

                        $nota->competencia = ($infNfse->getElementsByTagName('Competencia')->length > 0) ?
                            $infNfse->getElementsByTagName('Competencia')->item(0)->nodeValue : null;

                        $nota->nfseSubstituida = ($infNfse->getElementsByTagName('NfseSubstituida')->length > 0) ?
                            $infNfse->getElementsByTagName('NfseSubstituida')->item(0)->nodeValue : null;

                        $nota->outrasInformacoes = ($infNfse->getElementsByTagName('OutrasInformacoes')->length > 0) ?
                            $infNfse->getElementsByTagName('OutrasInformacoes')->item(0)->nodeValue : null;




                        $servico = ($infNfse->getElementsByTagName('Servico')->length > 0) ?
                            $infNfse->getElementsByTagName('Servico')->item(0) : null;

                        if(! empty($servico)){

                            $nota->valorServicos = ($servico->getElementsByTagName('ValorServicos')->length > 0) ?
                                $servico->getElementsByTagName('ValorServicos')->item(0)->nodeValue : null;

                            $nota->valorDeducoes = ($servico->getElementsByTagName('ValorDeducoes')->length > 0) ?
                                $servico->getElementsByTagName('ValorDeducoes')->item(0)->nodeValue : null;

                            $nota->valorPis = ($servico->getElementsByTagName('ValorPis')->length > 0) ?
                                $servico->getElementsByTagName('ValorPis')->item(0)->nodeValue : null;

                            $nota->valorCofins = ($servico->getElementsByTagName('ValorCofins')->length > 0) ?
                                $servico->getElementsByTagName('ValorCofins')->item(0)->nodeValue : null;

                            $nota->valorInss = ($servico->getElementsByTagName('ValorInss')->length > 0) ?
                                $servico->getElementsByTagName('ValorInss')->item(0)->nodeValue : null;

                            $nota->valorIr = ($servico->getElementsByTagName('ValorIr')->length > 0) ?
                                $servico->getElementsByTagName('ValorIr')->item(0)->nodeValue : null;

                            $nota->valorCsll = ($servico->getElementsByTagName('ValorCsll')->length > 0) ?
                                $servico->getElementsByTagName('ValorCsll')->item(0)->nodeValue : null;

                            $nota->issRetido = ($servico->getElementsByTagName('IssRetido')->length > 0) ?
                                $servico->getElementsByTagName('IssRetido')->item(0)->nodeValue : null;

                            $nota->valorIss = ($servico->getElementsByTagName('ValorIss')->length > 0) ?
                                $servico->getElementsByTagName('ValorIss')->item(0)->nodeValue : null;

                            $nota->valorIssRetido = ($servico->getElementsByTagName('ValorIssRetido')->length > 0) ?
                                $servico->getElementsByTagName('ValorIssRetido')->item(0)->nodeValue : null;

                            $nota->outrasRetencoes = ($servico->getElementsByTagName('OutrasRetencoes')->length > 0) ?
                                $servico->getElementsByTagName('OutrasRetencoes')->item(0)->nodeValue : null;

                            $nota->baseCalculo = ($servico->getElementsByTagName('BaseCalculo')->length > 0) ?
                                $servico->getElementsByTagName('BaseCalculo')->item(0)->nodeValue : null;

                            $nota->aliquota = ($servico->getElementsByTagName('Aliquota')->length > 0) ?
                                $servico->getElementsByTagName('Aliquota')->item(0)->nodeValue : null;

                            $nota->valorLiquidoNfse = ($servico->getElementsByTagName('ValorLiquidoNfse')->length > 0) ?
                                $servico->getElementsByTagName('ValorLiquidoNfse')->item(0)->nodeValue : null;

                            $nota->descontoIncondicionado = ($servico->getElementsByTagName('DescontoIncondicionado')->length > 0) ?
                                $servico->getElementsByTagName('DescontoIncondicionado')->item(0)->nodeValue : null;

                            $nota->descontoCondicionado = ($servico->getElementsByTagName('DescontoCondicionado')->length > 0) ?
                                $servico->getElementsByTagName('DescontoCondicionado')->item(0)->nodeValue : null;


                            $nota->itemListaServico = ($servico->getElementsByTagName('ItemListaServico')->length > 0) ?
                                $servico->getElementsByTagName('ItemListaServico')->item(0)->nodeValue : null;

                            $nota->codigoCnae = ($servico->getElementsByTagName('CodigoCnae')->length > 0) ?
                                $servico->getElementsByTagName('CodigoCnae')->item(0)->nodeValue : null;

                            $nota->codigoTributacaoMunicipio = ($servico->getElementsByTagName('CodigoTributacaoMunicipio')->length > 0) ?
                                $servico->getElementsByTagName('CodigoTributacaoMunicipio')->item(0)->nodeValue : null;

                            $nota->discriminacao = ($servico->getElementsByTagName('Discriminacao')->length > 0) ?
                                $servico->getElementsByTagName('Discriminacao')->item(0)->nodeValue : null;

                            $nota->codigoMunicipioPrestacao = ($servico->getElementsByTagName('CodigoMunicipio')->length > 0) ?
                                $servico->getElementsByTagName('CodigoMunicipio')->item(0)->nodeValue : null;


                        }

                        $nota->valorCredito = ($infNfse->getElementsByTagName('ValorCredito')->length > 0) ?
                            $infNfse->getElementsByTagName('ValorCredito')->item(0)->nodeValue : null;

                        $prestadorServico = ($infNfse->getElementsByTagName('PrestadorServico')->length > 0) ?
                            $infNfse->getElementsByTagName('PrestadorServico')->item(0) : null;

                        if(! empty($prestadorServico)){

                            $nota->cnpjPrestador = ($prestadorServico->getElementsByTagName('Cpf')->length > 0) ?
                                $prestadorServico->getElementsByTagName('Cpf')->item(0)->nodeValue : null;

                            $nota->cnpjPrestador = ($prestadorServico->getElementsByTagName('Cnpj')->length > 0) ?
                                $prestadorServico->getElementsByTagName('Cnpj')->item(0)->nodeValue : null;

                            $nota->inscricaoMunicipalPrestador = ($prestadorServico->getElementsByTagName('InscricaoMunicipal')->length > 0) ?
                                $prestadorServico->getElementsByTagName('InscricaoMunicipal')->item(0)->nodeValue : null;


                            $nota->razaoSocialPrestador = ($prestadorServico->getElementsByTagName('RazaoSocial')->length > 0) ?
                                $prestadorServico->getElementsByTagName('RazaoSocial')->item(0)->nodeValue : null;

                            $nota->nomeFantasiaPrestador = ($prestadorServico->getElementsByTagName('NomeFantasia')->length > 0) ?
                                $prestadorServico->getElementsByTagName('NomeFantasia')->item(0)->nodeValue : null;


                            $endereco = ($prestadorServico->getElementsByTagName('Endereco')->length > 0) ?
                                $prestadorServico->getElementsByTagName('Endereco')->item(0) : null;

                            if(! empty($endereco)){
                                $nota->enderecoPrestador = ($endereco->getElementsByTagName('Endereco')->length > 0) ?
                                    $endereco->getElementsByTagName('Endereco')->item(0)->nodeValue : null;

                                $nota->numeroEnderecoPrestador = ($endereco->getElementsByTagName('Numero')->length > 0) ?
                                    $endereco->getElementsByTagName('Numero')->item(0)->nodeValue : null;

                                $nota->bairroPrestador = ($endereco->getElementsByTagName('Bairro')->length > 0) ?
                                    $endereco->getElementsByTagName('Bairro')->item(0)->nodeValue : null;

                                $nota->codigoMunicipioPrestador = ($endereco->getElementsByTagName('CodigoMunicipio')->length > 0) ?
                                    $endereco->getElementsByTagName('CodigoMunicipio')->item(0)->nodeValue : null;

                                $nota->ufPrestador = ($endereco->getElementsByTagName('Uf')->length > 0) ?
                                    $endereco->getElementsByTagName('Uf')->item(0)->nodeValue : null;

                                $nota->codigoPaisPrestador = ($endereco->getElementsByTagName('CodigoPais')->length > 0) ?
                                    $endereco->getElementsByTagName('CodigoPais')->item(0)->nodeValue : null;

                                $nota->cepPrestador = ($endereco->getElementsByTagName('Cep')->length > 0) ?
                                    $endereco->getElementsByTagName('Cep')->item(0)->nodeValue : null;
                            }


                            $nota->telefonePrestador = ($prestadorServico->getElementsByTagName('Telefone')->length > 0) ?
                                $prestadorServico->getElementsByTagName('Telefone')->item(0)->nodeValue : null;

                            $nota->emailPrestador = ($prestadorServico->getElementsByTagName('Email')->length > 0) ?
                                $prestadorServico->getElementsByTagName('Email')->item(0)->nodeValue : null;

                        } // Fim prestadorServico






                        $tomador = ($infNfse->getElementsByTagName('TomadorServico')->length > 0) ?
                            $infNfse->getElementsByTagName('TomadorServico')->item(0) : null;

                        if(! empty($tomador)){

                            $nota->cpfCnpjTomador = ($tomador->getElementsByTagName('Cpf')->length > 0) ?
                                $tomador->getElementsByTagName('Cpf')->item(0)->nodeValue : null;

                            $nota->cpfCnpjTomador = ($tomador->getElementsByTagName('Cnpj')->length > 0) ?
                                $tomador->getElementsByTagName('Cnpj')->item(0)->nodeValue : null;

                            $nota->inscricaoMunicipalTomador = ($tomador->getElementsByTagName('InscricaoMunicipal')->length > 0) ?
                                $tomador->getElementsByTagName('InscricaoMunicipal')->item(0)->nodeValue : null;

                            $nota->razaoSocialTomador = ($tomador->getElementsByTagName('RazaoSocial')->length > 0) ?
                                $tomador->getElementsByTagName('RazaoSocial')->item(0)->nodeValue : null;


                            $endereco = ($prestadorServico->getElementsByTagName('Endereco')->length > 0) ?
                                $prestadorServico->getElementsByTagName('Endereco')->item(0) : null;

                            if(! empty($endereco)){
                                $nota->enderecoTomador = ($endereco->getElementsByTagName('Endereco')->length > 0) ?
                                    $endereco->getElementsByTagName('Endereco')->item(0)->nodeValue : null;

                                $nota->numeroEnderecoTomador = ($endereco->getElementsByTagName('Numero')->length > 0) ?
                                    $endereco->getElementsByTagName('Numero')->item(0)->nodeValue : null;

                                $nota->complementoEnderecoTomador = ($endereco->getElementsByTagName('Complemento')->length > 0) ?
                                    $endereco->getElementsByTagName('Complemento')->item(0)->nodeValue : null;

                                $nota->bairroTomador = ($endereco->getElementsByTagName('Bairro')->length > 0) ?
                                    $endereco->getElementsByTagName('Bairro')->item(0)->nodeValue : null;

                                $nota->codigoMunicipioTomador = ($endereco->getElementsByTagName('CodigoMunicipio')->length > 0) ?
                                    $endereco->getElementsByTagName('CodigoMunicipio')->item(0)->nodeValue : null;

                                $nota->ufTomador = ($endereco->getElementsByTagName('Uf')->length > 0) ?
                                    $endereco->getElementsByTagName('Uf')->item(0)->nodeValue : null;

                                $nota->cepTomador = ($endereco->getElementsByTagName('Cep')->length > 0) ?
                                    $endereco->getElementsByTagName('Cep')->item(0)->nodeValue : null;
                            }

                            $nota->telefoneTomador = ($tomador->getElementsByTagName('Telefone')->length > 0) ?
                                $tomador->getElementsByTagName('Telefone')->item(0)->nodeValue : null;

                            $nota->emailTomador = ($tomador->getElementsByTagName('Email')->length > 0) ?
                                $tomador->getElementsByTagName('Email')->item(0)->nodeValue : null;


                        }


                        $intermediario = ($infNfse->getElementsByTagName('IntermediarioServico')->length > 0) ?
                            $infNfse->getElementsByTagName('IntermediarioServico')->item(0) : null;

                        if(! empty($intermediario)){

                            $nota->cpfCnpjIntermediario = ($intermediario->getElementsByTagName('Cpf')->length > 0) ?
                                $intermediario->getElementsByTagName('Cpf')->item(0)->nodeValue : null;

                            $nota->cpfCnpjIntermediario = ($intermediario->getElementsByTagName('Cnpj')->length > 0) ?
                                $intermediario->getElementsByTagName('Cnpj')->item(0)->nodeValue : null;

                            $nota->inscricaoMunicipalIntermediario = ($intermediario->getElementsByTagName('InscricaoMunicipal')->length > 0) ?
                                $intermediario->getElementsByTagName('InscricaoMunicipal')->item(0)->nodeValue : null;

                            $nota->razaoSocialIntermediario = ($intermediario->getElementsByTagName('RazaoSocial')->length > 0) ?
                                $intermediario->getElementsByTagName('RazaoSocial')->item(0)->nodeValue : null;

                        }


                        $orgaoGerador = ($infNfse->getElementsByTagName('OrgaoGerador')->length > 0) ?
                            $infNfse->getElementsByTagName('OrgaoGerador')->item(0) : null;

                        if(! empty($orgaoGerador)){

                            $nota->codigoMunicipioOrgaoGerador = ($orgaoGerador->getElementsByTagName('CodigoMunicipio')->length > 0) ?
                                $orgaoGerador->getElementsByTagName('CodigoMunicipio')->item(0)->nodeValue : null;

                            $nota->ufMunicipioOrgaoGerador = ($orgaoGerador->getElementsByTagName('Uf')->length > 0) ?
                                $orgaoGerador->getElementsByTagName('Uf')->item(0)->nodeValue : null;

                        }


                        $construcao = ($infNfse->getElementsByTagName('ConstrucaoCivil')->length > 0) ?
                            $infNfse->getElementsByTagName('ConstrucaoCivil')->item(0) : null;

                        if(! empty($construcao)){

                            $nota->codigoObra = ($construcao->getElementsByTagName('CodigoObra')->length > 0) ?
                                $construcao->getElementsByTagName('CodigoObra')->item(0)->nodeValue : null;

                            $nota->artObra = ($construcao->getElementsByTagName('Art')->length > 0) ?
                                $construcao->getElementsByTagName('Art')->item(0)->nodeValue : null;

                        }

                    } // end infNfse


                    $nfseCancelamento = ($nfse->getElementsByTagName('NfseCancelamento')->length > 0) ?
                        $nfse->getElementsByTagName('NfseCancelamento')->item(0) : null;

                    if(! empty($nfseCancelamento)){

                        $nota->cpfCnpjCancelamento = ($nfseCancelamento->getElementsByTagName('Cnpj')->length > 0) ?
                            $nfseCancelamento->getElementsByTagName('Cnpj')->item(0)->nodeValue : null;

                        if(empty($nota->cpfCnpjCancelamento)){
                            $nota->cpfCnpjCancelamento = ($nfseCancelamento->getElementsByTagName('Cpf')->length > 0) ?
                                $nfseCancelamento->getElementsByTagName('Cpf')->item(0)->nodeValue : null;
                        }

                        $nota->codigoMunicipioCancelamento = ($nfseCancelamento->getElementsByTagName('CodigoMunicipio')->length > 0) ?
                            $nfseCancelamento->getElementsByTagName('CodigoMunicipio')->item(0)->nodeValue : null;

                        $nota->numeroNfseCancelamento = ($nfseCancelamento->getElementsByTagName('Numero')->length > 0) ?
                            $nfseCancelamento->getElementsByTagName('Numero')->item(0)->nodeValue : null;

                        $nota->codigoCancelamentoNfse = ($nfseCancelamento->getElementsByTagName('CodigoCancelamento')->length > 0) ?
                            $nfseCancelamento->getElementsByTagName('CodigoCancelamento')->item(0)->nodeValue : null;

                        $nota->dataHoraCancelamento = ($nfseCancelamento->getElementsByTagName('DataHora')->length > 0) ?
                            $nfseCancelamento->getElementsByTagName('DataHora')->item(0)->nodeValue : null;

                    } // end $nfseCancelamento


                    $nfseSubstituicao = ($nfse->getElementsByTagName('NfseSubstituicao')->length > 0) ?
                        $nfse->getElementsByTagName('NfseSubstituicao')->item(0) : null;

                    if(! empty($nfseSubstituicao)){

                        $nota->numeroNfseSubstituidora = ($nfseSubstituicao->getElementsByTagName('NfseSubstituidora')->length > 0) ?
                            $nfseSubstituicao->getElementsByTagName('NfseSubstituidora')->item(0)->nodeValue : null;

                    }

                    if(! empty($nota)){
                        array_push($this->listaNfse, $nota);
                    }
                } // end foreach compNfse

            }


        }catch (\Exception $e){
            return false;
        }

        return true;
    }

}