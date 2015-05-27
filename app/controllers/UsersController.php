<?php

/**
 * Controller to handle User related routes
 */
class UsersController extends Controller
{
    /**
     * @var $user
     */
    protected $user = null;

    public function __construct()
    {
        $this->user = User::isAuthenticated();
    }

    public function index()
    {
        $users = User::findMany();

        $this->view('users/index', compact('users'));
    }

    public function show($id)
    {
        $user = User::findOne($id);

        $this->view('users/show', compact('user'));
    }

    public function account()
    {
        if ($this->user === null) {
            header('Location: ' . HTTP_ROOT . 'auth/login');
        }

        $this->view('users/account', null);
    }

    public function update()
    {
        if ($this->user === null) {
            header('Location: ' . HTTP_ROOT . 'auth/login');
        }

        if (Input::get('submit')) {
            $old_pass = Input::get('old_pass');
            $new_pass = password_hash(Input::get('new_pass'), PASSWORD_DEFAULT);

            if (empty($new_pass) || empty($old_pass)) {
                die('Please missing.');
            }

            if (password_verify($old_pass, $this->user->password)) {
                $this->user->password = $new_pass;

                if ($this->user->save()) {
                    header('Location: ' . HTTP_ROOT);
                }
            } else {
                die('Wrong old password or empty new password.');
            }
        }
    }

    public function message()
    {
        $this->view('users/message', null);        
    }

    public function send()
    {
        if (Input::get('submit')) {
            $name  = Input::get('name');
            $email = Input::get('email');
            $message = Input::get('message');

            $user = User::where('email', $email)->findOne();
            
            // foreach ($fields as $field => $data) {
            //     if (empty($data)) {
            //         $errors[] = 'The ' . $field . ' field is required';
            //     }
            // }
          
            if (empty($errors)) {
            
                $m = new PHPMailer;
                $m->isSMTP();
                $m->SMTPAuth = true;
                $m->Host = 'smtp.gmail.com';
                $m->Username = 'email@example.com';
                $m->Password = 'password';
                $m->SMTPSecure = 'ssl';
                $m->Port = 465;
                $m->isHTML();
                $m->Subject = 'Contact form submitted';
                $m->Body = 'From: ' . $user['name'] . ' (' . $user['email'] . ')<p>' . $user['message'] . '</p>';
                $m->FromName = 'Contact';
                $m->AddAddress('email@example.com', 'yourname');
                if ($m->send()) {
                    header('Location: ' . HTTP_ROOT);
                  die();
                } else {
                  $errors[] = 'Sorry, could not send email.';
                }
            }
        }
    }
}
