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

      <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>

      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      
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
                  <div class="panel-heading">Create Label</div>
                  <div class="panel-body">
                     <form class="form-horizontal" id="create-label" method="POST" action="/get-label">
                        {{ csrf_field() }}
                        <div class="form-group">
                           <label for="address" class="col-md-4 control-label">Name</label>
                           <div class="col-md-6">
                              <input id="name" type="text" class="form-control" name="Name">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="address" class="col-md-4 control-label">Address</label>
                           <div class="col-md-6">
                              <input id="address" type="text" class="form-control" name="Address">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="city" class="col-md-4 control-label">City</label>
                           <div class="col-md-6">
                              <input id="city" type="text" class="form-control" name="City">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="state" class="col-md-4 control-label">State</label>
                           <div class="col-md-6">
                              <select class="" name="State" >
                                 <option>None</option>
                                 <option value="AL" >Alabama</option>
                                 <option value="AK" >Alaska</option>
                                 <option value="AZ" >Arizona</option>
                                 <option value="AR" >Arkansas</option>
                                 <option value="CA" >California</option>
                                 <option value="CO" >Colorado</option>
                                 <option value="CT" >Connecticut</option>
                                 <option value="DE" >Delaware</option>
                                 <option value="FL" >Florida</option>
                                 <option value="GA" >Georgia</option>
                                 <option value="HI" >Hawaii</option>
                                 <option value="ID" >Idaho</option>
                                 <option value="IL" >Illinois</option>
                                 <option value="IN" >Indiana</option>
                                 <option value="IA" >Iowa</option>
                                 <option value="KS" >Kansas</option>
                                 <option value="KY" >Kentucky</option>
                                 <option value="LA" >Louisiana</option>
                                 <option value="ME" >Maine</option>
                                 <option value="MD" >Maryland</option>
                                 <option value="MA" >Massachusetts</option>
                                 <option value="MI" >Michigan</option>
                                 <option value="MN" >Minnesota</option>
                                 <option value="MS" >Mississippi</option>
                                 <option value="MO" >Missouri</option>
                                 <option value="MT" >Montana</option>
                                 <option value="NE" >Nebraska</option>
                                 <option value="NV" >Nevada</option>
                                 <option value="NH" >New Hampshire</option>
                                 <option value="NJ" >New Jersey</option>
                                 <option value="NM" >New Mexico</option>
                                 <option value="NY" >New York</option>
                                 <option value="NC" >North Carolina</option>
                                 <option value="ND" >North Dakota</option>
                                 <option value="OH" >Ohio</option>
                                 <option value="OK" >Oklahoma</option>
                                 <option value="OR" >Oregon</option>
                                 <option value="PA" >Pennsylvania</option>
                                 <option value="PR" >Puerto Rico</option>
                                 <option value="RI" >Rhode Island</option>
                                 <option value="SC" >South Carolina</option>
                                 <option value="SD" >South Dakota</option>
                                 <option value="TN" >Tennessee</option>
                                 <option value="TX" >Texas</option>
                                 <option value="UT" >Utah</option>
                                 <option value="VT" >Vermont</option>
                                 <option value="VI" >Virgin Islands</option>
                                 <option value="VA" >Virginia</option>
                                 <option value="WA" >Washington</option>
                                 <option value="DC" >Washington DC</option>
                                 <option value="WV" >West Virginia</option>
                                 <option value="WI" >Wisconsin</option>
                                 <option value="WY" >Wyoming</option>
                              </select>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="email" class="col-md-4 control-label">Aprtment</label>
                           <div class="col-md-6">
                              <input id="apt" type="text" class="form-control" name="Apartment">
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="zip" class="col-md-4 control-label">Zip Code</label>
                           <div class="col-md-6">
                              <input id="zip" type="zip" class="form-control" name="Zip">
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-md-8 col-md-offset-4">
                              <button type="submit" class="btn btn-primary">
                              Submit
                              </button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Scripts -->

      <script type="text/javascript">
        $(function()
        {
          $("#create-label").validate(
            {
              rules:
              {

                Name:
                {
                  required:true,
                },
                City:
                {
                  required: true,
                },
                State:
                {
                  required:true,
                },
                Address:
                {
                  required:true,
                },
                Email:
                {
                  required:true,
                },
                Zip:
                {
                  required: true,
                },
              },
          });
        });
      </script>
      
   </body>
</html>