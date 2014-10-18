<form role="form"action="<?php echo $baseUrl ?>/admin/comment" method="POST">
  <div class="form-group">
    <label for="name" style="float:left; color:#FFF;">Name</label>
      <input class="form-control" type="text" name="name" style="font-family: arial;">
  </div>
  <div class="form-group">
    <label for="generation" style="float:left; color:#FFF;">Generation</label>
      <input class="form-control" type="text" name="generation"  style="font-family: arial;">
  </div>
  <div class="form-group">
    <label for="exampleInputFile" style="float:left; color:#FFF;">Cuap Cuap</label>
    <textarea class="form-control" name="comment" rows="5" style="font-family: arial;"></textarea>
  </div>
  <div class="col-md-4 pull-right">
    <div class="row">
      <button type="submit" class="btn-sponsor text-small col-md-4 ">Send</button>
    </div>
  </div>
</form>
