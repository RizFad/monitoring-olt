<!DOCTYPE html>
<html>
<head>
<title>DEVICE NOC Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body{
    background:#f6f7fb;
    font-family: 'Segoe UI', sans-serif;
}
.login-box{
    height:100vh;
}
.login-form{
    width:350px;
}
.login-btn{
    background:linear-gradient(90deg,#7a6ff0,#5b7cff);
    color:white;
}
.footer-text{
    font-size:12px;
    color:#999;
}
.lang{
    position:absolute;
    right:40px;
    top:20px;
    font-size:13px;
}
</style>
</head>

<body>

<div class="lang">
    <select class="form-select form-select-sm">
        <option>English</option>
        <option>Indonesia</option>
    </select>
</div>

<div class="container-fluid login-box d-flex align-items-center">

<div class="row w-100">

<div class="col-md-7 text-center">
    <img src="<?= base_url('assets/login.png') ?>" style="width:80%">
</div>

<div class="col-md-5 d-flex align-items-center justify-content-center">
<div class="login-form text-center">

<h5 class="mb-2">DEVICE NOC</h5>
<a href="#" style="font-size:13px">Root Login</a>

<form method="post" action="<?= base_url('auth/process') ?>" class="mt-3">

<input type="text" name="username" class="form-control mb-3" placeholder="Username">

<div class="input-group mb-2">
<input type="password" id="password" name="password" class="form-control" placeholder="Password">
<span class="input-group-text" onclick="togglePass()" style="cursor:pointer">
<i class="fa fa-eye"></i>
</span>
</div>

<div class="text-end mb-3">
<a href="#" style="font-size:13px">Forgot Password</a>
</div>

<button class="btn login-btn w-100">
<i class="fa fa-sign-in-alt"></i> Login
</button>

</form>

<div class="footer-text mt-5">
All Copyright reserved © 2009-2026 BHIMA  
<a href="#">Privacy Policy</a>
</div>

</div>
</div>

</div>

</div>

<script>
function togglePass(){
    let p=document.getElementById("password");
    p.type = p.type==="password" ? "text":"password";
}
</script>

</body>
</html>
