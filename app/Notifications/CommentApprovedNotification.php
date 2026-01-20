<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;



class CommentApprovedNotification extends Notification
{
    public function __construct(public $comment) {}

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => 'Your comment was approved on: ' . $this->comment->blog->title,
            'blog_id' => $this->comment->blog->id,
        ];
    }
}
