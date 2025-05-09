<?php

view('admin.layouts.header', ['title' => trans('admin.users') . ' - ' . trans('admin.show')]);

$user = db_find('users', request('id'));

redirect_if(empty($user), aUrl('users'));

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h2>{{trans('admin.users')}} / {{trans('admin.show')}} #{{$user['name']}}</h2>

        <a class="btn btn-info" href="{{ aUrl('users')}}">{{trans('admin.users')}}</a>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label from="name"> {{trans('user.name')}} </label>
                {{$user['name']}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label from="email"> {{trans('user.email')}} </label>
                {{$user['email']}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label from="password"> {{trans('user.password')}} </label>
                {{$user['password']}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label from="mobile"> {{trans('user.mobile')}} </label>
                {{$user['mobile']}}
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label from="user_type"> {{trans('user.user_type')}} </label>
                {{$user['user_type']}}
            </div>
        </div>

    </div>

</main>

<?php view('admin.layouts.footer') ?>