<form role="form"action="<?php echo $baseUrl ?>/admin/comment" method="POST" style="font-family: arial;">
  <div class="form-group">
    <label for="name" style="float:left; color:#FFF;">Name</label>
      <input class="form-control" type="text" name="name" style="font-family: arial;">
  </div>
  <div class="form-group">
    <label for="generation" style="float:left; color:#FFF;">Generation</label>
      <input class="form-control" type="text" name="generation" >
  </div>
  <div class="form-group">
    <label for="email" style="float:left; color:#FFF;">Email</label>
    <input class="form-control" type="text" name="email"  style="font-family: arial;">
  </div>
  <div class="form-group" style="text-align:left; color:#FFF;">
    <label for="email" style="float:left;">Sudah bergabung dalam milis Wikusama?</label>
    <div class="clearfix"></div>
    <div class="radio-inline">
      <input type="radio" value="1" name="milis" checked> Sudah
    </div>
    <div class="radio-inline">
      <input type="radio" value="0" name="milis"> Belum
    </div>
  </div>
  <div class="form-group" style="text-align:left; color:#FFF; display:none" id="milis">
    <label for="email" style="float:left;">Berminat bergabung dalam milis Wikusama?</label>
    <div class="clearfix"></div>
    <div class="radio-inline">
      <input type="radio" value="1" name="join"> Minat
    </div>
    <div class="radio-inline">
      <input type="radio" value="0" name="join" checked> Tidak
    </div>
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