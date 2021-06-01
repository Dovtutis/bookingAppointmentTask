<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Validation;
use app\model\AppointmentModel;

class SiteController extends Controller
{
    public Validation $validation;
    protected AppointmentModel $appointmentModel;

    public function __construct()
    {
        $this->validation = new Validation();
        $this->appointmentModel = new AppointmentModel();
    }
    /**
     * This handles Home Page GET requests
     * @return string|string[]
     */
    public function index()
    {
        $params = [
            'name' => "Doctor Appointment Booking",
            'currentPage' => "home"
        ];
        return $this->render('index', $params);
    }

    /**
     * This handles Home Page POST requests
     * @return string|string[]
     */
    public function addAnAppointment(Request $request)
    {
        $data = $request->getBody();

        $data['errors']['nameError'] = $this->validation->validateEmpty($data['name'], 'Name can\'t be empty');
        $data['errors']['lastnameError'] = $this->validation->validateEmpty($data['lastname'], 'Lastname can\'t be empty');
        $data['errors']['dayError'] = $this->validation->validateEmpty($data['day'], 'Day must be selected');
        $data['errors']['timeError'] = $this->validation->validateTime($data);

        if ($data['day'] !== "") {
            $data['weekOfTheYear'] = date("W", strtotime($data['day']));
            $existingRegistration = $this->validation->userRegistrationExists($data);

            if ($existingRegistration !== false) {
                foreach ($existingRegistration as $registration) {                    
                    if ($data['weekOfTheYear'] === $registration->week) {
                        $data['errors']['dayError'] = "You already booked this week.";
                    }
                }
            }
        }

        if ($this->validation->ifEmptyArray($data['errors'])) {
            if ($this->appointmentModel->addAppointment($data)) {
                $response = 'appointmentAdded';
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                die('Something went wrong in adding user to DB');
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode($data);
        }

            // header('Content-Type: application/json');
            // echo json_encode($data);
    }

    public function notFound()
    {
        return $this->render('_404');
    }
}

