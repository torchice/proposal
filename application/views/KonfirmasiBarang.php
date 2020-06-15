<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
 
<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />

<?php 
    $this->load->view("admin/_partials/head.php") 
    ?>

    <title>Confirmation Page </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
        table { 
            padding: 10px;
            margin:10px;
        }
        td { 
  
            padding: 10px;
        }
        th{
            
            padding: 10px;
        }

		
	</style>
</head>

<body id="page-top">

	<div id="wrapper">
		<div id="content-wrapper">
			<div class="container-fluid">
			<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
		Are you sure to reject ?
          <button type="button" class="close" data-dismiss="modal">&times;</button>
    
        </div>
        <div class="modal-body">
		Keterangan: 
		<input type="text" name="reason" id="reason">
        </div>
        <div class="modal-footer">
			<button type="button" class="btn btn-danger rejectConfirm" data-dismiss="modal">Reject</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
      
    </div>
  </div>
				<?php $this->load->view("admin/_partials/breadcrumb.php") ?>
				<?php if ($this->session->flashdata('success')): ?>
				<div class="alert alert-success" role="alert">
					<?php echo $this->session->flashdata('success'); ?>
				</div>
				<?php endif; ?>
				<div class="card mb-3">
					<div class="card-body">
					
					<form action="<?php echo site_url('Menu/index')  ?>" method="post" enctype="multipart/form-data" >  
						<div class="card-footer small text-muted">
					</div>
                            <input class="btn btn-warning" type="submit" name="btnMenu" id="btnMenu" value="Back to menu" />
				
					</form>
                        <H1>CONFIRMATION REQUEST</h1>
						<?php if(isset($results)){ ?>
                        <div class="table-responsive">
						<table class="table table-bordered">
							<tr class="edit">
								<th>Nama Barang</th>
								<th>Harga Penetapan</th>
								<th>Approve</th>
                                <th>Action</th>
							<tr>
							<?php if (is_array($results) || is_object($results)) { ?>
							<?php foreach($results as $data){ ?>
                            <?php $approve=$data->approve; 
                            if($data->approve ==0){ ?>
								<tr id="<?php echo $data->id_barang ?>" class="edit"> 
									<td> <?php echo $data->nama_barang ?> </td>
									<td> <?php echo $data->harga_penetapan ?> </td>
									<td> <?php 
								
									if($approve==0){
										echo "Belum Disetujui";
									}else{
										echo "Sudah disetujui";
									}?> </td>
									<td>
									<button type="button" class="btn btn-primary confirm" data-toggle="modal" data-target="#exampleModal">
									Confirmation
									</button>
									<button type="button" class="btn btn-danger rejectConfirm" data-toggle="modal" data-target="#exampleModal">
									Reject
									</button>
									<!-- <button type="button" class="btn btn-danger reject" data-toggle="modal" data-target="#myModal">Reject</button> -->
									</td>
									<td>
						
									
									</td>
								</tr>
							<?php } } }?>
						</table>
                        </div>
						<?php }  else { ?>
							<div>No Data(s) found.</div>
						<?php } ?>
						<?php if (isset($links)) { ?>
							<?php echo $links ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>

		<?php $this->load->view("admin/_partials/scrolltop.php") ?>
		<?php $this->load->view("admin/_partials/js.php") ?>

</body>


<script>
    $(".confirm").click(function(){
        var id = $(this).parents("tr").attr("id");
        if(confirm('Are you sure to confirm this request price ?'))
        {
            $.ajax({
               url: "<?php echo site_url('MasterBarang/confirmHarga?id=') ?>"+id,
               type: 'POST',
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    $results = data;
               }
            });
        }
    });
	$(".rejectConfirm").click(function(){
		console.log("asdasd");
        var id = $(this).parents("tr").attr("id");
		console.log(id);
		if(confirm('Are you sure to reject this request price ?'))
        {
            $.ajax({
               url: "<?php echo site_url('MasterBarang/rejectHarga?id=') ?>"+id,
               type: 'POST',
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    $results = data;
               }
            });
		}
    });
</script>


</html>