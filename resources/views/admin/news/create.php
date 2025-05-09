<?php view('admin.layouts.header', ['title' => trans('admin.news')]);

$categories = db_get("categories", "");

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h2>{{trans('admin.news')}} / {{trans('admin.create')}}</h2>

        <a class="btn btn-info" href="{{ aUrl('news')}}">{{trans('admin.news')}}</a>
    </div>


    <?php if (any_errors()): ?>
        <ol>
            @foreach(all_errors() as $error)

            <li><?php echo $error; ?></li>

            @endforeach
        </ol>
    <?php endif; ?>
    @php
    $title = get_error('title');
    $image = get_error('image');
    $description = get_error('description');
    $category_id = get_error('category_id');
    $content = get_error('content');
    end_errors();
    @endphp


    <form method="post" action="<?php echo aUrl('news/create') ?>" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post" />

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label from="title"> {{trans('news.title')}} </label>
                    <input name="title" id="title" type="text" placeholder="{{trans('news.title')}} "
                        class="form-control <?php echo !empty($title) ? 'is-invalid' : 'is-valid'; ?>"
                        value="{{ old('title') }}" />
                </div>
            </div>



            <div class="col-md-6">
                <div class="form-group">
                    <label from="category_id"> {{trans('news.category_id')}} </label>
                    <select name="category_id"
                        class="form-control {{!empty($category_id) ? 'is-invalid' : 'is-valid'}}">
                        <option disabled selected> {{trans('admin.choose')}} </option>
                        <?php while ($category = mysqli_fetch_assoc($categories['query'])): ?>
                            <option value="{{ $category['id']; }}"> {{ $category['name'] }} </option>
                        <?php endwhile; ?>
                    </select>

                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label from="image"> {{trans('news.image')}} </label>
                    <input name="image" id='image' type="file" placeholder="{{trans('news.image')}} "
                        class="form-control <?php echo !empty($image) ? 'is-invalid' : 'is-valid'; ?>" />
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <label from="description"> {{trans('news.description')}} </label>
                    <textarea name="description" placeholder="{{trans('news.description')}}"
                        class="form-control <?php echo !empty($description) ? 'is-invalid' : 'is-valid'; ?>">{{old('description')}}</textarea>

                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label from="content"> {{trans('news.content')}} </label>
                    <textarea name="content" id="content" placeholder="{{trans('news.content')}}"
                        class="form-control <?php echo !empty($content) ? 'is-invalid' : 'is-valid'; ?>">{{old('content')}}</textarea>
                </div>
            </div>

        </div>

        <input type="submit" class="btn btn-success m-3" value="{{trans('admin.create')}}" />

        <script>
            ClassicEditor
                .create(document.querySelector('#content'), {
                    language: '{{ session_has('locale')?session('locale'): "en" }}'
                })
                .catch(er => console.error(er));
        </script>

    </form>

</main>

<?php view('admin.layouts.footer') ?>