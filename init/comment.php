<?php
$errors=[];
try
{
    $stmt1=$pdo->prepare("SELECT * FROM `".POSTS_TABLE."` WHERE `post_slug` = ? AND `post_status`='P' LIMIT 1;");
    $stmt1->bindValue(1,$post_slug);
    $stmt1->execute();
    $post=$stmt1->fetch();
    if($post!==false)
    {
        $site_title=$post["post_title"]." | ".SITE_TITLE;
        $site_desc=$post["post_desc"];
    }
    else
    {
        array_push($errors,"post not exist");
    }
}
catch(PDOException $e)
{
    array_push($errors,$e->getMessage());
}
?>