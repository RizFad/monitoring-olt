<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<div class="sidebar">

    <h5 class="mb-4 fw-bold">DEVICE NOC</h5>

    <a href="<?= base_url('olt') ?>"
       class="<?= ($this->uri->segment(1)=='olt')?'active':'' ?>">
        <i class="bi bi-hdd-network me-2"></i>
        OLT List
    </a>

    <a href="<?= base_url('onu') ?>"
       class="<?= ($this->uri->segment(1)=='onu')?'active':'' ?>">
        <i class="bi bi-router me-2"></i>
        ONU List
    </a>

</div>

<div class="main-content">
