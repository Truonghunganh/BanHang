@extends('master')
@section('content')
    <div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index">Home</a> / <span>Sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<ul class="aside-menu">
							@foreach ($loai_SPs as $loai_SP)
								<li><a href="loai-san-pham/{{$loai_SP->id}}">{{$loai_SP->name}}</a></li>	
							@endforeach
							
						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4>Đây loại sản phẩm : {{$LoaiSanPham->name}}</h4>
							<div class="beta-products-details">
								<p class="pull-left">Đã tìm thấy {{count($SanPhamTheoIDloai)}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
							@foreach ($SanPhamTheoIDloai as $SanPham)
								<div class="col-sm-4">
									<div class="single-item">
                                        @if ($SanPham->promotion_price!=0)
       										<div class="ribbon-wrapper">
                                                <div class="ribbon sale">Sale
                                                </div>
                                            </div>
                                        @endif
								
										<div class="single-item-header">
											<a href="chi-tiet-san-pham/{{$SanPham->id}}"><img src="source/image/product/{{$SanPham->image}}" alt="" height="250px"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$SanPham->name}}</p>
											<p class="single-item-price" style="font-size: 18px;">
                                                @if ($SanPham->promotion_price==0)
                                                    <span class="flash-sale">{{number_format($SanPham->unit_price)}} đồng</span>
                                                @else
                                                    <span class="flash-del">{{number_format($SanPham->unit_price)}} đồng</span>
												    <span class="flash-sale">{{number_format($SanPham->promotion_price)}} đồng</span>    
                                                @endif
											</p>
										</div>
										<div class="single-item-caption">
                                            <a class="add-to-cart pull-left" 
                                                href="shopping_cart.html"
                                                >
                                                <i class="fa fa-shopping-cart"></i>
                                            </a>
                                            <a class="beta-btn primary" 
                                                href="chi-tiet-san-pham/{{$SanPham->id}}"
                                                >
                                               Details <i class="fa fa-chevron-right"></i>
                                            </a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>								
							@endforeach
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Sản Phẩm khác</h4>
							<div class="beta-products-details">
								<p class="pull-left">Đã tìm thấy {{count($SanPhamKhacTheoIDloai)}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
							@foreach ($SanPhamKhacTheoIDloai as $SanPham)
								<div class="col-sm-4">
									<div class="single-item">
                                        @if ($SanPham->promotion_price!=0)
       										<div class="ribbon-wrapper">
                                                <div class="ribbon sale">Sale
                                                </div>
                                            </div>
                                        @endif
								
										<div class="single-item-header">
											<a href="chi-tiet-san-pham/{{$SanPham->id}}"><img src="source/image/product/{{$SanPham->image}}" alt="" height="250px"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$SanPham->name}}</p>
											<p class="single-item-price" style="font-size: 18px;">
                                                @if ($SanPham->promotion_price==0)
                                                    <span class="flash-sale">{{number_format($SanPham->unit_price)}} đồng</span>
                                                @else
                                                    <span class="flash-del">{{number_format($SanPham->unit_price)}} đồng</span>
												    <span class="flash-sale">{{number_format($SanPham->promotion_price)}} đồng</span>    
                                                @endif
											</p>
										</div>
										<div class="single-item-caption">
                                            <a class="add-to-cart pull-left" 
                                                href="shopping_cart.html"
                                                >
                                                <i class="fa fa-shopping-cart"></i>
                                            </a>
                                            <a class="beta-btn primary" 
                                                href="chi-tiet-san-pham/{{$SanPham->id}}"
                                                >
                                               Details <i class="fa fa-chevron-right"></i>
                                            </a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>								
							@endforeach
							</div>
							
							<div >{{$SanPhamKhacTheoIDloai->links()}}</div>
							
							<div class="space40">&nbsp;</div>
							
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->
			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection