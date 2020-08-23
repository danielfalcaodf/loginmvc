<?php
// site config
define("SITE", [

    "nome" => "Auth em MVC com php",
    "desc" => "Aprenda a construir uma aplicação de autenticação em MCV com php do  Jeito certo neste cursos gratuido em youtube.com/upinside",
    "domain" => "localauth.com",
    "locale" => "pt_BR",
    "root" => "http://localhost/loginmvc/t1"

]);
// site minify
if ($_SERVER['SERVER_NAME'] == "localhost") {
    require __DIR__ . "/Minify.php";
}

// database criado
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "auth",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

// social 

define("SOCIAL", [

    "facebook_page" => "robsonvleite2",
    "facebook_author" => "robsonvleite",
    "facebook_appId" => "2193729837289",
    "twitter_creator" => "@robsonvleite",
    "twitter_site" => "@robsonvleite",


]);

// mail config

define("MAIL", [

    "facebook_page" => "",
    "facebook_author" => "",
    "facebook_appId" => "",


]);
// face config

define("FACEBOOK_LOGIN", []);
// google config

define("GOOGLE_LOGIN", []);