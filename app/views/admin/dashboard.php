<!-- <h1>Selamat datang di wikusama.com web manager</h1> -->
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Team Name</th>
        <th>Region</th>
        <th>Generation</th>
        <th>PIC</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Sosmed</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach( $teams as $num =>  $team ): ?>
        <tr>
          <td><?php echo ++$num ?></td>
          <td><?php echo $team->team_name ?></td>
          <td><?php echo $team->region ?></td>
          <td><?php echo $team->generation ?></td>
          <td><?php echo $team->pic ?></td>
          <td><?php echo $team->phone ?></td>
          <td><?php echo $team->email ?></td>
          <td><?php echo $team->sosmed ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
