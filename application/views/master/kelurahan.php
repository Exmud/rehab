<link href="assets/back/serverside/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<div class="page-wrapper">		
	<div class="page-breadcrumb">
		<div class="row">
			<div class="col-12 d-flex no-block align-items-center">
				<h4 class="page-title"><?php echo $title ?></h4>
				<div class="ml-auto text-right">
					<nav aria-label="breadcrumb">
						<?php echo $bread ?>
					</nav>
				</div>
			</div>
		</div>
	</div>    
	<div class="container-fluid">
		<?php                       
		if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {                    
			?>                  
			<div class="alert alert-<?php echo $_SESSION['tipe'] ?> alert-dismissable">
				<strong><?php echo $_SESSION['pesan'] ?></strong>                    
			</div>
			<?php
		}
		$_SESSION['pesan'] = '';                        

		?>

		<?php 
		if($set=="insert"){
			if($mode == 'insert'){
				$read = "";
				$read2 = "";
				$form = "save";
				$vis  = "";
				$form_id = "";
				$row = "";
			}elseif($mode == 'detail'){
				$row  = $dt_kelurahan->row();              
				$read = "readonly";
				$read2 = "disabled";
				$vis  = "style='display:none;'";
				$form = "save";              
				$form_id = "";
			}elseif($mode == 'edit'){
				$row  = $dt_kelurahan->row();
				$read = "";
				$read2 = "";
				$form = "update";              
				$vis  = "";
				$form_id = "<input type='hidden' name='id' value='$row->id_kelurahan'>";              
			}
			?>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<a href="master/kelurahan" class="btn btn-warning"><i class="fa fa-eye"></i> View</a>
						</div>
						<form class="form-horizontal" action="master/kelurahan/<?php echo $form ?>" method="POST" enctype="multipart/form-data">
							<div class="card-body">								
								<div class="form-group row">
									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Kelurahan</label>
									<div class="col-sm-4">
										<?php echo $form_id ?>
										<input type="text" <?php echo $read ?> value="<?php echo $tampil = ($row!='') ? $row->kelurahan : "" ; ?>" name="kelurahan" class="form-control" placeholder="Kelurahan">
									</div>																		

									<label for="fname" class="col-sm-2 text-right control-label col-form-label">Kabupaten</label>
									<div class="col-sm-4">
										<select name="id_kecamatan" class="form-control" <?php echo $read2 ?>>
											<option value=''>- pilih -</option>
											<?php                           
											foreach ($dt_kecamatan->result() as $isi) {
												$id_kecamatan = ($row!='') ? $row->id_kecamatan : "";
												if($id_kecamatan!='' && $id_kecamatan==$isi->id_kecamatan) $se = "selected";
												else $se="";												
												echo "<option $se value='$isi->id_kecamatan'>$isi->kecamatan</option>";
											}
											?>
										</select>
									</div>									
								</div>								
							</div>
							<div class="border-top" <?php echo $vis ?>>
								<div class="card-body">
									<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
									<button type="reset" class="btn btn-danger"><i class="fa fa-undo"></i> Batal</button>
								</div>
							</div>
						</form>
					</div>
				</div>				
			</div>

			<?php 
		}elseif($set=='view'){
			?>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<a href="master/kelurahan/add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
						</div>
						<div class="card-body">
							<!-- <h5 class="card-title">Basic Datatable</h5> -->
							<div class="table-responsive">
								<table id="zero_config" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th width="5%">No</th>											
											<th>Kelurahan</th>
											<th>Kabupaten</th>
											<th width="15%">Aksi</th>											
										</tr>
									</thead>
									<tbody>
										<?php 
										$no=1;
										foreach ($dt_kelurahan->result() as $row) {
											echo "
											<tr>
											<td>$no</td>
											<td><a href='master/kelurahan/detail?id=$row->id_kelurahan'>$row->kelurahan</a></td>											
											<td>$row->kecamatan</td>
											<td>"; ?>
											<a class='btn btn-info btn-sm' href='master/kelurahan/edit?id=<?php echo $row->id_kelurahan ?>'><i class='fa fa-edit'></i></a>
											<a class='btn btn-danger btn-sm' onclick="return confirm('Anda yakin?')" href='master/kelurahan/delete?id=<?php echo $row->id_kelurahan ?>'><i class='fa fa-trash'></i></a>
										</td>
									</tr>
									<?php
									$no++;
								}
								?>
							</tbody>									
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php 
}elseif($set=='view_fix'){
	?>

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<a href="master/kelurahan/add" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
				</div>
				<div class="card-body">
					<!-- <h5 class="card-title">Basic Datatable</h5> -->
					<div class="table-responsive">
						<table id="table" class="display" cellspacing="0" width="100%">
							<thead>
								<tr>                    
									<th width="5%">No</th>
									<th>ID Kelurahan</th>
									<th>Kelurahan</th>
									<th>Kabupaten</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							</tbody>

						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php 
} 
?>
</div>
</div>
<script src="assets/back/serverside/jquery/jquery-2.2.3.min.js"></script>

<script type="text/javascript">
	var table;
	$(document).ready(function() {

        //datatables
        table = $('#table').DataTable({ 

        	"processing": true, 
        	"serverSide": true, 
        	"order": [], 

        	"ajax": {
        		"url": "<?php echo site_url('master/kelurahan/ajax_list')?>",
        		"type": "POST"
        	},


        	"columnDefs": [
        	{ 
        		"targets": [ 0 ], 
        		"orderable": false, 
        	},
        	],

        });

      });

    </script>
