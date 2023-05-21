<?php include('../template/cabecera.php'); ?>
<?php include('../secciones/cursos.php'); ?>

<div class="col-md-5">
   <form action="" method="post">
      <div class="card">
         <div class="card-header">
            Cursos
         </div>
         <div class="card-body">
            <h4 class="card-title">Title</h4>
            <p class="card-text">Text</p>
            <div class="mb-3">
               <label for="" class="form-label">ID</label>
               <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID" value="<?php echo $id ?>">
            </div>
            <div class="mb-3">
               <label for="" class="form-label">Nombre</label>
               <input type="text" class="form-control" name="nombre_curso" id="nombre_curso" aria-describedby="helpId" placeholder="Nombre" value="<?php echo $nombre_curso ?>">
            </div>
            <div class="btn-group" role="group" aria-label="Button group name">
               <button type="submit" name="accion" value="agregar" class="btn btn-success">Agregar</button>
               <button type="submit" name="accion" value="editar" class="btn btn-primary">Editar</button>
               <button type="submit" name="accion" value="borrar" class="btn btn-danger">Borrar</button>
            </div>
         </div>
      </div>
   </form>
</div>
<div class="col-md-7">
   <div class="table-responsive">
      <table class="table table-primary">
         <thead>
            <tr>
               <th scope="col">ID</th>
               <th scope="col">Nombre</th>
               <th scope="col">Acciones</th>
            </tr>
         </thead>
         <tbody>
            <?php foreach ($listaCursos as $curso) { ?>
               <tr>
                  <td scope="row"><?php echo $curso->id ?></td>
                  <td><?php echo $curso->nombre_curso ?></td>
                  <td>
                     <form action="" method="post">
                        <input type="hidden" id="id" name="id" value="<?php echo $curso->id ?>">
                        <input type="submit" value="Seleccionar" name="accion" class="btn btn-info">
                     </form>
                  </td>
               </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>

</div>



<?php include('../template/pie.php'); ?>