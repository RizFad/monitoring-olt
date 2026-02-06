<!DOCTYPE html>
<html>
<head>
    <title>Monitoring NOC</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body{
            margin:0;
            background:#f5f6fa;
            overflow-x:hidden;
        }

        /* ===== SIDEBAR ===== */
        .sidebar{
            position:fixed;
            left:0;
            top:0;
            bottom:0;
            width:220px;
            background:linear-gradient(180deg,#4a00e0,#8e2de2);
            color:#fff;
            padding:20px;
            z-index:10;
        }

        .sidebar a{
            display:block;
            color:#fff;
            text-decoration:none;
            padding:10px 12px;
            border-radius:6px;
            margin-bottom:5px;
        }

        .sidebar a.active,
        .sidebar a:hover{
            background:rgba(255,255,255,0.15);
        }

        /* ===== CONTENT AREA ===== */
        .content-wrapper{
            margin-left:220px;
            min-height:100vh;
        }

        /* ===== HEADER (CONTENT ONLY) ===== */
        .content-header{
            height:60px;
            background:#fff;
            border-bottom:1px solid #eee;
            display:flex;
            align-items:center;
            padding:0 25px;
        }

        .menu-link{
            margin-right:25px;
            text-decoration:none;
            color:#666;
            font-weight:500;
            padding-bottom:15px;
        }

        .menu-link.active{
            color:#6f42c1;
            border-bottom:3px solid #6f42c1;
        }

        /* ===== MAIN CONTENT ===== */
        .main-content{
            padding:25px;
        }
    </style>
</head>

<body>

<?php $this->load->view('layout/sidebar'); ?>

<div class="content-wrapper">

    <?php $this->load->view('layout/header'); ?>

    <div class="main-content">
        <?= $content ?>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
