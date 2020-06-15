<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    $this->load->view("admin/_partials/head.php") 
    ?>
	<script src="<?php echo base_url('assets/jquery/jquery.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js') ?>"></script>
	<style>
		.pagination {
			display: inline-block;
			padding: 8px 16px;
			color:black;
		
			background-color:#7FFFD4;
		}
		.paginationA {
			display: inline-block;
			padding: 8px 16px;
			color:black;			
		}
		.pagination a {
			color: black;
			float: left;
			padding: 8px 16px;
			text-decoration: none;	
		}
		#btnMenu{
			float:right;
		}
		
	</style>
	
</head>
<script>
		$(document).ready(function() {
	
		
		});
		//fungsi untuk mengkalikan jumlah dan 
		function goDetail(){
			// var inputanQty = document.getElementById("Godetail").c;
			var hargaPcs = document.getElementById("inputanHarga").value;
			var jumlah = inputanQty * hargaPcs;
			var hasiltext = document.getElementById("total_perkiraan_biaya").innerHTML = "Total Biaya yang diajukan " + jumlah;
			// hiddenBiayaTotal
			$("#hiddenBiayaPcs").val(jumlah);
		}
</script>
<body id="page-top">
	<div id="wrapper">
		<div id="content-wrapper">
			<div class="container-fluid">
				<?php $this->load->view("admin/_partials/breadcrumb.php") ?>
				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>
				<div class="card mb-3">
					<div class="card-body">
					
					<form action="<?php echo site_url('Menu/index') ?>" method="post" enctype="multipart/form-data" >  
						<div class="card-footer small text-muted">
					</div>
                            <input class="btn btn-warning" type="submit" name="btnMenu" id="btnMenu" value="Back to menu" />
				
					</form>
                        <H1>REKAP</h1>
						<?php if(isset($results)){ ?>
						<table border="2" cellpadding="5" cellspacing="2">
							<tr>
								<th>Nomor Proposal</th>
								<th>Jenis</th>
								<th>Keperluan</th>
								<th>Perkiraan Biaya</th>
								<th>Diajukan</th>
								<th>Action</th>
							<tr>
							<?php if (is_array($results) || is_object($results)) { ?>
							<?php foreach($results as $data){ ?>
								<tr>
									<td> <?php echo $data->nomor ?> </td>
									<td> <?php echo $data->pabrik ?> </td>
									<td> <?php echo $data->jenis ?> </td>
									<td> <?php echo $data->keperluan ?> </td>
									<td> <?php echo $data->diajukan ?> </td>
									<td>
									<button class="btn btn-primary" onclick="location.href='<?php echo base_url();?>index.php/Rekap/Godetail?kdpro=<?php echo $data->nomor; ?>'">View Detail</button>
									<button class="btn btn-secondary" onclick="location.href='<?php echo site_url();?>/Form/index?kdpro=<?php echo $data->nomor; ?>'" >Print</button>
									<button class="btn btn-danger" >Delete</button>
									</td>
								
								</tr>
							<?php } } ?>
						</table>
						<?php } else { ?>
							<div>No Data(s) found.</div>
						<?php } ?>
						<?php if (isset($links)) { ?>
							<?php echo $links ?>
						<?php } ?>
					</div>
				</div>
                <?php 
                 ?>
			</div>
		</div>
		<?php $this->load->view("admin/_partials/scrolltop.php") ?>
		<?php $this->load->view("admin/_partials/js.php") ?>

</body>

</html>