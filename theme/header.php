<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $site_title; ?></title>
    <meta name="description" content="<?php echo $site_desc; ?>">	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/enouplus/rytplays-site-assets@latest/rytplays.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/enouplus/icon-pack/career-icons/icons.min.css">
</head>
<body class="lscroll no-select">
    <div class="abar">
        <div class="tbar">
            <div class="tbar-content">
                <div id="toggler" onclick="show_nbar();" class="ic ic-menu"></div>
                <a class="tbar-brand" href="<?php echo SITE_URL;?>"><b><?php echo SITE_TITLE; ?></b></a>
            </div>
            <div class="tbar-content">
                <a href="https://rytplays.com" class="ic ic-home"></a>
            </div>
        </div>
    </div>

    <div id="overlay" class="overlay" onclick="hide_nbar();"></div>
    <nav id="nbar" class="nbar lscroll">
        <div class="nbar-links">
            <a href="<?php echo SITE_URL;?>">ಮುಖಪುಟ</a>
        </div>
    </nav>
    
   
    
    <div class="label"><?php echo $label; ?></div>