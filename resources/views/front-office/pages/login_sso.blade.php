<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
</head>

<body>
<x-css-page-form-login-front-office/>

<div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100-2">
        <div class="login100-pic js-tilt">
          <img src="{{ CSIRTHelper::csirt_asset('assets/front-office/assets/img/rocket-login.png') }}" alt="IMG">
        </div>

        <div class="login100-form validate-form">
          <div class="login100-form-title">
            Single Sign-On Bappenas
          </div>          
          <div class="container-login100-form-btn">
            <a href="{{ route('login.sso') }}">
              <button style="width:200px;margin-bottom:10px;" class="login100-form-btn">
                <img width="55" src="{{CSIRTHelper::csirt_asset('img/password.png')}}">&nbsp; Login 
              </button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>