<?php

$data = validation([
    'email' => 'required|email',
    'password' => 'required',
    'remember_me' => '',

], [
    'email' => trans('admin.email'),
    'password' => trans('admin.password'),
]);



$login = db_first('users', "where email like '%" . $data['email'] . "%'");



if (empty($login) || !empty($login) && (!bcrypt_check($data['password'], $login['password']) || $login['user_type'] != 'admin')) {
    session('error_login', trans('admin.login_failed'));
    redirect(ADMIN . '/login');
} else {
    session('admin', json_encode($login));
    redirect(ADMIN);
}


