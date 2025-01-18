<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report</title>
  <style>
    table {
      width: 100%;
    }
    table, td {
      border: 1px solid;
    }
  </style>
</head>
<body>
    <h1 style="text-align:center;">Reservation Report</h1>
    <table>
      <thead>
        <tr>
          <td>No</td>
          <td>Check In Date</td>
          <td>Check Out Date</td>
          <td>Guest</td>
          <td>Room</td>
          <td>Total Price</td>
          <td>Status</td>
        </tr>
      </thead>
      <tbody>
        @foreach($reservations as $index => $reservation)
          <tr>
            <td>{{ $index }}</td>
            <td>{{ $reservation->check_in_date }}</td>
            <td>{{ $reservation->check_out_date }}</td>
            <td>{{ $reservation->guest->name }}</td>
            <td>{{ $reservation->room->room_number }}</td>
            <td>{{ $reservation->total_price }}</td>
            <td>{{ $reservation->status }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
</body>
</html>