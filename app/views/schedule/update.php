<form class="form-horizontal" role="form" action="<?php echo $baseUrl ?>/admin/schedule/<?php echo $schedule->id ?>" method="POST">
  <input type="hidden" value="false" name="islive">
  <input type="hidden" name="_METHOD" value="PUT"/>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Team A</label>
    <div class="col-sm-10">
      <input type="datetime" name="team1_id" value="<?php echo $schedule->team1_id ?>" >
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Team B</label>
    <div class="col-sm-10">
      <input type="datetime" name="team2_id" value="<?php echo $schedule->team2_id ?>" >
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Score Team A</label>
    <div class="col-sm-10">
      <input type="number" name="score_team1" value="<?php echo $schedule->score_team1 ?>" >
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Score Team B</label>
    <div class="col-sm-10">
      <input type="number" name="score_team2" value="<?php echo $schedule->score_team2 ?>" >
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Date</label>
    <div class="col-sm-10">
      <input type="datetime" name="datetime_competition" id="datetimepicker" data-date-format="YYYY-MM-DD HH:mm" value="<?php echo date("Y-m-d",strtotime($schedule->datetime_competition)).', '.date("H.i",strtotime($schedule->datetime_competition)) ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Regional</label>
    <div class="col-sm-10">
      <select class="form-control" name="city">
        <option value="jakarta" <?php echo ( strtolower($schedule->city) == 'jakarta' ) ? 'selected' : '' ?> >Jakarta</option>
        <option value="malang" <?php echo ( strtolower($schedule->city) == 'malang' ) ? 'selected' : '' ?>>Malang</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Game Category</label>
    <div class="col-sm-10">
      <select class="form-control" name="category">
        <option value="futsal"  <?php echo ( strtolower($schedule->category) == 'futsal' ) ? 'selected' : '' ?>>Futsal</option>
        <option value="basket" <?php echo ( strtolower($schedule->category) == 'basket' ) ? 'selected' : '' ?>>Basket</option>
        <option value="badminton" <?php echo ( strtolower($schedule->category) == 'badminton' ) ? 'selected' : '' ?>>Badminton</option>
        <option value="voly" <?php echo ( strtolower($schedule->category) == 'voly' ) ? 'selected' : '' ?>>Voly</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">It's Game Live Now?</label>
    <div class="col-sm-10">
      <select class="form-control" name="live">
        <option value="1"  <?php echo ( $schedule->live == '1' ) ? 'selected' : '' ?>>Live</option>
        <option value="0" <?php echo ( $schedule->live == '0' ) ? 'selected' : '' ?>>No Live</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Save</button>
    </div>
  </div>
</form>
