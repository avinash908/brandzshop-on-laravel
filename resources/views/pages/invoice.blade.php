@extends('layouts.master')
@section('title', 'Brandzshop - My Account')
@section('content')
<div class="ps-content pt-40 pb-40">
	<div class="container">
		<div class="ps-section__content">
			<div class="row">
				<div class="col-md-3">
					@include('partials.customer_dashboard_sidebar')
				</div>
				<div class="col-md-9">
					<!-- Invoice Container -->
					<div class="invoice-container" id="invoice">
						<div class="row">
							<div class="col-sm-6 m-b-20">
								<img alt="Logo" class="inv-logo img-fluid" src="{{url('images/logo.png')}}">
							</div>
							<div class="col-sm-6 m-b-20">
								<div class="invoice-details">
									<h3 class="text-uppercase">Invoice No: {{$invoice->invoice_no}}</h3>
									<div class="col-sm-12 text-right">
										<ul class="list-unstyled mb-0">
											<li>Order Date: <span>{{$invoice->created_at->format('M d, Y')}}</span></li>
											
										</ul>
										@if($invoice->status == 1)
										 	<span class="badge badge-success">Paid</span>
										@else
										 	<span class="badge badge-danger">UnPaid</span>
										@endif
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 col-lg-7 col-xl-8 m-b-20">
								<h6>Invoice to</h6>
								<ul class="list-unstyled mb-0">
									<li><h5 class="mb-0"><strong>{{$invoice->user->info->first_name}} {{$invoice->user->info->last_name}}</strong></h5></li>
									<li><b>Phone:   </b> {{$invoice->user->info->phone}}</li>
									<li><b>Email:   </b> {{$invoice->user->email}}</li>
									<li><b>Address: </b><p style="width: 40%">{{$invoice->user->info->address}}</p></li>
									<li><b>City: </b>{{$invoice->user->info->city->city_name}}</li>
									<li><b>State: </b>{{$invoice->user->info->state->state_name}}</li>
								</ul>
							</div>
							<div class="col-sm-6 col-lg-5 col-xl-4 m-b-20">
								<h6>Payment Details</h6>
								<ul class="list-unstyled invoice-payment-details mb-0">
									<li>Payment Method: <span>
										@if($invoice->payment_method == "AP")
										Advance Payment
										@else
										Cash on deliviery
										@endif
									</span></li>
									<li>Country: <span>Pakistan</span></li>
									@if($invoice->due_date)
									<li>Due date: <span>{{$invoice->due_date->format('M d, Y')}}</span></li>
									@else
									<li>Payment: <span>Pending</span></li>
									@endif
								</ul>
							</div>
						</div>
						
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Item</th>
										<th>Size</th>
										<th class="text-nowrap">Price</th>
										<th>QTY</th>
										<th>Total Price</th>
									</tr>
								</thead>
								<tbody>
									<?php $sno = 1;
									$total = 0;
									$delivery_charges = 0;
									?>
									@foreach($invoice->orders as $order)
									<tr>
										<td>{{($sno++)}}</td>
										<td>{{$order->product->name}}</td>
										<td>{{$order->size}}</td>
										<td>{{$order->product->price}}</td>
										<td>{{$order->quantity}}</td>
										<td>{{$order->amount}}</td>
										<?php
											$delivery_charges += $order->delivery_charges;
										?>
									@endforeach
								</tbody>
							</table>
						</div>
						
						<div>
							<div class="row invoice-payment">
								<div class="col-sm-7">
								</div>
								<div class="col-sm-5">
									<div class="m-b-20">
										<div class="table-responsive no-border">
											<table class="table mb-0">
												<tbody>
													<tr>
														<th>Subtotal:</th>
														<td class="text-right">{{$invoice->sub_total}}</td>
													</tr>
													<tr>
														<th>Delivery Charges:</th>
														<td class="text-right">{{$delivery_charges}}</td>
													</tr>
													<tr>
														<th>Total:</th>
														<td class="text-right"><h5>{{$invoice->grand_total}}</h5></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							@if($invoice->customer_note)
							<div class="invoice-info">
								<h5>Customer Note</h5>
								<p class="text-muted mb-20">{{$invoice->customer_note}}</p>
							</div>
							@endif
							<div class="invoice-info">
								<h5>Company Note</h5>
								<p class="text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed dictum ligula, cursus blandit risus. Maecenas eget metus non tellus dignissim aliquam ut a ex. Maecenas sed vehicula dui, ac suscipit lacus. Sed finibus leo vitae lorem interdum, eu scelerisque tellus fermentum. Curabitur sit amet lacinia lorem. Nullam finibus pellentesque libero.</p>
							</div>
						</div>
					</div>
					<!-- /Invoice Container -->
				</div>
			</div>
		</div>
	</div>
</div>
@if($invoice->status == 1)
<div class="bs_download_invoice"><a href="{{url('my-account/invoice/'.$invoice->invoice_no.'?download=true')}}" id="downloadPdf" class="btn"><i class="fa fa-arrow-down"></i> Download</a></div>
@endif
@endsection
@section('javascript')
		@if(isset($_GET['download']) && ($_GET['download'] == 'true') && ($invoice->status == 1))
		<script type="text/javascript" src="{{url('js/pdf.js')}}"></script>
		<script type="text/javascript">
		        const element = document.getElementById("invoice");
		        html2pdf()
		          .from(element)
		          .save('Brandzshop-Invoice-' + '<?=$invoice->created_at->format('d-m-Y')?>' + '.pdf');
		          new Noty({
		           type: 'success',
		           layout: 'centerRight',
		           theme: 'nest',
		           text: 'Your Invoice has been donwloaded!',
		           timeout: '4000',
		           progressBar: true,
		           killer: true,
		        }).show();
		      	window.history.replaceState(null, null, "?download=false");
		</script>
		@endif
@endsection