<?php
declare(strict_types=1);

namespace Scraper;

use Exception;

class ScraperRequest
{

    private String $url;
    private String $response = '';
    private bool $isValidURL = false;
    private int $timeSleep;
    private Array $headers = [
        'accept-language: es-ES,es;q=0.9,en;q=0.8', // Same header as a browser in Spain
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36'
    ];

    public function __construct(String $url, int $timeSleep = 5)
    {
        $this->url = $this->_isValidateURL($url);
        $this->timeSleep = $timeSleep;
        
    }

    private function _isValidateUrl($url) : String {

        if(!$this->isValidURL) {
            if(!filter_var($url, FILTER_VALIDATE_URL)){
                throw new Exception("$url is not a valid URL", 1);
            }
            $this->isValidURL = true;
            return $url;
        }
    }
    

    public function sendRequestUrl() : void {
        
        // It takes ($this->timeSleep) seconds for Google not to detect that we are a bot
        sleep($this->timeSleep);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HEADEROPT , $this->headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $this->response = curl_exec($ch);

        curl_close($ch);
        
    }


    public function getResponse() : string {  return $this->response;  }

}
?>