<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LowMaterialWarning extends Mailable
{
    use Queueable, SerializesModels;



    public $materialCollection;
    public $user;

    /**
     * Create a new message instance.
     *
     * @param Collection $materialCollection
     * @param User $user
     */
    public function __construct(Collection $materialCollection, User $user)
    {
        $this->materialCollection = $materialCollection;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.low-material-warning')
            ->from('bike.erp@gmail.com', 'Bike ERP System')
            ->subject("[IMPORTANT] Low Material Report");
    }
}
