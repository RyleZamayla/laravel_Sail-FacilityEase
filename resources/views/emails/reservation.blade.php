<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Reservation QRCODE</title>
</head>

<body>

    <div>

        <p>Good day <b>{{ $data->user->name }}</b>,</p>

        <p>Your reservation for <b>{{ $data->event }}</b> is still <b>PENDING</b>.</p>
        <br>
        <p>We will need to thoroughly go over your reservation form, please wait within the following days for
            confirmation.</p>
        <p>If we haven't contacted you within 3-5 days after the submission of your reservation, please submit a letter
            through this email:
            <b>{{ $data->facility->user_role->user->email }}</b><br> with the subject <b>"FOLLOW UP FOR MY RESERVATION
                {{ strtoupper($data->event) }}"</b>, or simply message us through this contact number:
            <b>{{ $data->facility->user_role->user->cNumber }}</b>.
        </p>
        <br>
        <p>Click this hyperlink inorder for you to be directly redirected to your reservation form: </p>
        <a href="{{ route('user.showReservationById', ['universityID' => $data->facility->user_role->user->universityID, 'id' => $data->id]) }}"
            target="_blank" class="custom-button"><b>View details</b></a>


    </div>

</body>

</html>
