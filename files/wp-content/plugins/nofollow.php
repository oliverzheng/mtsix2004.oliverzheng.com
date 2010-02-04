<?php
/*
Plugin Name: NoFollow
Plugin URI: http://alex.halavais.net/projects/nofollow
Description: NoFollow implements Google's requested indicator for comment links, resulting in reduced spam effectiveness.
Version: 0.02a
Author: Alex Halavais
Author URI: http://alex.halavais.net/
*/ 

add_filter('comment_url', 'TrickyNoFollow', 25);
add_filter('comment_text', 'NoFollow', 25);


function NoFollow($content) {
    // add in nofollow to the links
    $content = preg_replace('(href)', "rel='nofollow' href", $content);
    return $content;
}

function TrickyNoFollow($content) {
    // sneak a little html into the URL
    $content .= "' rel='nofollow";
    return $content;
}


?>
