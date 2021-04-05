<?php

namespace App\Mail;

use App\Models\Job;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class JobIssueWarning extends Mailable
{
    use Queueable, SerializesModels;

    public $job;
    public $user;

    /**
     * Create a new message instance.
     *
     * @param Job $job
     * @param User $user
     */
    public function __construct(Job $job, User $user)
    {
        $this->job=$job;
        $this->user=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.email.job-issue-warning')
            ->from('bike.erp@gmail.com', 'Bike ERP System')
            ->subject("[WARNING] Production Disruption with Job ID #". $this->job->id);
    }
}
