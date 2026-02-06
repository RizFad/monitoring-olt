<?php $this->load->view('layout/header'); ?>
<?php $this->load->view('layout/sidebar'); ?>

<h3>OLT Form</h3>

<form method="post" action="<?= isset($olt)?base_url('olt/update/'.$olt->id):base_url('olt/store') ?>">

<div class="mb-2">
<label>Description</label>
<input type="text" name="description" class="form-control" value="<?= $olt->description ?? '' ?>">
</div>

<div class="mb-2">
<label>IP</label>
<input type="text" name="ip" class="form-control" value="<?= $olt->ip ?? '' ?>">
</div>

<div class="mb-2">
<label>Model</label>
<input type="text" name="model" class="form-control" value="<?= $olt->model ?? '' ?>">
</div>

<button class="btn btn-primary">Save</button>
</form>

<?php $this->load->view('layout/footer'); ?>
