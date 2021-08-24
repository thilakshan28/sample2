<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body style="border: 2px solid black; padding: 10px">
<div style="text-align: center">
    <h1 style="font-family: bamini">Post Report</h1>
    <h4 style="text-align: left">User : {{ $name }}</h4>
    <h4 style="text-align: left">Year : {{ date("F", strtotime($month)).' '. $year }}</h4>
    <hr style="margin-top: 10px; height: 1px; color: black; background-color: black">
</div>
<table style="width: 100%; border: 0.5px solid gray; border-collapse: collapse">
    <tr>
        <th style="padding:10px 10px 20px 10px; border: 0.5px solid gray">Name</th>
        <th style="padding:10px 10px 20px 10px; border: 0.5px solid gray">Date</th>
        <th style="padding:10px 10px 20px 10px; border: 0.5px solid gray">Posts</th>
        <th style="padding:10px 10px 20px 10px; border: 0.5px solid gray">Comments</th>
    </tr>

    @foreach($data as $data1)
        <tr>
            <td style="padding:10px 10px 20px 10px; border: 0.5px solid gray">{{ $data1['user'] }}</td>
            <td style="padding:10px 10px 20px 10px; border: 0.5px solid gray">{{ $data1['date'] }}</td>
            <td style="padding:10px 10px 20px 10px; border: 0.5px solid gray">{{ $data1['posts'] }}</td>
            <td style="padding:10px 10px 20px 10px; border: 0.5px solid gray">{{ $data1['comments'] }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
