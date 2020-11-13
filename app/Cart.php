<?php

namespace App;

class Cart
{
	public $items = null;// danh sách sản phẩm
	public $totalQty = 0;// tổng sản phẩm
	public $totalPrice = 0;// tổng tiền

	public function __construct($oldCart){
		if($oldCart){                                // nếu session  mà không null thì 
			$this->items = $oldCart->items;			 // - danh sách giỏ hàng = danh sách giỏ hàng hiện tại									
			$this->totalQty = $oldCart->totalQty;	 // - tổng sản phẩn phẩm = tổng sản phẩm hiện tại	
			$this->totalPrice = $oldCart->totalPrice;// - tổng tiền của sản phẩm= tổng sản phẩm hiện tại
		}
	}

	public function add($item, $id){
		// tạo ra 1 cái giỏ hàng : số lượng n sản phẩm(qty), tổng tiền của n sản phẩm , và sản phẩm
		$giohang = ['qty'=>0, 'price' => $item->unit_price, 'item' => $item];// tạo ra 1 cái giỏ hàng
		if($this->items){// nếu danh sách sản phẩm tồn tại thì : 
			if(array_key_exists($id, $this->items)){// nếu id của giỏ hàng có trong danh sách gi hànd thì 
				$giohang = $this->items[$id];// cho giỏ hàng = giỏ hàng theo id (id sản phẩm) đó 
			}
		}
		$giohang['qty']++;// n+1
		if ($item->promotion_price>0) {
			$giohang['price'] = $item->promotion_price * $giohang['qty']; // tổng tiền của giỏ hàng đó
			$this->items[$id] = $giohang; // thêm vào danh sách giỏ hàng theo id
			$this->totalQty++; // tổng sản phẩm của những giỏ hàng
			$this->totalPrice += $item->promotion_price;// tổng tiền của những giỏ hàng		
		} else {
			$giohang['price'] = $item->unit_price * $giohang['qty']; // tổng tiền của giỏ hàng đó
			$this->items[$id] = $giohang; // thêm vào danh sách giỏ hàng theo id
			$this->totalQty++; // tổng sản phẩm của những giỏ hàng
			$this->totalPrice += $item->unit_price;// tổng tiền của những giỏ hàng
		}
		
	}
	//xóa 1
	public function removeByOne($id){		
		$this->items[$id]['qty']--;
		$this->totalQty--;
		if ($this->items[$id]['item']->promotion_price>0) {
			$this->items[$id]['price'] -= $this->items[$id]['item']->promotion_price;
			$this->totalPrice -= $this->items[$id]['item']->promotion_price;
		} else {
			$this->items[$id]['price'] -= $this->items[$id]['item']->unit_price;
			$this->totalPrice -= $this->items[$id]['item']->unit_price;
		}
		
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
	}
	//xóa nhiều
	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
