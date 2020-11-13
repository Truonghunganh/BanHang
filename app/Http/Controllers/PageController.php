<?php

namespace App\Http\Controllers;
use App\Models\Slide;
use Illuminate\Http\Request;
use App\Models\Product;

use App\Models\Type_Product;
use Session;
use App\Cart;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\Bill_Detail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    
    public function getIndex(){
        
        $slides=Slide::all();// lấy db của cái bảng slide

        $sanpham_khuyenmais=Product::where('promotion_price','<>',0)->paginate(8);
        // lấy cái Products từ database khi new=1 (sản phẩm mới)
        
        $new_products=Product::where('new',1)->paginate(4);
        // là cái trang khi có đường dẫn là index , slide là cái mãng truyền qua trang đó
         
        // lấy các biến trên truyền qua trang trangchu
        return view('page.trangchu',compact('slides','new_products', 'sanpham_khuyenmais'));
    }
    
    public function getLoaiSanPham($id_type){
        $SanPhamTheoIDloai=Product::where('id_type',$id_type)->get();// lấy cái  loại sản phẩm
        $LoaiSanPham= Type_Product::where('id',$id_type)->first();
        $SanPhamKhacTheoIDloai = Product::where('id_type','<>', $id_type)->paginate(3); // lấy cái  loại sản phẩm
        $loai_SPs = Type_Product::all();
        
        return view('page.loai_sanpham',compact('SanPhamTheoIDloai', 'LoaiSanPham', 'SanPhamKhacTheoIDloai', 'loai_SPs'));
    }
    
    public function getChiTietSanPham(Request $request){
        $ChiTietSanPham=Product::where('id',$request->id)->first();
        $sanpham_Tuongtus=Product::where('id_type',$ChiTietSanPham->id_type)->paginate(6);

        return view('page.chiTiet_sanPham',compact('ChiTietSanPham','sanpham_Tuongtus'));
    }

    public function getLienHe()
    {
        return view('page.LienHe');
    }

    public function getGioiThieu(){
        return view('page.Gioi_Thieu');
    }

    public function ThemSanPhamVaoGioHang(Request $request,$id)
    {
        $SanPham = Product::find($id);// tìm sản phẩm theo id trong db
        $oldCart=Session('cart')?Session('cart'):null;// lấy cái session hiện tại
        $cart=new Cart($oldCart);// khởi tạo cái giỏ hàng với session
        $cart->add($SanPham,$id);// thêm vào sản phẩm vào giỏ hàng
        
        $request->session()->put('cart',$cart);// lưu lại session
        return redirect()->back();
    }

    public function XoaSanPhamVaoGioHang(Request $request, $id)
    {
        $oldCart = Session('cart') ? Session('cart') : null;// lấy cái cart hiện tại
        if ($oldCart!=null) {
            $cart = new Cart($oldCart); // tạo cái cart hiện tại
            $cart->removeByOne($id); // xóa 1 sản phẩm trong c
            if (count($cart->items)>0) {
                $request->session()->put('cart', $cart);// lưu lại
            }
            else {
                $request->session()->forget('cart');
            }
        }
        return redirect()->back();// trở về trang đó
    }
    public function XoaNhieuSanPhamVaoGioHang(Request $request ,$id){
        $oldCart= Session('cart') ? Session('cart') : null;
        if ($oldCart!=null) {
            $cart=new Cart($oldCart);
            $cart->removeItem($id);
            if (count($cart->items) > 0) {
                $request->session()->put('cart', $cart); // lưu lại
            } else {
                $request->session()->forget('cart');//  xóa session đi
            }
        }
        return redirect()->back();
    }
    public function DatHang()
    {
        if (session('cart')) {
            $old_cart = Session('cart');
            $cart = new Cart($old_cart);
            $product_cart=$cart->items;
            $totalPrice=$cart->totalPrice;
            return view('page.dat_hang',compact('product_cart', 'totalPrice'));    
      }
        return view('page.dat_hang');
    }

    public function thanh_toan_dat_hang(Request $request){
        try {
            $old_cart = Session('cart') ? Session('cart') : null;
        
            if ($old_cart!=null) {
                $cart = new Cart($old_cart);
                $customer = new Customer;
                $customer->name = $request->name;
                $customer->gender = $request->gender;
                $customer->email = $request->email;
                $customer->address = $request->address;
                $customer->phone_number = $request->phone;
                $customer->note = $request->note;
                $customer->save();

                $bill = new Bill;
                $bill->id_customer = $customer->id;
                $bill->date_order = date('Y-m-d ');
                $bill->total = $cart->totalPrice;
                $bill->payment = $request->payment_method;
                $bill->note = $request->note;
                $bill->save();

                foreach ($cart->items as $value) {
                    $bill_detail = new Bill_Detail;
                    $bill_detail->id_bill = $bill->id;
                    $bill_detail->id_product = $value['item']['id'];
                    $bill_detail->quantity = $value['qty'];
                    $bill_detail->unit_price = ($value['price'] / $value['qty']);
                    $bill_detail->save();
                }
                $request->session()->forget('cart');
                return redirect()->back()->with('thongbao','đặt hàng thành công ');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('thongbao', 'đặt hàng thất bại');
        }      
    }
    public function dangnhap(){
        return view('page.dang_nhap');
    }
    public function dangki()
    {
        return view('page.dang_ki');
    }
    public function Submitdangki(Request $request)
    {
        $request->validate([
            'email'=>'required|email|unique:users,email',
            'fullname'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'password' => 'required|min:6|max:12',
            're_password'=>'same:password'
        ],[
            'email.reqired'=>'vui lòng nhạp email',
            'email.email'=>'email không đúng định dạng',
            'email.unique'=>'email đã có người sữ dụng',
            'fullname.required'=>'vui lòng nhập tên',
            'addrss.reqired' => 'vui lòng nhập địa chỉ ',
            'phone.reqired' => 'vui lòng nhập số điện thoại',
            'password.required'=>'vui lòng nhập mật khẩu',
            'password.min'=>'mật khẩu phải ít nhất 6 kí tự',
            'password.max'=>'mật khẩu không được quá 12 kí tự',
            're_password.same'=>'mật khẩu không giống nhau'
            
        ]);
        $user= new User();
        $user->full_name=$request->fullname;
        $user->email=$request->email;
        $user->password=Hash::make( $request->password);
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->save();
        return redirect()->back()->with('thongbao', 'đăng kí thành công');
    }

    public function Submitdangnhap(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:12',
        ], [
            'email.reqired' => 'vui lòng nhạp email',
            'email.email' => 'email không đúng định dạng',
            'password.required' => 'vui lòng nhập mật khẩu',
            'password.min' => 'mật khẩu phải ít nhất 6 kí tự',
            'password.max' => 'mật khẩu không được quá 12 kí tự',
        ]);
        $kiemtra = array('email' => $request->email,'password'=>$request->password );
        if (Auth::attempt($kiemtra)) {
            return redirect()->back()->with(['flag'=>'success','thongbao'=>'đăng nhập thành công']);
        } else {
            return redirect()->back()->with(['flag' => 'danger', 'thongbao' => 'đăng nhập thành công']);
        }        
    }

    public function dangxuat(){
        Auth::logout();
        return redirect('index');
    }
    public function seach(Request $request){
        $products=Product::where('name','like','%'.$request->key.'%')->orwhere('unit_price',$request->key)->get();
        return view('page.seach', compact('products'));
    }

}
