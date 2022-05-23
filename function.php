<?php 

class Alamat extends database
{
	public function getAlm($data, $n, $length, $table)
	{
		try
		{
			$sql = "SELECT kode, nama FROM $table WHERE LEFT(kode,:n)=:data AND CHAR_LENGTH(kode)=:length";
			$stmt = $this->koneksi->prepare($sql);
			$stmt->execute(array(':n'=>$n, ':data'=>$data,':length'=>$length));
			return $stmt;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function selectProv()
	{
		try
		{
			$sql ="SELECT kode, nama FROM wilayah_2022 WHERE CHAR_LENGTH(kode)=2";
			$stmt=$this->koneksi->prepare($sql);
			$stmt->execute();
			return $stmt;
			

			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function simpanAlamat($nama, $prov, $kab, $kec, $des)
	{
		try
		{
			$sql = "INSERT INTO simpan_alamat(nama, al_prov, al_kab, al_kec, al_des) VALUES(:nama, :al_prov, :al_kab, :al_kec, :al_des)";
			$stmt=$this->koneksi->prepare($sql);
			$stmt->bindParam(":nama",$nama);
			$stmt->bindParam(":al_prov",$prov);
			$stmt->bindParam(":al_kab",$kab);
			$stmt->bindParam(":al_kec",$kec);
			$stmt->bindParam(":al_des",$des);
			$stmt->execute();
			return $stmt;

		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function tampilAlamat()
	{
		try
		{
			$sql ="SELECT * FROM simpan_alamat";
			$stmt=$this->koneksi->prepare($sql);
			$stmt->execute();
			return $stmt;		
			
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function readAlamat($kolom, $where, $data, $table)
	{
		try
		{
			$sql = "SELECT $kolom FROM $table WHERE $where=:$where";
			$stmt = $this->koneksi->prepare($sql);
			$stmt->bindParam(":$where", $data);
			$stmt->execute();
			$stmt->bindColumn("$kolom",$kolom);
			$stmt->fetch(PDO::FETCH_BOUND);
			return $kolom? $kolom : '';
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
	public function getTable($table, $where, $data)
	{
		try
		{
			$sql="SELECT * FROM simpan_alamat WHERE $where=:$where";
			$stmt=$this->koneksi->prepare($sql);
			$stmt->bindParam(":$where",$data);
			$stmt->execute();
			$this->row=$stmt->fetch(PDO::FETCH_ASSOC);
			return $this->row;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
			
		}
	}
	public function jsAlamat()
	{
		?>
		<script type="text/javascript">
		        $(document).ready(function(){

		            // sembunyikan form kabupaten, kecamatan dan desa
		            $("#kab").hide();
		            $("#kec").hide();
		            $("#des").hide();

		            // ambil data kabupaten ketika data memilih provinsi
		            $('body').on("change","#prov",function(){
		                var id = $(this).val();
		                var data = "id="+id+"&data=kabupaten";
		                $.ajax({
		                    type: 'POST',
		                    url: "get_alamat.php",
		                    data: data,
		                    success: function(hasil) {
		                        $("#kab").html(hasil);
		                        $("#kab").show();
		                        $("#kec").hide();
		                        $("#des").hide();
		                    }
		                });
		            });

		            // ambil data kecamatan/kota ketika data memilih kabupaten
		            $('body').on("change","#kab",function(){
		                var id = $(this).val();
		                var data = "id="+id+"&data=kecamatan";
		                $.ajax({
		                    type: 'POST',
		                    url: "get_alamat.php",
		                    data: data,
		                    success: function(hasil) {
		                        $("#kec").html(hasil);
		                        $("#kec").show();
		                        $("#des").hide();
		                    }
		                });
		            });

		            // ambil data desa ketika data memilih kecamatan/kota
		            $('body').on("change","#kec",function(){
		                var id = $(this).val();
		                var data = "id="+id+"&data=desa";
		                $.ajax({
		                    type: 'POST',
		                    url: "get_alamat.php",
		                    data: data,
		                    success: function(hasil) {
		                        $("#des").html(hasil);
		                        $("#des").show();
		                    }
		                });
		            });


		        });
	    </script>
		<?php 
	}
	public function jsAlamat2()
	{
		?>
		<script type="text/javascript">
		        $(document).ready(function(){

		           

		            // ambil data kabupaten ketika data memilih provinsi
		            $('body').on("change","#prov",function(){
		                var id = $(this).val();
		                var data = "id="+id+"&data=kabupaten";
		                $.ajax({
		                    type: 'POST',
		                    url: "get_alamat.php",
		                    data: data,
		                    success: function(hasil) {
		                        $("#kab").html(hasil);
		                        $("#kab").show();
		                       
		                    }
		                });
		            });

		            // ambil data kecamatan/kota ketika data memilih kabupaten
		            $('body').on("change","#kab",function(){
		                var id = $(this).val();
		                var data = "id="+id+"&data=kecamatan";
		                $.ajax({
		                    type: 'POST',
		                    url: "get_alamat.php",
		                    data: data,
		                    success: function(hasil) {
		                        $("#kec").html(hasil);
		                        $("#kec").show();
		                       
		                    }
		                });
		            });

		            // ambil data desa ketika data memilih kecamatan/kota
		            $('body').on("change","#kec",function(){
		                var id = $(this).val();
		                var data = "id="+id+"&data=desa";
		                $.ajax({
		                    type: 'POST',
		                    url: "get_alamat.php",
		                    data: data,
		                    success: function(hasil) {
		                        $("#des").html(hasil);
		                        $("#des").show();
		                    }
		                });
		            });


		        });
	    </script>
		<?php 
	}
	public function __destruct()
	{
		return true;
	}
}

