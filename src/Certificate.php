<?php
/**
 * Created by PhpStorm.
 * User: Moisés
 * Date: 25/02/2020
 * Time: 15:55
 */

namespace EmissorNfse;


class Certificate
{
    private $priKey = null;
    private $pubKey = null;
    private $intermediate = null;
    private $password = null;

    public function __construct($pfxPath, $password)
    {
        try{
            $pem = file_get_contents($pfxPath);

            $certs = [];
            if (! openssl_pkcs12_read($pem, $certs, $password)) {
                throw new \Exception('Falha ao abrir certificado. Verifique a senha e outras questoes');
            }

            $this->intermediate = '';

            if (!empty($certs['extracerts'])) {
                foreach ($certs['extracerts'] as $value) {
                    $this->intermediate .= $value;
                }
            }

            $this->pubKey = $certs['cert'];
            $this->priKey = $certs['pkey'];

        }catch (\Exception $e){
            echo 'Falha ao abrir certificado. Verifique a senha e outras questoes: '. $e->getMessage() . '<br />';
        }
    }

    /**
     * @return null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param null $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }


    /**
     * @return mixed|null
     */
    public function getPriKey()
    {
        return $this->priKey;
    }

    /**
     * @return mixed|null
     */
    public function getPubKey()
    {
        return $this->pubKey;
    }

    /**
     * @return string|null
     */
    public function getIntermediate()
    {
        return $this->intermediate;
    }

    public function getPubKeyClean(){

        return $this->clean($this->pubKey);
    }

    public function getPriKeyClean(){

        return $this->clean($this->pubKey);
    }


    private function clean($str){
        $str = preg_replace('/-----.*[\n]?/', '',$str);
        return preg_replace('/[\n\r]/', '', $str);
    }




}