<head>
  <title>agregar productos</title>
  <link rel="stylesheet" href="../css/agregarPro.css">
</head>
<div class="container">
  <h2>Agregar Producto</h2>
  
  <form action="ctroAdmi.php?" enctype="multipart/form-data">
    <!-- Imagen dentro del formulario -->
    <div class="form-flex">
      <!-- Contenedor de vista previa de la imagen -->
      <div class="image-preview">
        <img id="preview" src="../img/dedo.jpg" alt="Vista previa de la imagen">
      </div>

      <!-- Contenedor de formulario -->
      <div class="form-fields">
        <div class="form-group">
          <label for="id_producto">ID Producto:</label>
          <input type="number" id="id_producto" name="id_producto">
        </div>

        <div class="form-group">
          <label for="id_categoria">ID Categoría:</label>
          <select id="id_categoria" name="id_categoria" required>
            <option value="">Selecciona una categoría</option>
            <option value="1">Damas y caballeros</option>
            <option value="3">Ropa infantil</option>
            <option value="4">Calzado para todos</option>
            <option value="5">Accesorios para todos</option>
          </select>
        </div>

        <div class="form-group">
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" name="nombre">
        </div>

        <div class="form-group">
          <label for="precio">Precio:</label>
          <input type="number" id="precio" name="precio">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="cantidad">Cantidad:</label>
      <input type="number" id="cantidad" name="cantidad">
    </div>

    <div class="form-group">
      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion" name="descripcion" rows="4"></textarea>
    </div>

    <div class="form-group">
      <label for="color">Color:</label>
      <input type="text" id="color" name="color">
    </div>

    <div class="form-group">
      <label for="tallas">Tallas:</label>
      <input type="text" id="tallas" name="tallas">
    </div>

    <div class="form-group">
      <label for="imagen">Subir Imagen:</label>
      <input type="file" id="imagen" name="imagen" accept="image/*" onchange="previewImage()">
    </div>

    <div class="submit-button">
      <input type="submit" name="crear" value="Agregar Producto">
    </div>
  </form>
</div>

<script src="../js/imgPrevia.js"></script>
