<?php

class Requests_Transport_cURL_Extended extends Requests_Transport_cURL
{
    public function __construct()
    {
        parent::__construct();
    }

    public function &get_subrequest_handle($url, $headers, $data, $options)
    {
        $parsed = parse_url($url);
        if ($parsed['host'] == 'meluchat.com') {
            parent::get_subrequest_handle($url, $headers, $data, $options);
            curl_setopt($this->handle, CURLOPT_REFERER, 'https://' . $_SERVER['HTTP_HOST'] . '/');
            return $this->handle;
        } else {
            return parent::get_subrequest_handle($url, $headers, $data, $options);
        }

    }

    public function setup_handle($url, $headers, $data, $options)
    {
        $parsed = parse_url($url);
        if ($parsed['host'] == 'meluchat.com') {
            parent::setup_handle($url, $headers, $data, $options);
            curl_setopt($this->handle, CURLOPT_REFERER, 'https://' . $_SERVER['HTTP_HOST'] . '/');
        } else {
            parent::setup_handle($url, $headers, $data, $options);
        }
    }
}