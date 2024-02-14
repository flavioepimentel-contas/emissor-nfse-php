<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 25/01/2021
 * Time: 13:32
 */

namespace EmissorNfse\Providers\Webiss\V1_00\Response;


use EmissorNfse\Response;

class CancelarNfseResponse extends Response
{
    public $numeroNfseCancelada = null;
    public $cnpjPrestador = null;
    public $inscricaoMunicipalPrestador = null;
    public $codigoMunicipioGerador = null;
    public $codigoCancelamento = null;
    public $dataHoraCancelamento = null;

    public function parseXml($xml){

        if (stripos($xml, 'CancelarNfseResposta') === false){
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





            $nfseCancelamento = ($dom->getElementsByTagName('NfseCancelamento')->length > 0) ?
                $dom->getElementsByTagName('NfseCancelamento')->item(0) : null;

            if(! empty($nfseCancelamento)){

                $this->numeroNfseCancelada = ($nfseCancelamento->getElementsByTagName('Numero')->length > 0) ?
                    $nfseCancelamento->getElementsByTagName('Numero')->item(0)->nodeValue : null;

                $this->cnpjPrestador = ($nfseCancelamento->getElementsByTagName('Cnpj')->length > 0) ?
                    $nfseCancelamento->getElementsByTagName('Cnpj')->item(0)->nodeValue : null;

                $this->inscricaoMunicipalPrestador = ($nfseCancelamento->getElementsByTagName('InscricaoMunicipal')->length > 0) ?
                    $nfseCancelamento->getElementsByTagName('InscricaoMunicipal')->item(0)->nodeValue : null;

                $this->codigoMunicipioGerador = ($nfseCancelamento->getElementsByTagName('CodigoMunicipio')->length > 0) ?
                    $nfseCancelamento->getElementsByTagName('CodigoMunicipio')->item(0)->nodeValue : null;

                $this->codigoCancelamento = ($nfseCancelamento->getElementsByTagName('CodigoCancelamento')->length > 0) ?
                    $nfseCancelamento->getElementsByTagName('CodigoCancelamento')->item(0)->nodeValue : null;

                $this->dataHoraCancelamento = ($nfseCancelamento->getElementsByTagName('DataHora')->length > 0) ?
                    $nfseCancelamento->getElementsByTagName('DataHora')->item(0)->nodeValue : null;
            }



        }catch (\Exception $e){
            return false;
        }

        return true;
    }

}