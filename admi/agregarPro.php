<head>
  <title>Agregar Productos</title>
  <link rel="stylesheet" href="../css/agregarPro.css">
</head>
<div class="container">
  <h2>Agregar Producto</h2>

  <form action="ctroAdmi.php" method="POST" enctype="multipart/form-data">
    <!-- Imagen dentro del formulario -->
    <div class="form-flex">
      <!-- Contenedor de vista previa de la imagen -->
      <div class="image-preview">
        <img id="preview" src="../img/dedo.jpg" alt="Vista previa de la imagen">
      </div> 

      <!-- Contenedor de formulario -->
      <div class="form-fields">
        <div class="form-group">
          <label for="id_categoria">ID Categoría:</label>
          <select id="id_categoria" name="id_categoria" required>
            <option value="">Selecciona una categoría</option>
            <?php
            include_once("modelo.php");

            // Obtener categorías desde la base de datos
            $categorias = Productos::obtenerCategorias();
            foreach ($categorias as $categoria) {
                // Escape de las categorías para prevenir XSS
                $id_categoria = htmlspecialchars($categoria['id'], ENT_QUOTES, 'UTF-8');
                $nombre_categoria = htmlspecialchars($categoria['nombre'], ENT_QUOTES, 'UTF-8');
                echo "<option value='" . $id_categoria . "'>" . $nombre_categoria . "</option>";
            }
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="nombre">Nombre:</label>
          <input type="text" id="nombre" name="nombre" required pattern="[A-Za-z0-9\s]+" title="Solo letras, números y espacios" value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8') : ''; ?>">
        </div>

        <div class="form-group">
          <label for="precio">Precio:</label>
          <input type="number" id="precio" name="precio" step="0.01" required value="<?php echo isset($_POST['precio']) ? htmlspecialchars($_POST['precio'], ENT_QUOTES, 'UTF-8') : ''; ?>">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="cantidad">Cantidad:</label>
      <input type="number" id="cantidad" name="cantidad" required value="<?php echo isset($_POST['cantidad']) ? htmlspecialchars($_POST['cantidad'], ENT_QUOTES, 'UTF-8') : ''; ?>">
    </div> 

    <div class="form-group">
      <label for="descripcion">Descripción:</label>
      <textarea id="descripcion" name="descripcion" rows="4" required><?php echo isset($_POST['descripcion']) ? htmlspecialchars($_POST['descripcion'], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
    </div>

    <div class="form-group">
      <label for="color">Color:</label>
      <input type="text" id="color" name="color" required pattern="[A-Za-z]+" title="Solo letras" value="<?php echo isset($_POST['color']) ? htmlspecialchars($_POST['color'], ENT_QUOTES, 'UTF-8') : ''; ?>">
    </div>

    <div class="form-group">
      <label for="tallas">Tallas:</label>
      <input type="text" id="tallas" name="tallas" required pattern="[A-Za-z0-9\s]+" title="Solo letras, números y espacios" value="<?php echo isset($_POST['tallas']) ? htmlspecialchars($_POST['tallas'], ENT_QUOTES, 'UTF-8') : ''; ?>">
    </div>

    <div class="form-group">
      <label for="imagenes">Subir Imágenes:</label>
      <input type="file" id="imagenes" name="imagenes[]" accept="image/*" multiple onchange="previewImages(this)" required>
    </div>

    <div class="submit-button">
      <input type="submit" name="crear" value="Agregar Producto">
    </div>
  </form>
</div>

<script src="../js/imgPrevia.js"></script>
