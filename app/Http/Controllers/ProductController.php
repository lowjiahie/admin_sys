<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller {

    public function productmanagement() {
        $product = Product::get();
        return view('adminblade.productmanagement')->with(compact('product'));
    }

    public function addproductpage() {
        return view("adminblade.addproductpage");
    }

    public function addproduct(Request $request) {
        $request->validate([
            'productid' => 'required',
            'productname' => 'required',
            'productimage' => 'required',
            'productprice' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'productdesc' => 'required',
            'productcategory' => 'required',
        ]);

        $product = new Product();
        $product->prodID = $request->productid;
        $product->prodName = $request->productname;
        if ($request->file('productimage')) {
            $file = $request->file('productimage');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('img'), $filename);
            $product->prodImage = $filename;
        }
        $product->prodPrice = $request->productprice;
        $product->prodDesc = $request->productdesc;
        $product->prodCategory = $request->productcategory;

        $result = $product->save();

        if ($result) {
            return back()->with('success', 'Successfully added');
        } else {
            return back()->with('fail', 'Please enter correct information and try again');
        }
    }

    public function getproduct($allproduct) {
        $product = Product::find($allproduct);
        return view('adminblade.updateproductpage')->with(compact('product'));
    }

    public function updateproduct(Request $request) {
        $request->validate([
            'productid' => 'required',
            'productname' => 'required',
            'productimage' => 'required',
            'productprice' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'productdesc' => 'required',
            'productcategory' => 'required',
        ]);

        $product = Product::find($request->productid);
        $product->prodName = $request->productname;
        if ($request->prodImage != '') {
            $path = public_path('img/');

            if ($product->prodImage != '' && $product->prodImage != null) {
                $file_old = $path . $product->prodImage;
                unlink($file_old);
            }
            if ($request->file('productimage')) {
                $file = $request->file('productimage');
                $filename = $file->getClientOriginalName();
                $file->move(public_path('img/'), $filename);
                $product->prodImage = $filename;
            }
        }
        $product->prodPrice = $request->productprice;
        $product->prodDesc = $request->productdesc;
        $product->prodCategory = $request->productcategory;

        $result = $product->save();

        if ($result) {
            return back()->with('success', 'Successfully updated');
        } else {
            return back()->with('fail', 'Please enter correct information and try again');
        }
    }

    public function deleteproduct($prodID) {
        $product = Product::find($prodID);
        $result = $product->delete();
        if ($result) {
            return back()->with('success', 'Successfully deleted');
        } else {
            return back()->with('fail', 'Please enter correct information and try again');
        }
    }
    
    
    public function sort_product_api(Request $request){
        $query = Product::query();

        // Search by name
        if ($request->has('name')) {
            $query->where('prodName', 'like', '%' . $request->input('name') . '%');
        }

        // Filter by price
        if ($request->has('min_price')) {
            $query->where('prodPrice', '>=', $request->input('min_price'));
        }

        if ($request->has('max_price')) {
            $query->where('prodPrice', '<=', $request->input('max_price'));
        }

        // Sort by price
        if ($request->has('sort') && in_array($request->input('sort'), ['asc', 'desc'])) {
            $query->orderBy('prodPrice', $request->input('sort'));
        }

        $products = $query->get();

        return response()->json($products);
    }
    
    
}