<?php


namespace App\Http\Controllers\Api\Contact;


use App\Core\Database;
use App\Core\Http\Response\JsonResponse;
use App\Core\Http\Response\ResponseInterface;
use App\Http\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;

class MessageController extends Controller
{
    public function sendMessage(ServerRequestInterface $request): ResponseInterface
    {
        $postedData = $request->getParsedBody();
        $time = time();

        $errors = validator()->validate($request->getParsedBody(), [
            'name' => [
                new Length([
                    'min' => 3,
                    'max' => 50
                ])
            ],
            'email' => [
                new Length([
                    'min' => 3,
                    'max' => 200
                ]),
                new Email()
            ],
            'message' => [
                new Length(['min' => 10])
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
            return JsonResponse::error([
                'message' => 'Invalid Data',
                'errors' => $formErrors
            ]);
        }

        $pdo = Database::create();
        $prepared = $pdo->prepare("INSERT INTO messages(name, email, message, time) VALUES (:name, :email, :message, :time)");
        $prepared->bindValue(':name', $postedData['name']);
        $prepared->bindValue(':email', $postedData['email']);
        $prepared->bindValue(':message', htmlspecialchars($postedData['message']));
        $prepared->bindValue(':time', $time);
        $prepared->execute();

        return JsonResponse::success([
            'message' => 'Your message has been received.<br/>Please do not resend your message.'
        ]);
    }
}