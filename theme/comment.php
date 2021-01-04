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
    
    
    
        <div><div class="text-center p-2" style="border:1px solid #e1e1e1">ದಯವಿಟ್ಟು ನಿಮ್ಮ ಪ್ರಶ್ನೆಗಳನ್ನು ಇಲ್ಲಿ ಕಾಮೆಂಟ್ ಮಾಡಿ. ಯಾರಿಗಾದರೂ ಉತ್ತರ ತಿಳಿದಿದ್ದರೆ ದಯವಿಟ್ಟು ಉತ್ತರಿಸಿ.</div></div>

        <div><div class="text-center p-2" style="border:1px solid #e1e1e1">ಕಾಮೆಂಟ್ ನಿಧಾನವಾಗಿ ಲೋಡ್ ಆಗುತ್ತದೆ. ದಯವಿಟ್ಟು ಸ್ವಲ್ಪ ಸಮಯ ಕಾಯಿರಿ</div></div>
    
    
    <div class="p-3">
        <div id="fb-root"></div>
        <script crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v9.0" nonce="7Z8OmEWc"></script>
        <div class="fb-comments" data-href="<?php echo SITE_URL.$post_slug; ?>" data-width="100%" data-numposts="10" data-mobile="true"></div>
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

