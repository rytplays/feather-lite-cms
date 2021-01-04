<div>
  <button class="btn ic ic-menu r0" type="button" data-toggle="dropdown" aria-expanded="false"></button>
  <ul class="dropdown-menu dropdown-menu-dark r0">
    <li><a class="dropdown-item px-3 py-2" href="index.php"> <b class="ic ic-home mr-2"></b> Home </a></li>
    <li><a class="dropdown-item px-3 py-2" href="page-add-post.php"><b class="ic ic-add mr-2"></b> New Post</a></li>
    <li><a class="dropdown-item px-3 py-2" href="page-manage-tags.php"><b class="ic ic-tags mr-2"></b> Tags </a></li>
    <hr class="m-0">
    <li><a class="dropdown-item px-3 py-2" href="<?php echo SITE_URL;?>"> <b class="ic ic-eye mr-2"></b> Website </a></li>
    <li><a class="dropdown-item px-3 py-2" onclick="window.history.back();"><b class="ic ic-arrow-left mr-2"></b> Back </a></li>
    <li><a href="<?php echo "../logout.php"; ?>" class="dropdown-item px-3 py-2"><b class="ic ic-power mr-2"></b> Logout </a></li>
  </ul>
</div>