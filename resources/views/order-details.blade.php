@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                  <div class="log_inner text-center">
                    @if(Session::has('error'))
                    <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>{!! Session::get('error') !!}</strong>
                    </div>
                    @endif
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>{!! Session::get('success') !!}</strong>
                    </div>
                    @endif
                  </div>

                  <?php
                  Session::forget('error');
                  Session::forget('success');
                  ?>
                  <table class="table table-bordered" id="admin-view" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Order_id</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($orders as $value)
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