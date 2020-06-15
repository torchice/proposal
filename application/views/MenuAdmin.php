<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
    $this->load->view("admin/_partials/head.php") 
    ?>
	<style>
		#logout{
			float:right;
			border:1px solid black;
			padding:10px;
		}
	</style>
</head>

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
				<?php ?>
				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>
				<a id="logout" href="<?php echo site_url('Login/logout'); ?>">Logout</a>
				<div class="card mb-3">
					<div class="card-header">
                    <a href="
                        <?php 
							
                        ?>">
                        <!-- <i class="fas fa-arrow-left"></i> Back -->
                    </a>
					</div>
					<div class="card-body">
                        <H1>MENU</h1>
						
						<form action="<?php echo site_url('Rekap/index') ?>" method="GET" enctype="multipart/form-data" >  
					<div class="card-footer small text-muted">
					</div>
                            <input class="btn btn-success" type="submit" name="btnRekap" value="Rekap Proposal" />
						</form>
					
					<form action="<?php echo site_url('Rekap/rekap_non_confirmed') ?>" method="post" enctype="multipart/form-data" >  
					<div class="card-footer small text-muted">
					</div>
                            <input class="btn btn-success" type="submit" name="btnRekap" value="Rekap Non-Active Proposal" />
						</form>
				
					<form action="<?php echo site_url('Menu/GoKonfirmasiBarang') ?>" method="post" enctype="multipart/form-data" >  
					<div class="card-footer small text-muted">
					</div>
                            <input class="btn btn-success" type="submit" name="btnRekap" value="Konfirmasi" />
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