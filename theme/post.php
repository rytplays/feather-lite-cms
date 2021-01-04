<?php include(THEME_DIR.'header.php'); ?>

<div class="">
<?php
if(count($errors)==0)
{ ?>


    <div class="bg-light">
    <hr class="hr">
        <h1 class="h4 p-3  m-0"><?php echo $post["post_title"];?></h1>
        <hr class="hr">
        <small class="d-block uppercase text-dark px-3 py-2">POSTED ON : <?php echo date('d F Y',strtotime($post["post_date"])); ?></small>
        <hr class="hr">
    </div>
    
    <div class="p-3">
        <?php echo $post["post_content"]; ?>
    </div>
    
    <hr>

    <div class="text-center my-3"><a href="<?php echo SITE_URL.'comment/'.$post_slug; ?>" class="btn btn-primary">LOAD COMMENTS</a></div>

    <hr>

    <div class="paging">
        <div></div>
        <a class="btn btn-outline-info" onclick="window.history.back();">BACK</a>
        <div></div>
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

<?php include(THEME_DIR.'footer.php'); ?>

