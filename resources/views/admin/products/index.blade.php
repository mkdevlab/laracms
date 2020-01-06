@extends('layouts.admin.master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-10">
        <h1>Products</h1>
      </div>
      <div class="col-sm-1">
    	<ol class="breadcrumb float-sm-right">
    		<a href="{{ route('product.create')}}" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i></a>
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
              <table id="tblDatatable" class="table table-bordered table-striped">
                <thead>	
                <tr>
                  <th>SNo.</th>
                  <th>Image</th>
                  <th>Product Code</th>
                  <th>Product Name</th>
                  <th>Category</th>
                  <th>Price</th>
                  <th>Active</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                
                @foreach($products as $product)	
                <tr>
                  <td style="text-align: center;">{{ $SNo++ }}.</td>
                  <td><img src="{{ asset($product->product_image) }}" title="{{ asset($product->product_image) }}" class="img-thumbnail" /></td>
                  <td>{{ $product->product_code }}</td>
                  <td>{{ $product->product_name }}</td>
                  <td>{{ $product->category_name }}</td>
                  <td>{{ $product->product_price }}</td>
                  <td>{{ $product->is_active }}</td>
                  <td>
                  	<a href="{{ route('product.edit',['product'=>$product->id])}}" class="btn btn-default btn-sm"><i class="fas fa-edit"></i></a>
                  </td>	
                  <td>
                  	<form role="form" class="delete" method="post" action="{{ route('product.destroy',['product'=>$product->id]) }}">
                  	{{ csrf_field() }}	
                  	{{ method_field('DELETE') }}	
                  	<button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></button>
                  	</form>
                  </td>
                </tr>
                @endforeach
 
                </tbody>
                <tfoot>
                <tr>
                  <th>SNo.</th>
                  <th>Image</th>
                  <th>Product Code</th>
                  <th>Product Name</th>
                  <th>Category</th>
                  <th>Price</th>
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

@endsection

@section('script')
<script>
  $(function () {
    $("#tblDatatable").DataTable();
  });
</script>
<script>
$(".delete").on("submit", function(){
    return confirm("Are you sure to delete... ?");
});
</script>
@endsection