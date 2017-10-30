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
                <th>Mode</th>
                <td>Order_date</td>
                <td>Track</td>
               
               
              </tr>
            </thead>
            <tbody>
              @foreach($order as $value)
              <tr>
                <td id="order_id">{{$value->id}}</td>
                <td>{{$value->mode}}</td>
                <td>{{$value->created_at}}</td>
                 <td>
                  <button type="button" class="btn btn-primary" id="details" onclick="return show('{{$value->id}}')">Details </button>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
   function show(row_value) {
    var row_data = row_value;
        alert("Order Deatils of "+ row_data+" is under construction.");
    
}; 
</script>
@endsection