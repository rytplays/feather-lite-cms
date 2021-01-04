<?php
include("config.php");

$site_title="";
$site_desc="#1 Karnataka Govt Job Listing Website";
$label="";

$uri = explode('/',parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH));
$count=count($uri);
if($count==3 and empty($uri[2]))
{
    #HOME PAGE
    include("init/tag.php");
    include("theme/tag.php");
}
else if($count==4 and $uri[2]=="tag" and !empty($uri[3]))
{
    #TAG INDEX PAGE
    $tag_slug=$uri[3];
    include("init/tag.php");
    include("theme/tag.php");
}
else if($count==3 and !empty($uri[2]))
{
    #POST
    $post_slug=$uri[2];
    include("init/post.php");
    include("theme/post.php");
}
else if($count==4 and $uri[2]=="comment" and !empty($uri[3]))
{
    #FACEBOOK COMMENT PAGE
    $post_slug=$uri[3];
    include("init/comment.php");
    include("theme/comment.php");
}
else
{
    include("theme/error.php");
}
?>