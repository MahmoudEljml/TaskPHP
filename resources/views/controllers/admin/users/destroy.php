<?php
$user = db_find('users', request('id'));
redirect_if(empty($user), aUrl('users'));

db_delete('users', request('id'));
redirect(aUrl('users'));