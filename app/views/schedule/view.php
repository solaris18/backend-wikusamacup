<a href="<?php echo $baseUrl ?>/admin/schedule/add" class="btn btn-success btn-lg btn-xs" role="button">Add New Schedule</a>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Team A</th>
        <th>Team B</th>
        <th>Score A</th>
        <th>Score B</th>
        <th>Date</th>
        <th>Region</th>
        <th>Game Category</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach( $schedules as $num =>  $schedule ): ?>
        <tr>
          <td><?php echo ++$num ?></td>
          <td><?php echo $schedule->team1_id ?></td>
          <td><?php echo $schedule->team2_id ?></td>
          <td><?php echo $schedule->score_team1 ?></td>
          <td><?php echo $schedule->score_team2 ?></td>
          <td><?php echo date("d m y",strtotime($schedule->datetime_competition)).', '.date("H.i",strtotime($schedule->datetime_competition)) ?></td>
          <td><?php echo $schedule->city ?></td>
          <td><?php echo $schedule->category ?></td>
          <td><?php echo ( '1' == $schedule->live ) ? 'Live' : 'Not Live' ?></td>
          <td>
            <a href="<?php echo $baseUrl ?>/admin/schedule/livescore/<?php echo $schedule->id ?>" target="_blank">Update Score</a> |
            <a href="<?php echo $baseUrl ?>/admin/schedule/edit/<?php echo $schedule->id ?>">Edit</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
