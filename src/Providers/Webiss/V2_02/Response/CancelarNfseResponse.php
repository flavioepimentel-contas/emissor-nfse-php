<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 23/07/2020
 * Time: 17:53
 */

namespace EmissorNfse\Providers\Webiss\V2_02\Response;


use EmissorNfse\Response;

class CancelarNfseResponse extends Response
{

    public $numeroNfse = null;
    public $cnpjPrestador = null;
    public $inscricaoMunicipalPrestador = null;
    public $codigoMunicipioGerador = null;
    public $codigoCancelamento = null;
    public $dataCancelamento = null;


    public function parseXml($xml){
        if (stripos($xml, 'CancelarNfseResposta') === false){
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

            $confirmacao = ($dom->getElementsByTagName('Confirmacao')->length > 0) ?
                $dom->getElementsByTagName('Confirmacao')->item(0) : null;

            if(! empty($confirmacao)){
                //Pega o Número do lote
                $this->numeroNfse = ($confirmacao->getElementsByTagName('Numero')->length > 0) ?
                    $confirmacao->getElementsByTagName('Numero')->item(0)->nodeValue : null;

                $this->cnpjPrestador = ($confirmacao->getElementsByTagName('Cnpj')->length > 0) ?
                    $confirmacao->getElementsByTagName('Cnpj')->item(0)->nodeValue : null;

                $this->inscricaoMunicipalPrestador = ($confirmacao->getElementsByTagName('InscricaoMunicipal')->length > 0) ?
                    $confirmacao->getElementsByTagName('InscricaoMunicipal')->item(0)->nodeValue : null;

                $this->codigoMunicipioGerador = ($confirmacao->getElementsByTagName('CodigoMunicipio')->length > 0) ?
                    $confirmacao->getElementsByTagName('CodigoMunicipio')->item(0)->nodeValue : null;

                $this->codigoCancelamento = ($confirmacao->getElementsByTagName('CodigoCancelamento')->length > 0) ?
                    $confirmacao->getElementsByTagName('CodigoCancelamento')->item(0)->nodeValue : null;

                $this->dataCancelamento = ($confirmacao->getElementsByTagName('DataHora')->length > 0) ?
                    $confirmacao->getElementsByTagName('DataHora')->item(0)->nodeValue : null;


            }


        }catch (\Exception $e){
            return false;
        }

        return true;
    }

}