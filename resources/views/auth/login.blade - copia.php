@extends('layouts.app')

@section('content')
<style>
    body {
        font-size: 14px !important;
        font-family: Arial, Helvetica, sans-serif;
        margin: 0px 0px 10px 0px;
        padding: 0px;
        background: #FFF;
        color: #666666;
    }

   
    .MainArea {
        margin-left: auto;
        margin-right: auto;
        padding-left: 20px;
        padding-right: 20px;
        display: block;
        width: 955px;
    }
 
    .left {
        width: 475px;
        height: 475px;
        padding: 0px 0px 10px 0px;
        float: left;
        display: block;
    }
 
    .right {
        width: 320px;
        float: right;
        display: block;
        background: #FFF;
    }
 
	    .copyright_login {
        float: right;
        font-size: 12px;
        color: #702789;
        padding: 4px 0px 0px 0px;
    }
</style>

<div class="container" id="app">
	<div class="row">
		<div id="Div1" class="MainArea">
			<div class="left">
				<div class="left_img">
					<img src="/imagenes/login/logo_right.jpg" alt="">
				</div>
			</div>	
				<div class="right">
					<div class="logo">
						<img src="/imagenes/login/logo_top.png" alt="">
					</div>
				
					<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
						 
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Usuario:</label>
							
							
                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" v-model="email">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> 

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Clave:</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Sucursal:</label>

                            <div class="col-md-8">
                                <select class="form-control" name="site">
                                    <option value="">Seleccione una sucursal</option>
                                    <option v-for="site in userSites" :value="site.id">@{{site.name}}</option>
                                </select>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Recordar
                                    </label>
                                </div>
                            </div>
                        </div>
 
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Acceder
                                </button>

                                 
                            </div>
                        </div>
                    </form>
				</div>

			 
		</div>
		<div class="foot_login">
            <div class="foot_login_content">
                
                <div class="copyright_login">
                    Copyright Asvnets 2019. All rights reserved.
                </div>
            </div>
        </div>
		
	</div>
 
</div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/sites.js')}}"></script>
@endsection