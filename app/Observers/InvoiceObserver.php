<?php

namespace App\Observers;

use App\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class InvoiceObserver
{
    /**
     * Handle the invoice "created" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function created(Invoice $invoice)
    {
        if(!Storage::exists('public/invoice')) {
            Storage::makeDirectory('public/invoice', 0775, true); //creates directory
        }
        $image_name = 'invoice_'.Carbon::now();
        \QrCode::size(500)
        ->format('png')
        ->generate('https://www.google.com',storage_path('app/public/invoice/'.$image_name).'.png');

        $invoice->qr_link = $image_name.'.png';
        $invoice->save();
    }

    /**
     * Handle the invoice "updated" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function updated(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the invoice "deleted" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function deleted(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the invoice "restored" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function restored(Invoice $invoice)
    {
        //
    }

    /**
     * Handle the invoice "force deleted" event.
     *
     * @param  \App\Invoice  $invoice
     * @return void
     */
    public function forceDeleted(Invoice $invoice)
    {
        //
    }
}
