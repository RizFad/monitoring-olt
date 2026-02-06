<!DOCTYPE html>
<html>
<head>
<title>Monitoring OLT</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>
body{
    background:#f5f6fa;
    overflow-x:hidden;
}

/* ===== SIDEBAR ===== */
.sidebar{
    position:fixed;
    top:0;
    left:0;
    bottom:0;
    width:220px;
    background:linear-gradient(180deg,#4a00e0,#8e2de2);
    color:white;
    padding:20px;
}

.sidebar a{
    color:white;
    text-decoration:none;
    display:block;
    padding:10px 12px;
    border-radius:6px;
    margin-bottom:5px;
}

.sidebar a.active,
.sidebar a:hover{
    background:rgba(255,255,255,0.15);
}

/* ===== CONTENT ===== */
.main-content{
    margin-left:220px;
    padding:25px;
}
</style>
</head>

<body>

<script>
$(document).ajaxComplete(function(event, xhr) {
    try{
        let res = JSON.parse(xhr.responseText);
        if(res.error=="Unauthorized"){
            window.location.href="<?= base_url('auth') ?>";
        }
    }catch(e){}
});
</script>
