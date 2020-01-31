<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DATABASE DATA PULL PAGE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
        /* Some custom styles to beautify this example */
        p{
            padding: 50px;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            background: #dbdfe5;
        }
    </style>
</head>

<body>
<h2 class="text-center my-3"> DATABASE DATA PULL</h2>
<div class="text-center">Open the output in a new blank tab (Click the arrow next to "Show Output" button) and resize the browser window to understand how the Bootstrap responsive grid system works.</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $i)
    <tr>
        <th scope="row">{{ $i -> instructorID }}</th>
        <td>{{ $i -> firstName }}</td>
        <td>{{ $i -> lastName }}</td>
        <td>{{ $i -> phoneNumber }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
