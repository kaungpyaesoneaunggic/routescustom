<?php

namespace App\Http\Controllers;
use App\Models\Drink;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDrinkRequest;
use App\Http\Requests\UpdateDrinkRequest;
class DrinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    

    public function index()
    {
        //
        $drinks = Drink::all();
        return view("drink.index",compact('drinks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("drink.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDrinkRequest;
     * @return \Illuminate\Http\Response
     */

     // @param  \Illuminate\Http\Request  $request
    public function store(StoreDrinkRequest $request)
    {
        //
        $drink = new Drink();
        $drink->name = $request->name;
        $drink->price = $request->price;
        $drink->type = $request->type;
        $drink->description = $request->description;
        $drink->quantity = $request->quantity;
        $drink->save();
        return redirect()->route('drink.index');
    }
    // private function requestValidator($request){
    //     return validator($request->validate([
    //         (['name=>required',
    //         'price'=>'required',
    //         'quantity'=>'required'
    //         ])
    //     ]));
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $drink = Drink::find($id);
        return view("drink.detail",compact('drink'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drink = Drink::find($id);
        return view("drink.edit",compact("drink"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateDrinkRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    //* @param  \Illuminate\Http\Request  $request
    public function update(UpdateDrinkRequest $request, $id)
    {
        //
        $drink = Drink::find($id);
        $drink->name = $request->name;
        $drink->price = $request->price;
        $drink->type = $request->type;
        $drink->description = $request->description;
        $drink->quantity = $request->quantity;
        $drink->update();
        return redirect()->route('drink.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $drink = Drink::find($id);
        if($drink){
            $drink->delete();
        }
        return redirect()->route('drink.index');
    }


    public function validator(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            // Add more validation rules as needed
        ]);

        // Create a new drink using the validated data
        $drink = Drink::create($validatedData);

        // Redirect or perform any additional actions
        return redirect()->route('show', ['id' => $drink->id]);
    }
}
