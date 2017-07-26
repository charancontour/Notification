@extends('base')
@section('content')
<div class="content-header">
	<div class="title">
      <h1>Notifications</h1>
  </div>
</div>

<table class="table bordered striped datatable">
  <thead>
    <tr>
      <th>Type</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody id="notification-body">
    @foreach($notifications as $notification)
    <tr>
      <td>{{$notification->type}}</td>
      <td>{{$notification->description}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
@section('customScripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
<script>
  $(function () {
    var socket = io('http://localhost:3000');
    socket.on("notifications-{{Auth::user()->id}}", function(msg){
      console.log(msg);
      var tbody = document.getElementById('notification-body');
      var tr = document.createElement('tr');
      var td = document.createElement('td');
      td.innerHTML = msg.type;
      tr.appendChild(td);
      var td = document.createElement('td');
      td.innerHTML = msg.description;
      tr.appendChild(td);
      tbody.appendChild(tr);
    });
  });
</script>
@endsection
