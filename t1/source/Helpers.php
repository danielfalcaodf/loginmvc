<?php


/**
 * @param string|null $param
 * 
 * @return string
 */
function site(string $param = null): string
{
    if ($param and !empty(SITE[$param])) {
        return SITE[$param];
    }
    return SITE['root'];
}
/**
 * @param string $imageUrl
 * 
 * @return string
 */
function routeImage(string $imageUrl): string
{
    return "http://via.placeholder.com/1200x628/0984e3/FFFFFF?text={$imageUrl}";
}
/**
 * @param string $path
 * 
 * @return string
 */
function asset(string $path): string
{
    return SITE['root'] . "/views/assets/{$path}";
}

/**
 * @param string|null $type
 * @param string|null $message
 * 
 * @return string|null
 */
function flash(string $type = null, string $message = null): ?string
{
    if ($type and $message) {
        $_SESSION["flash"] = [
            "type" => $type,
            "messagem" => $message
        ];
        return null;
    }

    if (!empty($_SESSION["flash"]) and $flash =   $_SESSION["flash"]) {
        unset($_SESSION["flash"]);
        return "<div class=\"message {$flash["type"]}\">{$flash["message"]}</div>";
    }
    return null;
}