@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                      <table class="table table-bordered" id="admin-view" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Order_id</th>
               
               
              </tr>
            </thead>
            <tbody>
              @foreach($order as $value)
              <tr>
                <td>{{$value->id}}</td>
               
               
              </tr>
              @endforeach
            </tbody>
          </table>
            </div>
        </div>
    </div>
</div>
@endsection