<?php
use Scraper\Scraper;
use Scraper\ScraperHTML;
use Scraper\ScraperWebBrowser\ScraperGoogle;
use Scraper\ScraperWebBrowser\ScraperBing;

// Start Session 
session_start();


// Autoload Libraries
spl_autoload_register(function ($clase) {
    $clase = str_replace('\\', DIRECTORY_SEPARATOR, $clase);
    include  __DIR__ . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . $clase . '.php';
});

// When Submit Form
if(isset($_GET['submit']) && $_GET['keywords'] != '') {

    // Submit Clean 
    if($_GET['submit'] == 'clean') $_SESSION['hosts'] = [];

    // Url encode to query string
    $keywords = urlencode($_GET['keywords']);
    $numItemsPerPage = 30;

    switch ($_GET['browser']) {
        case 'bing':
            $scraper = new Scraper(new ScraperBing($keywords, $numItemsPerPage));
            break;
        default: // Default is Google
            $scraper = new Scraper(new ScraperGoogle($keywords, $numItemsPerPage));
            break;
    }

    $scraper->run();

} 
else $_SESSION['hosts'] = [];

// ScraperHTML
$scraperHTML = ScraperHTML::class;

// Template
include_once 'template.php';
?>