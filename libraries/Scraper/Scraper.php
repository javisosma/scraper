<?php
declare(strict_types=1);

namespace Scraper;

use Scraper\ScraperWebBrowser\ScraperInterfaceWebBrowser;

class Scraper {

    private ScraperInterfaceWebBrowser $scraperWebBrowser;

    public function __construct(ScraperInterfaceWebBrowser $scraperWebBrowser)
    {
        $this->scraperWebBrowser = $scraperWebBrowser;
    }


    public function run() : ScraperInterfaceWebBrowser {

        return $this->scraperWebBrowser->run();

    }

}
?>