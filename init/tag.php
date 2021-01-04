<?php
$errors=[];

$tag_slug = $tag_slug ?? 'latest';

$offset=0;
$limit=10;

$page = $_GET["page"] ?? '1';

if(ctype_digit($page) and $page>0)
{
    try
    {
        $stmt1=$pdo->prepare("SELECT `tag_id`,`tag_name` FROM `".TAGS_TABLE."` WHERE `tag_slug` = :tag_slug LIMIT 1;");
        $stmt1->bindValue(":tag_slug",$tag_slug);
        $stmt1->execute();
        $tag=$stmt1->fetch(PDO::FETCH_ASSOC);
        if($tag!==false)
        {
            $tag_id=$tag["tag_id"];
            $label=$tag["tag_name"];
            $site_desc=$site_title=SITE_TITLE." | ".$label;

            $stmt2=$pdo->prepare
            (
                "SELECT COUNT(`".POSTS_TABLE."`.`post_id`)
                FROM `".POSTS_TABLE."`
                JOIN `".POST_TAG_TABLE."` ON `".POSTS_TABLE."`.`post_id` = `".POST_TAG_TABLE."`.`post_id`
                JOIN `".TAGS_TABLE."` ON `".POST_TAG_TABLE."`.`tag_id` = `".TAGS_TABLE."`.`tag_id`
                WHERE `".TAGS_TABLE."`.tag_id = ? AND `".POSTS_TABLE."`.post_status='P';"
            );
            $stmt2->bindValue(1,$tag_id);
            $stmt2->execute();
            $total_posts=$stmt2->fetch()[0];

            $total_pages=ceil($total_posts/$limit);

            $offset = ($page-1)*$limit;
            $stmt3=$pdo->prepare
            (
                "SELECT `".POSTS_TABLE."`.`post_title`,`post_slug`,`post_date`
                FROM `".POSTS_TABLE."`
                JOIN `".POST_TAG_TABLE."` ON `".POSTS_TABLE."`.`post_id` = `".POST_TAG_TABLE."`.`post_id`
                JOIN `".TAGS_TABLE."` ON `".POST_TAG_TABLE."`.`tag_id` = `".TAGS_TABLE."`.`tag_id`
                WHERE `".TAGS_TABLE."`.tag_id = ? AND `".POSTS_TABLE."`.`post_status`='P'
                ORDER BY `".POSTS_TABLE."`.`post_date` DESC
                LIMIT ?,?;"
            );
            $stmt3->bindValue(1,$tag_id);
            $stmt3->bindValue(2,$offset,PDO::PARAM_INT);
            $stmt3->bindValue(3,$limit,PDO::PARAM_INT);
            $stmt3->execute();
            $posts=$stmt3->fetchAll(PDO::FETCH_ASSOC);
            if(count($posts)==0)
            {
                array_push($errors,"no posts found in this page");
            }
            
        }
        else{array_push($errors,"tag not exist");}
    }
    catch(PDOException $e){array_push($errors,$e->getMessage());}
}
else{array_push($errors,"page number is invalid");}
?>
