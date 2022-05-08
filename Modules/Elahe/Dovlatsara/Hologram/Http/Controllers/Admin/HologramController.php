<?php

namespace Modules\Hologram\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Modules\Hologram\Entities\Hologram;
use Modules\Hologram\Http\Requests\Admin\StoreRequest;
use Modules\Hologram\Http\Requests\Admin\UpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Modules\AdminMasterNew\Http\Traits;

class HologramController extends Controller
{
    use Traits\UploadFileTrait;

    public function convertToEnglish($string)
    {
        $newNumbers = range(0, 9);
        // 1. Persian HTML decimal
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string = str_replace($persianDecimal, $newNumbers, $string);
        $string = str_replace($arabicDecimal, $newNumbers, $string);
        $string = str_replace($arabic, $newNumbers, $string);
        //dd(str_replace($persian, $newNumbers, $string));
        return str_replace($persian, $newNumbers, $string);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $holograms = Hologram::all();
        return view('Holograms::admin.index', compact('holograms'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('Holograms::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        if ($request->file('logo')) {
            $logo = $this->uploadFile($request->file('logo'), 'public/upload/hologram/logo/' . now()->year
                . '/' . now()->month);
        }else
            $logo = null;
        $hologram = Hologram::create(
            [
                'type' => $request->hologram_type,
                'title' => $request->title,
                'price' => ($request->price),
                'created_user' => Auth::id(),
                'description' => $request->description,
                'logo'=>$logo,
            ]
        );
        Alert::success('', 'هولوگرام با موفقیت ثبت شد');
        return redirect()->route('holograms.index.admin');
    }

    /**
     * Show the form for editing the specified resource.
     * @param Hologram $hologram
     * @return Renderable
     */
    public function edit(Hologram $hologram)
    {
        return view('Holograms::admin.edit', compact( 'hologram'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Hologram $hologram
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Hologram $hologram)
    {
        if ($request->file('logo')) {
            File::delete(public_path($hologram->logo));
            $logo = $this->uploadFile($request->file('logo'), 'public/upload/hologram/logo/' . now()->year
                . '/' . now()->month);
        }else
            $logo = $hologram->logo;

        $hologram->update(
            [
                'type' => $request->hologram_type,
                'title' => $request->title,
                'price' => $request->price,
                'description' => $request->description,
                'logo'=>$logo,
                'updated_user' => \auth()->id(),
            ]
        );
        Alert::success('', 'هولوگرام با موفقیت ویرایش شد');
        return redirect()->route('holograms.index.admin');
    }

    /**
     * Remove the specified resource from storage.
     * @param Hologram $hologram
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Hologram $hologram)
    {
        $hologram->users()->detach();
        $hologram->ads()->detach();
        $hologram->update(['deleted_user'=>\auth()->id()]);
        $hologram->delete();
        Alert::success('', 'هولوگرام با موفقیت حذف شد');
        return redirect()->back();
    }

    public function deleteFile(Request $request): JsonResponse
    {
        $hologram = Hologram::find($request->id);
        unlink($hologram->logo);
        $hologram->update(['logo' => null,]);
        return response()->json(['success' => true]);
    }
}
