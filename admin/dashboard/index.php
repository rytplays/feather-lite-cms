<?php require_once("core-functions.php");
require_once("../../config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post | Admin Panel</title>
    <?php echo BOOTSTRAP_CSS; echo STYLES; echo ICONS;?>
</head>
<body class="bg-light">
<?php

$error = [];
$posts=[];

if(isset($_GET['page_no']))$page_no=$_GET['page_no']; else $page_no="1";

if(ctype_digit($page_no) and $page_no>0)
{
    $limit=10;
    $offset = ($page_no-1)*$limit;

    $current_url="index.php";

    if(!empty($_GET["search"]))
    {
        $current_url="index.php?search=".$_GET['search'];
        $stmt_total_posts=$pdo->prepare
        (
            "SELECT COUNT(`post_id`)
             FROM `".POSTS_TABLE."` 
             WHERE
            `post_slug` LIKE :query OR
            `post_date` LIKE :query OR
            `post_title` LIKE :query OR
            `post_desc` LIKE :query OR
            `post_content` LIKE :query OR
            `post_meta` LIKE :query;"
        );
        $stmt_total_posts->bindValue(":query","%".$_GET['search']."%");

        $stmt_posts=$pdo->prepare
        (
            "SELECT `post_id`,`post_slug`,`post_date`,`post_status`,`post_title` 
             FROM `".POSTS_TABLE."` 
             WHERE
            `post_slug` LIKE :query OR
            `post_date` LIKE :query OR
            `post_title` LIKE :query OR
            `post_desc` LIKE :query OR
            `post_content` LIKE :query OR
            `post_meta` LIKE :query
             ORDER BY `post_date` DESC
             LIMIT :offset,:limit;"
        );
        $stmt_posts->bindValue(":query","%".$_GET['search']."%");
    }
    else
    {
        $current_url="index.php?";
        $stmt_total_posts=$pdo->prepare("SELECT COUNT(`post_id`) FROM `".POSTS_TABLE."`;");
        $stmt_posts=$stmt=$pdo->prepare
        (
            "SELECT `post_id`,`post_slug`,`post_date`,`post_status`,`post_title` 
             FROM `".POSTS_TABLE."`
             ORDER BY `post_date`DESC
             LIMIT :offset,:limit;"
        );
    }

    $stmt_total_posts->execute();
    $total_posts=$stmt_total_posts->fetch()[0];

    $stmt_posts->bindValue(":offset",$offset,PDO::PARAM_INT);
    $stmt_posts->bindValue(":limit",$limit,PDO::PARAM_INT);
    $stmt_posts->execute();

    $posts=$stmt_posts->fetchAll();

    $total_pages=ceil($total_posts/$limit);
}
else
{
    array_push($error,"page number must be valid number");
}



if (count($error) > 0){
    foreach ($error as $err)
    {
        echo '<div class="alert alert-info" role="alert">' . $err . '</div>';
    }
}
else
{ ?>


    <!-- MODAL -->
    <div style="cursor: pointer" class="modal fade user-select-none"  id="modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div id="modal_title" class="d-flex justify-content-center p-3"></div>
                <div class="p-1 border-top">
                    <div id="modal_msg" class="p-2 text-uppercase" data-toggle="collapse" data-target="#modal_meta" aria-expanded="false"></div>
                    <div id="modal_meta" class="collapse p-2 card card-body"></div>
                </div>
                <div class="modal-footer">
                    <button id="modal_btn_close" type="button" class="btn btn-secondary"></button>
                    <button id="modal_btn_delete" type="button" class="btn btn-danger"></button>
                </div>
            </div>
        </div>
    </div>


    <!-- HEADER -->
    <div style="z-index: 1020;" class="position-sticky top-0 bg-white d-flex p-1 justify-content-between align-items-center shadow-sm mb-2">
        <div class="d-flex align-items-center">
            <?php include("qlinks.php"); ?>
            <div class="px-2"><b><?php echo SITE_TITLE; ?></b></div>
        </div>
        <div class="px-2">
            <a class="btn btn-light border-dark btn-sm" href="page-add-post.php"><b class="ic ic-add"></b></a>
            <a class="btn btn-light border-dark btn-sm" href="page-manage-tags.php"><b class="ic ic-tags"></b></a>
        </div>
    </div>

    <div class="container-fluid py-1">
        <form class="input-group" action="index.php" method="get">
            <input placeholder="Search Posts Here..." required type="text" name="search"  class="form-control form-control-sm">
            <button class="btn btn-primary" type="submit">SEARCH</button>
        </form>
    </div>

    


<!--BODY-->
<div class="container-fluid"><div class="posts" id="posts">
<?php if(count($posts)>0) { foreach($posts as $post) {  $post_id=$post["post_id"]; ?>

    <div class="bg-white post shadow-sm mt-2">
      
        <div style="<?php if($post["post_status"]=="D") echo "color: #999999;"; ?>" id="post_title_<?php echo $post_id; ?>" data-toggle="collapse" data-target="#post_meta_<?php echo $post_id; ?>" >
            <?php echo $post["post_title"]; ?>
        </div>
        <div id="post_meta_<?php echo $post_id; ?>" class="post-meta px-2 py-1 rounded collapse mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-uppercase"><?php echo date("M d, Y h:i a",strtotime($post["post_date"])); ?></div>
                <div class="btn-group">
                    <button onclick="view_post('<?php echo $post['post_slug']; ?>');" class="btn btn-primary ic ic-eye">
                    </button>
                    <button onclick="tag_post(<?php echo $post_id; ?>);" class="btn btn-warning ic ic-tags">
                    </button>
                    <button onclick="edit_post(<?php echo $post_id; ?>);" class="btn btn-info ic ic-edit">
                    </button>
                    <button onclick="delete_post(<?php echo $post_id; ?>);" class="btn btn-danger ic ic-delete">
                    </button>
                </div>
            </div>
        </div>

    </div>

<?php  } } else {  ?>

    <div class="p-3 my-4 text-center"><b class="alert alert-primary" role="alert">NO POSTS FOUND</b></div>;

<?php } ?>
</div></div>



<!--PAGINATION-->
<form class="mt-5" action="index.php">
    <nav>
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link btn" href="<?php echo $current_url."&page_no=1"; ?>"> <span class="badge bg-light text-dark border"> <?php echo 1; ?></span> </a>
            </li>
            <li class="page-item <?php if ($page_no < 2) echo "disabled"; ?>">
                <a class="page-link" href="<?php echo $current_url."&page_no=".$page_no-1; ?>"> PREV </a>
            </li>
            <li class="page-item">
                <input min="1" max="<?php echo $total_pages ?>" type="number" name="page_no" class="form-control">
            </li>
            <li class="page-item <?php if ($page_no >= $total_pages) echo "disabled"; ?>">
                <a class="page-link" href="<?php echo $current_url."&page_no=".$page_no+1; ?>"> NEXT </a>
            </li>
            <li class="page-item">
                <a class="btn page-link" href="<?php echo $current_url."&page_no=".$total_pages; ?>"><span class="badge bg-light text-dark border"> <?php echo $total_pages; ?></span></a>
            </li>
        </ul>
    </nav>
</form>


    
<?php echo BOOTSTRAP_JS; echo JQUERY; echo SCRIPTS; ?>
<script>
reload_on_navigate();
const modal_title = GEBI("modal_title");
const modal_msg = GEBI("modal_msg");
const modal_meta = GEBI("modal_meta");
const modal_btn_close = GEBI("modal_btn_close");
const modal_btn_delete = GEBI("modal_btn_delete");

const modal = new bootstrap.Modal(document.getElementById('modal'), {
    keyboard: false,
    backdrop: 'static',
});
function view_post(slug) {
    location.href = "../../" + slug;
}

function edit_post(id) {
    location.href = "page-update-post.php?post_id=" + id;
}

function tag_post(id) {
    location.href = "page-manage-relations.php?post_id=" + id;
}

function delete_post(id) {
    
    modal_btn_close.disabled = false;
    modal_btn_delete.disabled = false;

    modal_btn_close.innerHTML = "CANCEL";
    modal_btn_delete.innerHTML = "DELETE PERMANENTLY";

    modal_title.innerHTML = "ARE YOU SURE TO DELETE THE POST";
   
    modal_msg.innerHTML = GEBI("post_title_" + id).innerHTML;
    modal_meta.innerHTML = "";

    modal.show();

    modal_btn_close.onclick=function(){modal.hide();id=0;}

    modal_btn_delete.onclick = function() {
        
        modal_btn_close.disabled = true;
        modal_btn_delete.disabled = true;
        modal_title.innerHTML = ic_loader;

        $.ajax({
                type: "POST",
                url: "../ajax/ajax-delete-post.php",
                data: {
                    post_id: id,
                },
            })
            .done(function(response) 
            {
                try {
                    response = JSON.parse(response);

                    if (response.type == "success") modal_title.innerHTML = ic_done;
                    else if (response.type == "error") modal_title.innerHTML = ic_error;
                    else modal_title.innerHTML = ic_catch;

                    modal_msg.innerHTML = response.msg;

                    $.each(response.meta, function(key, metavalue) {
                        modal_meta.innerHTML += metavalue + "<br>";
                    });

                } catch (err) {
                    modal_title.innerHTML = ic_catch;
                    modal_msg.innerHTML = response;
                    modal_meta.innerHTML = err;
                }
            })
            .fail(function(jqXHR, textStatus, exception) {
                modal_title.innerHTML = ic_catch;
                modal_msg.innerHTML = textStatus;
                modal_meta.innerHTML = exception;
                modal_btn_close.disabled = false;
            })
            .always(function() {
                modal_btn_delete.disabled = false;
                modal_btn_delete.innerHTML = "REFRESH PAGE";
                modal_btn_delete.onclick = function() {location.reload();id=0;}
            });
    }

}

</script>

<?php } ?>
        
</body>
</html>