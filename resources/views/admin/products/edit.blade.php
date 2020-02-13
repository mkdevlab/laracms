@extends('layouts.admin.master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Product</h1>
      </div>
      <div class="col-sm-6"></div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
	<div class="container-fluid">
		<div class="card card-info">
		  <div class="card-header">
		    <h3 class="card-title">Edit</h3>
		  </div>
		  <!-- /.card-header -->
		  @include('admin.includes.errors')
		  <!-- form start -->

		  <form role="form" method="post" action="{{ route('product.update', ['product'=>$product->id]) }}" enctype="multipart/form-data">
		  	
		  	{{ csrf_field() }}

		  	{{ method_field('PUT') }}
		    
		    <div class="card-body">

		      <div class="form-group">
		        <label for="ProductCode">Product Code</label>
		        <input type="text" class="form-control" id="txtProductCode" name="txtProductCode" placeholder="Product Code" value="{{ $product->product_code }}">
		      </div>
		      	
		      <div class="form-group">
		        <label for="ProductName">Product Name</label>
		        <input type="text" class="form-control" id="txtProductName" name="txtProductName" placeholder="Product Name" value="{{ $product->product_name }}">
		      </div>

		      <div class="form-group">
		        <label for="Category">Category</label>
		        <select class="form-control" id="cmbCategory" name="cmbCategory">
		        	<option value="">Select Category</option>
		        	@foreach($categories as $category)
		        		<option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
		        	@endforeach	
		        </select> 
		      </div>

		      <div class="form-group">
		        <label for="Brand">Brand</label>
		        <input type="text" class="form-control" id="txtProductBrand" name="txtProductBrand" placeholder="Brand" value="{{ $product->product_brand }}">
		      </div>
		   	  
		   	  <div class="form-group">
		        <label for="Model">Model</label>
		        <input type="text" class="form-control" id="txtProductModel" name="txtProductModel" placeholder="Model" value="{{ $product->product_model }}">
		      </div>

		      <div class="form-group">
		        <label for="Colour">Colour</label>
		        <input type="text" class="form-control" id="txtProductColour" name="txtProductColour" placeholder="Colour" value="{{ $product->product_colour }}">
		      </div>

		      <div class="form-group">
		        <label for="Size">Size</label>
		        <input type="text" class="form-control" id="txtProductSize" name="txtProductSize" placeholder="Size" value="{{ $product->product_size }}">
		      </div>

		      <div class="form-group">
		        <label for="Description">Description</label>
		        <textarea class="form-control" id="txtProductDescription" name="txtProductDescription" placeholder="Description">{{ $product->product_description }}</textarea>
		      </div>

		      <div class="form-group">
		        <label for="Price">Price</label>
		        <input type="text" class="form-control" id="txtProductPrice" name="txtProductPrice" placeholder="Price" value="{{ $product->product_price }}">
		      </div>

		      <div class="form-group">
		        <label for="Quantity">Quantity</label>
		        <input type="text" class="form-control" id="txtProductQuantity" name="txtProductQuantity" placeholder="Quantity" value="{{ $product->product_quantity }}">
		      </div>

		      <div class="form-group">
		        <label for="Size">Image</label>
		        <div class="custom-file">
                  <input type="file" class="custom-file-input" id="txtProductImage" name="txtProductImage">
                  <label class="custom-file-label" for="customFile">Choose file</label>
                </div>
		      </div>

		      <div class="form-group">
		        <label for="Remarks">Remarks</label>
		        <textarea class="form-control" id="txtProductRemarks" name="txtProductRemarks" placeholder="Remarks">{{ $product->product_remarks }}</textarea>
		      </div>

		      <div class="form-check">
		        <input type="checkbox" class="form-check-input" id="chkActive" name="chkActive" value="1" {{  $product->is_active == '1' ? 'checked' : '' }}>
		        <label class="form-check-label" for="chkActive">Active</label>
		      </div>

		    </div>
		    <!-- /.card-body -->
		    
		    <div class="card-footer">
		      <button type="submit" class="btn btn-primary">Submit</button>
		      <a href="{{ route('product.index')}}" class="btn btn-secondary">Back</a>
		    </div>
		  </form>

		</div>
	</div>
</section>

@endsection