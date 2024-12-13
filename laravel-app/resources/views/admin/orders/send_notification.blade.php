@extends('admin.layouts.app')
@section('content')
    <div>
        <form action="{{route('orders.sendNotificationToUser', ['id' => $id, 'notification_type' => $notiifcationType])}}" method="post">
            {{ csrf_field() }}
            <div class="mb-3 mt-3">
                <label for="order_id">#Order Id:</label>
                <input type="text" disabled value="{{$id}}" class="form-control" name="order_id">
            </div>
          <div class="mb-3 mt-3">
            <label for="email">User Identifier:</label>
            <input type="text" disabled value="{{$userIdentifier}}"  class="form-control" name="Identifier">
          </div>
          <div class="mb-3 mt-3">
            <label for="email">Notification Type:</label>
            <input type="text"  disabled value="{{$notiifcationType}}" class="form-control" name="notification_type">
          </div>
          <div class="mb-3">
            <label for="msg_content">Msg content:</label>
            <textarea type="msg_content" class="form-control" name="msg_content" ></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection