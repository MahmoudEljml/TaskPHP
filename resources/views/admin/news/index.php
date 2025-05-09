<?php view('admin.layouts.header', ['title' => trans('admin.news')]);

$news_list = db_paginate(
    "news",
    " Join categories on news.category_id = categories.id
    JOIN users on news.user_id = users.id ",
    2,
    'asc',
    "
    news.id,
    news.title,
    news.description,
    news.content,
    news.image,
    news.category_id,
    news.user_id,
    news.created_at,
    news.updated_at,
    users.name as user_name,
    categories.name as category_name"
);

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 ">


    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h2>{{trans('admin.news')}}</h2>

        <a class="btn btn-primary" href="{{ aUrl('news/create')}}">
            <i class="fa-solid fa-plus"></i>
            {{trans('admin.create')}}</a>
    </div>


    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{trans("news.title")}}</th>
                    <th scope="col">{{trans("news.user_id")}}</th>
                    <th scope="col">{{trans("news.category_id")}}</th>
                    <th scope="col">{{trans("news.image")}}</th>
                    <th scope="col">{{trans("admin.created_at")}}</th>
                    <th scope="col">{{trans("admin.updated_at")}}</th>
                    <th scope="col">{{trans("admin.action")}}</th>

                </tr>
            </thead>
            <tbody>

                <?php while ($news = mysqli_fetch_assoc($news_list["query"])): ?>
                    <tr>
                        <td>{{ $news['id'] }}</td>
                        <td>{{ $news['title'] }}</td>
                        <td>{{ $news['user_name'] }}</td>
                        <td>
                            {{ $news['category_name'] }}
                            <a href="{{aUrl('categories/edit?id='.$news['category_id'].'')}}"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td><img src="<?php echo storage_url($news['image']) ?>" width="25px" height="25px"></td>
                        <td>{{ $news['created_at'] }}</td>
                        <td>{{ $news['updated_at'] }}</td>
                        <td>
                            <a class="color-dark" href="{{aUrl('news/show?id='.$news['id'].'')}}"> <i
                                    class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{aUrl('news/edit?id='.$news['id'].'')}}"> <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            {{delete_record(aUrl('news/delete?id='.$news['id']))}}
                        </td>
                    </tr>

                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- pagination -->
        <nav aria-label="Page navigation example">
            {{$news_list['render']}}
        </nav>

    </div>
</main>

<?php view('admin.layouts.footer') ?>