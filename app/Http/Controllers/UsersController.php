<?php

namespace App\Http\Controllers;

use App\Users\Commands\StoreUserCommand;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class UsersController extends Controller
{
    private $commandBus;
    private $session;
    private $auth;

    public function __construct(Dispatcher $commandBus, Store $session, Guard $auth)
    {
        $this->commandBus = $commandBus;
        $this->session = $session;
        $this->auth = $auth;
    }

    public function home()
    {
        return view('home');
    }

    public function registerForm()
    {
        return view('users.register');
    }

    public function register(Request $request)
    {
        $name = $request->get('name');
        $surname = $request->get('surname');
        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');
        $birthday = $request->get('birthday');

        try {
            $this->commandBus->dispatch(new StoreUserCommand(
                $name, $surname, $username, $email, $password, $birthday
            ));

            $this->session->flash('success', 'User successfully stored');
        } catch (\Exception $e) {
            $this->session->flash('error', 'Error while storing the user.');
        }

        return redirect()->back();
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if ($this->auth->attempt($credentials)) {
            return redirect()->route('home');
        }

        $this->session->flash('error', 'Email or password wrong');

        return redirect()->route('user.login');
    }

    public function logout()
    {
        $this->auth->logout();

        return redirect()->route('home');
    }
}
