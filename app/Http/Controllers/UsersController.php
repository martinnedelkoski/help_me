<?php

namespace App\Http\Controllers;

use App\Categories\Category;
use App\Roles\Role;
use App\Topics\Topic;
use App\Users\Commands\StoreUserCommand;
use App\Users\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $user = null;
        if (Auth::user()) {
            $user = Auth::user();
        }

        /** @var Topic[] $topics */
        $topics = Topic::get()->all();
        $topic = null;

        $max = 0;
        $now = Carbon::now();

        foreach ($topics as $current) {
            if (count($current->getComments()) >= $max) {
                $max = count($current->getComments());
                $topic = $current;
            }
        }

        return view('home')->with(compact('user', 'topic'));
    }

    public function profile()
    {
        $user = Auth::user();

        return view('users.profile')->with(compact('user'));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $user->setName($request->get('name'));
        $user->setSurname($request->get('surname'));
        $user->setUsername($request->get('username'));
        $user->setEmail($request->get('email'));
        $user->setBirthday(new Carbon($request->get('birthday')));

        $user->save();

        return redirect()->route('users.profile');
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

        $role = Role::where('name', 'user')->get()->first();

        $user = new User();
        $user->setName($name);
        $user->setSurname($surname);
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setBirthday(new Carbon($birthday));

        $user->setRole($role);

        $user->save();

//        try {
//            $this->commandBus->dispatch(new StoreUserCommand(
//                $name, $surname, $username, $email, $password, $birthday
//            ));
//
//            $this->session->flash('success', 'User successfully stored');
//        } catch (\Exception $e) {
//            dd($e);
//            $this->session->flash('error', 'Error while storing the user.');
//        }

        return redirect()->route('home');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $user = User::where('username', $credentials['username'])
            ->where('password', $credentials['password'])->get()->first();

        if ($user) {
            Auth::login($user);

            return redirect()->route('home');
        }

        $this->session->flash('error', 'Email or password wrong');

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }

    public function topics()
    {
        /** @var User $user */
        $user = Auth::user();

        $topics = $user->getTopics();

        return view('users.topics')->with(compact('user', 'topics'));
    }

    public function createCategory()
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->isAdmin()) {
            return redirect()->back();
        }

        return view('categories.create');
    }

    public function storeCategory(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        if (! $user->isAdmin()) {
            return redirect()->back();
        }

        $category = new Category();
        $category->setName($request->get('name'));
        $category->save();

        return redirect()->route('home');
    }
}
