<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MaterialOrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;


    public $order;
    public $totalCost;
    public $user;

    /**
     * Create a new message instance.
     *
     * @param Order $order
     * @param float $totalCost
     * @param User $user
     */
    public function __construct(Order $order, float $totalCost, User $user)
    {

        $this->order = $order;
        $this->totalCost = $totalCost;
        $this->user = $user;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.material-order-confirmation')
            ->from('bike.erp@gmail.com', 'Bike ERP System')
            ->subject("Order #". $this->order->id . ": Material Order Placed");
    }
}
