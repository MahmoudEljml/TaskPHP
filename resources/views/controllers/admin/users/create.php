<?php

$data =  validation([
    'name'=>'required|string',
    'email'=>'required|email|unique:users,email',
    'password'=>'required|string',
    'mobile'=>'required|unique:users,mobile',
    'user_type'=>'required|string|in:admin,user',
] ,[
    'name'=>trans('user.name'),
    'email'=>trans('user.email'),
    'password'=>trans('user.password'),
    'mobile'=>trans('user.mobile'),
    'user_type'=>trans('user.user_type'),
]);

$data['password'] = encrypt($data['password']);

db_create('users', $data);
session_flash('old');
redirect(aUrl('users'));

