@extends('layouts.admin.master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Invoices</h1>
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
		  	<form role="form" method="post" action="{{ route('invoice.store') }}">
		  	{{ csrf_field() }}
		    <div class="card-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="InvoiceNo">Invoice No.</label>
							<input type="text" class="form-control" id="txtInvoiceNo" name="txtInvoiceNo" placeholder="Invoice No." value="{{ old('txtInvoiceNo') }}">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="InvoiceDate">Invoice Date</label>
							<!--<div class="input-group">
								<div class="input-group-prepend">
								  <span class="input-group-text">
								    <i class="far fa-calendar-alt"></i>
								  </span>
								</div>-->
								<input type="text" class="form-control float-right datepicker" id="txtInvoiceDate" name="txtInvoiceDate" value="{{ old('txtInvoiceDate') }}">
							<!--</div>-->
						</div>
					</div>	
				</div>	
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="CustomerName">Customer Name</label>
							<input type="text" class="form-control" id="txtCustomerName" name="txtCustomerName" placeholder="Customer Name" value="{{ old('txtCustomerName') }}">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="MobileNo">Mobile No.</label>
							<input type="text" class="form-control" id="txtMobileNo" name="txtMobileNo" placeholder="Mobile Number" value="{{ old('txtMobileNo') }}">
						</div>
					</div>
				</div>	
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="Address">Address</label>
							<textarea class="form-control" id="txtAddress" name="txtAddress" placeholder="Address">{{ old('txtAddress') }}</textarea>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="City">City</label>
							<input type="text" class="form-control" id="txtCity" name="txtCity" placeholder="City" value="{{ old('txtCity') }}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label for="Remarks">Remarks</label>
							<textarea class="form-control" id="txtRemarks" name="txtRemarks" placeholder="Remarks">{{ old('txtRemarks') }}</textarea>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<label for="Remarks">Payment Mode</label>
							<select name="cmbPaymentMode" id="cmbPaymentMode" class="form-control myselect">
					        <option value="">Select Payment Mode</option>
					        <option value="Cash" selected>Cash</option>
					        <option value="Card">Card</option>
					        <option value="Paytm">Paytm</option>
					        <option value="Credit">Credit</option>
					        <option value="Finance">Finance</option>
							</select>
						</div>
					</div>
				</div>	
				
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
				      		<div class="form-check">
				        	<input type="checkbox" class="form-check-input" id="chkPaid" name="chkPaid" value="1" checked>
				        	<label class="form-check-label" for="chkActive">Paid</label>
				      	</div>
				    </div>
				</div>    
		    </div>

		    <div class="row mb-2">
		      <div class="col-sm-10"></div>
		      <div class="col-sm-1"></div>
		      <div class="col-sm-1" onclick="add_row();">
	      		<a href="#" class="btn btn-info btn-sm">
	      			<i class="fas fa-plus-square"></i>
	      		</a>
		      </div>
		    </div>

		    <div class="row">
				<div class="col-sm-12">
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
		                  <thead>                  
		                    <tr>
		                      <th style="width: 10px">SNo.</th>
		                      <th>Product Code</th>
		                      <th>Description</th>
		                      <th>Quantity</th>
		                      <th>Price</th>
		                      <th>Discount</th>
		                      <th>Amount</th>
		                      <th style="text-align:center">#</th>
		                    </tr>
		                  </thead>
		                  <tbody id="items_listing">
		                    <tr>
		                      <td class="sno">1.</td>
		                      <td class="td_product_code">
		                      	<select name="txtProductId[]" class="form-control myselect selected_item" style="width: 100%;" onchange="get_product_details(this);">
		                      	<option value="">Select Code</option>
		                      	@foreach($products as $product)
		                      	<option value="{{ $product->id}}">{{ $product->product_code}}</option>
		                      	@endforeach
		                      	</select>
		                      	<input type="hidden" class="form-control txt_product_code" name="txtProductCode[]" size="5">
		                      	<input type="hidden" class="form-control txt_product_desc" name="txtProductDescription[]" size="5">	
		                      </td>
		                      <td class="td_product_desc"></td>
		                      <td class="td_quantity"><input type="number" min="0" step="1" class="form-control txt_quantity" name="txtQty[]" placeholder="Qty" value="1" onchange="calculate_amount(this);"></td>
		                      <td class="td_price"><input type="number" min="0" step="1" class="form-control txt_price" name="txtPrice[]" placeholder="Price" value="0.00" onchange="calculate_amount(this);"></td>
		                      <td class="td_discountamt"><input type="number" min="0" step="1" class="form-control txt_discountamt" name="txtDiscount[]" placeholder="Discount" value="0.00" onchange="calculate_amount(this);"></td>
		                      <td class="td_amount"><input type="number" class="form-control txt_amount" name="txtAmount[]" placeholder="Amount" value="0.00" onchange="calculate_total_amount();" readonly></td>
		                      <td class="row_remove">
		                      	<i class="fas fa-minus-square" style="color:red;"  onclick="remove_row(this);"></i>
		                      </td>
		                    </tr>
		                  </tbody>
		                  <thead>                  
							<tr>
								<th colspan="5">&nbsp;</th>
								<th style="font-weight:bold;">Total :</th>
								<th style="font-weight:bold;" colspan="2">
									<input type="text" class="form-control" id="txtTotalAmount" 
									name="txtTotalAmount" placeholder="Total Amount" value="0.00" readonly>
								</th>
							</tr>
		                  </thead>
		                </table>
	                </div>	
				</div>
			</div>

		    <!-- /.card-body -->
		    <div class="card-footer">
		    	<div class="row">	
					<div class="col-sm-4"></div>
					<div class="col-sm-8">	
				      <button type="submit" class="btn btn-primary">Submit</button>
				      <a href="{{ route('invoice.index')}}" class="btn btn-secondary">Back</a>
		    		</div>
		    	</div>
		    </div>
		  </form>
		</div>
	</div>
</section>

<div style="display:none;">
	<table>
		<tbody id="listing_hidden">
			<tr>
              <td class="sno"></td>
              <td class="td_product_code">
              	<select name="txtProductId[]" class="form-control myselect selected_item" style="width: 100%;"
              	onchange="get_product_details(this);">
              	<option value="">Select Code</option>
              	@foreach($products as $product)
              	<option value="{{ $product->id}}">{{ $product->product_code}}</option>
              	@endforeach
              	</select>
              	<input type="hidden" class="form-control txt_product_code" name="txtProductCode[]" size="5">
              	<input type="hidden" class="form-control txt_product_desc" name="txtProductDescription[]" size="5">
              </td>
              <td class="td_product_desc"></td>
              
              <td class="td_quantity"><input type="number" min="0" step="1" class="form-control txt_quantity" name="txtQty[]" placeholder="Qty" value="1"  onchange="calculate_amount(this);"></td>
              <td class="td_price"><input type="number" min="0" step="1" class="form-control txt_price" name="txtPrice[]" placeholder="Price" value="0.00" onchange="calculate_amount(this);"></td>
              <td class="td_discountamt"><input type="number" min="0" step="1" class="form-control txt_discountamt" name="txtDiscount[]" placeholder="Discount" value="0.00" onchange="calculate_amount(this);"></td>
              <td class="td_amount"><input type="number" class="form-control txt_amount" name="txtAmount[]" placeholder="Amount" value="0.00" onchange="calculate_total_amount(); " readonly></td>
              <td class="row_remove"><i class="fas fa-minus-square" style="color:red;" onclick="remove_row(this);"></i></td>
            </tr>
		</tbody>
	</table>
</div>

@endsection

<script>
function add_row(){
	
	//$(".select2").select2('destroy');
	$(".myselect").select2('destroy');
	
	$("#items_listing").append($("#listing_hidden").html());
	
	$(".myselect").select2();
    
    listing_count();

    calculate_total_amount();
}

function remove_row(e){
	
	var price_sum = 0;

	$(e).closest("tr").remove();
	
	listing_count();

    calculate_total_amount();
}

function get_product_details(e)
{
	var product_id = $(e).closest("tr").find(".selected_item").val();

	if(product_id!='')
	{	
		var url = "{{ route('get_product_details')}}";

		$.post(url,{product_id:product_id,'_token':"{{csrf_token()}}" },function(responsedata,status){
			$.each(responsedata, function(i, data){
           		
           		$(e).closest("tr").find(".txt_product_code").val(data.product_code);
                $(e).closest("tr").find(".td_product_desc").html(data.product_description);
                $(e).closest("tr").find(".txt_product_desc").val(data.product_description);
                $(e).closest("tr").find(".txt_price").val(parseFloat(data.product_price).toFixed(2));
            });

            calculate_amount(e);
		});
	} 
	else
	{
		$(e).closest("tr").find(".txt_product_code").val('');
		$(e).closest("tr").find(".td_product_desc").html('');
		$(e).closest("tr").find(".txt_product_desc").val('');
		$(e).closest("tr").find(".txt_quantity").val('1');
		$(e).closest("tr").find(".txt_price").val('0.00');
		$(e).closest("tr").find(".txt_discountamt").val('0.00');
		$(e).closest("tr").find(".txt_amount").val('0.00');

		calculate_amount(e);
	}		
}		

function listing_count(){
     var count_row = 1;
     $("#items_listing").find(".sno").each(function(){
        $(this).html(count_row+".");
        //$(this).closest("tr").find("row_remove").remove();
        count_row++;
    });
    $("#items_listing").find(".row_remove").last().prepend('');
}

function calculate_amount(e)
{
	var quantity = $(e).closest("tr").find(".txt_quantity").val();
	var price = $(e).closest("tr").find(".txt_price").val();
	var txtdiscamt = $(e).closest("tr").find(".txt_discountamt").val();
	var txtamt = $(e).closest("tr").find(".txt_amount").val();

	$(e).closest("tr").find(".txt_price").val(parseFloat(price).toFixed(2));
	$(e).closest("tr").find(".txt_discountamt").val(parseFloat(txtdiscamt).toFixed(2));
	$(e).closest("tr").find(".txt_amount").val(parseFloat(txtamt).toFixed(2));

	if((quantity!='') && (price!=''))
	{
		var calamt = (parseInt(quantity) * parseFloat(price)).toFixed(2);
	}

	var cal_amt = (parseFloat(calamt) - parseFloat(txtdiscamt)).toFixed(2);

	$(e).closest("tr").find(".txt_amount").val(parseFloat(cal_amt).toFixed(2));

	 calculate_total_amount();
}

function calculate_total_amount()
{
	var TotalAmount = 0;
    $("#items_listing").find(".txt_amount").each(function(){
		if($(this).val()!=''){
			TotalAmount+=parseFloat($(this).val());	
		}
    });

	var CalTotalAmount = Math.round(parseFloat(TotalAmount));

    $("#txtTotalAmount").val(parseFloat(CalTotalAmount).toFixed(2));
}
</script>