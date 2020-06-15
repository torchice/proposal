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
					
					<form action="<?php echo site_url('Menu/GoHistoryHarga') ?>" method="post" enctype="multipart/form-data" >  
						<div class="card-footer small text-muted">
					</div>
                            <input class="btn btn-warning" type="submit" name="btnMenu" id="btnMenu" value="Back to list Item" />
				
					</form>
                        <H1>DETAIL HISTORY</h1>
						<?php if(isset($results)){ ?>
						<table border="2" cellpadding="5" cellspacing="2">
							<tr>
								<th>ID Barang</th>
								<th>Tanggal Penetapan</th>
								<th>Harga Penetapan</th>
							<tr>
							<?php if (is_array($results) || is_object($results)) { ?>
							<?php foreach($results as $data){ ?>
								<tr>
									<td> <?php echo $data->id_barang ?> </td>
									<?php $originalDate= $data->last_update; ?>
									<?php $newDate = date("d-F-o g:h:i a", strtotime($originalDate)); ?>
									<td> <?php echo $newDate ?> </td>
									<td> <?php echo number_format($data->harga_penetapan) ?> </td>
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