<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    protected $smsService;
    public function __construct(SmsService $smsService)
    {
        $this->smsService = $smsService;
    }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
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
            'name_np' => ['required', 'string', 'max:255'],
            'contact_no' => ['required', 'string', 'max:10'],
            'dob_bs' => ['nullable', 'date'],
            'dob_ad' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:male,female,others'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'name_np' => $request->name_np,
            'contact_no' => $request->contact_no,
            'dob_bs' => $request->dob_bs,
            'dob_ad' => $request->dob_ad,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
              $user->assignRole('trainee');
        event(new Registered($user));

        // SMS अहिलेका लागि Disable गरिएको छ
        // if (!empty($user->contact_no)) {
        //     $this->smsService->sendSMS(
        //         $user->contact_no,
        //         'तपाईंको खाता दर्ता भइसकेको छ। कृपया इमेल जाँच गर्नुहोस्। नदेखिए स्प्याम बक्स पनि जाँच्नुस्।'
        //     );
        // }

        return redirect()->route('login')->with('registered_email', $user->email);
    }
}
