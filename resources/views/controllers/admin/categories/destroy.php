<?php
$category = db_find('categories', request('id'));
redirect_if(empty($category), aUrl('categories'));

if (!empty($category['icon'])) {
    delete_file($category['icon']);
}
db_delete('categories', request('id'));
redirect(aUrl('categories'));