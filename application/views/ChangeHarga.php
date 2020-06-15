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

    function getHarga(){
                var idBarang = document.getElementById("nama");
    
                // var kodeJobinti = elemenId1.options[elemenId1.selectedIndex].text;
                var barangValue =idBarang.value;
         
                console.log(barangValue);
                // console.log(elemenId1);
                $.ajax({
                    type:'POST',
                    url:"<?php echo site_url('MasterBarang/showHarga');?>",
                    data:{
                        idBarang:barangValue
                    },
                    success:function(response){
          
                        $("#price").html(response);
                    }
                })	
        };

		function getBarang(){
			var departemen = document.getElementById("department");
			var departemenValue =departemen.value;
			var status = document.getElementById("status");
			var statusValue =status.value;

			// console.log(elemenId1);
			$.ajax({
				type:'POST',
				url:"<?php echo site_url('MasterBarang/showBarang');?>",
				data:{
					idBarang:departemenValue,
					idStatus:statusValue
				},
				success:function(msg){
					var options=msg;
    	            $('#nama').html(options);
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
                        <H1>CHANGE HARGA BARANG</h1>
                        <form action="<?php echo site_url('MasterBarang/changeHargaPenetapan') ?>" method="post" enctype="multipart/form-data" >  
					<div class="card-footer small text-muted">
						* required fields
					</div>
							<div class="form-group">
								<label for="price">Department*</label>
								<select name="department" class="form-control" id="department" onchange='getBarang(this.val);'>
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
								<label for="price">Status*</label>
								<select name="status" class="form-control" id="status" onchange='getBarang(this.val);'>
									<option value="0">Pilih Status</option>
									<option value="1">Sudah Ditetapkan</option>
									<option value="2">Direject</option>
								</select>
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
                            </div>
                            <div class="form-group">
								<label for="name">Nama Barang*</label>
								<select name="nama" class="form-control" id="nama" onchange='getHarga(this.val);'>
                                        <option>Pilih Departemen terlebih dahulu</option>
								</select>
							</div>
						
                            <label id="price" name="price">Harga Yang Disetujui sekarang: </label>
                            <div class="form-group">
								<label for="price">Request Perubahan Harga Penetapan*</label>
								<input class="form-control"
								 type="number" name="harga_penetapan" id="tanggal"/>
								<div class="invalid-feedback">
								</div>
							</div>					
							<input class="btn btn-success" type="submit" name="btn" value="Request" />
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