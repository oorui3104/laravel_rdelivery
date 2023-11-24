<?php

namespace App\Http\Controllers\Owner\Auth;

use App\Http\Controllers\Controller;
use App\Models\Owner;
use App\Models\Shop;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Throwable;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('owner.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Owner::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try {
            DB::transaction(function () use($request, &$owner){
                $owner = Owner::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                Shop::create([
                    'owner_id' => $owner->id,
                    'name' => '店名を入力してください',
                    'address' => '住所を入力してください',
                    'inquiry' => '問い合わせ先を入力してください', 
                    'information' => '店舗情報を入力してください',
                    'filename' => '',
                ]);

                event(new Registered($owner));
                Auth::guard('owners')->login($owner);
            });  

            } catch(Throwable $e) {
                Log::error($e);
                throw $e;
            }

        if ($owner && $owner->id) {
            return redirect()->route('owner.shops.edit', ['id' => $owner->id])
            ->with([
                'message' => '店舗の情報を登録してください',
                'status' => 'info'
            ]);

        } else {
            Log::error('オーナーのidが取得できていません');
        }
        
    }
}
