<?php 
require_once('database.php');
require_once('function.php');
$obj = new Alamat;

$simpan = "";
if(isset($_POST['simpan']))
{
    $nama = $_POST['nama'];
    $prov = $_POST['prov'];
    $kab = $_POST['kab'];
    $kec = $_POST['kec'];
    $des = $_POST['des'];
    
    if($obj->simpanAlamat($nama, $prov, $kab, $kec, $des))
    {
        $simpan="<div class='alert alert-success'>Data berhasil disimpan</div>";
    }
    else
    {
        $simpan="<div class='alert alert-danger'>Data gagal disimpan</div>";
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
                        <input class="form-control" name="nama" required="">
                    </div>

                    <div class="row">  
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Provinsi</label>
                                <select class="form-control" name="prov" id="prov" required="">
                                    <option>Pilih</option>
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
                                  
                                </select>
                            </div>
                        </div>
                   
                         <div class="col-md-3">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <select class="form-control" name="kec" id="kec" required="">
                                    
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Desa/Kel</label>
                                <select class="form-control" name="des" id="des" required="">
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        
                        <button type="submit" name="simpan" class="btn btn-md btn-primary"> Simpan</button>
                    </div>
                </form>
            </div>
        </div> 
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Prov</th>
                            <th>Kota/Kab</th>
                            <th>Kecamatan</th>
                            <th>Desa</th>
                            <th>Edit</th>
                        </thead>
                        <tbody>
                            <?php 
                                $no=1;
                                $d=$obj->tampilAlamat();
                                while($row=$d->fetch(PDO::FETCH_ASSOC))
                                {
                            ?>
                                <tr>
                                    <td><?=$no;?></td>
                                     <td><?=$row['nama']?></td>
                                    <td><?=$obj->readAlamat('nama','kode',$row['al_prov'],'wilayah_2022')?></td>
                                    <td><?=$obj->readAlamat('nama','kode',$row['al_kab'],'wilayah_2022')?></td>
                                    <td><?=$obj->readAlamat('nama','kode',$row['al_kec'],'wilayah_2022')?></td>
                                    <td><?=$obj->readAlamat('nama','kode',$row['al_des'],'wilayah_2022')?></td>
                                    <td><a href="edit.php?edit=<?=$row['id_data']?>" target="_blank">Edit</a></td>
                                </tr>

                            <?php $no+=1; }?>    

                        </tbody>
                    </table>
                </div>
            </div>
        </div>      
    </div>
</div>
<script src="jquery/dist/jquery.min.js"></script>
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<?=$obj->jsAlamat2()?>
</body>
</html>