<form class="form-horizontal" role="form" action="<?php echo $baseUrl ?>/admin/schedule" method="POST">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Team A</label>
    <div class="col-sm-10">
      <select class="form-control" name="team1_id">
        <?php foreach( $teams as $team ): ?>
          <option value="<?php echo $team->id ?>"><?php echo $team->team_name ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Team B</label>
    <div class="col-sm-10">
      <select class="form-control" name="team2_id">
        <?php foreach( $teams as $team ): ?>
          <option value="<?php echo $team->id ?>"><?php echo $team->team_name ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Date</label>
    <div class="col-sm-10">
      <input type="datetime" name="datetime_competition" >
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Regional</label>
    <div class="col-sm-10">
      <select class="form-control" name="city">
        <option value"jakarta">Jakarta</option>
        <option value"malang">Malang</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Game Category</label>
    <div class="col-sm-10">
      <select class="form-control" name="city">
        <option value"futsal">Futsal</option>
        <option value"basket">Basket</option>
        <option value"badminton">Badminton</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">Save</button>
    </div>
  </div>
</form>
