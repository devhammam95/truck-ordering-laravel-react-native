@extends('admin.layouts.app')
@section('content')
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">user Sender</th>
        <th scope="col">Order Status</th>
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
        <td>{{$item->size}}</td>
        <td>{{$item->weight}}</td>
        <td>{{$item->location}}</td>
        <td>{{$item->created_at->format('Y-m-d h:i:s')}}</td>
        <td>
            
            @if($item->status == 'pending')
            <button class="btn btn-info">
                Change to in progress
            </button>
            @elseif($item->status == 'inprogress')
            <button class="btn btn-success">
                Change to delivered
            </button>
            @endif
            
            <button class="btn btn-warning">Send SMS</button>
            <button class="btn btn-primary">Send Email</button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <div class="text-center">{{ $orders->links() }}</div>

@endsection