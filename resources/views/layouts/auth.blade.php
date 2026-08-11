<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Login') - Dashboard Sekolah</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

<style>
  :root{
    --brand-blue: #17A2B8;
    --fb-blue:    #3b5998;
    --google-red: #dd4b39;
  }
  body{ background:#222a35; min-height:100vh; }
  .login-page{ min-height:100vh; display:flex; align-items:center; justify-content:center; padding:2rem 1rem; }
  .login-logo{ text-align:center; margin-bottom:1.2rem; }
  .login-logo a{ color:#e9ecef; font-size:1.6rem; font-weight:600; text-decoration:none; }
  .login-logo i{ color:var(--brand-blue); margin-right:.4rem; }
  .login-box{ width:380px; }
  .card-dark{ background:#2c3440; border:1px solid #3c4655; border-radius:6px; }
  .card-body{ padding:1.75rem 1.6rem; }
  .panel-title{ color:#c9ced6; text-align:center; font-size:.95rem; margin-bottom:1.2rem; }
  .input-group .form-control{ background:transparent; border:1px solid #4a5568; border-right:0; color:#e9ecef; height:calc(2.5rem + 2px); }
  .input-group .form-control::placeholder{ color:#8b93a1; }
  .input-group .form-control:focus{ background:transparent; color:#fff; box-shadow:none; border-color:var(--brand-blue); }
  .input-group-text{ background:transparent; border:1px solid #4a5568; border-left:0; color:#8b93a1; }
  .input-group:focus-within .input-group-text{ border-color:var(--brand-blue); }
  .custom-control-label{ color:#c9ced6; font-size:.85rem; }
  .custom-control-label a{ color:#7eb6ff; }
  .btn-brand{ background:var(--brand-blue); border-color:var(--brand-blue); font-weight:600; }
  .btn-brand:hover{ background:#128394; border-color:#128394; }
  .btn-facebook{ background:var(--fb-blue); border-color:var(--fb-blue); color:#fff; text-align:left; font-weight:500; }
  .btn-facebook:hover{ color:#fff; opacity:.92; }
  .btn-google{ background:var(--google-red); border-color:var(--google-red); color:#fff; text-align:left; font-weight:500; }
  .btn-google:hover{ color:#fff; opacity:.92; }
  .btn-facebook i, .btn-google i{ background:#fff; border-radius:50%; width:22px; height:22px; display:inline-flex; align-items:center; justify-content:center; font-size:.7rem; margin-right:.6rem; }
  .btn-facebook i{ color:var(--fb-blue); }
  .btn-google i{ color:var(--google-red); }
  .or-divider{ text-align:center; color:#8b93a1; font-size:.8rem; margin:.9rem 0; }
  .foot-links{ margin-top:.9rem; }
  .foot-links a{ display:block; color:#7eb6ff; font-size:.82rem; text-decoration:underline; margin-bottom:.35rem; }
</style>
@stack('css')
</head>
<body>

<div class="login-page">
<div class="login-box">

  <div class="login-logo">
    <a href="{{ url('/') }}"><i class="fas fa-graduation-cap"></i>Dashboard Sekolah</a>
  </div>

  <div class="card card-dark">
    <div class="card-body">
      @yield('content')
    </div>
  </div>

</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
@stack('js')
</body>
</html>