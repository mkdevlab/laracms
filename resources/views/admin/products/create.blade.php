@extends('layouts.admin.master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Products</h1>
      </div>
      <div class="col-sm-6"></div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
	<div class="container-fluid">
		<div class="card card-info">
		  <div class="card-header">
		    <h3 class="card-title">Add</h3>
		  </div>
		  <!-- /.card-header -->
		  @include('admin.includes.errors')
		  <!-- form start -->
		  <form role="form" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
		  	
		  	{{ csrf_field() }}
		    
		    <div class="card-body">

		      <div class="form-group">
		        <label for="ProductCode">Product Code</label>
		        <input type="text" class="form-control" id="txtProductCode" name="txtProductCode" placeholder="Product Code" value="{{ old('txtProductCode') }}">
		      </div>
		      	
		      <div class="form-group">
		        <label for="ProductName">Product Name</label>
		        <input type="text" class="form-control" id="txtProductName" name="txtProductName" placeholder="Product Name" value="{{ old('txtProductName') }}">
		      </div>

		      <div class="form-group">
		        <label for="Category">Category</label>
		        <select class="form-control" id="cmbCategory" name="cmbCategory">
		        	<option value="">Select Category</option>
		        	@foreach($categories as $category)
		        		
      				<option value="{{ $category->id }}" {{(old('cmbCategory')==$category->id)? 'selected':''}}>{{ $category->category_name }}</option>
						
		        	@endforeach	
		        </select>
		      </div>

		      <div class="form-group">
		        <label for="Brand">Brand</label>
		        <input type="text" class="form-control" id="txtProductBrand" name="txtProductBrand" placeholder="Brand" value="{{ old('txtProductBrand') }}">
		      </div>
		   	  
		   	  <div class="form-group">
		        <label for="Model">Model</label>
		        <input type="text" class="form-control" id="txtProductModel" name="txtProductModel" placeholder="Model" value="{{ old('txtProductModel') }}">
		      </div>

		      <div class="form-group">
		        <label for="Colour">Colour</label>
		        <input type="text" class="form-control" id="txtProductColour" name="txtProductColour" placeholder="Colour" value="{{ old('txtProductColour') }}">
		      </div>

		      <div class="form-group">
		        <label for="Size">Size</label>
		        <input type="text" class="form-control" id="txtProductSize" name="txtProductSize" placeholder="Size" value="{{ old('txtProductSize') }}">
		      </div>

		      <div class="form-group">
		        <label for="Description">Description</label>
		        <textarea class="form-control" id="txtProductDescription" name="txtProductDescription" placeholder="Description">{{ old('txtProductDescription') }}</textarea>
		      </div>

		      <div class="form-group">
		        <label for="Price">Price</label>
		        <input type="text" class="form-control" id="txtProductPrice" name="txtProductPrice" placeholder="Price" value="{{ old('txtProductPrice') }}">
		      </div>

		      <div class="form-group">
		        <label for="Quantity">Quantity</label>
		        <input type="text" class="form-control" id="txtProductQuantity" name="txtProductQuantity" placeholder="Quantity" value="{{ old('txtProductQuantity') }}">
		      </div>

		      <div class="form-group">
		        <label for="Size">Image</label>
		        <input type="file" class="form-control" id="txtProductImage" name="txtProductImage">
		      </div>

		      <div class="form-group">
		        <label for="Remarks">Remarks</label>
		        <textarea class="form-control" id="txtProductRemarks" name="txtProductRemarks" placeholder="Remarks">{{ old('txtProductRemarks') }}</textarea>
		      </div>

		      <div class="form-check">
		        <input type="checkbox" class="form-check-input" id="chkActive" name="chkActive" value="1" checked>
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