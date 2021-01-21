<?php


namespace App\Http\Controllers\Admin;


use App\Core\Auth\Auth;
use App\Core\Auth\Token;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use App\Statistic;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Validator\Constraints\Length;

class MainController extends Controller
{
    public function index(): ResponseInterface
    {
        if (Auth::check()) {
            return view('app/admin/index');
        }

        return view('app/admin/login');
    }

    public function statistic(ServerRequestInterface $request): ResponseInterface
    {
        $stats = Statistic::getInstance($request)->get();

        return view('app/admin/statistic', [
            'stats' => $stats,
        ]);
    }

    public function login(ServerRequestInterface $request): ResponseInterface
    {
        $inputs = $request->getParsedBody();
        $errors = validator()->validate($inputs, [
            'username' => [
                new Length([
                    'min' => 4,
                    'max' => 50
                ])
            ],
            'password' => [
                new Length(['min' => 4])
            ]
        ]);

        //Format error
        $formErrors = [];
        foreach ($errors as $key => $violations) {
            foreach ($violations as $violation) {
                $formErrors[$key][] = $violation->getMessage();
            }
        }

        if (0 !== count($formErrors)) {
            return view('app/admin/login', [
                'errors' => $formErrors
            ]);
        }

        $token = null;
        $authError = null;
        if ($_ENV['ADMIN_USERNAME'] === $inputs['username']) {
            if ($_ENV['ADMIN_PASSWORD'] === $inputs['password']) {
                $token = Token::encode([$_ENV['ADMIN_USERNAME']]);
                Auth::handle($token);
            }
        }

        if (!$token) {
            $authError = 'Invalid username or password.';
        }

        return view('app/admin/login', [
            'token' => $token,
            'authError' => $authError,
        ]);
    }
}