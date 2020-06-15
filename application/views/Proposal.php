<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    	$this->load->view("admin/_partials/head.php") 
	?>
	<style>
		#btnMenu{
			float:right;
		}
	</style>
<script src="<?php echo base_url('assets/jquery/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js') ?>"></script>
</head>
<script>
	$(document).ready(function() {

	});

 function getNomer(){
			var tanggal = document.getElementById("tanggal");
			var departemen = document.getElementById("department");
			// var kodeJobinti = elemenId1.options[elemenId1.selectedIndex].text;
			var tanggalValue =tanggal.value;
			var departemenValue =departemen.value;
			console.log(tanggalValue);
			console.log(departemenValue);
			// console.log(elemenId1);
			$.ajax({
				type:'POST',
				url:"<?php echo site_url('Proposal/generateNomor');?>",
				data:{
					tanggalVal:tanggalValue,
					departemenVal:departemenValue
				},
				success:function(response){
					document.getElementById("nomor_proposal").value=response;
					$("#nomor_proposal").val(response);
				}
			})	
      };
</script>

<body id="page-top">

    <?php
    //  $this->load->view("admin/_partials/navbar.php") 
     ?>
	<div id="wrapper">
        <?php
        //  $this->load->view("admin/_partials/sidebar.php") 
        ?>
		<div id="content-wrapper">
			<div class="container-fluid">
				<?php $this->load->view("admin/_partials/breadcrumb.php") ?>
				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>

				<div class="card mb-3">
					<div class="card-header">
					<form action="<?php echo site_url('Menu/index') ?>" method="post" enctype="multipart/form-data" >  
						<div class="card-footer small text-muted">
					</div>
                            <input class="btn btn-warning" type="submit" name="btnMenu" id="btnMenu" value="Back to menu" />
				
					</form>
                    <a href="
                        <?php 
                        // echo site_url('admin/products/') 
                        ?>">
                        <!-- <i class="fas fa-arrow-left"></i> Back -->
                    </a>
					</div>
					<div class="card-body">
                        <H1>PROPOSAL</h1>
                        <form action="<?php echo site_url('Proposal/gotoaddBarang') ?>" method="post" enctype="multipart/form-data" >  
					<div class="card-footer small text-muted">
						* required fields
					</div>
							<div class="form-group">
								<label for="name">Pabrik*</label>
								<select name="pabrik" class="form-control">
										<option value="">Pilih Pabrik</option>
										<option value="TG - 1; UNIT - 1">TG - 1 UNIT - 1</option>
										<option value="TG - 1; UNIT - 2">TG - 1 UNIT - 2</option>
										<option value="TG - 1; UNIT - 3">TG - 1 UNIT - 3</option>		
								</select>
								<div class="invalid-feedback">
									<?php echo form_error('name') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="price">Tanggal*</label>
								<input onchange='getNomer(this.val);' class="form-control <?php echo form_error('price') ? 'is-invalid':'' ?> "
								 type="date" name="tanggal" id="tanggal"/>
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="price">Department*</label>
								<select name="department" class="form-control" id="department" onchange='getNomer(this.val);'>
									<option value="">Pilih Departemen</option>
									<?php foreach($Departemen as $each){ ?>
										<option value="<?php echo $each->kode_departemen; ?>"><?php echo $each->nama_departemen; ?></option>';
									<?php } ?>
								</select>
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
                            </div>
							<div class="form-group">
								<label for="price">Nomor*</label>
								<input disabled class="form-control <?php echo form_error('price') ? 'is-invalid':'' ?>"
								 type="text" id="nomor_proposal" name="nomor_proposal" placeholder="" />
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
                            </div>
							<div class="form-group">
								<label for="name">Jenis*</label>
								<select name="jenis" class="form-control">
										<option value="">Pilih Jenis Proposal</option>
										<option value="Pemakaian">Pemakaian</option>
										<option value="Perbaikan">Perbaikan</option>
										<option value="Pengadaan">Pengadaan/Stok</option>
										<option value="Investasi">Investasi</option>
										<option value="Penyempurnaan">Penyempurnaan</option>
										<option value="Penggantian">Penggantian</option>	
										
								</select>
								<div class="invalid-feedback">
									<?php echo form_error('name') ?>
								</div>
							</div>
							<div class="form-group">
								<label for="price">Keperluan*</label>
								<input class="form-control <?php echo form_error('price') ? 'is-invalid':'' ?>"
								 type="text" name="kepentingan" placeholder="Kepentingan Proposal" />
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
                            </div>
							<div class="form-group">
								<label for="lokasi">Lokasi*</label>
								<input class="form-control <?php echo form_error('price') ? 'is-invalid':'' ?>"
								 type="text" name="lokasi" placeholder="Lokasi" />
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
                            </div>							
                            <div class="form-group">
								<label for="price">Pertimbangan & Manfaat*</label>
								<input class="form-control <?php echo form_error('price') ? 'is-invalid':'' ?>"
								 type="text" name="pertimbangan" placeholder="Maximum 300 Karakter" />
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
                            </div>
                            <div class="form-group">
								<label for="price">Keadaan*</label>
								<select name="keadaan" class="form-control">
										<option value="">Pilih Keadaan</option>
										<option value="Sudah Dikerjakan">Sudah Dikerjakan</option>
										<option value="Very Urgent">Very Urgent</option>
										<option value="Urgent">Urgent</option>
										<option value="Normal">Normal</option>
								</select>	
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
                            </div>
	
                            <!-- <div class="form-group">
								<label for="price">Disetujui Oleh*</label>
								<input disabled class="form-control <?php echo form_error('price') ? 'is-invalid':'' ?>"
								 type="text" name="disetujui" value="Pak Antony" />
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
                            </div>
                            <div class="form-group">
								<label for="price">Diketahui Oleh*</label>
								<input disabled x`	class="form-control <?php echo form_error('price') ? 'is-invalid':'' ?>"
								 type="text" name="diketahui" value="Manajemen PPIC" />
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
							</div> -->
                            <div class="form-group">
								<label for="price">Diajukan Oleh*</label>
								<input class="form-control <?php echo form_error('price') ? 'is-invalid':'' ?>"
								 type="text" name="diajukan" placeholder="Nama Yang Mengajukan" />
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
							</div>
							<!-- <div class="form-group">
								<label for="name">Photo</label>
								<input class="form-control-file <?php echo form_error('price') ? 'is-invalid':'' ?>"
								 type="file" name="image" />
								<div class="invalid-feedback">
									<?php echo form_error('image') ?>
								</div>
							</div> -->

							<input class="btn btn-success" type="submit" name="btn" value="Next" />
						</form>

					</div>
				</div>
				<!-- /.container-fluid -->
				<!-- Sticky Footer -->
                <?php 
                // $this->load->view("admin/_partials/footer.php")
                 ?>
			</div>
			<!-- /.content-wrapper -->

		</div>
		<!-- /#wrapper -->


		<?php $this->load->view("admin/_partials/scrolltop.php") ?>

		<?php $this->load->view("admin/_partials/js.php") ?>

</body>

</html>