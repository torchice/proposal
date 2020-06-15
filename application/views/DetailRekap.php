<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    $this->load->view("admin/_partials/head.php") 
    ?>
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
					
					<form action="<?php echo site_url('Rekap/index') ?>" method="post" enctype="multipart/form-data" >  
						<div class="card-footer small text-muted">
					</div>
                            <input class="btn btn-warning" type="submit" name="btnMenu" id="btnMenu" value="Back to Rekap" />
				
					</form>
                        <H1>DETAIL REKAP</h1>
						<?php if(isset($results)){ ?>
						<table border="2" cellpadding="5" cellspacing="2">
							<tr>
								<th>Nomor Proposal</th>
								<th>Project</th>
								<th>Quantity</th>
								<th>Spesifikasi</th>
								<th>Harga yang Diajukan</th>
							<tr>
							<?php if (is_array($results) || is_object($results)) { ?>
							<?php foreach($results as $data){ ?>
								<tr>
									<td> <?php echo $data->nomor_proposal ?> </td>
									<td> <?php echo $data->nama ?> </td>
									<td> <?php echo $data->jumlah ?> </td>
									<td> <?php echo $data->spesifikasi ?> </td>
									<td> <?php echo number_format($data->perkiraan_biaya_unit) ?> </td>
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