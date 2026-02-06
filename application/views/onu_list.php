<?php
$username = $this->session->userdata('username');
$initial  = strtoupper(substr($username,0,1));
?>
<?php $this->load->view('layout/header'); ?>
<?php $this->load->view('layout/sidebar'); ?>

<style>
    .page-header{
    background:#fff;
    border-radius:10px;
    padding:18px 30px;
    box-shadow:0 2px 8px rgba(0,0,0,0.05);

    display:flex;
    align-items:center;
    justify-content:space-between;
}

.menu-link{
    margin-right:28px;
    text-decoration:none;
    color:#6c757d;
    font-weight:500;
    padding-bottom:18px;
    transition:.2s;
}

.menu-link:hover{
    color:#6f42c1;
}

.menu-link.active{
    color:#6f42c1;
    border-bottom:3px solid #6f42c1;
}
.onu-card{
    background:#fff;
    border-radius:10px;
    padding:18px;
    box-shadow:0 2px 8px rgba(0,0,0,0.05);
}

.status-dot{
    width:8px;
    height:8px;
    border-radius:50%;
    display:inline-block;
    margin-right:5px;
}

.dot-online{ background:#1abc9c; }
.dot-offline{ background:#e74c3c; }

.table thead{
    background:#f6f7fb;
}
</style>

<div class="page-header">

    <div class="d-flex align-items-center">
        <a href="<?= base_url('dashboard') ?>" class="menu-link">Dashboard</a>
        <a href="<?= base_url('olt') ?>" class="menu-link active">Device</a>
        <a href="#" class="menu-link">Alarm</a>
        <a href="#" class="menu-link">Monitor</a>
        <a href="#" class="menu-link">Admin</a>
    </div>

    <div class="dropdown">

    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center dropdown-toggle"
         data-bs-toggle="dropdown"
         style="width:36px;height:36px;font-weight:600;cursor:pointer">
        <?= $initial ?>
    </div>

    <ul class="dropdown-menu dropdown-menu-end">
        <li class="dropdown-item text-muted">
            <?= $username ?>
        </li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <a class="dropdown-item" href="<?= base_url('auth/logout') ?>">
                Logout
            </a>
        </li>
    </ul>

</div>


</div>

<br>
<div class="onu-card">
<div class="d-flex justify-content-between align-items-center mb-3">

    <div>
        <h4 class="mb-1">ONU List</h4>
        <small>
            <span class="status-dot dot-online"></span>
            <span id="onlineCount">0</span>

            <span class="ms-3 status-dot dot-offline"></span>
            <span id="offlineCount">0</span>
        </small>
    </div>

    <button class="btn btn-success" onclick="showAdd()">Add ONU</button>
</div>

<div class="d-flex justify-content-end mb-3 gap-2">
    <select id="perPage" class="form-select form-select-sm" style="width:120px">
        <option>5</option>
        <option>10</option>
        <option>15</option>
        <option>20</option>
    </select>
</div>

<table class="table align-middle" id="onuTable">
<thead>
<tr>
<th>Description</th>
<th>SN/MAC/IP</th>
<th>Group</th>
<th>OLT</th>
<th>Vendor/Model/Firmware</th>
<th>Status</th>
<th>Reason</th>
<th>RX/TX</th>
<th>Last Up Time</th>
<th>Action</th>
</tr>
</thead>
<tbody></tbody>
</table>

<div class="d-flex justify-content-between">
    <div>Total <span id="totalData">0</span></div>
    <div id="pagination"></div>
</div>

</div>


<!-- MODAL -->
<div class="modal fade" id="onuModal">
<div class="modal-dialog modal-lg">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">ONU Form</h5>
</div>

<div class="modal-body">

<input type="hidden" id="id">

<div class="row">

<div class="col-md-6">
<label>OLT</label>
<select id="olt_id" class="form-control mb-2" onchange="fillOltData()"></select>
</div>

<div class="col-md-6">
<label>Description</label>
<input type="text" id="description" class="form-control mb-2">
</div>

<div class="col-md-6">
<label>SN</label>
<input type="text" id="sn" class="form-control mb-2">
</div>

<div class="col-md-6">
<label>MAC</label>
<input type="text" id="mac" class="form-control mb-2">
</div>

<div class="col-md-6">
<label>IP</label>
<input type="text" id="ip" class="form-control mb-2">
</div>

<div class="col-md-6">
<label>Vendor Model</label>
<input type="text" id="vendor_model" class="form-control mb-2">
</div>

<div class="col-md-6">
<label>Firmware</label>
<input type="text" id="firmware" class="form-control mb-2">
</div>

<div class="col-md-6">
<label>Reason</label>
<input type="text" id="reason" class="form-control mb-2">
</div>

<div class="col-md-4">
<label>Status</label>
<select id="status" class="form-control mb-2">
<option value="online">Online</option>
<option value="offline">Offline</option>
</select>
</div>

<div class="col-md-4">
<label>RX</label>
<input type="text" id="rx" class="form-control mb-2">
</div>

<div class="col-md-4">
<label>TX</label>
<input type="text" id="tx" class="form-control mb-2">
</div>

<div class="col-md-12">
<label>Last Up Time</label>
<input type="datetime-local" id="last_up_time" class="form-control">
</div>

<hr>
<h6>ONU Detail</h6>

<div class="col-md-6">
<label>WiFi Name</label>
<input type="text" id="wifi_name" class="form-control mb-2">
</div>

<div class="col-md-6">
<label>WiFi Password</label>
<input type="text" id="wifi_password" class="form-control mb-2">
</div>

<div class="col-md-6">
<label>Gateway</label>
<input type="text" id="gateway" class="form-control mb-2">
</div>

<div class="col-md-6">
<label>DNS</label>
<input type="text" id="dns" class="form-control mb-2">
</div>

<div class="col-md-4">
<label>CPU Usage</label>
<input type="text" id="cpu_usage" class="form-control mb-2">
</div>

<div class="col-md-4">
<label>Memory Usage</label>
<input type="text" id="memory_usage" class="form-control mb-2">
</div>

<div class="col-md-4">
<label>Wireless Clients</label>
<input type="text" id="wireless_clients" class="form-control mb-2">
</div>

<div class="col-md-4">
<label>Wired Clients</label>
<input type="text" id="wired_clients" class="form-control mb-2">
</div>


</div>
</div>


<div class="modal-footer">
<button class="btn btn-primary" onclick="save()">Save</button>
</div>

</div>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>

let editMode=false;
let onuModal = new bootstrap.Modal(document.getElementById('onuModal'));

function loadOLT(){
    $.get("<?= base_url('api/olt/dropdown') ?>",function(res){

        let data = JSON.parse(res);
        let opt='<option value="">Select OLT</option>';

        data.forEach(d=>{
            opt+=`<option value="${d.id}">${d.description} (${d.ip})</option>`;
        });

        $("#olt_id").html(opt);
    });
}


function fillOltData(){
    let id = $("#olt_id").val();
    if(!id) return;

    $.get("<?= base_url('api/olt/show/') ?>"+id,function(res){

        let d = JSON.parse(res);

        if(!d) return;

        $("#ip").val(d.ip || '');
        $("#firmware").val(d.firmware || '');
    });
}



let currentPage=1;
let perPage=5;

function loadData(){

    perPage = $("#perPage").val();

    $.get("<?= base_url('api/onu') ?>?page="+currentPage+"&limit="+perPage,function(res){

        let r = JSON.parse(res);
        let data = r.data;

        $("#totalData").text(r.total);
        $("#onlineCount").text(r.online);
        $("#offlineCount").text(r.offline);

        let html='';

        data.forEach(d=>{
            html+=`
            <tr>
                <td>${d.description}</td>
                <td>${d.sn ?? ''}<br>${d.mac ?? ''}<br>${d.ip ?? ''}</td>
                <td>${d.group_name ?? ''}</td>
                <td>${d.olt_name ?? ''}</td>
                <td>${d.vendor_model ?? ''}<br>${d.firmware ?? ''}</td>
                <td>
                    <span class="badge rounded-pill ${d.status=='online'?'bg-success':'bg-danger'}">
                        ${d.status}
                    </span>
                </td>
                <td>${d.reason ?? ''}</td>
                <td>${d.rx ?? ''} / ${d.tx ?? ''}</td>
                <td>${d.last_up_time ?? ''}</td>
                <td>
                    <button class="btn btn-warning btn-sm" onclick="edit(${d.id})">Edit</button>
                    <button class="btn btn-danger btn-sm" onclick="del(${d.id})">Delete</button>
                    <a href="<?= base_url('onu/detail/') ?>${d.id}" class="btn btn-info btn-sm">Detail</a>
                </td>
            </tr>`;
        });

        $("#onuTable tbody").html(html);

        renderPagination(r.pages);
    });
}

function renderPagination(total){
    let html='';
    for(let i=1;i<=total;i++){
        html+=`<button class="btn btn-sm ${i==currentPage?'btn-primary':'btn-light'} me-1"
                onclick="gotoPage(${i})">${i}</button>`;
    }
    $("#pagination").html(html);
}

function gotoPage(p){
    currentPage=p;
    loadData();
}

$("#perPage").change(function(){
    currentPage=1;
    loadData();
});

loadData();


loadOLT();

function showAdd(){
    editMode=false;
    $("#id").val('');
    onuModal.show();
}

function edit(id){
    editMode=true;
    $.get("<?= base_url('api/onu/show/') ?>"+id,function(res){
        let d = JSON.parse(res);
        $("#id").val(d.id);
        $("#olt_id").val(d.olt_id);
        $("#description").val(d.description);
        $("#sn").val(d.sn);
        $("#mac").val(d.mac);
        $("#vendor_model").val(d.vendor_model);
        $("#status").val(d.status);
        $("#rx").val(d.rx);
        $("#tx").val(d.tx);
        $("#last_up_time").val(d.last_up_time);
        $("#ip").val(d.ip);
        $("#firmware").val(d.firmware);
        onuModal.show();
    });
}

function save(){
    let id=$("#id").val();

    let url = editMode ?
        "<?= base_url('api/onu/update/') ?>"+id :
        "<?= base_url('api/onu/store') ?>";

    $.post(url,{
        olt_id:$("#olt_id").val(),
        description:$("#description").val(),
        sn:$("#sn").val(),
        mac:$("#mac").val(),
        ip:$("#ip").val(),
        vendor_model:$("#vendor_model").val(),
        firmware:$("#firmware").val(),
        reason:$("#reason").val(),
        status:$("#status").val(),
        rx:$("#rx").val(),
        tx:$("#tx").val(),
        last_up_time:$("#last_up_time").val(),

        /* ONU DETAIL */
        wifi_name:$("#wifi_name").val(),
        wifi_password:$("#wifi_password").val(),
        gateway:$("#gateway").val(),
        dns:$("#dns").val(),
        cpu_usage:$("#cpu_usage").val(),
        memory_usage:$("#memory_usage").val(),
        wireless_clients:$("#wireless_clients").val(),
        wired_clients:$("#wired_clients").val()
    },function(){
        onuModal.hide();
        loadData();
    });
}



function del(id){
    if(confirm("Delete?")){
        $.get("<?= base_url('api/onu/delete/') ?>"+id,function(){
            loadData();
        });
    }
}
</script>

<?php $this->load->view('layout/footer'); ?>
