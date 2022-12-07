<?php

namespace AbbasShDev\BlogPackage\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use AbbasShDev\BlogPackage\Models\Post;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function build()
    {
        return $this->view('blogpackage::emails.welcome');
    }
}