<?php $this->load->view('layout/header'); ?>
<?php $this->load->view('layout/sidebar'); ?>

<h3>ONU Form</h3>

<form method="post" action="<?= isset($onu)?base_url('onu/update/'.$onu->id):base_url('onu/store') ?>">

<div class="mb-2">
<label>Description</label>
<input type="text" name="description" class="form-control" value="<?= $onu->description ?? '' ?>">
</div>

<div class="mb-2">
<label>OLT</label>
<select name="olt_id" class="form-control">
<?php foreach($olt as $o){ ?>
<option value="<?= $o->id ?>" <?= isset($onu)&&$onu->olt_id==$o->id?'selected':'' ?>>
<?= $o->description ?>
</option>
<?php } ?>
</select>
</div>

<button class="btn btn-primary">Save</button>

</form>

<?php $this->load->view('layout/footer'); ?>
