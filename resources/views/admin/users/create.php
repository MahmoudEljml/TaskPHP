<?php view('admin.layouts.header', ['title' => trans('admin.users')]);

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h2>{{trans('admin.users')}} / {{trans('admin.create')}}</h2>

        <a class="btn btn-info" href="{{ aUrl('users')}}">{{trans('admin.users')}}</a>
    </div>


    <?php if (any_errors()): ?>
        <ol>
            @foreach(all_errors() as $error)

            <li><?php echo $error; ?></li>

            @endforeach
        </ol>
    <?php endif; ?>
    @php
    $name = get_error('name');
    $email = get_error('email');
    $password = get_error('password');
    $user_type = get_error('user_type');
    $mobile = get_error('mobile');

    end_errors();
    @endphp


    <form method="post" action="<?php echo aUrl('users/create') ?>" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post" />

        <div class="row">

            <div class="col-md-12">
                <div class="form-group">
                    <label from="name"> {{trans('user.name')}} </label>
                    <input name="name" type="text" placeholder="{{trans('user.name')}} "
                        class="form-control <?php echo !empty($name) ? 'is-invalid' : 'is-valid'; ?>"
                        value="{{ old('name') }}" />
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label from="email"> {{trans('user.email')}} </label>
                    <input name="email" type="text" placeholder="{{trans('user.email')}} "
                        class="form-control <?php echo !empty($email) ? 'is-invalid' : 'is-valid'; ?>"
                        value="{{ old('email') }}" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label from="password"> {{trans('user.password')}} </label>
                    <input name="password" type="password" placeholder="{{trans('user.password')}} "
                        class="form-control <?php echo !empty($password) ? 'is-invalid' : 'is-valid'; ?>"
                        value="{{ old('password') }}" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label from="mobile"> {{trans('user.mobile')}} </label>
                    <input name="mobile" type="mobile" placeholder="{{trans('user.mobile')}} "
                        class="form-control <?php echo !empty($mobile) ? 'is-invalid' : 'is-valid'; ?>"
                        value="{{ old('mobile') }}" />
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="form-group">
                    <label from="user_type"> {{trans('user.user_type')}} </label>
                    <select name="user_type"
                        class="form-control <?php echo !empty($user_type) ? 'is-invalid' : 'is-valid'; ?>">
                        <option value="admin">{{ 'admin' }}</option>
                        <option value="user">{{ 'user' }}</option>
                    </select>
                </div>
            </div>


        </div>

        <input type="submit" class="btn btn-success m-3" value="{{trans('admin.create')}}" />


    </form>

</main>

<?php view('admin.layouts.footer') ?>