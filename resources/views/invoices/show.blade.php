@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Invoice number - @if($invoice->number != null){{$invoice->number}}@else {{$invoice->id}} @endif
                    <a  class="btn btn-primary" style="float:right" href="{{route('invoice.index',['company_id'=>$invoice->company->id])}}"> All Invoice </a>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row clearfix">
                            <div class="col-md-12  text-center">
                                <div class="row">
                                    <div class="col-3 offset-5">
                                        <div class="logo">
                                            <label for="upload" style="display:block">
                                                <img id="blah" src="{{$invoice->qr_link}}" alt="your image" width="100px" height="100px"  aria-hidden="true" style="" class="image-preview" />
                                                <input accept="image/*" type='file' id="imgInp" class="image-upload" />
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        Invoice number*:
                                        <br />
                                        <input type="text" name='invoice[number]' class="form-control" placeholder="AA001" value="@if($invoice->number != null){{$invoice->number}}@else {{$invoice->id}} @endif" disabled/>
                                    </div>
                                    <div class="col-6">
                                        Invoice date*:
                                        <br />
                                        <input type="text" name='invoice[date]' class="form-control" value="{{ $invoice->date }}"  disabled />
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="row clearfix" style="margin-top:20px">
                            <div class="col-md-12">
                                <div class="float-left col-md-6">
                                    Name*: <input type="text" name='customer[name]' class="form-control" value="{{$invoice->customer->name}}"  disabled/>
                                    Address*: <input type="text" name='customer[address]' class="form-control" value="{{$invoice->customer->address}}"  disabled />
                                    Postcode/ZIP: <input type="text" name='customer[postcode]' class="form-control" value="{{$invoice->customer->postcode}}"  disabled />
                                    City*: <input type="text" name='customer[city]' class="form-control" value="{{$invoice->customer->city}}"  disabled />
                                    State: <input type="text" name='customer[state]' class="form-control" value="{{$invoice->customer->state}}"  disabled />
                                    Country*: <input type="text" name='customer[country]' class="form-control" value="{{$invoice->customer->country}}"  disabled />
                                    Phone: <input type="text" name='customer[phone]' class="form-control" value="{{$invoice->customer->phone}}"  disabled />
                                    Email: <input type="email" name='customer[email]' class="form-control" value="{{$invoice->customer->email}}"  disabled />
                                    <br />
                                    @if(isset($invoice->fields) && count($invoice->fields) > 0)
                                        <b>Additional fields</b>
                                        <br />
                                        <table class="table table-bordered table-hover">
                                            <tbody>
                                            <tr>
                                                <th class="text-center" width="50%">Field</th>
                                                <th class="text-center">Value</th>
                                            </tr>
                                            @forelse($invoice->fields as $field)
                                                <tr>
                                                    <td class="text-center">
                                                        <input type="text" name='customer_fields[{{ $field->id }}][field_key]' value="{{$field->title}}" class="form-control" disabled />
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" name='customer_fields[{{ $field->id }}][field_value]' class="form-control"  value="{{$field->value}}" disabled/>
                                                    </td>
                                                </tr>
                                            @empty
                                            @endforelse
                                            </tbody>
                                        </table>
                                    @endif

                                </div>
                                <div class="float-right col-md-4">
                                    <div class="logo">
                                        <label for="upload" style="display:block">
                                            @if ($invoice->company)

                                            <img id="blah" src="{{$invoice->company->logo_link}}" alt="your image" width="100px" height="100px"  aria-hidden="true" style="" class="image-preview" />
                                            @else
                                            <img id="blah" src="{{asset('placeholder.png')}}" alt="your image" width="100px" height="100px"  aria-hidden="true" style="" class="image-preview" />

                                            @endif
                                        </label>
                                    </div>

                                    <b>Seller details</b>:
                                    <br /><br />
                                    @if ($invoice->company)
                                        {{$invoice->company->name}}
                                    @else
                                        company name
                                    @endif

                                    <br />
                                    @if ($invoice->company)
                                    {{$invoice->company->address}}
                                    @else
                                    1 Street Name, London, United Kingdom
                                    @endif
                                    <br />
                                    @if ($invoice->company)
                                    Email: {{$invoice->company->email}}
                                    @else
                                    Email: xxxxx@company.com
                                    @endif

                                    <br />
                                    @if ($invoice->company)
                                    Phone Number: {{$invoice->company->phone}}
                                    @else

                                    Phone Number: {{$invoice->company->phone}}
                                    @endif
                                    <br />
                                    @if ($invoice->company)
                                    Vat Number: {{$invoice->company->vat}}
                                    @else

                                    Vat Number: xxxxx-xxxx-xx
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix" style="margin-top:20px">
                            <div class="col-md-12">
                                <table class="table table-bordered table-hover" id="tab_logic">
                                    <thead>
                                    <tr>
                                        <th class="text-center"> # </th>
                                        <th class="text-center"> Product </th>
                                        <th class="text-center"> Qty </th>
                                        <th class="text-center"> Price </th>
                                        <th class="text-center"> Total </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($invoice->items as $item)
                                            <tr id='addr{{$item->id}}'>
                                                <td>{{$item->id}}</td>
                                                <td><input type="text" name='product[]'  placeholder='Enter Product Name' class="form-control" value="{{$item->name}}" disabled/></td>
                                                <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0" value="{{$item->qty}}" disabled /></td>
                                                <td><input type="number" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0" value="{{$item->price}}" disabled /></td>
                                                <td><input type="number" name='total[]' placeholder='0.00' class="form-control total" value="{{$item->total}}" readonly/></td>
                                            </tr>
                                        @empty

                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row clearfix" style="margin-top:20px">
                            <div class="col-md-12">
                                <div class="float-right col-md-6">
                                    <table class="table table-bordered table-hover" id="tab_logic_total">
                                        <tbody>
                                        <tr>
                                            <th class="text-center" width="50%">Sub Total</th>
                                            <td class="text-center"><input type="number" name='invoice[sub_total]' placeholder='0.00' class="form-control" id="sub_total" value="{{$invoice->sub_total}}" readonly/></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Tax</th>
                                            <td class="text-center"><div class="input-group mb-2 mb-sm-0">
                                                    <input type="number" class="form-control" name="invoice[tax]" id="tax" placeholder="0" disabled value="{{$invoice->tax}}">
                                                    <div class="input-group-addon">%</div>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Tax Amount</th>
                                            <td class="text-center"><input type="number" name='invoice[tax_amount]' id="tax_amount" placeholder='0.00' value="{{$invoice->tax_amount}}" class="form-control" readonly/></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Grand Total</th>
                                            <td class="text-center"><input type="number" name='invoice[total_amount]' id="total_amount" placeholder='0.00' value="{{$invoice->total_amount}}" class="form-control" readonly/></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection



