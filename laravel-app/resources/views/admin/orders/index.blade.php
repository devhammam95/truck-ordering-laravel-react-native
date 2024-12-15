@extends('admin.layouts.app')
@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">user Sender</th>
        <th scope="col">Order Status</th>
        <th scope="col">Delivery / Pickup type</th>
        <th scope="col">Delivery / Pickup DateTime</th>
        <th scope="col">size</th>
        <th scope="col">weight</th>
        <th scope="col">location</th>
        <th scope="col">created date</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($orders as $item)
      <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->user->name}}</td>
        <td>{{$item->status ?? 'pending'}}</td>
        <td>{{$item->delivery_pickup_type}}</td>
        <td>{{$item->delivery_pickup_date_time}}</td>
        <td>{{$item->size}}</td>
        <td>{{$item->weight}}</td>
        <td>{{$item->location}}</td>
        <td>{{$item->created_at->format('Y-m-d h:i:s')}}</td>
        <td>
            @if($item->status == 'pending')
            <button class="btn btn-info" onclick='document.getElementById("update-order-status-form-{{$item->id}}").submit()'>
                Change to in progress
            </button>
            @elseif($item->status == 'inprogress')
            <button class="btn btn-success" onclick='document.getElementById("update-order-status-form-{{$item->id}}").submit()'>
                Change to delivered
            </button>
            @endif

            <form id="update-order-status-form-{{$item->id}}" class="hidden" action="{{route('orders.updateOrderStatus', ['id' => $item->id])}}" method="post">
                {{ csrf_field() }}
            </form>
            
            <a class="btn btn-warning" href="{{ route('orders.getSendNotificationToUserPage', ['id' => $item->id, 'notification_type' => 'sms']) }}">Send SMS</a>
            <a class="btn btn-warning" href="{{ route('orders.getSendNotificationToUserPage', ['id' => $item->id, 'notification_type' => 'mail']) }}">Send Email</a>

            {{-- <form id="send-sms-form" class="hidden" action="{{route('orders.sendNotificationToUser', ['id' => $item->id])}}" method="post">
              {{ csrf_field() }}
          </form> --}}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="text-center">{{ $orders->links() }}</div>

@endsection