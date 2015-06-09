#Example - Fetch images via Bing Image API using ZF2 (PHP)
Project that allows the user to search images by keyword. The application starts to find pictures located in "./public/data" in a folder with the same name as the given keyword. When it cant find any image or not atleast 20 pieces, then it calls the Bing Image API and fetches some images.  
Requires a API Key from "https://datamarket.azure.com/dataset/bing/search". The api key and the username should be written into "./config/autoload/bing.api.global.php".
