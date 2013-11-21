<?php require_once '../Oram/bootloader.php';

/*
 * Routing
 */

if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != '') {
    $url_array = array_filter(explode('/', $_SERVER['REDIRECT_URL']));
} else {
    $url_array = array_filter(explode('/', $_SERVER['REQUEST_URI']));
}
$path_to_public = array_filter(explode('/', PATH_TO_PUBLIC));
$url = array_values(array_diff($url_array, $path_to_public));

$page = !empty($url) && $url[0] != '' ? $url[0] : 'index';

// Logic for the current page
if(!file_exists('views/'. $page .'.php')) {
    $page = 404;
    http_response_code(404);
} else {
    require_once 'views/logic/'. $page .'.php';
}


// Template for the current page
require_once 'static/html/default_header.php';
require_once 'views/'. $page .'.php';
require_once 'static/html/default_footer.php';