<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scraper</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Scraper</h1>
            <div class="d-flex justify-content-end"><small>by Javier Sosa Martín</small></div>
        </div>
    </header>

    <div class="container">
        <div class="d-flex align-items-center justify-content-end">
            <form class="form" method="get" action="index.php">
                <input class="w-100" type="input" name="keywords" placeholder="Search..." required>
                <select name="browser">
                    <option value="google" selected>Google</option>
                    <option value="bing">Bing</option>
                </select>
                <button name="submit" value="search" type="submit">Scraper</button>
                <button name="submit" value="clean" type="submit">Clean Scraper</button>			
            </form>
        </div>
    </div>
    <div class="container divTable">
        <?php 
        // Get session data table
        $scraperHTML::toHtml($_SESSION['hosts']);
        ?>
    </div>
</body>
</html>