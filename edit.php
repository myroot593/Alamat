<?php 
require_once('database.php');
require_once('function.php');
$obj = new Alamat;

$simpan = "";
if(isset($_GET['edit']) && !empty($_GET['edit']))
{
    if(!$obj->getTable('simpan_alamat', 'id_data', $_GET['edit']))
    {
        die("Data tidak ditemukan");
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Module Test</title>
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    
</head>
<body>

<div class="container">
    <div class="container-fluid">
        

        <div class="row">
            <div class="col-md-12">
                <h4>MODULE TEST ALAMAT</h4>
                <hr>
                <?=$simpan?>
                <form action="" method="POST"> 
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input class="form-control" name="nama" value="<?=$obj->row['nama']?>" required="">
                    </div>

                    <div class="row">  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select class="form-control" name="prov" id="prov" required="">
                                    <option value="<?=$obj->row['al_prov']?>"><?=$obj->readAlamat('nama','kode',$obj->row['al_prov'],'wilayah_2022')?></option>
                                    <?php 
                                        $prov = $obj->selectProv();
                                        while($provinsi=$prov->fetch(PDO::FETCH_ASSOC))
                                        {
                                             echo '<option value='.$provinsi['kode'].'>'.$provinsi['nama'].'</option>';
                                         }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                               <label>Kab/Kota</label>
                                <select class="form-control" name="kab" id="kab" required="">
                                    <option value="<?=$obj->row['al_kab']?>"><?=$obj->readAlamat('nama','kode',$obj->row['al_kab'],'wilayah_2022')?></option>
                                  
                                </select>
                            </div>
                        </div>
                   
                         <div class="col-md-3">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select class="form-control" name="kec" id="kec" required="">
                                  <option value="<?=$obj->row['al_kec']?>"><?=$obj->readAlamat('nama','kode',$obj->row['al_kec'],'wilayah_2022')?></option>   
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Desa/Kel</label>
                                <select class="form-control" name="des" id="des" required="">
                                   <option value="<?=$obj->row['al_des']?>"><?=$obj->readAlamat('nama','kode',$obj->row['al_des'],'wilayah_2022')?></option> 
                                </select>
                            </div>
                        </div>
                    </div>
                     
                </form>
            </div>
        </div> 
           
    </div>
</div>
<script src="jquery/dist/jquery.min.js"></script>
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<?=$obj->jsAlamat2()?>
</body>
</html>