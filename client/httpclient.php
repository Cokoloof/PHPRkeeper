<?php

namespace Tech\Rkeeper\Client;

class HttpClient implements IClient {
    private string $username;
    private string $password;
    private string $rkeeperAddress;

    public function __construct($username, $password, $rkeeperAddress)
    {
        $this->username = $username;
        $this->password = $password;
        $this->rkeeperAddress = $rkeeperAddress;

    }

    public function sendRequest(string $xmlBody): string
    {
        $crl = curl_init($this->rkeeperAddress);
        curl_setopt($crl, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($crl, CURLOPT_ENCODING, 'UTF-8');
        curl_setopt($crl, CURLOPT_USERPWD, $this->username . ":" . $this->password);
        curl_setopt($crl, CURLOPT_POST, 1);
        curl_setopt($crl, CURLOPT_POSTFIELDS, $xmlBody);
        $data =  curl_exec($crl);
        if(curl_errno($crl)>0)
        {
        	return curl_error($crl);
        }
        curl_close($crl);
        return $data;
    }
}