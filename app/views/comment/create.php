<form class="form-horizontal" role="form" action="<?php echo $baseUrl ?>/admin/comment" method="POST">
  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input type="text" name="name" >
    </div>
  </div>
  <div class="form-group">
    <label for="generation" class="col-sm-2 control-label">Generation</label>
    <div class="col-sm-10">
      <input type="text" name="generation" >
    </div>
  </div>
  <div class="form-group">
    <label for="comment" class="col-sm-2 control-label">Comment</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="comment" rows="3"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Save</button>
    </div>
  </div>
</form>
