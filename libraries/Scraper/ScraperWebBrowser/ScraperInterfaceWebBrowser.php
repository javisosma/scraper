<?php
declare(strict_types=1);

namespace Scraper\ScraperWebBrowser;

interface ScraperInterfaceWebBrowser
{

    public function run() : ScraperInterfaceWebBrowser;
    public function getQueryUrl();
    public function getQueryXPath();

}
?>