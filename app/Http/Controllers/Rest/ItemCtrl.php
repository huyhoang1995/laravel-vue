<?php

// ItemController.php

namespace App\Http\Controllers\Rest;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Validator;
use Intervention\Image\ImageManager;

class ItemCtrl extends Controller
{
    private $itemModel;
    
    // images resize
     /**
     * Instance của Intervention\Image\ImageManager
     */
    private $imageManager;

    /**
     * Đường dẫn đến file sẽ resize
     */
    private $imagePath;

    /**
     * Tỷ lệ ảnh.
     * Dành cho trường hợp chỉ sử dụng width của ảnh thumbnail
     */
    private $thumbRate;

    /**
     * Width của ảnh thumb
     */
    private $thumbWidth;

    /**
     * Height của ảnh thumb
     */
    private $thumbHeight;

    /**
     * Thư mục sẽ chứa ảnh đã được resize
     */
    private $destPath;

    /**
     * Tọa độ X. Cho trường hợp crop ảnh
     */
    private $xCoordinate;

    /**
     * Tọa độ Y. Cho crop ảnh
     */
    private $yCoordinate;

    /**
     * Vị trí sẽ dùng cho cả 2 trường hợp crop và resize. Là fit
     */
    private $fitPosition;

    /**
     * Tên ảnh thumb sẽ được lưu
     */
    private $fileName;
    public function __construct(Item $itemModel){
        $this->itemModel = $itemModel;
    }
    
    /**
     * danh sach item
     */
    public function listItem(Request $request){
        
        //validate
        $validate = Validator::make($request->all(), [
            'page' => 'required|numeric',
            'perPage' => 'required|numeric',
        ], [
            'page.required' => 'page không được bỏ trống',
            'page.numeric' => 'page không đúng định dạng',
            'perPage.required' => 'perPage không được bỏ trống',
            'perPage.numeric' => 'perPage không đúng định dạng',
        ]);
        if($validate->fails()){
            return response()->json($validate->messages(), 422);
        }
        $perPage = $request->input('perPage', 10); 
        $name = $request->input('name', '');
        $listItem = $this->itemModel->filterName($name)->buildCond()->orderBy('id','desc')->paginate($perPage);
        return response()->json($listItem);
    }

    public function singleItem(Request $request, $id){
        $data = $this->itemModel->filterId($id)->buildCond()->first();
        return response()->json($data);
    }

    public function insertItem(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
        ], [
            'name.required' => 'tên không được bỏ trống',
            'price.required' => 'giá không được bỏ trống',
            'price.numeric' => 'giá không đúng định dạng',
        ]);

        if($validate->fails()){
            return response()->json($validate->messages(), 422);
        }
        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatar_name = $avatar->getClientOriginalName();
            $avatar->move('images', $avatar_name);
        }else{
            $avatar_name = "avatar.png";
        }
        $newId = $this->itemModel->insertGetId([
            'name' => $request->name,
            'price' => $request->price,
            'avatar'=> $avatar_name,
        ]);
        return response()->json(['status' => true]);

    }

    public function updateItem(Request $request,$id)
    {
        //validate
        $validate = Validator::make(array_merge(['id' => $id], $request->all()), [
            'id' => 'required|exists:items,id',
            'name' => 'required',
            'price' => 'required|numeric',
        ], [
            'name.required' => 'name không được bỏ trống',
            'price.required' => 'age không được bỏ trống',
            'price.numeric' => 'age không đúng định dạng',
            'id.required' => 'id không được bỏ trống',
            'id.exists' => 'id không tồn tại'
        ]);

        if($validate->fails()){
            return response()->json($validate->messages(), 422);
        }
        $itemInfo=$this->itemModel->find($id);

        if ($request->hasFile('avatar')) {
            $avatar = $request->avatar;
            $avatar_name = $avatar->getClientOriginalName();
            $avatar->move('images', $avatar_name);
        }else {
            $avatar_name = $itemInfo->avatar;
        }
        $itemInfo->name = $request->name;
        $itemInfo->price = $request->price;
        $itemInfo->avatar = $avatar_name;

        $itemInfo->save();

        return response()->json(['status'=>true]);
    }
    
    public function deleteItem($id){
        //validate
        $validate = Validator::make(['$id' => $id], [
            'id' => 'requried|exists:example,id'
        ], [
            'id.required' => 'id không được bỏ trống',
            'id.exists' => 'id không tồn tại'
        ]);

        if($validate->fails()){
            return response()->json($validate->messages(), 422);
        }
        $this->itemModel->find($id)->delete();
        return response()->json(['status' => true]);
    }
}

