<?php

$data = validation([
    'name' => 'required|string',
    'icon' => 'required|image',
    'description' => 'required',

], [
    'name' => trans('cat.name'),
    'icon' => trans('cat.icon'),
    'description' => trans('cat.desc'),
]);



if (!empty($data['icon']['tmp_name'])) {
    $category = db_find('categories', request('id'));
    redirect_if(empty($category), aUrl('categories'));
    delete_file($category['icon']);
    $data['icon'] = store_file($data['icon'], 'categories/' . file_ext($data['icon'])['hash']);
} else {
    unset($data['icon']);
}


db_update('categories', $data, request('id'));

// session_flash('old');
redirect(aUrl('categories/edit?id=' . request('id')));
