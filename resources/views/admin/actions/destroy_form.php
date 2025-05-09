<?php if (!empty($url)):

    $rand = md5(rand(1, 1000)); // Generate a random string to use as an ID for the modal
    ?>
    <!-- Button trigger modal -->
    <a href="#" data-bs-toggle="modal" data-bs-target="#deleteForm{{$rand}}">
        <i class="fa fa-trash"></i>
    </a>

    <!-- Modal -->
    <div class="modal fade" data-bs-dismiss="modal" id="deleteForm{{$rand}}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="showImageLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" action="{{$url}}"
                        action="<?php echo aUrl('categories/delete?id=' . $category['id']) ?>">
                        <input type="hidden" name="_method" value="post" />
                        <div class="alert alert-danger">
                            <h5>{{trans('admin.delete_message')}}</h5>
                        </div>
                        <button type="button" class="btn btn-success" data-bs-dismiss="model">
                            {{ trans('admin.cancel') }}
                        </button>

                        <button type="submit" class="btn btn-danger">
                            {{ trans('admin.delete') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>