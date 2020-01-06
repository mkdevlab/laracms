@extends('layouts.admin.master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Category</h1>
      </div>
      <div class="col-sm-6"></div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
	<div class="container-fluid">
		<div class="card card-info">
		  <div class="card-header">
		    <h3 class="card-title">Edit </h3>
		  </div>
		  <!-- /.card-header -->
		  @include('admin.includes.errors')
		  <!-- form start -->
		  <form role="form" method="post" action="{{ route('category.update', ['category'=>$category->id]) }}">
		  	{{ csrf_field() }}
		  	{{ method_field('PUT') }}
		    <div class="card-body">
		      <div class="form-group">
		        <label for="txtCategoryName">Category Name</label>
		        <input type="text" class="form-control" id="txtCategoryName" name="txtCategoryName" placeholder="Category Name" value="{{ $category->category_name }}">
		      </div>
		   
		      <div class="form-check">
		        <input type="checkbox" class="form-check-input" id="chkActive" name="chkActive" value="1" 
		       	{{  $category->is_active == '1' ? 'checked' : '' }}>
		        <label class="form-check-label" for="chkActive">Active</label>
		      </div>
		    </div>
		    <!-- /.card-body -->
		    <div class="card-footer">
		      <button type="submit" class="btn btn-primary">Submit</button>
		      <a href="{{ route('category.index')}}" class="btn btn-secondary">Back</a>
		    </div>
		  </form>
		</div>
	</div>
</section>

@endsection