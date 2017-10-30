<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <style type="text/css">
         #id{

         }
      </style>
   </head>
   <body>
      <div id="app">
      <nav class="navbar navbar-default navbar-static-top">
         <div class="container">
            <div class="navbar-header">
               <!-- Collapsed Hamburger -->
               <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
               <span class="sr-only">Toggle Navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               </button>
               <!-- Branding Image -->
               <a class="navbar-brand" href="{{ url('/') }}">
               {{ config('app.name', 'Laravel') }}
               </a>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
               <!-- Left Side Of Navbar -->
               <ul class="nav navbar-nav">
                  &nbsp;
               </ul>
            </div>
         </div>
      </nav>
      <div class="container">
         <div class="row">
               <div class="col-md-8 col-md-offset-2">
                  <div class="panel panel-default">
                     <div class="panel-heading">Label
                         <a href="{{route('order')}}" class="btn btn-info">Schedule Pickup</a>
                     </div>
                     <div class="panel-body">
                        <div class="form-group">
                           <div class="col-md">
                              <img src="{{$label}}"  id="image" height="600" width="500">
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-md-4">
                              <form action="{{route('printLabel')}}" method="POST">
                                 {{csrf_field()}}
                                 <div class="form-group">
                                    <input type="hidden" name="label" value="{{$label}}">
                                    <div class="col-md-8 col-md-offset-4">
                                       <button type="submit" class="btn btn-primary">
                                       Print Label
                                       </button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                           <div class="col-md-4">
                              <form action="{{route('createOrder')}}" method="POST">
                                 {{csrf_field()}}
                                 <div class="form-group">
                                    <input type="hidden" name="to_address" value="{{json_encode($to_address_params)}}">
                                    <input type="hidden" name="from_address" value="{{json_encode($from_address_params)}}">
                                    <input type="hidden" name="shipment_id" value="{{$shipment_id}}">
                                    <div class="col-md-8 col-md-offset-4">
                                       <button type="submit" class="btn btn-primary">
                                       Create Order
                                       </button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Scripts -->
   </body>
</html>