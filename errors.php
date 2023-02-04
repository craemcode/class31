<?php  if (count($errors) > 0) : ?>
  <div class="alert alert-danger">
  	<?php foreach ($errors as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" data-bs-target="#my-alert" aria-label="Close"></button>
  </div>
<?php  endif ?>