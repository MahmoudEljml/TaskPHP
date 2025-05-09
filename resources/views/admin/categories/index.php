<?php view('admin.layouts.header', ['title' => trans('admin.categories')]);

$categories = db_paginate("categories", "", 1);

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">


    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h2>{{trans('admin.categories')}}</h2>

        <a class="btn btn-primary" href="{{ aUrl('categories/create')}}">{{trans('admin.create')}}</a>
    </div>


    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{trans("cat.name")}}</th>
                    <th scope="col">{{trans("cat.icon")}}</th>
                    <th scope="col">{{trans("cat.desc")}}</th>
                    <th scope="col">{{trans("admin.action")}}</th>

                </tr>
            </thead>
            <tbody>

                <?php while ($category = mysqli_fetch_assoc($categories["query"])): ?>
                    <tr>
                        <td>{{ $category['id'] }}</td>
                        <td>{{ $category['name'] }}</td>
                        <!-- <td>{{ $category['icon'] }}</td> -->
                        <td><img src="<?php echo storage_url($category['icon']) ?>" width="25px" height="25px"></td>
                        <td>{{ $category['description'] }}</td>
                        <td>
                            <!-- <i class="fa-solid fa-eye"></i>
                            <i class="fa-solid fa-pen-to-square"></i>
                            <a href="{{aUrl('categories/show?id='.$category['id'].'')}}">{{trans('admin.show')}}</a> -->
                            <a class="color-dark" href="{{aUrl('categories/show?id='.$category['id'].'')}}"> <i
                                    class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{aUrl('categories/edit?id='.$category['id'].'')}}"> <i
                                    class="fa-solid fa-pen-to-square"></i>
                            </a>
                            {{delete_record(aUrl('categories/delete?id='.$category['id']))}}
                        </td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>
    
        <!-- pagination -->
        <nav aria-label="Page navigation example">
            {{$categories['render']}}
        </nav>


    </div>
</main>

<?php view('admin.layouts.footer') ?>