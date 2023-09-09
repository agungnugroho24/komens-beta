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
      <div class="wrap-login100">
        <div class="login100-pic js-tilt">
          <img class="img-home" src="{{ CSIRTHelper::csirt_asset('assets/front-office/assets/img/logo-csirt-new.png') }}" alt="IMG">
        </div>

        <div class="login100-form validate-form">
          <div class="login100-form-title">
            You are logged in!
          </div>          
          <div class="container-login100-form-btn">
            <a href="{{ route('dashboard') }}">
              <button style="width:200px;margin-bottom:10px;"  class="login100-form-btn-3">
                <img width="35" src="{{ CSIRTHelper::csirt_asset('img/Bo1putih.png') }}">&nbsp;Back Office
              </button>
            </a>
          </div>
          
          <div class="container-login100-form-btn">
            <!--<a href="{{ route('login.sso') }}">-->
              <button style="width:200px;" class="login100-form-btn-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <img width="35" src="{{ CSIRTHelper::csirt_asset('img/logout.png') }}">&nbsp;Logout
              </button>
            <!--</a>-->
            <form id="logout-form" action="{{ route('logout.sso') }}" method="POST" class="d-none">
                @csrf
            </form>            
          </div>          
        </div>
      </div>
    </div>
  </div>
</body>

</html>