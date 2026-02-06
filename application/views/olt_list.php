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


.olt-card{
    background:#fff;
    border-radius:10px;
    padding:18px;
    box-shadow:0 2px 8px rgba(0,0,0,0.05);
}

.status-dot{
    display:inline-block;
    width:8px;
    height:8px;
    border-radius:50%;
    margin-right:5px;
}

.dot-online{ background:#1abc9c; }
.dot-offline{ background:#e74c3c; }

.toolbar-btn{
    border:1px solid #ddd;
    border-radius:6px;
    background:#fff;
    padding:5px 8px;
}
.olt-grid-card{
    background:#fff;
    border-radius:10px;
    padding:15px;
    box-shadow:0 2px 6px rgba(0,0,0,0.05);
    margin-bottom:15px;
}

.olt-grid-title{
    font-weight:600;
    margin-bottom:5px;
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
<div class="olt-card">
    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h4 class="mb-1">OLT List</h4>
            <small>
                <span class="status-dot dot-online"></span>
                <span id="onlineCount">0</span>

                <span class="ms-3 status-dot dot-offline"></span>
                <span id="offlineCount">0</span>
            </small>
        </div>

        <button class="btn btn-success" onclick="showAdd()">Add OLT</button>
    </div>

<div class="d-flex justify-content-end mb-2 gap-2">

    <select id="perPage" class="form-select form-select-sm" style="width:120px">
        <option>5</option>
        <option>10</option>
        <option>15</option>
        <option>20</option>
    </select>

<button class="toolbar-btn" onclick="showGrid()">☷</button>
<button class="toolbar-btn" onclick="showList()">☰</button>


</div>

<table class="table align-middle" id="oltTable">

<thead>
<tr>
<th>Description</th>
<th>Group</th>
<th>Model</th>
<th>IP</th>
<th>Firmware</th>
<th>Status</th>
<th>Last Up Time</th>
<th>Action</th>
</tr>
</thead>
<tbody></tbody>
</table>
<div class="row" id="gridView" style="display:none"></div>
<div class="d-flex justify-content-between align-items-center mt-3">
    <div>Total <span id="totalData">0</span></div>
    <div id="pagination" class="text-end"></div>
</div>


<div class="modal fade" id="oltModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">OLT Form</h5>
      </div>

      <div class="modal-body">

        <input type="hidden" id="olt_id">

        <label>Description</label>
        <input type="text" id="description" class="form-control mb-2">

        <label>Group</label>
        <input type="text" id="group_name" class="form-control mb-2">

        <label>Model</label>
        <input type="text" id="model" class="form-control mb-2">

        <label>IP</label>
        <input type="text" id="ip" class="form-control mb-2">

        <label>Firmware</label>
        <input type="text" id="firmware" class="form-control mb-2">

        <label>Status</label>
        <select id="status" class="form-control mb-2">
            <option value="online">Online</option>
            <option value="offline">Offline</option>
        </select>

        <label>Last Up Time</label>
        <input type="datetime-local" id="last_up_time" class="form-control">

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

let editMode = false;
let oltModal = new bootstrap.Modal(document.getElementById('oltModal'));

let currentPage = 1;
let totalData = 0;

function loadData(){

    let limit = $("#perPage").val();

    $.get("<?= base_url('api/olt') ?>?page="+currentPage+"&limit="+limit, function(res){

        let r = JSON.parse(res);

        totalData = r.total;

        $("#onlineCount").text(r.online);
        $("#offlineCount").text(r.offline);
        $("#totalData").text(r.total);

        renderTable(r.data);
        renderGrid(r.data);
        renderPagination();
    });
}


function updateCounter(){
    let online = allData.filter(d=>d.status=='online').length;
    let offline = allData.filter(d=>d.status=='offline').length;

    $("#onlineCount").text(online);
    $("#offlineCount").text(offline);
    $("#totalData").text(allData.length);
}

function renderTable(data){

    let html='';

    data.forEach(d=>{
        html+=`
        <tr>
            <td>${d.description}</td>
            <td>${d.group_name ?? ''}</td>
            <td>${d.model ?? ''}</td>
            <td>${d.ip}</td>
            <td>${d.firmware ?? ''}</td>
            <td>
                <span class="badge ${d.status=='online'?'bg-success':'bg-danger'}">
                    ${d.status}
                </span>
            </td>
            <td>${d.last_up_time ?? ''}</td>
            <td>
                <button class="btn btn-warning btn-sm" onclick="edit(${d.id})">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="del(${d.id})">Delete</button>
            </td>
        </tr>`;
    });

    $("#oltTable tbody").html(html);
}


function renderPagination(){

    let perPage = $("#perPage").val();
    let totalPage = Math.ceil(totalData/perPage);

    let html='';

    for(let i=1;i<=totalPage;i++){
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

function renderGrid(data){

    let html='';

    data.forEach(d=>{
        html+=`
        <div class="col-md-3">
            <div class="olt-grid-card">
                <div class="olt-grid-title">${d.description}</div>
                <div>${d.group_name ?? ''}</div>
                <div>${d.model ?? ''}</div>
                <div>${d.ip}</div>
                <div class="mt-2">
                    <span class="badge ${d.status=='online'?'bg-success':'bg-danger'}">
                        ${d.status}
                    </span>
                </div>
            </div>
        </div>`;
    });

    $("#gridView").html(html);
}


function showGrid(){
    $("#oltTable").hide();
    $("#gridView").show();
    renderGrid();
}

function showList(){
    $("#oltTable").show();
    $("#gridView").hide();
}


function showAdd(){
    editMode=false;
    $("#olt_id").val('');
    $("#description").val('');
    $("#group_name").val('');
    $("#model").val('');
    $("#ip").val('');
    $("#firmware").val('');
    $("#status").val('online');
    $("#last_up_time").val('');
    oltModal.show();
}

function edit(id){
    editMode=true;

    $.get("<?= base_url('api/olt/show/') ?>"+id,function(res){
        let d = JSON.parse(res);

        $("#olt_id").val(d.id);
        $("#description").val(d.description);
        $("#group_name").val(d.group_name);
        $("#model").val(d.model);
        $("#ip").val(d.ip);
        $("#firmware").val(d.firmware);
        $("#status").val(d.status);
        $("#last_up_time").val(d.last_up_time);

        oltModal.show();
    });
}

function save(){

    let id = $("#olt_id").val();

    let url = editMode ?
        "<?= base_url('api/olt/update/') ?>"+id :
        "<?= base_url('api/olt/store') ?>";

    $.post(url,{
        description: $("#description").val(),
        group_name: $("#group_name").val(),
        model: $("#model").val(),
        ip: $("#ip").val(),
        firmware: $("#firmware").val(),
        status: $("#status").val(),
        last_up_time: $("#last_up_time").val()
    },function(){
        oltModal.hide();
        loadData();
    });
}

function del(id){
    if(confirm("Delete?")){
        $.get("<?= base_url('api/olt/delete/') ?>"+id,function(){
            loadData();
        });
    }
}

</script>


<?php $this->load->view('layout/footer'); ?>
