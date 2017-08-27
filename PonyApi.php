<?php

class PonyApi
{
    protected $ch;
    protected $access_token;

    public function __construct($access_token)
    {
        $this->access_token = $access_token;
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
    }

    public function request($method, $params = [])
    {
        if (!isset($params['access_token'])) $params['access_token'] = $this->access_token;
        $url = 'https://api.vk.com/method/'.$method;
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
        $res = curl_exec($this->ch);

        return json_decode($res);
    }
}

