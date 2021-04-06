@extends('principal')
@section('contenido')
<main class="main">
  <!-- Breadcrumb -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item active"><a href="/">SISTEMA DE INVENTARIO</a></li>
  </ol>
  <div class="container-fluid">
    <form action="{{ route('equipo.import') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="file" name="file" required>
      <button type="submit" class="btn btn-primary">
        Enviar
      </button>
    </form>
  </div>
</main>
@endsection