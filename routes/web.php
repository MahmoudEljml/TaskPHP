<?php
include base_path('routes/admin.php');

// echo $_SERVER['REQUEST_URI'];


route_get("/", 'home');
route_get("lang", 'controllers.set_language');

route_post("upload", 'controllers.upload');

// route_get("articles");
// route_post("user1111");
// route_post("user_created",'layout/create_user');


// var_dump($routes);


// echo segment();