@extends('master')
@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Đăng nhập</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb">
					<a href="index">Home</a> / <span>Đăng nhập</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	@if (Session::has('thongbao'))
		<div>
			<h5 style="text-align: center;color: blue">{{Session::get('thongbao')}}</h5>
		</div>
	@endif	
	@if (count($errors)>0)
        <div >
            @foreach ($errors->all() as $error)
                {{$error}}
            @endforeach
        </div>
    @endif

	<div class="container">
		<div id="content">
			
			<form action="submitdangnhap" method="post" class="beta-form-checkout">
				<input name="_token"  type="hidden" value="{{csrf_token()}}">
				<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<h4>Đăng nhập</h4>
						<div class="space20">&nbsp;</div>

						<div class="form-block">
							<label for="email">Email address*</label>
							<input type="email" name="email" required>
						</div>
						<div class="form-block">
							<label for="password">Password*</label>
							<input type="text" name="password" required>
						</div>
						<div class="form-block">
							<button type="submit" class="btn btn-primary">Login</button>
						</div>
					</div>
					<div class="col-sm-3"></div>
				</div>
			</form>
		</div> <!-- #content -->
	</div> <!-- .container -->


@endsection