<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="" name="keywords">
<meta content="" name="description">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Komens') }}</title>

<!-- Favicon -->
<link href="{{ asset('img/kms/favicon.png') }}" rel="icon" type="image/png">

<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&amp;family=Open+Sans:wght@400;500&amp;display=swap" rel="stylesheet">
<link id="googleFonts" href="{{asset('css/kms/css.css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap')}}" rel="stylesheet" type="text/css">

<!-- Icon Font Stylesheet -->
<link href="{{ asset('cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('cdn.jsdelivr.net/npm/bootstrap-icons%401.4.1/font/bootstrap-icons.css') }}" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="{{ asset('css/kms/bootstrap.min.css') }}" rel="stylesheet">

<!-- Font Awesome v4.7.0 -->
<link href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Template Stylesheet -->
<link href="{{ asset('css/kms/style.css') }}" rel="stylesheet">

<style>

.card2, .owl-item {
  transition: all 1s ease-out;
  -webkit-backface-visibility: hidden;
  -webkit-transform: translateZ(0) scale(1, 1);
}

.owl-wrapper {
  position: relative;
  width: 100%;
  margin: 0;
  padding: 0;
}

.cards {
  position: relative;
  width: 100%;
  padding: 4em 0;
  /* background-color: #fefefe; */
}

.card2 {
  display: flex;
  justify-content: center;
  height: 19em;
  padding: 1em;
  margin: 1em 0;
  border-radius: 4px;
  opacity: 0.7;
  transform: scale(0.87);
  transition: transform 0.4s 0.5s ease-out, opacity 1s ease;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
  background-color: #fefefe;
}
.active .card2 {
  box-shadow: 0 0px 1em rgba(0, 0, 0, 0.2);
  transform: box-shadow 0.3s ease, transform 0.1s 0.4s ease-in, opacity 0.4s ease;
}
.card__content {
  display: flex;
  align-items: center;
  text-align: center;
  color: #fff;
  opacity: 1;
}
.active .card__content {
  opacity: 1;
  transition: opacity 0.4s ease;
}
.card__title {
  display: inline-block;
  overflow: hidden;
}
.card__title span {
  display: inline-block;
  animation: slide-up 0.4s 0s ease both;
}
.center.active .card__title span, .center.active.cloned:last-child .card__title span {
  opacity: 1;
  animation: slide-down 0.4s 0.4s ease both;
  transition: transform 0.3s 0.4s ease, opacity 0.3s ease;
}
.center .card2 {
  opacity: 1;
  transform: scale(1);
}
.center .card2:hover {
  box-shadow: 0 8px 16px -5px rgba(0, 0, 0, 0.4);
}

@keyframes slide-down {
  0% {
    opacity: 0;
    transform: translate3d(0, -120%, 0);
  }
  100% {
    opacity: 1;
    transform: translate3d(0, 0%, 0);
  }
}
@keyframes slide-up {
  0% {
    opacity: 1;
    transform: translate3d(0, 0%, 0);
  }
  100% {
    opacity: 0;
    transform: translate3d(0, -120%, 0);
  }
}

video::-internal-media-controls-download-button {
    display:none !important;
}

video::-webkit-media-controls-enclosure {
    overflow:hidden !important;
}

video::-webkit-media-controls-panel {
    width: calc(100% + 30px) !important; /* Adjust as needed */
}
</style>