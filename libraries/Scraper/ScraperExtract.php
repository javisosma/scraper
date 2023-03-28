<?php
declare(strict_types=1);

namespace Scraper;

use Scraper\ScraperRequest;
use DOMDocument;
use DOMXPath;

class ScraperExtract {

    private ScraperRequest $scraperRequest;
    private DOMDocument $doc;
    private String $queryXPath;
    private Array $data = [];

    public function __construct(ScraperRequest $scraperRequest, String $queryXPath)
    {
        $this->scraperRequest = $scraperRequest;
        $this->queryXPath = $queryXPath;
    }


    public function extractLinks() : ScraperExtract {

        // Send Request Curl
        $this->scraperRequest->sendRequestUrl();
        
        // Get Response
        if($this->scraperRequest->getResponse() != '') {

            // Transfer response HTML to DOMDocument
            $this->doc 	= new DOMDocument();

            // Disable libxml errors and allow user to fetch error information as neede, example: Tag header invalid in Entity
            libxml_use_internal_errors(true);

            // Load HTML Response
            $this->doc->loadHTML($this->scraperRequest->getResponse());

            // Get Query XPath DOMDocument
            $this->getQueryXPathItemsText();

            // Save Session Data
            $this->saveSessionData();

        }
        return $this;
    }
    

    private function getQueryXPathItemsText() : void {

        $domxpath = new DOMXPath($this->doc);
        $filtered = $domxpath->query("//$this->queryXPath");

        $i = 0;
        while($link = $filtered->item($i++) ){
            $urlArr = parse_url(str_replace('/url?q=' ,'', $link->getAttribute('href')));
            if(isset($urlArr['host'])) $this->insertCountData($urlArr['host']);
        }
     
    }

    private function insertCountData($host) {

        if(isset($this->data[$host])) $this->data[$host] += 1;
        else $this->data[$host] = 1; 

    }

    public function saveSessionData(): void {

        foreach ($this->data as $host => $matchResult) {

            // Insert Count Host
            $_SESSION['hosts'][$host] = isset($_SESSION['hosts'][$host]) ? $_SESSION['hosts'][$host] + $matchResult : $matchResult ;           
        }

    }


    public static function toArray() : Array {
        return $_SESSION['hosts'];
    }

}
?>