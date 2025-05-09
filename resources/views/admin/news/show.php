<?php view('admin.layouts.header', ['title' => trans('admin.news') . ' - ' . trans('admin.show')]);

$categories = db_get("categories", "");

// $new = db_find('news', request('id'));
$new = db_first(
    "news",
    ' 
    JOIN users on news.user_id = users.id 
    Join categories on news.category_id = categories.id where news.id=' . request('id'),
    '
    news.title,
    news.description,
    news.content,
    news.image,
    news.category_id,
    news.user_id,
    news.created_at,
    news.updated_at,
    users.name as user_name,
    categories.name as category_name
    '
);

redirect_if(empty($new), aUrl('news'));

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h2>{{trans('admin.news')}} / {{trans('admin.show')}} #{{$new['title']}}</h2>

        <a class="btn btn-info" href="{{ aUrl('news')}}">{{trans('admin.news')}}</a>
    </div>



    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label from="title"> {{trans('news.title')}} </label>
                {{ $new['title'] }}
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label from="category_id"> {{trans('news.category_id')}} </label>
                {{$new['category_name']}}
                <a href="{{aUrl('categories/edit?id='.$new['category_id'].'')}}"><i
                        class="fa-solid fa-pen-to-square"></i></a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label from="user_id"> {{trans('news.user_id')}} </label>
                {{$new['user_name']}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label from="image"> {{trans('news.image')}} </label>
                <?php if (!empty($new['image'])): ?>
                    {{image(storage_url($new['image'])) }}
                <?php endif; ?>
            </div>
        </div>


        <div class="col-md-12">
            <div class="form-group">
                <label from="description"> {{trans('news.description')}} </label>
                {{ $new['description'] }}
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label from="content"> {{trans('news.content')}} </label>
                <div id="content" class="form-control" style="read-only" />
                {{ $new['content'] }}
            </div>
        </div>
        <script>
            ClassicEditor
                .create(document.querySelector('#content'), {
                    language: '{{ session_has('locale')?session('locale'): "en" }}'
                })
                .catch(er => console.error(er));
        </script>
    </div>




</main>

<?php view('admin.layouts.footer') ?>