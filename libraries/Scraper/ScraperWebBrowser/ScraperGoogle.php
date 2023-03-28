<?php 
declare(strict_types=1);

namespace Scraper\ScraperWebBrowser;

use Scraper\ScraperWebBrowser\ScraperInterfaceWebBrowser;
use Scraper\ScraperExtract;
use Scraper\ScraperRequest;


class ScraperGoogle implements ScraperInterfaceWebBrowser {


    private String $keywords;
    private String $url = 'https://www.google.es/search?';
    private String $tagName = 'div';
    private String $attrName = 'class';
    private String $attrValue = 'egMi0 kCrYT';
    private int $numItemsPerPage;

    private ScraperExtract $scraperExtract;

    public function __construct(String $keywords, int $numItemsPerPage = 10)
    {
        $this->keywords = $keywords;
        $this->numItemsPerPage = $numItemsPerPage;        
    }

    public function run() : ScraperInterfaceWebBrowser{
         
        $this->scraperExtract = new ScraperExtract(new ScraperRequest($this->getQueryUrl()), $this->getQueryXPath());
        $this->scraperExtract->extractLinks();
        return $this;

    }


    public function getQueryUrl() : String {

        return $this->url . "q=$this->keywords&num=$this->numItemsPerPage";
    }


    public function getQueryXPath() : String
    {
        return "//$this->tagName" . '[@' . $this->attrName . "='$this->attrValue']/a";
        
    }


    
}
?>