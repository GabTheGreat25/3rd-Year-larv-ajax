<!DOCTYPE html>
<html>

<head>
    <title>Admin Message</title>
</head>

<body>
    <h1>Thank you for registering Ma'am / Sir {{ $full_name }} !</h1>
    <h2>Age: {{ $age }}</h2>
    <img src="{{ $message->embed(public_path('/folder/thank_you.jpg')) }}" style="padding:0px; margin:0px" />
</body>

</html>