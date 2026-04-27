<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\ProductCategories;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\States;
use Illuminate\Support\Facades\Auth;
use File;
use Session;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->sort??'DESC';
        $limit = $request->limit??10;
        if($request->has('q') && $request->q!='') {
            $q = $request->q;
            $data = Products::where('title', 'LIKE', "%{$q}%")->OrderBy('id', $sort)->paginate($limit);
        } else {
            $data = Products::OrderBy('id', $sort)->paginate($limit);
        }
        return view('backend.products.index', compact('data'));
    }

    public function create()
    {
        $categories = ProductCategories::where('is_active',1)->OrderBy('title')->get()->groupBy('category_type');
        $states = States::where('country_id', '233')->pluck('name', 'id');
        return view('backend.products.create', compact('categories','states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo_date' => 'required|date',
        ]);

        $data = $request->except('_token');
        $data['slug'] = generateUniqueProductSlug($request->title);
        $data['is_active'] = 1;
        $data['created_by'] = Auth::user()->id;
        $data['user_id'] = Auth::user()->id;
        $data['vaccinations'] = (int) $request->input('vaccinations', 0) ? 1 : 0;
        $data['health_certificate'] = (int) $request->input('health_certificate', 0) ? 1 : 0;
        $data['health_record'] = (int) $request->input('health_record', 0) ? 1 : 0;
        $data['health_warranty'] = ($request->health_warranty === 'on' || $request->health_warranty === 1)?1:0;
        $data['is_featured'] = ($request->is_featured === 'on' || $request->is_featured === 1)?1:0;
        Products::create($data);
        Session::flash('success', 'Item added successfully');
        return redirect()->route('products.index');
    }

    public function edit($id)
    {
        $data = Products::with('location')->find($id);
        $categories = ProductCategories::where('is_active',1)->OrderBy('title')->get()->groupBy('category_type');
        $states = States::where('country_id', '233')->pluck('name', 'id');
        $cities = Cities::where('state_id', $data->state_id)->pluck('name', 'id');
        return view('backend.products.edit', compact('data','categories','states','cities'));
    }
    
    public function update($id, Request $request)
    {
        $request->validate([
            'photo_date' => 'required|date',
        ]);

        $product = Products::find($id);
        
        $data = $request->except('_token', 'gallery', 'existing_gallery', 'removed_gallery', 'existing_gallery_items');
        $data['user_id'] = Auth::user()->id;
        $data['vaccinations'] = (int) $request->input('vaccinations', 0) ? 1 : 0;
        $data['health_certificate'] = (int) $request->input('health_certificate', 0) ? 1 : 0;
        $data['health_record'] = (int) $request->input('health_record', 0) ? 1 : 0;
        $data['health_warranty'] = ($request->health_warranty === 'on' || $request->health_warranty === 1)?1:0;
        $data['is_featured'] = ($request->is_featured === 'on' || $request->is_featured === 1)?1:0;
        
        // Handle gallery images
        $gallery = [];
        
        // Get existing gallery (if product has gallery)
        $existingGallery = [];
        if($product->gallery && is_array($product->gallery)) {
            $existingGallery = $product->gallery;
        }
        
        // Get removed gallery images
        $removedGallery = [];
        if($request->has('removed_gallery') && !empty($request->removed_gallery)) {
            $removedGallery = json_decode($request->removed_gallery, true);
            if(!is_array($removedGallery)) {
                $removedGallery = [];
            }
        }
        
        // Keep existing gallery images that were not removed
        foreach($existingGallery as $existingImage) {
            if(!in_array($existingImage, $removedGallery)) {
                $gallery[] = $existingImage;
            } else {
                // Delete removed image file from server
                $imagePath = public_path($existingImage);
                if(File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        }
        
        // Handle new gallery images from file manager
        if($request->has('gallery') && !empty($request->gallery)) {
            $newGallery = $request->gallery;
            // If it's a string (comma-separated), convert to array
            if(is_string($newGallery)) {
                $newGallery = array_filter(array_map('trim', explode(',', $newGallery)));
            }
            // If it's an array, merge with existing
            if(is_array($newGallery)) {
                $gallery = array_merge($gallery, $newGallery);
            }
        }
        
        // Remove duplicates and re-index array
        $gallery = array_values(array_unique($gallery));
        
        // Ensure gallery is stored as array (model will JSON encode it)
        $data['gallery'] = $gallery;
        
        $product->update($data);
        Session::flash('success', 'Item update successfully');
        return redirect()->route('products.index');
    }

    public function status($id)
    {
        $client = Products::find($id);
        $client->is_active = ($client->is_active==1)?0:1;
        $client->save();
        return redirect()->route('products.index');
    }

    public function delete(Request $request, $id)
    {
        Products::destroy($id);
        Session::flash('success', "1 item(s) deleted");
        return redirect()->route('products.index');
    }

	public function delete_all(Request $request)
    {
        $count = count($request->ids);
        Products::destroy($request->ids);
        Session::flash('success', "{$count} item(s) deleted");
        return redirect()->route('products.index');
    }
}
