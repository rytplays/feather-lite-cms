<?php
require_once("../functions/tag-functions.php");
is_admin_ajax();
add_tag
(
    GVPV("tag_slug"),
    GVPV("tag_name")
);
?>