<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUserFormRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // $users = User::get();  //o get pega todos os users da tabela.
        // Não se deve colocar as queres na camada Controller. Poderia ser na Model, mas o ideal é concentrar todas em Repository
        // Elas estão aqui por questões didáticas no exemplo.
        // $users = User::where('name', 'LIKE', "%{$request->search}%")->get(); /* com apenas um filtro */
        $search = $request->search; 
        $users = User::where(function ($query) use ($search) {
            if ($search) {
                $query->where('email', $search);   // com mais de um filtro
                $query->orWhere('name', 'LIKE', "%{$search}%");
            }
        })->get();
        
        return view('users.index', compact('users'));

    }
    public function show($id)
    {
        //$user = User::where('id', $id)->first(); /*poderia ser assim: where('id', '=', $id), com o comparador explicitado.*/
        if (!$user = User::find($id))
            return redirect()->route('users.index');
        return view('users.show', compact('user'));

        //dd('users.show', $id);

    }

    public function create()
    {
        return view('users.create');


    }
    public function store(StoreUpdateUserFormRequest $request)
    {
        //dd($request->all());
        $data = $request->all();

       $data['password'] = bcrypt($request->password);

        User::create($data); // cuidado para não deixar created ao invés de create

        // return redirect()->route('users.show', $user->id);
        return redirect()->route('users.index');
     
        // $user = new User;
        // $user->name =  $request->name;
        // $user->email =  $request->email;
        // $user->password =  $request->password;
        // $user->save();
        
    }
    public function edit($id)
    {
        if (!$user = User::find($id))
            return redirect()->route('users.index');
        return view('users.edit', compact('user'));
    }
    public function update(StoreUpdateUserFormRequest $request, $id)
    {
        if (!$user = User::find($id))
            return redirect()->route('users.index');
        $data = $request->only('name', 'email');

        if ($request->password)
            $data['password'] = bcrypt($request->password);

        $user->update($data);

        return redirect()->route('users.index');
        
    }
    public function destroy($id)
    {
       
        if (!$user = User::find($id))
            return redirect()->route('users.index');
        
        $user->delete();

        return redirect()->route('users.index');

        //dd('users.show', $id);

    }
}
