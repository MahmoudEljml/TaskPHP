<?php view('layout.header', ['title' => trans('main.home')]); ?>

<h1>home file</h1>


<a href="<?php echo url('storage/user/1/test.png'); ?>">Download file</a>

<?php if (all_errors() > 0): ?>
    <ol>
        @foreach(all_errors() as $error)

        <li><?php echo $error; ?></li>

        @endforeach
    </ol>
<?php endif; ?>

@php
$email_valid = get_error('email');
$mobile_valid = get_error('mobile');
$address_valid = get_error('address');
end_errors();
@endphp

{{ 'welcome to php project' }}

<form method="post" action="<?php echo url('upload'); ?>" enctype="multipart/form-data" class='needs-validation'>


    <label>Email: </label>
    <input type="text" class="form-control <?php echo !empty($email_valid) ? 'is-invalid' : 'is-valid'; ?>" name="email"
        value="<?php echo old('email'); ?>">
    <div class="<?php echo !empty($email_valid) ? 'invalid-feedback' : 'valid-feedback'; ?>">
        <?php echo $email_valid ?>
    </div>

    <label>Mobile: </label>
    <input type="text" class="form-control <?php echo !empty($mobile_valid) ? 'is-invalid' : 'is-valid'; ?>"
        name="mobile" value="<?php echo old('mobile'); ?>">
    <div class="<?php echo !empty($mobile_valid) ? 'invalid-feedback' : 'valid-feedback'; ?>">
        <?php echo $mobile_valid ?>
    </div>


    <input type="text" class="form-control <?php echo !empty($address_valid) ? 'is-invalid' : 'is-valid'; ?>"
        name="address" value="<?php echo old('address'); ?>">
    <div class="<?php echo !empty($address_valid) ? 'invalid-feedback' : 'valid-feedback'; ?>">
        <?php echo $address_valid ?>
    </div>



    <input type="hidden" name="_method" value="post">
    <input type="submit" value="Send" class="btn btn-success">
</form>



<?php view('layout.footer'); ?>