10<?php 
require_once('database.php');
require_once('function.php');
$obj = new Alamat;

$data = $_POST['data'];
$id = $_POST['id'];

$n=strlen($id);
$length=($n==2?5:($n==5?8:13));

?>
<?php 
if($data == "kabupaten"){
	?>
	
	
	
		<option value="">Pilh Kab/Kota</option>
		<?php 
			$daerah = $obj->getAlm($id, $n, $length, 'wilayah_2022');
			while($d = $daerah->fetch(PDO::FETCH_ASSOC)){
				?>
				<option value="<?php echo $d['kode']; ?>"><?php echo $d['nama']; ?></option>
				<?php 
			}
		?>
	

	<?php 
}else if($data == "kecamatan"){ 
	?>
	
		<option value="">Pilih Kecamatan</option>
		<?php 
			$daerah = $obj->getAlm($id, $n, $length, 'wilayah_2022');
			while($d = $daerah->fetch(PDO::FETCH_ASSOC)){
				?>
				<option value="<?php echo $d['kode']; ?>"><?php echo $d['nama']; ?></option>
				<?php 
			}
		?>
	

	<?php 
}else if($data == "desa"){ 
	?>


		<option value="">Pilih Desa</option>
		<?php 
			$daerah = $obj->getAlm($id, $n, $length, 'wilayah_2022');
			while($d = $daerah->fetch(PDO::FETCH_ASSOC)){
				?>
				<option value="<?php echo $d['kode']; ?>"><?php echo $d['nama']; ?></option>
				<?php 
			}
		?>


	<?php 

}
?>