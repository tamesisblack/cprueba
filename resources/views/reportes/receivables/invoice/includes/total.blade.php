<div class="row">
    <table>
        <tr>
            <th rowspan="3">
                - Esta cotixacion eta sujeta a variaciones si al realizar el servicio se requieren repuestos o trabajos adicionales.
                - Esta cotizacion esta realizada segun requerimiento, terminos de referencia o especificaciones tecnicas
                - Esta cotizacion tiene vigencia de 30 dias habiles a partir de su creacion
            </th>
            <th width="100px">
                Sub Total (S/w.)
            </th>
            <th width="100px" style="text-align:right">{{ $d->totalLinea->SUM('total')  }}</th> 
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