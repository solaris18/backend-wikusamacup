<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Team A</th>
        <th>Team B</th>
        <th>Score Team A</th>
        <th>Score Team B</th>
        <th>Date Time Competition</th>
        <th>Region</th>
        <th>Game Category</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach( $schedules as $num =>  $schedule ): ?>
        <tr>
          <td><?php echo ++$num ?></td>
          <td><?php echo $schedule->team1() ?></td>
          <td><?php echo $schedule->team2() ?></td>
          <td><?php echo $schedule->score_team1 ?></td>
          <td><?php echo $schedule->score_team2 ?></td>
          <td><?php echo date("d m y",strtotime($schedule->datetime_competition)).', '.date("H.i",strtotime($schedule->datetime_competition)) ?></td>
          <td><?php echo $schedule->city ?></td>
          <td><?php echo $schedule->category ?></td>
          <td><?php echo ( '1' == $schedule->live ) ? 'Live' : 'Not Live' ?></td>>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
