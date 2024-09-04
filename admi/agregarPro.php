
    
    <div class="card-content">
      <form action="ctroAdmi.php?" enctype="multipart/form-data" >
        <div class="form-group">
        <h2>Agregar Producto</h2>
      <center><div class="image-preview" id="imagen_prev">
      <img id="preview" src="../imagenes/hellokitty.gif" alt="Vista previa de la imagen">
    </div></center>
          <label id="id_pro" for="id_producto">ID_producto:</label>
          <input type="number" id="id_producto" name="id_producto">

          <div class="form-group" id="para_cat">
            <label id="id_cate" for="id_categoria">ID Categoría:</label>
            <select id="id_categoria" name="id_categoria" required>
              <option value="">Selecciona una categoría</option>
              <option value="1">damas y caballeros</option>
              <option value="3">ropa infantil</option>
              <option value="4">calzado para todos</option>
              <option value="5">accesorios para todos</option>
            </select>
          </div>
        </div>
        <div class="form-group" id="para_nom">
          <label for="nombre" id="nombre_p">Nombre:</label>
          <input type="text" id="nombre" name="nombre">
        </div>
        <div class="form-group" id="para_pre">
          <label for="precio" id="precio_p">Precio:</label>
          <input type="number" id="precio" name="precio">
        </div>
        <div class="form-group" id="para_can">
          <label for="cantidad" id="cantidad_p">Cantidad:</label>
          <input type="number" id="cantidad" name="cantidad">
        </div>
        <div class="form-group" id="para_des">
          <label for="descripcion" id="descri_p">Descripción:</label>
          <textarea id="descripcion" name="descripcion" filas="4"></textarea>
        </div>

        <div class="form-group" id="para_color">
          <label for="color" id="color">color:</label>
          <input type="text" id="color" name="color">
        </div>

        <div class="form-group" id="tallas">
          <label for="tallas" id="tallas">tallas:</label>
          <input type="text" id="tallas" name="tallas">
        </div>
        <input type="file" id="imagen" name="imagen" accept="image/*"multiple onchange="previewImage()"><br><br>
        <input type="submit" name="crear" value="Agregar Producto"><br>
      </form>
    </div>
    </div>

  <script src="../js/imgPrevia.js"></script>
  
  
  