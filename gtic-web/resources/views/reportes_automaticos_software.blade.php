@foreach ($reportes as $reporte)
	
	<div class="barra_titulo_reportes_automaticos">Software Instalado en el PC {{$reporte[0]}}</div> <!--nombre del PC-->
	<div style="height: 25em; overflow: auto;">
		<table class="table table-striped">
			<thead class="table-primary">
			 <tr>
			    <th>Fecha de instalación</th>
			    <th>Nombre</th>
			    <th>Desarrollador</th>
			    <th>Versión</th>

			  </tr>
			</thead>

			<tbody>

			  @for($i = 1; $i < sizeof($reporte); $i++)
					<tr>
					  	@foreach ($reporte[$i] as $info)
						    <td>{{$info}}</td>
						@endforeach
					</tr>
			  @endfor

			</tbody>
		</table>
	</div>
@endforeach