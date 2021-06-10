<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reporte de comisiones por vendedor</title>

    <style type="text/css">

        @font-face {
            font-family: SourceSansPro;
            src: url(SourceSansPro-Regular.ttf);
          }

          .clearfix:after {
            content: "";
            display: table;
            clear: both;
          }

          a {
            color: #0087C3;
            text-decoration: none;
          }

          body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 14px;
            font-family: SourceSansPro;
          }

          header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
          }

          #logo {
            float: left;

          }

          #logo img {
            height: 50px;
          }

          #company {
            float: right;
            text-align: right;
          }


          #details {
            margin-bottom: 50px;
          }

          #client {
            padding-left: 6px;
            border-left: 6px solid #ff6000;
            float: left;
          }

          #client .to {
            color: #777777;
          }

          h2.name {
            font-size: 1.4em;
            font-weight: normal;
            margin: 0;
          }

          #invoice {
            float: right;
            text-align: right;
          }

          #invoice h1 {
            color: #1E9FF2;
            font-size: 2.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0  0 10px 0;
          }

          #invoice h3 {
            color: #1E9FF2;
            font-size: 1.4em;
            line-height: 1em;
            font-weight: normal;
            margin: 0  0 10px 0;
          }

          #invoice .date {
            font-size: 1.1em;
            color: #777777;
          }

          table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
          }

          table th,
          table td {
            padding: 20px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
          }

          table th {
            white-space: nowrap;
            font-weight: normal;
          }

          table td {
            text-align: right;
          }

          table td h3{
            color: #57B223;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
          }

          table .no {
            color: #FFFFFF;
            font-size: 1.6em;
            background: #ff6000;
            text-align: center;
          }

          table .desc {
            text-align: center;
          }

          table .unit {
            background: #DDDDDD;
          }

          table .qty {
          }

          table .total {
            background: #1E9FF2;
            color: #FFFFFF;
          }

          table td.unit,
          table td.qty,
          table td.total {
            font-size: 1.2em;
            text-align: center;
          }

          table tbody tr:last-child td {
            border: none;
          }

          table tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
          }

          table tfoot tr:first-child td {
            border-top: none;
          }

          table tfoot tr:last-child td {
            color: #57B223;
            font-size: 1.4em;
            border-top: 1px solid #57B223;

          }

          table tfoot tr td:first-child {
            border: none;
          }

          #thanks{
            font-size: 2em;
            margin-bottom: 50px;
          }

          #notices{
            padding-left: 6px;
            border-left: 6px solid #0087C3;
          }

          #notices .notice {
            font-size: 1.2em;
          }

          footer {
            color: #777777;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;
            text-align: center;
          }


    </style>

  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src='images/ferraros-logo.png' width="120px">
      </div>

    </header>
    <main>
        <div id="details" class="clearfix">
          <div id="client">
              <div class="to">{{ $cliente->nombre_completo }}</div>
              <h2 class="name">{{ $cliente->telefono }}</h2>
              <h2 class="name">{{ $cliente->direccion }}</h2>
              <div class="address"></div>
              <div class="email"><a href=""></a></div>
            </div>
          <div id="invoice">
            <h3 style="color: #ff6000">REPORTE DE MEMBRESIAS POR CLIENTE</h3>
            <div class="date"></div>
          </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <th class="no">PLAN</th>
              <th class="desc">FECHA INICIO</th>
              <th class="unit">FECHA FIN</th>
              <th class="desc">ESTADO</th>
            </tr>
          </thead>
          <tbody>
            @foreach( $membresias as $membresia)
            <tr>
              <td class="no">{{ $membresia->nombre_plan }}</td>
              <td class="desc">{{ $membresia->fecha_inicio }}</td>
              <td class="unit">{{ $membresia->fecha_fin }}</td>
              @if( $membresia->id_estado_membresia == 1)
              <td class="desc" style="color: green">Activo</td>
              @else
              <td class="desc" style="color: red">Inactiva</td>
              @endif
            </tr>
            @endforeach

          </tbody>



        </table>
      </main>
    <footer>

    </footer>
  </body>
</html>
