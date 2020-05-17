<?php

namespace App\Mail;

use App\OrderInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailtrapExample extends Mailable
{
    use Queueable, SerializesModels;
    public $info;

    /**
     * Create a new message instance.
     *
     * @param OrderInfo $orderInfo
     */
    public function __construct( OrderInfo $orderInfo)
    {
        $this->info = $orderInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('mails@example.com', 'Mailtrap')
                ->subject('Order Confirmation')
                ->view('mails.newOrder', ['order' => $this->info->token]);
    }
}
