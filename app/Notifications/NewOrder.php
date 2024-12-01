<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class NewOrder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private $order)
    {
        $this->afterCommit();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = route('filament.lunar.resources.orders.order', $this->order->id);
        return (new MailMessage)
                    ->greeting('Yeah!!')
                    ->line("We have a new order ({$this->order->status})")
                    ->line(new HtmlString("<b>Total value:</b> {$this->order->total->formatted}"))
                    ->line(new HtmlString(
                        $this->order->productLines->map(
                            fn ($line) => "<p><b>Product:</b> {$line->purchasable->product->translateAttribute('name')} <br /><b>Quantity:</b> {$line->quantity} <b>Price:</b> {$line->total->formatted}</p>")->implode('')
                        )
                    )->action('Click here to view', $url)
                    ->line(new HtmlString('Thank you for using <a href="https://zabrdast.com">Zabrdast E-commerce!</a>'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
