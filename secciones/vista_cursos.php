<?php include('../template/cabecera.php'); ?>
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
               <input type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="ID">
            </div>
            <div class="mb-3">
               <label for="" class="form-label">Nombre</label>
               <input type="text" class="form-control" name="" id="" aria-describedby="helpId" placeholder="Nombre">
            </div>
            <div class="btn-group" role="group" aria-label="Button group name">
               <button type="button" class="btn btn-success">Agregar</button>
               <button type="button" class="btn btn-primary">Editar</button>
               <button type="button" class="btn btn-danger">Borrar</button>
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
            <tr>
               <td scope="row">1</td>
               <td>Aprende Bash</td>
               <td>Seleccionar</td>
            </tr>

         </tbody>
      </table>
   </div>

</div>



<?php include('../template/pie.php'); ?>