<?php
require_once __DIR__ . '/../includes/app.php';


// db_create("users", ["email" => "mahmoud31112@gmail.com", "password" => "22222222", "mobile" => "1124454"]);
// db_update("users", ["email" => "mahmoud3@gmail.com", "password" => "22222222", "mobile" => "1124454"], 1);
// db_delete("users", 1);
// db_find("users", 21);
// db_first('users', "where phone like '%2%'");
// db_get("users", "where phone like '%5%'");
// db_paginate("users", "", 6);

// set session
// session('data', "my data is stored in session");
// get session
// session("data");
// destroy session by key
// session_forget('data');
// destroy all session
// session_delete_all();

// file management in storage folder
// symlink(base_path('storage/files'), public_path('storage'));
// store_file(request('image'), 'user/1/test.png');             upload file
// storage('user/1/test.png');                                  show or download file
// delete_file(base_path('storage/files/user/1/test.png'));     delete file
// remove_folder('storage/images');                             remove dir



route_init();
if (!empty($GLOBALS['query'])) {
    mysqli_free_result($GLOBALS['query']);
}

mysqli_close($connection);
// ob_end_clean();
ob_end_flush();
