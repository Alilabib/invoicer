<?php

namespace App\Http\Controllers;

use App\{Customer, FieldInvoice, Invoice,InvoiceItem};

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $invoices = Invoice::with(['customer'])->get();
        return view('invoices.index',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $oldCustomer = Customer::where('email',$request->customer['email'])->orWhere('phone',$request->customer['phone'])->first();
        if($oldCustomer){
            $customer = $oldCustomer;
        }else{
            $customer = Customer::create($request->customer);
        }
        $invoice = Invoice::create($request->invoice+['customer_id'=>$customer->id,'total'=>$request->invoice['total_amount'],'uuid'=>Str::orderedUuid()]);
        for ($item=0; $item < count($request->product) ; $item++) {
            if(isset($request->product[$item]) && isset($request->price[$item]) && isset($request->qty[$item])){
                $new_item = InvoiceItem::create(['invoice_id'=>$invoice->id,'name'=>$request->product[$item],'price'=>$request->price[$item],'qty'=>$request->qty[$item],'total'=>$request->total[$item]]);
            }
        }
        for ($field=0; $field < count($request->customer_fields) ; $field++) {
                if(isset($request->customer_fields[$field]['field_key'])&& isset($request->customer_fields[$field]['field_value'])){
                    $new_field = FieldInvoice::create(['invoice_id'=>$invoice->id,'title'=>$request->customer_fields[$field]['field_key'],'value'=>$request->customer_fields[$field]['field_value']]);
                }
        }

        return 'created';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('invoices.show',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
