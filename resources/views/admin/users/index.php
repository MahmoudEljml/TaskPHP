<?php view('admin.layouts.header', ['title' => trans('admin.users')]);

$users = db_paginate("users", "", 10);

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">


    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h2>{{trans('admin.users')}}</h2>

        <a class="btn btn-primary" href="{{ aUrl('users/create')}}">{{trans('admin.create')}}</a>
    </div>


    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{trans("user.name")}}</th>
                    <th scope="col">{{trans("user.email")}}</th>
                    <th scope="col">{{trans("user.password")}}</th>
                    <th scope="col">{{trans("user.mobile")}}</th>
                    <th scope="col">{{trans("user.user_type")}}</th>
                    <th scope="col">{{trans("admin.action")}}</th>

                </tr>
            </thead>
            <tbody>

                <?php while ($user = mysqli_fetch_assoc($users["query"])): ?>
                    <tr>
                        <td>{{ $user['id'] }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ strlen($user['password']) > 20 ? substr($user['password'], 0, 20) . '...' : $user['password']
                            }}</td>
                        <td>{{ $user['mobile'] }}</td>
                        <td>{{ $user['user_type'] }}</td>
                        <td>
                            <a class="color-dark" href="{{aUrl('users/show?id='.$user['id'].'')}}"> <i
                                    class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{aUrl('users/edit?id='.$user['id'].'')}}"> <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            {{delete_record(aUrl('users/delete?id='.$user['id']))}}
                        </td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- pagination -->
        <nav aria-label="Page navigation example">
            {{$users['render']}}
        </nav>

        <button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>

        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Bootstrap</strong>
                    <small>11 mins ago</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Hello, world! This is a toast message.
                </div>
            </div>
        </div>
    </div>
</main>

<?php view('admin.layouts.footer') ?>