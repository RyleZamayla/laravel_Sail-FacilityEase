<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class ReservartionStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $reservation;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $reservation)
    {
        $this->user = $user;
        $this->reservation = $reservation;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('reservation@example.com', 'FacilityEase'),
            subject: $this->reservation->status === 'APPROVED' ? 'Approved Reservation for ' . $this->reservation->event : (
                $this->reservation->status === 'PENCILBOOKED' ? 'Pencilbooked Reservation for ' . $this->reservation->event : (
                    $this->reservation->status === 'DECLINED' ? 'Declined Reservation for ' . $this->reservation->event : (
                        $this->reservation->status === 'CANCELLED' ? 'Cancelled Reservation for ' . $this->reservation->event : (
                            $this->reservation->status === 'REVOKED' ? 'Revoked Reservation for ' . $this->reservation->event : (
                                $this->reservation->status === 'RESCHEDULED' ? 'Rescheduled Reservation for ' . $this->reservation->event : (
                                    $this->reservation->status === 'OCCUPIED' ? 'Ongoing Reservation for ' . $this->reservation->event : 'Reservation Status Notification'
                                )
                            )
                        )
                    )
                )
            ),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reservation-status',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     return [];
    // }
}
