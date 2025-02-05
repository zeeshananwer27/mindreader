<?php

namespace App\Events;

use App\Models\Book;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookGenerated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Book $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return PrivateChannel[]
     */
    public function broadcastOn()
    {
        return [
            new PrivateChannel('Book.User.' . $this->book->user_id)
        ];
    }

    public function broadcastAs(): string
    {
        return 'book.generated';
    }

    public function broadcastWith(): array
    {
        return [
            'title' => 'Wooah! Great News',
            'message' => "Your book '{$this->book->title}' is ready.",
        ];
    }
}
