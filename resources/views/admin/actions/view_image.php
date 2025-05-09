<?php if (!empty($image)):

    $rand = md5(rand(1, 1000)); // Generate a random string to use as an ID for the modal
    ?>
    <!-- Button trigger modal -->
    <img src="{{$image}}" style="cursor: pointer;" width="50px" height="50px" data-bs-toggle="modal"
        data-bs-target="#showImage{{$rand}}" />
    <!-- Modal -->
    <div class="modal fade" data-bs-dismiss="modal" id="showImage{{$rand}}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="showImageLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <img class="d-flex m-auto" src="{{$image}}" width="60%" height="60%" />
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>