<form class="form-horizontal" role="form" action="<?php echo $baseUrl ?>/admin/schedule/<?php echo $schedule->id ?>" method="POST">
  <input type="hidden" value="true" name="live">
  <input type="hidden" name="_METHOD" value="PUT"/>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $schedule->team1() ?></label>
    <div class="col-sm-10">
      <input type="number" name="score_team1" value="<?php echo $schedule->score_team1 ?>" >
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $schedule->team2() ?></label>
    <div class="col-sm-10">
      <input type="number" name="score_team2" value="<?php echo $schedule->score_team2 ?>" >
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Save</button>
    </div>
  </div>
</form>
