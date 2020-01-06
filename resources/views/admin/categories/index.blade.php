@extends('layouts.admin.master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-10">
        <h1>Categories</h1>
      </div>
      <div class="col-sm-1">
    	<ol class="breadcrumb float-sm-right">
    		<a href="{{ route('category.create')}}" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i></a>
		</ol>
      </div>
      <div class="col-sm-1"></div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="row">
        <div class="col-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Listing</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>	
                <tr>
                  <th style="text-align: center;">SNo.</th>
                  <th>Category Name</th>
                  <th>Active</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                
                @foreach($categories as $category)	
                <tr>
                  <td style="text-align: center;">{{ $SNo++ }}.</td>
                  <td>{{ $category->category_name }}</td>
                  <td>{{ $category->is_active }}</td>
                  <td>
                  	<a href="{{ route('category.edit',['category'=>$category->id])}}" class="btn btn-default btn-sm"><i class="fas fa-edit"></i></a>
                  </td>	
                  <td>
                  	<form role="form" class="delete" method="post" action="{{ route('category.destroy',['category'=>$category->id]) }}">
                  	{{ csrf_field() }}	
                  	{{ method_field('DELETE') }}	
                  	<button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></button><!-- data-toggle="modal" data-target="#modal-default"-->
                  	</form>
                  </td>
                </tr>
                @endforeach
 
                </tbody>
                <tfoot>
                <tr>
                  <th style="text-align: center;">SNo.</th>
                  <th>Category Name</th>
                  <th>Active</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Default Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection

@section('script')
<script>
  $(function () {
    $("#example1").DataTable();
  /*$('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": fals
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });*/
  });
</script>
<script>
$(".delete").on("submit", function(){
    return confirm("Are you sure to delete... ?");
});
</script>
@endsection