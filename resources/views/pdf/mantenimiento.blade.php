<!DOCTYPE>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Detalles del Mantenimiento</title>
<style>
  body {
    font-family: Arial, sans-serif;
    font-size: 14px;
  }

  .container {
    width: 500px;
    margin: 0 auto;
    padding: 0 100px;
  }
  table {
    width: 100%;
    margin: 0 auto;
    border: 1px solid blue;
  }
  th,td {
    padding: 10px;
  }
  th {
    text-align: left;
  }
  td {
    text-align: right;
  }
  
</style>

<body>
  <div class="container">
    <h1>
      Detalles de aplicación del Mantenimiento
    </h1>
    <table>
      <tr>
        <th>
          Equipo
        </th>
        <td>
          {{ $aplicacion->mantenimiento->equipo->nombre . " " . $aplicacion->mantenimiento->equipo->activo_fijo }}
        </td>
      </tr>
      <tr>
        <th>
          Modelo
        </th>
        <td>
          {{ $aplicacion->mantenimiento->equipo->modelo }}
        </td>
      </tr>
      <tr>
        <th>
          Marca
        </th>
        <td>
          {{ $aplicacion->mantenimiento->equipo->marca }}
        </td>
      </tr>
      <tr>
        <th>
          Tipo de Mantenimiento
        </th>
        <td>
          {{ $aplicacion->mantenimiento->tipo }}
        </td>
      </tr>
      <tr>
        <th>
          Fecha de aplicación
        </th>
        <td>
          {{ $aplicacion->fecha_aplicacion }}
        </td>
      </tr>
      <tr>
        <th>
          Tiempo parado por mantenimiento
        </th>
        <td>
          {{ $aplicacion->tiempo_parado_mantenimiento }}
        </td>
      </tr>
      <tr>
        <th>
          Frecuencia de Mantenimiento
        </th>
        <td>
          {{ $aplicacion->mantenimiento->frecuencia }} Mes
        </td>
      </tr>
      <tr>
        <th>
          Fecha de proxima aplicación
        </th>
        <td>
          {{ $aplicacion->mantenimiento->fecha_vencimiento }}
        </td>
      </tr>
    </table>
  </div>
</body>

</html>