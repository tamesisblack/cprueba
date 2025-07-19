<div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover display table-responsive table-condensed" id="table">
                            <thead>
								<tr>
									<th>DOCUMENTO</th>
									<th>VIGENTE DESDE</th>
									<th>VIGENTE HAST</th>
									<th>ESTADO</th>
								</tr>
                            </thead>
                            <tbody>
			 
								<tr>
									<td> SOAT </td>
									<td> 05/12/2021 </td>
									<td> 05/12/2021 </td>
									<td><input type="checkbox"  'checked' ></td>
								</tr>
								<tr>
									<td> ALQUILER </td>
									<td> 04/01/2020 </td>
									<td> 05/12/2021 </td>
									<td><input type="checkbox"  'checked' ></td>
								</tr>
								<tr>
									<td> SCTR </td>
									<td> 05/05/2019 </td>
									<td> 05/12/2021 </td>
									<td><input type="checkbox"  'checked' ></td>
								</tr>
								<tr>
									<td> SCTR </td>
									<td> 04/05/2018 </td>
									<td> 05/12/2021 </td>
									<td><input type="checkbox"  'checked' ></td>
								</tr>
							 
							</tbody>
                        </table>
                        <div class="text-center">
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <!-- footer-->
            </div>
            <!-- /.box-footer-->
        </div>
		
		 

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#table').DataTable({
                "language": {
                    "url": "{{ asset('AdminLTE/plugins/datatables/esp.lang') }}"
                }
            });
        });
    </script>
@endsection