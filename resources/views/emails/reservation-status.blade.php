<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Reservation Status</title>
</head>

<body>
    @if ($reservation->status === 'APPROVED' && $user->id === $reservation->userID)
        <div class="container">
            <p>Good day <b>{{ $user->name }}</b>!</p>
            <p>Your reservation for <b>{{ $reservation->event }}</b> is now <b>APPROVED</b>. You may now contact
                {{ $reservation->facility->user_role->user->name }} through this contact number
                {{ $reservation->facility->user_role->user->cNumber }} or through this email
                {{ $reservation->facility->user_role->user->email }}. </p>
            <br>
            <p>Here are your event details:</p>
            <div>
                <p><b>Event name:</b> {{ $reservation->event }}</p>
                <p><b>Venue:</b> {{ $reservation->facility->facility }}</p>
                <p><b>Number of attendees:</b> {{ $reservation->occupants }}</p>
            </div>
            <br>

            @foreach ($reservation->reservation_days as $day)
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Date:</b> {{ $day->date }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Start time:</b> {{ $day->startTime->format('h:i A') }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>End time:</b> {{ $day->endTime->format('h:i A') }} </p>
                </div>
            @endforeach

            <br>
            <div><b>Equipments held accountable:</b></div>
                @foreach ($reservation->equipment as $equipment)
                <ul>
                    <li>
                        <p>{{ $equipment->equipment }}</p>
                    </li>
                </ul>

                @endforeach
                <br>
            </div>

            @if ($reservation->status === 'APPROVED' && $user->id === $reservation->userID)
                <div style="display: flex; flex-direction: column;">
                    <p>Please present QR to the facility in charge on the day of the
                        reservation. To download Qr Code, please logged in first to the portal.</p>
                    <p>
                        <a href="
                        {{ route('downloadQRCode', ['id' => $reservation->id]) }}"
                            class="custom-button"> Download QR Code</a>
                    </p>
                </div>
            @endif
            <p>Click this hyperlink inorder for you to be directly redirected to your reservation form: </p>
                <a href="{{ route('user.showReservationById', ['universityID' => $reservation->facility->user_role->user->universityID, 'id' => $reservation->id]) }}"
                    target="_blank" class="custom-button">View details</a>


        </div>
    @elseif($reservation->status === 'PENCILBOOKED' && $user->id === $reservation->userID)
        <div class="container">
            <p>Good day <b>{{ $user->name }}</b>,</p>
            <p>Your reservation for <b>{{ $reservation->event }}</b> is now <b>PENCILBOOKED</b> with this message:</p>
            <br>
            <p><strong><i>{{ $reservation->reason }}</i></strong></p>
            <br>
            <p>Be informed that you are not allowed to use the facility until your reservation is <b>APPROVED</b>.
                Please submit the necessary documents needed for the {{ $reservation->event }} or follow the remarks
                given by the facility-incharge.</p>
            <p>Click this hyperlink inorder for you to be directly redirected to your reservation form: </p>
                <a href="{{ route('user.showReservationById', ['universityID' => $reservation->facility->user_role->user->universityID, 'id' => $reservation->id]) }}"
                    target="_blank" class="custom-button">View details</a>
            <br>
            <p>If you have clarifications regarding your reservation, you may contact
                <b>{{ $reservation->facility->user_role->user->name }}</b> through this contact number
                <b>{{ $reservation->facility->user_role->user->cNumber }}</b> or through this email
                <b>{{ $reservation->facility->user_role->user->email }}</b>.
                <br>
            <p>Thank you!
            <p>
        </div>
    @elseif($reservation->status === 'DECLINED' && $user->id === $reservation->userID)
        <div class="container">
            <p>The reservation for <b>{{ $reservation->event }}</b> has been <b>DECLINED</b> with this message:</p>
            <br>
            <p><strong><i>{{ $reservation->reason }}</i></strong></p>
            <br>
            <div>
                <p><b>Event name:</b> {{ $reservation->event }}</p>
                <p><b>Venue:</b> {{ $reservation->facility->facility }}</p>
                <p><b>Number of attendees:</b> {{ $reservation->occupants }}</p>
            </div>
            <br>

            @foreach ($reservation->reservation_days as $day)
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Date:</b> {{ $day->date }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Start time:</b> {{ $day->startTime->format('h:i A') }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>End time:</b> {{ $day->endTime->format('h:i A') }} </p>
                </div>
            @endforeach

            <br>
            <div><b>Equipments held accountable:</b></div>
                @foreach ($reservation->equipment as $equipment)
                <ul>
                    <li>
                        <p>{{ $equipment->equipment }}</p>
                    </li>
                </ul>

                @endforeach
                <br>
            </div>
            <p>Click this hyperlink inorder for you to be directly redirected to your reservation form: </p>
                <a href="{{ route('user.showReservationById', ['universityID' => $reservation->facility->user_role->user->universityID, 'id' => $reservation->id]) }}"
                    target="_blank" class="custom-button">View details</a>
            <br>
            <p>Thank you!
            <p>
        </div>
        </div>
    @elseif($reservation->status === 'RESCHEDULED' && $user->id === $reservation->userID)
        <div class="container">
            <p>The reservation for <b>{{ $reservation->event }}</b> has been <b>RESCHEDULED</b>. Please wait for approval.</p>
            <br>
            <div>
                <p><b>Event name:</b> {{ $reservation->event }}</p>
                <p><b>Venue:</b> {{ $reservation->facility->facility }}</p>
                <p><b>Number of attendees:</b> {{ $reservation->occupants }}</p>
            </div>
            <br>

            @foreach ($reservation->reservation_days as $day)
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Date:</b> {{ $day->date }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Start time:</b> {{ $day->startTime->format('h:i A') }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>End time:</b> {{ $day->endTime->format('h:i A') }} </p>
                </div>
            @endforeach

            <br>
            <div><b>Equipments held accountable:</b></div>
                @foreach ($reservation->equipment as $equipment)
                <ul>
                    <li>
                        <p>{{ $equipment->equipment }}</p>
                    </li>
                </ul>

                @endforeach
                <br>
            </div>
            <p>Click this hyperlink inorder for you to be directly redirected to your reservation form: </p>
                <a href="{{ route('user.showReservationById', ['universityID' => $reservation->facility->user_role->user->universityID, 'id' => $reservation->id]) }}"
                    target="_blank" class="custom-button">View details</a>
            <br>
            <p>Thank you!
            <p>
        </div>
        </div>
    @elseif($reservation->status === 'REVOKED' && $user->id === $reservation->userID)
        <div class="container">
            <p>The reservation for <b>{{ $reservation->event }}</b> has been <b>REVOKED</b> with this message:</p>
            <br>
            <p><strong><i>{{ $reservation->reason }}</i></strong></p>
            <br>

            <p>Click this hyperlink inorder for you to be directly redirected to your reservation form: </p>
                <a href="{{ route('user.showReservationById', ['universityID' => $reservation->facility->user_role->user->universityID, 'id' => $reservation->id]) }}"
                    target="_blank" class="custom-button">View details</a>
            <br>
            <p>Please contact the facility in-charge: <b>{{ $reservation->facility->user_role->user->name }}</b> through this
                contact number <b>{{ $reservation->facility->user_role->user->cNumber }}</b> or through this email
                <b>{{ $reservation->facility->user_role->user->email }}</b> for us to be able to discuss and make a new
                reservation for you directly. Thank you!
            <p>
        </div>
        </div>
    @elseif($reservation->status === 'OCCUPIED' && $user->id === $reservation->userID)
        <div class="container">
            <p>Good day <b>{{ $user->name }}</b>,</p>
            <p>Your reservation for <b>{{ $reservation->event }}</b> has been <b>RESERVED</b>. You may now contact
                <b>{{ $reservation->facility->user_role->user->name }}</b> through this contact number
                <b>{{ $reservation->facility->user_role->user->cNumber }}</b> or through this email
                <b>{{ $reservation->facility->user_role->user->email }}</b> for any questions and clarifications. </p>
            <br>
            <p>Here are your event details:</p>
            <div>
                <p><b>Event name:</b> {{ $reservation->event }}</p>
                <p><b>Venue:</b> {{ $reservation->facility->facility }}</p>
                <p><b>Number of attendees:</b> {{ $reservation->occupants }}</p>
            </div>
            <br>

            @foreach ($reservation->reservation_days as $day)
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Date:</b> {{ $day->date }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Start time:</b> {{ $day->startTime->format('h:i A') }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>End time:</b> {{ $day->endTime->format('h:i A') }} </p>
                </div>
            @endforeach

            <br>
            <div><b>Equipments held accountable:</b></div>
                @foreach ($reservation->equipment as $equipment)
                <ul>
                    <li>
                        <p>{{ $equipment->equipment }}</p>
                    </li>
                </ul>

                @endforeach
                <br>
            </div>
            <p>Click this hyperlink inorder for you to be directly redirected to your reservation form: </p>
                <a href="{{ route('user.showReservationById', ['universityID' => $reservation->facility->user_role->user->universityID, 'id' => $reservation->id]) }}"
                    target="_blank" class="custom-button">View details</a>

        </div>
    @elseif($reservation->status === 'CANCELLED' && $user->id === $reservation->userID)
    <div class="container">
            <p>Your reservation for <b>{{ $reservation->event }}</b> has been <b>CANCELLED</b> with
                your message:</p>
            <br>
            <p><strong><i>{{ $reservation->reason }}</i></strong></p>
            <div>
                <p><b>Event name:</b> {{ $reservation->event }}</p>
                <p><b>Venue:</b> {{ $reservation->facility->facility }}</p>
                <p><b>Number of attendees:</b> {{ $reservation->occupants }}</p>
            </div>
            <br>

            @foreach ($reservation->reservation_days as $day)
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Date:</b> {{ $day->date }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Start time:</b> {{ $day->startTime->format('h:i A') }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>End time:</b> {{ $day->endTime->format('h:i A') }} </p>
                </div>
            @endforeach

            <br>
            <div><b>Equipments held accountable:</b></div>
                @foreach ($reservation->equipment as $equipment)
                <ul>
                    <li>
                        <p>{{ $equipment->equipment }}</p>
                    </li>
                </ul>

                @endforeach
                <br>
            </div>
            <p>Click this hyperlink inorder for you to be directly redirected to your reservation form: </p>
                <a href="{{ route('user.showReservationById', ['universityID' => $reservation->facility->user_role->user->universityID, 'id' => $reservation->id]) }}"
                    target="_blank" class="custom-button">View details</a>
            <br>
            <p>Thank you!
            <p>
        </div>
        </div>
    @endif

    @if ($reservation->status === 'APPROVED' && $user->id === $reservation->facility->user_role->user->id)
        <div class="container">
            <p>The reservation for <b>{{ $reservation->event }}</b> is now <b>APPROVED</b>.</p>
            <br>
            <p>Here are the event details:</p>
            <div>
                <p><b>Applicant:</b> {{ $reservation->user->name }}</p>
                <p><b>Contact Number:</b> {{ $reservation->user->cNumber }}</p>
                <p><b>Event name:</b> {{ $reservation->event }}</p>
                <p><b>Venue:</b> {{ $reservation->facility->facility }}</p>
                <p><b>Number of attendees:</b> {{ $reservation->occupants }}</p>
            </div>
            <br>

            @foreach ($reservation->reservation_days as $day)
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Date:</b> {{ $day->date }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Start time:</b> {{ $day->startTime->format('h:i A') }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>End time:</b> {{ $day->endTime->format('h:i A') }} </p>
                </div>
            @endforeach

            <br>
            <div><b>Equipments held accountable:</b></div>
                @foreach ($reservation->equipment as $equipment)
                <ul>
                    <li>
                        <p>{{ $equipment->equipment }}</p>
                    </li>
                </ul>

                @endforeach
                <br>
            </div>
            <br>
            <p>Click this hyperlink inorder for you to be directly redirected to the reservation form: </p>
                <a href="{{ route('fic.showReservationById', ['universityID' => $reservation->facility->user_role->user->universityID, 'id' => $reservation->id]) }}"
                    target="_blank" class="custom-button">View details</a>

        </div>
    @elseif($reservation->status === 'PENCILBOOKED' && $user->id === $reservation->facility->user_role->user->id)
        <div class="container">
            <p>The reservation for <b>{{ $reservation->event }}</b> is now <b>PENCILBOOKED</b> with this message:</p>
            <br>
            <p><strong><i>{{ $reservation->reason }}</i></strong></p>
            <br>
            <p><b>Applicant:</b> {{ $reservation->user->name }}</p>
                <p><b>Contact Number:</b> {{ $reservation->user->cNumber }}</p>
            <br>
            <p>Please inform your applicant that they are not allowed to use the facility until their reservation is
                <b>APPROVED</b>.
            </p>
            <br>
            <p>Click this hyperlink inorder for you to be directly redirected to the reservation form: </p>
                <a href="{{ route('fic.showReservationById', ['universityID' => $reservation->facility->user_role->user->universityID, 'id' => $reservation->id]) }}"
                    target="_blank" class="custom-button">View details</a>
            <br>
            <p>
        </div>
    @elseif($reservation->status === 'DECLINED' && $user->id === $reservation->facility->user_role->user->id)
        <div class="container">
            <p>The reservation for <b>{{ $reservation->event }}</b> has been <b>DECLINED</b> with this message:</p>
            <br>
            <p><strong><i>{{ $reservation->reason }}</i></strong></p>
            <div>
                <p><b>Applicant:</b> {{ $reservation->user->name }}</p>
                <p><b>Contact Number:</b> {{ $reservation->user->cNumber }}</p>
                <p><b>Event name:</b> {{ $reservation->event }}</p>
                <p><b>Venue:</b> {{ $reservation->facility->facility }}</p>
                <p><b>Number of attendees:</b> {{ $reservation->occupants }}</p>
            </div>
            <br>

            @foreach ($reservation->reservation_days as $day)
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Date:</b> {{ $day->date }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Start time:</b> {{ $day->startTime->format('h:i A') }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>End time:</b> {{ $day->endTime->format('h:i A') }} </p>
                </div>
            @endforeach

            <br>
            <div><b>Equipments held accountable:</b></div>
                @foreach ($reservation->equipment as $equipment)
                <ul>
                    <li>
                        <p>{{ $equipment->equipment }}</p>
                    </li>
                </ul>

                @endforeach
                <br>
            </div>
            <p>Click this hyperlink inorder for you to be directly redirected to the reservation form: </p>
                <a href="{{ route('fic.showReservationById', ['universityID' => $reservation->facility->user_role->user->universityID, 'id' => $reservation->id]) }}"
                    target="_blank" class="custom-button">View details</a>
            <br>
            <p>Thank you!
            <p>
        </div>
        </div>
    @elseif($reservation->status === 'CANCELLED' && $user->id === $reservation->facility->user_role->user->id)
        <div class="container">
            <p>The reservation for <b>{{ $reservation->event }}</b> has been <b>CANCELLED</b> by {{ $reservation->user->name }} with
                this message:</p>
            <br>
            <p><strong><i>{{ $reservation->reason }}</i></strong></p>
            <div>
                <p><b>Applicant:</b> {{ $reservation->user->name }}</p>
                <p><b>Contact Number:</b> {{ $reservation->user->cNumber }}</p>
                <p><b>Event name:</b> {{ $reservation->event }}</p>
                <p><b>Venue:</b> {{ $reservation->facility->facility }}</p>
                <p><b>Number of attendees:</b> {{ $reservation->occupants }}</p>
            </div>
            <br>

            @foreach ($reservation->reservation_days as $day)
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Date:</b> {{ $day->date }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>Start time:</b> {{ $day->startTime->format('h:i A') }} </p>
                </div>
                <div style="display: flex; flex-direction: column;">
                    <p style="margin-bottom: 5px;"><b>End time:</b> {{ $day->endTime->format('h:i A') }} </p>
                </div>
            @endforeach

            <br>
            <div><b>Equipments held accountable:</b></div>
                @foreach ($reservation->equipment as $equipment)
                <ul>
                    <li>
                        <p>{{ $equipment->equipment }}</p>
                    </li>
                </ul>

                @endforeach
                <br>
            </div>
            <p>Click this hyperlink inorder for you to be directly redirected to the reservation form: </p>
                <a href="{{ route('fic.showReservationById', ['universityID' => $reservation->facility->user_role->user->universityID, 'id' => $reservation->id]) }}"
                    target="_blank" class="custom-button">View details</a>
            <br>
            <p>Thank you!
            <p>
        </div>
        </div>
    @elseif ($reservation->status === 'REVOKED' && $user->id === $reservation->facility->user_role->user->id)
    <div class="container">
            <p>The reservation for <b>{{ $reservation->event }}</b> has been <b>REVOKED</b> with this message:</p>
            <br>
            <p><strong><i>{{ $reservation->reason }}</i></strong></p>
            <br>
                <p><b>Applicant:</b> {{ $reservation->user->name }}</p>
                <p><b>Contact Number:</b> {{ $reservation->user->cNumber }}</p>

            <p>Click this hyperlink inorder for you to be directly redirected to the reservation form: </p>
                <a href="{{ route('fic.showReservationById', ['universityID' => $reservation->facility->user_role->user->universityID, 'id' => $reservation->id]) }}"
                    target="_blank" class="custom-button">View details</a>
            <br>
        </div>
        </div>
    @elseif ($reservation->status === 'RESCHEDULED' && $user->id === $reservation->facility->user_role->user->id)
        <div class="container">
            <p>The reservation for <b>{{ $reservation->event }}</b> has been <b>RESCHEDULED</b></p>
            <br>
            <p>Click this hyperlink inorder for you to be directly redirected to the reservation form: </p>
                <a href="{{ route('fic.showReservationById', ['universityID' => $reservation->facility->user_role->user->universityID, 'id' => $reservation->id]) }}"
                    target="_blank" class="custom-button">View details</a>
            <br>
        </div>
        </div>
    @endif
</body>

</html>
