@extends('master')
@section('content')
    
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">San Phẩm</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index">Home</a> / <span>chi tiết sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						<div class="col-sm-4">
							<img src="source/image/product/{{$ChiTietSanPham->image}}" alt="">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title">{{$ChiTietSanPham->name}}</p>
								<p class="single-item-price" style="font-size: 18px;">
                                    @if ($ChiTietSanPham->promotion_price==0)
                                        <span class="flash-sale">{{number_format($ChiTietSanPham->unit_price)}} đồng</span>
                                    @else
                                        <span class="flash-del">{{number_format($ChiTietSanPham->unit_price)}} đồng</span>
									    <span class="flash-sale">{{number_format($ChiTietSanPham->promotion_price)}} đồng</span>    
                                    @endif
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p>{{$ChiTietSanPham->description}}</p>
							</div>
							<div class="space20">&nbsp;</div>

							<p>Options:</p>
							<div class="single-item-options">
								<select class="wc-select" name="color">
									<option>Qty</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								<a class="add-to-cart" href="them-SP-vao-gio-hang/{{$ChiTietSanPham->id}}"><i class="fa fa-shopping-cart"></i></a>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Mô tả </a></li>
							<li><a href="#tab-reviews">Reviews (0)</a></li>
						</ul>

						<div class="panel" id="tab-description">
							<p>{{$ChiTietSanPham->description}}</p>
						</div>
						<div class="panel" id="tab-reviews">
							<p>No Reviews</p>
						</div>
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Sản Phẩm Tương tự </h4>

						<div class="row">
							@foreach ($sanpham_Tuongtus as $sanpham_Tuongtu)
								
							<div class="col-sm-4">
								<div class="single-item">
									@if ($sanpham_Tuongtu->promotion_price!=0)
       										<div class="ribbon-wrapper">
                                                <div class="ribbon sale">Sale
                                                </div>
                                            </div>
                                        @endif
									<div class="single-item-header">
										<img src="source/image/product/{{$sanpham_Tuongtu->image}}" alt="" height="250px">
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$sanpham_Tuongtu->name}}</p>
										<p class="single-item-price" style="font-size: 18px;">
                                            @if ($sanpham_Tuongtu->promotion_price==0)
                                                <span class="flash-sale">{{number_format($sanpham_Tuongtu->unit_price)}} đồng</span>
                                            @else
                                                <span class="flash-del">{{number_format($sanpham_Tuongtu->unit_price)}} đồng</span>
											    <span class="flash-sale">{{number_format($sanpham_Tuongtu->promotion_price)}} đồng</span>    
                                            @endif
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="them-SP-vao-gio-hang/{{$sanpham_Tuongtu->id}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="chi-tiet-san-pham/{{$sanpham_Tuongtu->id}}">Details <i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							@endforeach
						</div>

						<div class="row">{{$sanpham_Tuongtus->links()}}</div>
					</div> <!-- .beta-products-list -->
				</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Best Sellers</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/1.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/2.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/3.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/4.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title">New Products</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/1.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/2.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/3.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
								<div class="media beta-sales-item">
									<a class="pull-left" href="product.html"><img src="source/assets/dest/images/products/sales/4.png" alt=""></a>
									<div class="media-body">
										Sample Woman Top
										<span class="beta-sales-price">$34.55</span>
									</div>
								</div>
							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->

@endsection