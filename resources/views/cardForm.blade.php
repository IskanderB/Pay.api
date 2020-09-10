<?php

//print_r($data);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Payment</title>
        
        <link href="{{URL::asset('css/app.css')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
        
        <div class="payment_info_wrap">
            <div class="col-lg-4 offset-lg-4 offset-md-3 offset-sm-3 offset-2 payment_info_box col-md-6 col-sm-6 col-8">
                <div class="target_box payment_data">
                    {{$data['target']}}
                </div>
                <div class="amount_box payment_data">
                    <h4>{{$data['amount']}} $</h4>
                </div>
            </div>
        </div>
        
        <div class="wrapper" id="app">
            <card-form-component :data="{{$data}}"></card-form-component>
        </div>
  
    <script src="{{URL::asset('js/app.js')}}"></script>
    </body>
    
</html>

