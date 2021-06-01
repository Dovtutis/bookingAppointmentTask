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
        $data = [
            'name' => "Doctor Appointment Booking",
            'currentPage' => "home"
        ];

        // $data['appointments'] = $this->appointmentModel->getAppointments();

        return $this->render('index', $data);
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
        $data['errors']['dateError'] = $this->validation->validateEmpty($data['date'], 'Date must be selected');
        $data['errors']['timeError'] = "";

        if ($data['date'] !== "") {
            $data['weekOfTheYear'] = date("W", strtotime($data['date']));
            $data['monthOfTheYear'] = date("m", strtotime($data['date']));
            $data['dayOfTheMonth'] = date("d", strtotime($data['date']));
            $existingRegistration = $this->validation->userRegistrationExists($data);

            if ($existingRegistration !== false) {
                foreach ($existingRegistration as $registration) {                    
                    if ($data['weekOfTheYear'] === $registration->week) {
                        $data['errors']['dateError'] = "You already booked this week.";
                    }
                }
            } else {
                if ($this->validation->validateTime($data)) {
                    $data['errors']['timeError'] = "This time is already booked, please select different time.";
                }
            }
        }

        if ($this->validation->ifEmptyArray($data['errors'])) {
            if ($this->appointmentModel->addAppointment($data)) {
                $data['response'] = 'success';
                header('Content-Type: application/json');
                echo json_encode($data);
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

    public function getAppointments (Request $request)
    {
        $data['appointments'] = $this->appointmentModel->getAppointments();

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function notFound()
    {
        return $this->render('_404');
    }
}

