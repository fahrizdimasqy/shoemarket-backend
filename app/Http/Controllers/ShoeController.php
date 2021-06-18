<?php

namespace App\Http\Controllers;
use App\Http\Requests\ShoeRequest;
use Illuminate\Http\Request;
use App\Models\Shoe;
use Yajra\DataTables\Facades\DataTables;
class ShoeController extends Controller
{
    //
    public function index()
    {
        $shoe = Shoe::paginate(10);

        return view('shoe.index', [
            'shoe' => $shoe
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shoe.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ShoeRequest $request)
    {
        $data = $request->all();

        $data['picturePath'] = $request->file('picturePath')->store('assets/shoe', 'public');

        Shoe::create($data);

        return redirect()->route('shoe.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shoe  $food
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show(Shoe $shoe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shoe  $food
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Shoe $shoe)
    {
        return view('shoe.edit',[
            'item' => $shoe
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shoe  $food
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Shoe $shoe)
    {
        $data = $request->all();

        if($request->file('picturePath'))
        {
            $data['picturePath'] = $request->file('picturePath')->store('assets/shoe', 'public');
        }

        $shoe->update($data);

        return redirect()->route('shoe.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shoe  $food
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Shoe $shoe)
    {
        $shoe->delete();

        return redirect()->route('shoe.index');
    }
}
