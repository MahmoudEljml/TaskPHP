<?php
// C:\xampp\htdocs\TaskPHP\public\storage\images\img.png

// store_file(request('image'), 'images/img.png');


// validation('email', 'required|email', trans('main.email'));
// validation('mobile', 'required|integer', trans('main.mobile'));



$data = validation([
    'email' => 'required|email',
    'mobile' => 'required|numeric',
    'address' => 'required|string',
], [
    'email' => trans('main.email'),
    'mobile' => trans('main.mobile'),
    'address' => trans('main.address'),
],);

var_dump($data);

