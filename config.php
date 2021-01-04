<?php

#site timezone
date_default_timezone_set("Asia/Kolkata");
define('DATE_FORMATE', 'M d, Y');

#admin password
define('ADMIN_PASSWORD', '112600R=r');

#site information
define('SITE_TITLE', 'RYTPLAYS JOBS');
define('SITE_URL','http://mysite.test/jobs/');

#file paths
define('DS', DIRECTORY_SEPARATOR);
define('ROOT_PATH',dirname(__FILE__).DS);
define('THEME_DIR',ROOT_PATH.'theme'.DS);

#database table names
define('POSTS_TABLE', 'job_posts');
define('TAGS_TABLE', 'job_tags');
define('POST_TAG_TABLE', 'job_post_tag');


define('DB_HOST', 'localhost');
define('DB_NAME', 'rytplays_career');
define('DB_USERNAME', 'rytplays_admin');
define('DB_PASSWORD', '112600R=r');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATION', 'utf8mb4_unicode_ci');


#connection information
try
{
    $pdo=new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,DB_USERNAME,DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    exit($e->getMessage());
}

?>