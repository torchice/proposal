<!DOCTYPE html>
<html lang="en">

<head>
	<?php 
	if(!isset($_SESSION["nomor_proposal"])){
		redirect('Proposal'); 
	} 
    $this->load->view("admin/_partials/head.php") 
	?>
	<script src="<?php echo base_url('assets/jquery/jquery.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js') ?>"></script>
</head>
<script>
	$(document).ready(function() {
	
		
	});
	//fungsi untuk mengkalikan jumlah dan 
	function timesqty(){
		var inputanQty = document.getElementById("jumlah").value;
		var hargaPcs = document.getElementById("inputanHarga").value;
		var jumlah = inputanQty * hargaPcs;
		var hasiltext = document.getElementById("total_perkiraan_biaya").innerHTML = "Total Biaya yang diajukan " + jumlah;
		// hiddenBiayaTotal
		$("#hiddenBiayaTotal").val(jumlah);
	}
	function myKeyup(){
		var inputanHarga=  parseInt($("#inputanHarga").val());
		var perkiraanBiaya = parseInt($("#hiddenBiayaPcs").val());
		var myNewTitle = document.getElementById("inputanHarga").value;
		
		var title = document.getElementById('typing');
   		title.innerHTML = number_format(myNewTitle, 2, ',', '.' );
		   timesqty();
		if(inputanHarga>  perkiraanBiaya){
			alert("Harga melebihi perkiraan");
			$('#inputanHarga').val('');
			title.innerHTML ="";
		}
	
		console.log(inputanHarga);
		console.log(perkiraanBiaya);
	}

	function number_format(number, decimals, decPoint, thousandsSep){
		decimals = decimals || 0;
		number = parseFloat(number);

		if(!decPoint || !thousandsSep){
			decPoint = '.';
			thousandsSep = '.';
		}
		
		var roundedNumber = Math.round( Math.abs( number ) * ('1e' + decimals) ) + '';
		var numbersString = decimals ? roundedNumber.slice(0, decimals * -1) : roundedNumber;
		var decimalsString = decimals ? roundedNumber.slice(decimals * -1) : '';
		var formattedNumber = "";

		while(numbersString.length > 3){
			formattedNumber += thousandsSep + numbersString.slice(-3)
			numbersString = numbersString.slice(0,-3);
		}

		return (number < 0 ? '-' : '') + numbersString + formattedNumber + (decimalsString ? (decPoint + decimalsString) : '');
	}

	
	function ChangeBarang(value){
			var KdBarang = document.getElementById("nama").value;
			var e =document.getElementById("nama");
			var strUser = e.options[e.selectedIndex].text;
			console.log(KdBarang);
			$.ajax({
				type:'post', 
				url:"<?php echo site_url('BarangProposal/ChangeNama');?>", 
				data: {
					idBarang:KdBarang,
					namaBarang:	strUser
				},    
				success: function (results){
					var obj=$.parseJSON(results); // now obj is a json object
					// alert(obj.formatted); // will alert "1"
					// alert(obj.value); 
					$("#perkiraan_biaya_unit").html("Perkiraan Biaya/Unit : Rp " + obj.formatted);
					// var a=parseint(data);
					$("#hiddenBiayaPcs").val(obj.value);
				},
			}); 
		}

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
                    <a href="
                        <?php 
                        // echo site_url('admin/products/') 
                        ?>">
                        <!-- <i class="fas fa-arrow-left"></i> Back -->
                    </a>
					</div>
					<div class="card-body">
                        <H1>BARANG</h1>
            
                        <form action="<?php echo site_url('BarangProposal/add') ?>" method="post" enctype="multipart/form-data" >  
					<div class="card-footer small text-muted">
						* required fields
					</div>
					<?php echo $_SESSION["nomor_proposal"]; ?>
							<div class="form-group">
								<label for="name">Nama Barang*</label>
								<select name="nama" class="form-control" id="nama" onchange='ChangeBarang(this.val);'>
									<option value="">Pilih Barang</option>
									<?php foreach($ListBarang as $each){ ?>
										<option value="<?php echo $each->id_barang; ?>"><?php echo $each->nama_barang; ?></option>';
									<?php } ?>
								</select>
							</div>
				
                            <div class="form-group">
								<label for="price">Spesifikasi*</label>
								<input class="form-control <?php echo form_error('price') ? 'is-invalid':'' ?>"
								 type="text" name="spesifikasi" placeholder="Spesifikasi" />
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
                            </div>
                            <div class="form-group">
								<label for="price">Jumlah*</label>
								<input class="form-control <?php echo form_error('price') ? 'is-invalid':'' ?>"
								 type="number" id="jumlah" name="jumlah" placeholder="Jumlah" onchange="timesqty()"/>
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
                            </div>
                            <div class="form-group">
                                <div id="perkiraan_biaya_unit">Perkiraan Biaya/Unit: </div>
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
							</div>
							<input type="hidden" name="hiddenBiayaPcs" id="hiddenBiayaPcs" value=""/>
							<div class="form-group">
								<label for="price">Harga yang diajukan per unit*</label>
								<input  class="form-control <?php echo form_error('price') ? 'is-invalid':'' ?>"
								 type="number" name="inputanHarga" id="inputanHarga" min="0" placeholder="inputanHargaperunit" onkeyup="myKeyup()" />
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
							</div>
							<div id="typing"></div>
							<div id="results"></div>
                            <div class="form-group">
								<div id="total_perkiraan_biaya">Total Biaya yang diajukan: </div>
								<div class="invalid-feedback">
									<?php echo form_error('price') ?>
								</div>
							</div>
							<input type="hidden" name="hiddenBiayaTotal" id="hiddenBiayaTotal" value=""/>
                            <input class="btn btn-primary" type="submit" name="btnMore" value="More" />
                            <input class="btn btn-success" type="submit" name="btnDone" value="Done" />
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