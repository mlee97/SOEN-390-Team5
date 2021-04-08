<?php

namespace App\Mail;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LargeSaleNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $sale;
    public $user;

    /**
     * Create a new message instance.
     *
     * @param Sale $sale
     * @param User $user
     */
    public function __construct(Sale $sale, User $user)
    {
        $this->sale = $sale;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.large-sale-notification')
            ->from('bike.erp@gmail.com', 'Bike ERP System')
            ->subject("Sale #" . $this->sale->id . ": Large Sale Completed");
    }
}
