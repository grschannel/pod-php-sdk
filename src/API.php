<?php

namespace PasargadIranianBank\Pod;

use PasargadIranianBank\Pod\Entities\UserProfile;
use PasargadIranianBank\Pod\Factories\UserProfileFactory;
use PasargadIranianBank\Pod\Exceptions\PodException;
use PasargadIranianBank\Pod\Exceptions\HttpException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class Api
{
    /**
     * @var string
     */
    private $token;
    /**
     * @var string
     */
    private $tokenIssuer;
    /**
     * @var string
     */
    private $ott;
    /**
     * @var string
     */
    private $serviceUrl;

    /**
     * @var Client
     */
    private $httpClient;

    private $responseBody;

    public function __construct($token, $tokenIssuer, $serviceUrl, $httpClient = null)
    {
        $this->token = $token;
        $this->tokenIssuer = $tokenIssuer;
        $this->serviceUrl = $serviceUrl;
        $this->httpClient = $httpClient;
        //https://bus.fanapium.com/srv/core/nzh
    }
    /**
     * @return mixed
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }
    /**
     * @return UserProfile
     */
    public function getUserProfile(){
        $result = $this->_call('GET', 'getUserProfile');
        return $result->result ? (new UserProfileFactory())->make($result->result) : null;
    }

    /**
     * @param $firstName
     * @param $lastName
     * @param $toolCode
     * @param $toolId
     * @param $guildCode
     * @param $amount
     * @return string referenceNumber
     */
    public function requestSettlementByTool($firstName, $lastName, $toolCode, $toolId, $guildCode, $amount){
        $ott = $this->ottRequest();

        $result = $this->_call('GET', 'requestSettlementByTool', [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'toolCode' => $toolCode,
            'toolId' => $toolId,
            'guildCode' => $guildCode,
            'amount' => $amount
        ], $ott);
        return $result->result ?? null;
    }
    /**
     * @param null $size
     * @param null $firstId
     * @param null $lastId
     * @param null $billNumber
     * @param null $isPayed
     * @param null $query
     * @return string referenceNumber
     */
    public function getInvoiceList($size = null, $firstId = null, $lastId = null, $billNumber = null, $isPayed = null, $query = null){
        $ott = $this->ottRequest();
        $result = $this->_call('GET', 'ott', [
            'size' => $size,
            'firstId' => $firstId,
            'lastId' => $lastId,
            'billNumber' => $billNumber,
            'isPayed' => $isPayed,
            'query' => $query
        ], $ott);
        return $result->referenceNumber ?? null;
    }
    /**
     * @param $invoiceId
     * @return string referenceNumber
     */
    public function payinvoice($invoiceId, $redirectUri = null, $callUri = null){
        $ott = $this->ottRequest();
        $result = $this->_call('GET', 'payInvoiceByCredit', [
            'invoiceId' => $invoiceId,
            'redirectUri' => $redirectUri,
            'callUri' => $callUri
        ], $ott);
        return $result->referenceNumber ?? null;
    }

    /**
     * @param $invoiceId
     * @return string referenceNumber
     */
    public function payInvoiceByCredit($invoiceId){
        $ott = $this->ottRequest();
        $result = $this->_call('GET', 'ott', [ 'invoiceId' => $invoiceId], $ott);
        return $result->referenceNumber ?? null;
    }

    /**
     * @param $guildCode
     * @param $amount
     * @param $customerAmount
     * @param $uniqueId
     * @return null
     */
    public function transferFromOwnAccounts($guildCode, $amount, $customerAmount, $uniqueId){
        $ott = $this->ottRequest();
        $result = $this->_call('GET', 'biz/transferFromOwnAccounts', [ 'invoiceId' => $invoiceId], $ott);
        return $result->referenceNumber ?? null;
    }

    /**
     * you can transfer credit from your wallet to another user's wallet (destination wallet must registered in your contact)
     * @param int $contactId - destination wallet
     * @param int $amount
     * @param int $wallet
     * @param $currencyCode
     * @param $description
     * @param $uniqueId
     * @return null
     */
    public function transferToContact($contactId, $amount, $wallet, $currencyCode, $description, $uniqueId ){
        $result = $this->_call('GET', 'transferToContact', [
            'contactId' => $contactId,
            'amount' => $amount,
            'wallet' => $wallet,
            'currencyCode' => $currencyCode,
            'description' => $description,
            'uniqueId' => $uniqueId
        ]);
        return $result->referenceNumber ?? null;
    }

    private function ottRequest(){
        $result = $this->_call('GET', 'ott', null);
        return $result->ott ?? null;
    }

    /**
     * @param string $methodName
     * @return string
     */
    private function getPath($methodName){
        return $this->serviceUrl . '/' . $methodName;
    }
    private function getHttpClient(){
        return $this->httpClient ? $this->httpClient : new Client();
    }
    /**
     * @param $requestType
     * @param $methodName
     * @param null $data
     * @return object
     */
    private function _call($requestType, $methodName, $data = null, $ott = null)
    {
        $url = $this->getPath($methodName);
        $headers = array(
            '_token_' => $this->token,
            '_token_issuer_' => $this->tokenIssuer,
            '_ott_' => $ott
        );

        try {
            if(!empty($data)){
                if( $requestType == 'GET' ){
                    $url .= '?' . http_build_query($data);
                    $data = null;
                }else{
                    $data = json_encode($data);
                }
            }

            $client = $this->getHttpClient();

            $request = new Request($requestType, $url, $headers, $data);
            $response = $client->send($request);
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if($response){
                $content = (string) $response->getBody();
                if( !empty( $content ) ){
                    $result = json_decode( $content );
                    throw new PodException($result->message, $result->errorCode);
                }
                throw new HttpException($e->getMessage(), $response->getStatusCode());
            }
            throw new HttpException($e->getMessage(), $e->getCode());
        }

        $code = $response->getStatusCode();
        $this->responseBody = json_decode($response->getBody());
        if (is_null($this->responseBody)) {
            throw new PodException("Response is empty!", $code);
        } else {
            if ($this->responseBody->hasError) {
                throw new PodException($this->responseBody->message, $this->responseBody->errorCode, $this->responseBody);
            }
            return $this->responseBody;
        }
    }
}
