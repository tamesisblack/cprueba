<html>
    <title>INFORME DE PRECIOS DE PRODUCTOS POR SUCURSAL</title>
<head>
  <style>
    @page { margin: 100px 25px; }
    header { position: fixed; top: -85px; left: 0px; right: 0px; background-color: lightblue; height: 60px; padding-bottom: -10px;}
    footer { position: fixed; bottom: -90px; left: 0px; right: 0px; height: 30px; }
    table {
      border-collapse: collapse;
    }
    tr.border_bottom td {
      border-bottom: 1px solid black;
    }
    td { 
        padding: 6px;
    }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }

    .page:after { content: counter(page) }
  </style>
</head>
<body>
  <header>
   <h4 style="text-align: center;"> INFORME DE PRECIOS DE PRODUCTOS POR SUCURSAL <h5>Informe al {{date('d/m/Y')}}</h5></h4>
   <div style="margin-bottom: 20px;">&nbsp;</div>
  </header>

  <footer style="text-align: right; padding-right: 5px;">
    Pagina
    <span class="page"></span>
    </footer>
  <main>
    <table>
        <thead>
        <tr>
            <th style="text-align: left;">PRODUCTO</th>
            @foreach($sites as $site)
            <th style="width:200px !important">{{$site->name}}</th>
            @endforeach
        </tr>   
        </thead>
        <tbody>
            @foreach($items as $row)
            <tr class="border_bottom">
                <td>{{$row->nombre}}</td>

                    @if($row->site_id == 10)
                        <td style="text-align: center;">{{$row->list_price_per_unit}}</td>
                        <td></td>
                        <td></td>
                    @endif
                    @if($row->site_id == 101)
                        <td></td>
                        <td style="text-align: center;">{{$row->list_price_per_unit}}</td>
                        <td></td>
                    @endif
                    @if($row->site_id == 102)
                        <td></td>
                        <td></td>
                        <td style="text-align: center;">{{$row->list_price_per_unit}}</td>
                    @endif
            </tr>
            @endforeach 
        </tbody>
    </table>
  </main>  
</body>

</html>