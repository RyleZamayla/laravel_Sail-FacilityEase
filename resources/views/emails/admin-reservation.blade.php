<!doctype html>
<html>

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>New Reservation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body>
    <div>
        <div>
            <p><b>Applicant:</b> {{ $data->user->name }}</p>
            <p><b>Event name:</b> {{ $data->event }}</p>
            <p><b>Venue:</b> {{ $data->facility->facility }}</p>
            <p><b>Number of attendees:</b> {{ $data->occupants }}</p>
        </div>


        @foreach ($data->reservation_days as $day)
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
        @foreach ($data->equipment as $equipment)
            <p>{{ $equipment->equipment }}</p>
        @endforeach

        <br>
        <p>Click this hyperlink inorder for you to be directly redirected to your reservation form: </p>
        <a href="
                    {{ route('email.showReservationById', ['universityID' => $data->facility->user_role->user->universityID, 'id' => $data->id]) }}"
            target="_blank" class="custom-button">View details</a>

</body>

</html>
