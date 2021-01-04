<?php include(THEME_DIR.'header.php'); ?>

<main>
    <div class="posts">
<?php
if(count($errors)==0)
{
    foreach($posts as $post)
    {
        echo '<a href="'.SITE_URL.$post["post_slug"].'" class="post"><div class="post-title">'.$post["post_title"].'</div><div class="post-date">'.date(DATE_FORMATE,strtotime($post["post_date"])).'</div></a>';
    }?>

    <div class="paging">
        <div class="btn-group btn-group-sm">
            <a class="btn btn-outline-info <?php if ($page < 2) echo "disabled"; ?>" href="?page=<?php echo $page - 1; ?>">PREV</a>
            <a class="btn btn-outline-info" href="<?php echo SITE_URL; ?>">HOME</a>
            <a class="btn btn-outline-info <?php if ($page >= $total_pages) echo "disabled"; ?>" href="?page=<?php echo $page + 1; ?>">NEXT</a>
        </div>
    </div>

<?php }
else
{
    foreach($errors as $error)
    {
        echo '<div class="alert alert-warning text-center uppercase">'.$error.'</div>';
    }
}
?>
    </div>
</main>

<?php include(THEME_DIR.'footer.php'); ?>