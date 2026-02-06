<?php $this->load->view('layout/header'); ?>
<?php $this->load->view('layout/sidebar'); ?>

<style>
.detail-card{
    background:#fff;
    border-radius:14px;
    padding:22px;
    box-shadow:0 2px 10px rgba(0,0,0,.05);
    margin-bottom:20px;
}
.network-box{
    background:#f8f9fc;
    border-radius:12px;
    padding:15px;
}
.network-diagram{
    text-align:center;
    padding:40px 0;
}
.device-info td{
    padding:8px 5px;
    border-bottom:1px solid #eee;
}
.gpon-box{
    text-align:center;
}
.gauge{
    font-size:22px;
    font-weight:bold;
}
</style>

<div class="main-content">

<h4 class="mb-4">ONU Detail</h4>

<div class="row">

<!-- LEFT -->
<div class="col-md-8">

<div class="detail-card network-diagram">

    <img id="onuImage"
     src="<?= base_url('assets/onu.png') ?>"
     style="max-width:100%;height:220px;cursor:pointer">


    <div class="mt-3">
        <span id="status" class="badge bg-success">Online</span>
        <div class="text-muted small" id="uptime"></div>
    </div>

</div>

<div class="detail-card">
<h6>Network</h6>

<div class="network-box mt-3">
IP Address : <b id="ip"></b><br>
Gateway : <b id="gateway"></b><br>
DNS : <b id="dns"></b>
</div>

</div>

<div class="detail-card">
<h6>Wi-Fi</h6>

<div class="network-box mt-3">
SSID : <b id="ssid"></b><br>
Password : ********
</div>

</div>

</div>

<!-- RIGHT -->
<div class="col-md-4">

<div class="detail-card gpon-box">
    <h6>GPON</h6>

    <div class="position-relative text-center">

        <img id="gponImage"
     src="<?= base_url('assets/gpon.png') ?>"
     style="width:220px">


        <!-- RX value overlay -->
        <div style="
            position:absolute;
            top:55%;
            left:50%;
            transform:translate(-50%,-50%);
            font-weight:bold;
            font-size:18px;">
            
        </div>

    </div>

    <div class="mt-3 text-center">
        Registration : <span class="text-success">Success</span><br>
        RX : <b id="rx"></b><br>
        TX : <b id="tx"></b>
    </div>
</div>


<div class="detail-card">
<h6>Device Info</h6>

<table class="table table-sm device-info">
<tr><td>OLT</td><td id="olt"></td></tr>
<tr><td>Description</td><td id="description"></td></tr>
<tr><td>SN</td><td id="sn"></td></tr>
<tr><td>MAC</td><td id="mac"></td></tr>
<tr><td>Vendor</td><td id="vendor"></td></tr>
</table>

</div>

</div>

</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function(){

    let id = <?= $id ?>;

    function setImages(status)
    {
        if(status=='online'){
            $("#onuImage").attr("src","<?= base_url('assets/onu.png') ?>");
            $("#gponImage").attr("src","<?= base_url('assets/gpon.png') ?>");
            $("#status").removeClass('bg-danger').addClass('bg-success').text('Online');
        }else{
            $("#onuImage").attr("src","<?= base_url('assets/offline.png') ?>");
            $("#gponImage").attr("src","<?= base_url('assets/gponoff.png') ?>");
            $("#status").removeClass('bg-success').addClass('bg-danger').text('Offline');
        }
    }

    /* LOAD DATA */
    $.get("<?= base_url('api/onu/show/') ?>"+id,function(res){

        let d = JSON.parse(res);

        $("#status").text(d.status);
        $("#uptime").text("Last Up : "+d.last_up_time);

        $("#rx").text(d.rx+" dBm");
        $("#tx").text(d.tx+" dBm");

        $("#ip").text(d.ip_address ?? '-');
        $("#gateway").text(d.gateway ?? '-');
        $("#dns").text(d.dns ?? '-');

        $("#ssid").text(d.wifi_name ?? '-');

        $("#olt").text(d.olt_name);
        $("#description").text(d.description);
        $("#sn").text(d.sn);
        $("#mac").text(d.mac);
        $("#vendor").text(d.vendor_model);

        /* penting */
        setImages(d.status);

    });

    /* CLICK IMAGE TO TOGGLE */
    $("#onuImage").click(function(){

        $.get("<?= base_url('api/onu/toggle_status/') ?>"+id,function(res){
            let r = JSON.parse(res);
            setImages(r.status);
        });

    });

});
</script>

<?php $this->load->view('layout/footer'); ?>
