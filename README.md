#Example - Fetch images via Bing Image API using ZF2 (PHP)
Project that allows the user to search images by keyword. The application starts to find pictures located in "./public/data" in a folder with the same name as the given keyword. When it cant find any image or not atleast 20 pieces, then it calls the Bing Image API and fetches some images.  
Requires a API Key from "https://datamarket.azure.com/dataset/bing/search". The api key and the username should be written into "./config/autoload/bing.api.global.php".  
The main code can be found in "./module/Application/src/Application".
##Installing the project
__Requires PHP 5.5 or newer__ and "mbstring" extension
*  Load all dependencies with ```php composer.phar install```
*  Run the project on a webserver or run it with PHP built-in server ```php -S 127.0.0.1:80 -t public public/index.php```
*  Configure "./config/autoload/bing.api.global.php" to have valid credentials
*  Run PHPUnit with ```./vendor/bin/phpunit```
*  For acceptance test "curl" is required and a working project
 * Acceptance test are run with ```./vendor/bin/codecept run```
