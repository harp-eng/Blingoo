@extends('backend.reports.layout')
@section('title','Sales Report')
@section('body')
<p>Analyse your overall sales by payment types.</p>
<table class="table table-bordered">
    <tr><th>Payment Type</th><th>Total Orders</th><th>Amount</th></tr>
</table>
@endsection
