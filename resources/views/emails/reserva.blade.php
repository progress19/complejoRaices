<? use App\Fun; ?>
<html>
<head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <link href="http://www.pixtudios.net/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <table cellspacing="0" cellpadding="10" style="color:#666;font:15px Arial;line-height:1.4em;width:100%;">
        <tbody>
            <tr>
                <td style="color:#333;font-size:15px;padding-top:18px;">

                    <div class="container">

                        <div class="row clearfix">
                            <div class="col-md-12 column">
                                <div class="panel panel-danger">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <div style="padding:15px">
                                                <img src="https://complejoraices.com.ar/images/logo.png" width="150px" >   
                                            </div>
                                        </h3>
                                    </div>

                                    <div class="panel-body" style="color: #333; font-size: 15px;">

                                        <p>{!! $textoEmail !!}</p>

                                        <h3>N° de Reserva : <strong> {{ $reserva['id'] }} </strong></h3>
                                        <hr>

                                        <b>Fecha : </b>{{ Carbon::parse($reserva['fecha'])->translatedFormat('d F Y') }}<br> 
                                        <b>Nombre y Apellido: </b>{{ $reserva['titular'] }}<br> 
                                        <b>Email : </b>{{ $reserva['email'] }}<br> 
                                        <b>Teléfono : </b>{{ $reserva['telefono'] }}<br> 
                                        <b>Comentarios : </b>{{ $reserva['comentarios'] }}<br>

                                        <hr>

                                        <p><b>Detalle</b></p>

                                        <b>Día de ingreso : </b>{{ Carbon::parse($reserva['desde'])->translatedFormat('d M Y') }}<br> 
                                        <b>Día de salida: </b>{{ Carbon::parse($reserva['hasta'])->translatedFormat('d M Y') }}<br> 
                                        <b>Apartamento : </b>{{ $apartamento }}<br> 
                                        <b>Noches : </b>{{ $reserva['noches'] }}<br> 
                                        <b>Huéspedes : </b>{{ $reserva['huespedes'] }}<br>
                                        
                                        <?php $tarifa_diaria = 0; $tarifa_diaria = $reserva['total'] / $reserva['noches']; ?>

                                        <b>Tarifa diaria : </b>$ {{ number_format($tarifa_diaria,0, ',', '.') }}<br>

                                        <p><b>TOTAL: $ {{ number_format($reserva['total'],0, ',', '.') }}</b></p>
                                              
                                        <hr>

                                            <p><b>Datos MercadoPago</b></p>

                                            <p>N° de transacción: {{ $reserva['collection_id'] }}</p>
                                            <p>Estado : {{ $reserva['collection_status'] }}</p><br>

                                    </div>

                                    <hr>

                                    <div class="panel-footer">

                                        <strong>COMPLEJO RAÍCES</strong><br>
                                        Teléfono: 02604 - 400282 | 02604 - 408749 <br>
                                        <a href="mailto:info@complejoraices.com.ar" style="color: #3f3f3f;">info@complejoraices.com.ar</a> / <a href="https://complejoraices.com.ar" style="color: #3f3f3f;">complejoraices.com.ar</a><br>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                </td>
            </tr>
            <tr>
                <td style="padding:15px 20px;text-align:left;padding-top:5px;border-top:solid 1px #dfdfdf">
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>