<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 25/01/2021
 * Time: 13:19
 */

namespace EmissorNfse\Providers\Webiss\V1_00\Response;


use EmissorNfse\Response;

class ConsultarSituacaoLoteRpsResponse extends Response
{

    public $numeroLote = null;
    public $situacao = null;

    public function parseXml($xml){

        if (stripos($xml, 'ConsultarSituacaoLoteRpsResposta') === false){
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


            $this->numeroLote = ($dom->getElementsByTagName('NumeroLote')->length > 0) ?
                $dom->getElementsByTagName('NumeroLote')->item(0)->nodeValue : null;

            $this->situacao = ($dom->getElementsByTagName('Situacao')->length > 0) ?
                $dom->getElementsByTagName('Situacao')->item(0)->nodeValue : null;

        }catch (\Exception $e){
            return false;
        }

        return true;
    }
}