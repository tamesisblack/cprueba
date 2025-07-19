<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><h4>&times;</h4></button>
    <h4 class="modal-title" id="titulo">Acerca de Este Registro</h4>
</div>
<div class="modal-body">
    <p>Creado Por: {{ $creator->name }}</p>
    <p>Fecha de Creación: {{ $data->created_at }}</p>
    <p>Actualizado Por: {{ $updator->name }}</p>
    <p>Fecha de Actualización: {{ $data->updated_at }}</p>
     
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Aceptar</button>
</div>
