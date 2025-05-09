<?php
$new = db_find('news', request('id'));
redirect_if(empty($new), aUrl('news'));

if (!empty($new['image'])) {
    delete_file($new['image']);
}
db_delete('news', request('id'));
redirect(aUrl('news'));