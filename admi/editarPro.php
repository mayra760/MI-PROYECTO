<title>editar producto</title>
<form action="ctroAdmi.php?ediPro=ola&dato=<?php echo $_GET['dato']; ?>" class="row g-3" method="post">
<center>
  <div class="col-auto">
    <input type="text" name="nombre" class="form-control" id="producto" placeholder="Nombre Producto" value="<?php if(isset($_GET['dato']))echo Productos::datoPro(1,$_GET['dato']) ?>">
  </div><br>
  <div class="col-auto">
    <input type="text" name="precio" class="form-control" id="precio" placeholder="precio" value="<?php if(isset($_GET['dato']))echo Productos::datoPro(2,$_GET['dato']) ?>">
  </div><br>
  <div class="col-auto">
    <input type="text" name="cantidad" class="form-control" id="cantidad" placeholder="cantidad" value="<?php if(isset($_GET['dato'])) echo Productos::datoPro(3,$_GET['dato']) ?>">
  </div><br>  
  <div class="col-auto">
    <input type="text" name="detalles" class="form-control" id="detalles" placeholder="Detalles" value="<?php if(isset($_GET['dato'])) echo Productos::datoPro(4,$_GET['dato']) ?>">
  </div><br>
  <div class="col-auto">
    <input type="text" name="color" class="form-control" id="detalles" placeholder="Color" value="<?php if(isset($_GET['dato'])) echo Productos::datoPro(5,$_GET['dato']) ?>">
  </div><br>
  <div class="col-auto">
    <input type="text" name="tallas" class="form-control" id="detalles" placeholder="Tallas" value="<?php if(isset($_GET['dato'])) echo Productos::datoPro(6,$_GET['dato']) ?>">
  </div><br>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Actualizar Producto</button>
  </div>
</center>
</form>