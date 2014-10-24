<a href="<?php echo $baseUrl ?>/admin/comment/add" class="btn btn-success btn-lg btn-xs" role="button">Add New Comment</a>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Generation</th>
        <th>Milis</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach( $data as $num =>  $comment ): ?>
        <tr>
          <td><?php echo ++$num ?></td>
          <td><?php echo $comment->name ?></td>
          <td><?php echo $comment->generation ?></td>
          <td><?php echo ( $comment->join ) ? 'Minat join milis' : 'Tidak minat/sudah join milis' ?></td>
          <td>
            <form action="<?php echo $baseUrl ?>/admin/comment/delete/<?php echo $comment->id ?>" onSubmit="return confirmDelete();" method="POST">
              <input type="hidden" name="_METHOD" value="DELETE"/>
              <button type="submit"  class="btn default btn-xs blue">Delete</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    <script>
      function confirmDelete(){
          return confirm("Are you sure delete this data?");
      }
    </script>
  </table>
</div>
