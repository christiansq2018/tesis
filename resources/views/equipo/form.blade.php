    <div class="form-group row">
      <label class="col-md-3 form-control-label" for="titulo">Clasificación</label>
      <div class="col-md-9">
        <select class="form-control" name="clasificacion_id" id="id" required>
          <option value="0" disabled>Seleccione</option>
          @foreach($clasificaciones as $clas)
            <option value="{{$clas->id}}">{{$clas->nombre}}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-md-3 form-control-label" for="nombre">Nombre</label>
      <div class="col-md-9">
        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese la nombre" required pattern="^[a-zA-Z_áéíóúñ\s]{0,100}$">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-md-3 form-control-label" for="codigo">Serie</label>
      <div class="col-md-9">
        <input type="text" id="serie" name="serie" class="form-control" placeholder="Ingrese el Código de Serie" required pattern="[0-9]{0,15}">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-md-3 form-control-label" for="codigo">Activo Fijo</label>
      <div class="col-md-9">
        <input type="text" id="activo_fijo" name="activo_fijo" class="form-control" placeholder="Activo Fijo" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-md-3 form-control-label" for="marca">Marca</label>
      <div class="col-md-9">
        <input type="text" id="marca" name="marca" class="form-control" placeholder="Ingrese la Marca" pattern="^[a-zA-Z_áéíóúñ\s]{0,100}$" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-md-3 form-control-label" for="marca">Modelo</label>
      <div class="col-md-9">
        <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Ingrese el Modelo" pattern="^[a-zA-Z_áéíóúñ\s]{0,100}$" required>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-md-3 form-control-label" for="marca">Fecha de Entrega al Servicio</label>
      <div class="col-md-9">
        <input type="date" id="fecha_entrega_servicio" name="fecha_entrega_servicio" class="form-control">
      </div>
    </div>

    <div class="form-group row">
      <label class="col-md-3 form-control-label" for="marca">Ubicación y Piso</label>
      <div class="col-md-9">
        <div class="form-row">
          <div class="col">
            <input type="text" id="ubicacion" name="ubicacion" class="form-control" placeholder="Ej: Laboratorio" required>
          </div>
          <div class="col">
            <input type="text" id="piso" name="piso" class="form-control" placeholder="Primer Piso" required>
          </div>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-md-3 form-control-label" for="marca">Motivo y Fecha de Baja</label>
      <div class="col-md-9">
        <div class="form-row">
          <div class="col-lg-6">
            <input type="text" id="motivo_baja" name="motivo_baja" class="form-control" placeholder="Motivo de Baja">
          </div>
          <div class="col-lg-6">
            <input type="date" id="fecha_baja" name="fecha_baja" class="form-control">
          </div>
        </div>
      </div>
    </div>

    <div class="form-group row">
      <label class="col-md-3 form-control-label" for="imagen">Imagen</label>
      <div class="col-md-9">
        <input type="file" id="imagen" name="imagen" class="form-control">
      </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">
        <i class="fa fa-times fa-2x"></i>
        Cerrar
      </button>
      <button type="submit" class="btn btn-success">
        <i class="fa fa-save fa-2x"></i>
        Guardar
      </button>
    </div>