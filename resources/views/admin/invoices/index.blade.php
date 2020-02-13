@extends('layouts.admin.master')

@section('content')

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-10">
        <h1>Invoices</h1>
      </div>
      <div class="col-sm-1">
      	<ol class="breadcrumb float-sm-right">
      		<a href="{{ route('invoice.create')}}" class="btn btn-info btn-sm"><i class="fas fa-plus-square"></i></a>
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
                  <th>Invoice No.</th>
                  <th>Invoice Date</th>
                  <th>Customer Name</th>
                  <th>Total Amount</th>
                  <th>Paid</th>
                  <th>Print</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                
                @foreach($invoices as $invoice)	
                <tr>
                  <td style="text-align: center;">{{ $SNo++ }}.</td>
                  <td>{{ $invoice->invoice_no }}</td>
                  <td>{{ $invoice->invoice_date }}</td>
                  <td>{{ $invoice->customer_name }}</td>
                  <td>{{ $invoice->total_amount }}</td>
                  <td>{{ $invoice->is_paid }}</td>
                  <td><a href="#">print</a></td>
                  <td>
                  	<a href="{{ route('invoice.edit',['invoice'=>$invoice->id])}}" class="btn btn-default btn-sm"><i class="fas fa-edit"></i></a>
                  </td>	
                  <td>
                  	<form id="deleteform-{{ $invoice->id }}" role="form" class="confirm-delete" data-id="{{ $invoice->id }}" method="post" action="{{ route('invoice.destroy',['invoice'=>$invoice->id]) }}">
                  	{{ csrf_field() }}	
                  	{{ method_field('DELETE') }}	
                  	<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></button><!-- data-toggle="modal" data-target="#modal-default"-->
                  	</form>
                  </td>
                </tr>
                @endforeach
 
                </tbody>
                <tfoot>
                <tr>
                  <th style="text-align: center;">SNo.</th>
                  <th>Invoice No.</th>
                  <th>Invoice Date</th>
                  <th>Customer Name</th>
                  <th>Total Amount</th>
                  <th>Paid</th>
                  <th>Edit</th>
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

<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Confirm Delete</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure to delete...?</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" id="btnDeleteYes" class="btn btn-primary">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
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
  });
</script>
<script>
$('.confirm-delete').on('click', function(e) {
    e.preventDefault();
    var form_id = $(this).data('id');
    $('#myModal').data('delformid', form_id).modal('show');
    //console.log(form_id);
});

$('#btnDeleteYes').click(function() {
    var del_form_id = $('#myModal').data('delformid');
    //console.log(del_form_id);
    $('#deleteform-'+del_form_id).submit();
    $('#myModal').modal('hide');
});
</script>
@endsection