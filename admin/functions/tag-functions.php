<?php
require_once("../../config.php");
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR."core-functions.php");
function slugify($text) 
{
    if(is_string($text)) 
    {
        $text = preg_replace('/[^A-Za-z0-9-]+/', '-', $text);
        $text = trim($text, '-');
        $text = preg_replace('~-+~', '-', $text);
        if(empty($text))
        {
            exit_with_response("error","tag slug becoming empty after converting it to url");
        }
        else
        {
            return $text;
        }
    }
    else 
    {
        exit_with_response("error","tag slug must be string");
    }
}

function validate_tag_id($tag_id)
{
    if(ctype_digit($tag_id))
    {
        global $pdo;
        try
        {
            $stmt=$pdo->prepare("SELECT `tag_id` FROM `".TAGS_TABLE."` WHERE `tag_id`=? LIMIT 1;");
            $stmt->bindValue(1,$tag_id);
            $stmt->execute();
            $fetch=$stmt->fetch();
            if($fetch===false)
            {
                exit_with_response("error","tag having id = ".$tag_id." not exists");
            }
            else
            {
                return $tag_id;
            }
        }
        catch(PDOException $e)
        {
            exit_with_response("catch",$e->getMessage());
        }
    }
    else
    {
        exit_with_response("error","tag id must be numerical string");
    }
}

function validate_tag_slug($tag_slug,$tag_id=null)
{
    $tag_slug=slugify($tag_slug);
    global $pdo;
    try
    {
        $stmt=$pdo->prepare("SELECT `tag_id` FROM `".TAGS_TABLE."` WHERE `tag_slug`=? LIMIT 1;");
        $stmt->bindValue(1,$tag_slug);
        $stmt->execute();
        $fetch=$stmt->fetch(PDO::FETCH_ASSOC);
        if($fetch===false)
        {
            return $tag_slug;
        }
        else
        {
            if($tag_id==null)
            {
                exit_with_response("error","tag having slug = ".$tag_slug." already exists");
            }
            elseif($tag_id==$fetch["tag_id"])
            {
                return $tag_slug;
            }
            else
            {
                exit_with_response("error","tag having slug = ".$tag_slug." already exists");
            }
        }
    }
    catch(PDOException $e)
    {
        exit_with_response("catch",$e->getMessage());
    }
}

function validate_tag_name($tag_name)
{
    if(is_string($tag_name)) return $tag_name;
    else exit_with_response("error","tag name must be string");
}

function add_tag($tag_slug,$tag_name)
{
    $tag_slug=validate_tag_slug($tag_slug);
    $tag_name=validate_tag_name($tag_name);

    global $pdo;
    try
    {
        $stmt=$pdo->prepare
        (
            "INSERT INTO `".TAGS_TABLE."` VALUES
            (
                NULL,
                :tag_slug,
                :tag_name
            );"
        );
        $stmt->bindValue(":tag_slug",$tag_slug);
        $stmt->bindValue(":tag_name",$tag_name);
        $stmt->execute();
        exit_with_response("success","tag added successfully",array("tag_id"=>$pdo->lastInsertId()));
    }
    catch(PDOException $e)
    {
        exit_with_response("error",$e->getMessage());
    }
}

function update_tag($tag_id,$tag_slug,$tag_name)
{
    $tag_id=validate_tag_id($tag_id);
    $tag_slug=validate_tag_slug($tag_slug,$tag_id);
    $tag_name=validate_tag_name($tag_name);

    global $pdo;
    try
    {
        $stmt=$pdo->prepare
        (
            "UPDATE `".TAGS_TABLE."` SET
            `tag_slug`=:tag_slug,
            `tag_name`=:tag_name
            WHERE tag_id=:tag_id LIMIT 1;"
        );
        $stmt->bindValue(":tag_slug",$tag_slug);
        $stmt->bindValue(":tag_name",$tag_name);
        $stmt->bindValue(":tag_id",$tag_id);
        $stmt->execute();
        $rows_updated=$stmt->rowCount();
        if($rows_updated==1)
        {
            exit_with_response("success","tag having id = ".$tag_id." updated successfully");
        }
        elseif($rows_updated==0)
        {
            exit_with_response("success","tag having id = ".$tag_id." updated successfully,may be no changes made");
        }
        else
        {
            exit_with_response("error",$rows_updated. " rows updated from ".TAGS_TABLE);
        }
    }
    catch(PDOException $e)
    {
        exit_with_response("error",$e->getMessage());
    }
}

function delete_tag($tag_id)
{
    $tag_id=validate_tag_id($tag_id);
    global $pdo;
    try
    {
        $stmt=$pdo->prepare("DELETE FROM `".TAGS_TABLE."` WHERE `tag_id`=? LIMIT 1;");
        $stmt->bindValue(1,$tag_id);
        $stmt->execute();
        $rows_deleted=$stmt->rowCount();
        if($rows_deleted==1)
        {
            exit_with_response("success","tag having id = ".$tag_id." deleted successfully");
        }
        elseif($rows_deleted==0)
        {
            exit_with_response("error","tag having id = ".$tag_id." not exist");
        }
        else
        {
            exit_with_response("error",$rows_deleted. " rows deleted from ".TAGS_TABLE);
        }
    }
    catch(PDOException $e)
    {
        exit_with_response("catch",$e->getMessage());
    }
}


?>