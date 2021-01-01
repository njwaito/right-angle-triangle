<?php

namespace App\Mail;

use App\Models\Triangle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportLog extends Mailable
{
    use Queueable, SerializesModels;

    public $triangleLog;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->triangleLog = Triangle::all();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.report');
    }
}
