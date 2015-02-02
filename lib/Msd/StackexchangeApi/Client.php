<?php

class Msd_StackexchangeApi_Client {
    /* AppData */
    private $client_id;
    private $client_secret;
    private $scope;
    private $oauth_url;
    private $accesstoken_url;
    private $redirect_uri;
    private $state;

    //@TODO: refactor construct, also in Msd_StackexchangeApi_Model_Api
    public function __construct($client_id, $client_secret, $scope, $redirect_uri, $state='', $oauth_url, $accesstoken_url) {
        $this->client_id        = $client_id;
        $this->client_secret    = $client_secret;
        $this->scope            = $scope;
        $this->redirect_uri     = $redirect_uri;
        $this->state            = $state;
        $this->oauth_url        = $oauth_url;
        $this->accesstoken_url  = $accesstoken_url;
    }

    public function getOauthUrl() {
        $query = array('client_id'      => $this->client_id,
                        'scope'         => $this->scope,
                        'redirect_uri'  => $this->redirect_uri,
                        'state'         => $this->state
        );

        $querystring = http_build_query($query);
        return $this->oauth_url . "?" . $querystring;
    }

    public function getAccessToken($code) {
        $ch = curl_init($this->accesstoken_url);

        $query = array('client_id'      => $this->client_id,
                        'client_secret' => $this->client_secret,
                        'code'          => $code,
                        'redirect_uri'  => $this->redirect_uri,
        );
        $querystring = http_build_query($query);
        curl_setopt($ch, CURLOPT_HTTPHEADER,  array('Content-type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $querystring);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER , 1);  // RETURN THE CONTENTS OF THE CALL
        $response = curl_exec($ch);

        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        switch($httpcode) {
            case 200: parse_str($response, $data);
                return $data['access_token'];
                break;
            case 400: throw new Exception("Error during authorization");
                break;
            default: throw new Exception("An error occured.");
                break;
        }
    }

}