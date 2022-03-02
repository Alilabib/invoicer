@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Invoices </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-sucess" role="alert">
                            {{session('status')}}
                        </div>
                    @endif
                    <a href="{{route('invoice.create',['company_id'=>$company->id])}}" class="btn btn-primary">Add new Invoice</a>
                    <br>
                    <br>
                    <table class="table">
                        <tr>
                            <th>Invoice Date</th>
                            <th>Invoice Number</th>
                            <th>Customer</th>
                            <th>Total Amount</th>
                            <th></th>
                        </tr>
                        @forelse ($invoices as $item)
                            <tr>
                                <td>{{$item->date}}</td>
                                <td>@if($item->number != null){{$item->number}}@else {{$item->id}} @endif</td>
                                <td>{{optional($item->customer)->name}}</td>
                                <td>{{number_format($item->total_amount,2)}}</td>
                                <td><a href="{{route('invoice.show',$item->id)}}" class="btn btn-sm btn-info">View invoice</a></td>
                            </tr>
                        @empty

                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
