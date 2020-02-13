<table width="100%" cellspacing="0" cellpadding="0" border="1">
<tr>
  <td>Invoice No.</td>
  <td>{{ $invoice->invoice_no }}</td>
  <td>Invoice Date</td>
  <td>{{ $invoice->invoice_date }}</td>
</tr>
<tr>
  <td>Customer Name</td>
  <td>{{ $invoice->customer_name }}</td>
  <td>Mobile No</td>
  <td>{{ $invoice->mobile_no }}</td>
</tr>
<tr>
  <td>Address</td>
  <td>{{ $invoice->address }}</td>
  <td>City</td>
  <td>{{ $invoice->city }}</td>
</tr>
<tr>
  <td>Payment Mode</td>
  <td>{{ $invoice->payment_mode }}</td>
  <td>Remarks</td>
  <td>{{ $invoice->remarks }}</td>
</tr>
</table>

<table width="100%" cellspacing="0" cellpadding="0" border="1">
<thead> 
<tr>
  <th style="text-align: center;">SNo.</th>
  <th>Invoice No.</th>
  <th>Invoice Date</th>
  <th>Customer Name</th>
  <th>Total Amount</th>
  <th>Paid</th>
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
</tr>
@endforeach
</tbody>
</table>