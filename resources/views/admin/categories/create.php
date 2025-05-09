<?php view('admin.layouts.header', ['title' => trans('admin.categories')]);

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

        <h2>{{trans('admin.categories')}} / {{trans('admin.create')}}</h2>

        <a class="btn btn-info" href="{{ aUrl('categories')}}">{{trans('admin.categories')}}</a>
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
    $icon = get_error('icon');
    $description = get_error('description');

    end_errors();
    @endphp


    <form method="post" action="<?php echo aUrl('categories/create') ?>" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="post" />

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label from="name"> {{trans('cat.name')}} </label>
                    <input name="name" type="text" placeholder="{{trans('cat.name')}} "
                        class="form-control <?php echo !empty($name) ? 'is-invalid' : 'is-valid'; ?>"
                        value="{{ old('name') }}" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label from="icon"> {{trans('cat.icon')}} </label>
                    <input name="icon" type="file" placeholder="{{trans('cat.icon')}} "
                        class="form-control <?php echo !empty($icon) ? 'is-invalid' : 'is-valid'; ?>" />
                </div>
            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <label from="description"> {{trans('cat.desc')}} </label>
                    <textarea name="description" placeholder="{{trans('cat.desc')}}"
                        class="form-control <?php echo !empty($description) ? 'is-invalid' : 'is-valid'; ?>">{{old('description')}}</textarea>

                </div>
            </div>



        </div>

        <input type="submit" class="btn btn-success m-3" value="{{trans('admin.create')}}" />


    </form>

</main>

<?php view('admin.layouts.footer') ?>