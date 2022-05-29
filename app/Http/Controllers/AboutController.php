<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\HomeAbout;
use App\Models\Multipic;

class AboutController extends Controller
{
    public function HomeAbout() {
        $abouts = HomeAbout::latest()->get();
        return view('admin.about.index', compact('abouts'));
    }

    public function AddAbout() {
        return view('admin.about.create');
    }

    public function StoreAbout(Request $request) {
        HomeAbout::insert([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.about')->with('success', 'About successfully added');
    }

    public function EditAbout($id) {
        $abouts = HomeAbout::find($id);
        return view('admin.about.edit', compact('abouts'));
    }

    public function UpdateAbout(Request $request, $id) {
        HomeAbout::find($id)->update([
            'title' => $request->title,
            'short_dis' => $request->short_dis,
            'long_dis' => $request->long_dis,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->route('home.about')->with('success', 'About successfully updated');
    }

    public function DeleteAbout($id) {
        HomeAbout::find($id)->delete();
        return Redirect()->back()->with('success', 'About successfully deleted');
    }

    public function Portfolio() {
        $images = Multipic::all();
        return view('pages.portfolio', compact('images'));
    }
}
