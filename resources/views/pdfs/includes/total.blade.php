<div class="row">
    <table>
        <tr>
            <th rowspan="3">
                <font size=1> 
                - Esta cotizacion esta sujeta a variaciones si al realizar el servicio se requieren repuestos o  trabajos adicionales. Esta cotizacion esta realizada segun requerimiento, terminos de referencia o especificaciones tecnicas. Esta cotizacion tiene vigencia de 30 dias habiles a partir de su creacion
                </font>
            </th>
            <th width="100px">
                Sub Total (S/.)
            </th>
            <th width="100px" style="text-align:right">{{ $d->subtotal }}</th> 
        </tr>
        <tr>
            <th>I.G.V (18%)</th>
            <th style="text-align:right">{{ $d->igv }}</th>
        </tr>
        <tr>
            <th>TOTAL (S/.)</th>
            <th style="text-align:right">{{ $d->total }}</th>
        </tr>
    </table>
</div>