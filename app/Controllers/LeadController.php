<?php

namespace App\Controllers;

use App\Entities\Lead;
use Core\Controllers\EmailController  as Email;
use \DrewM\MailChimp\MailChimp;

class LeadController extends BaseController
{
    /**
     * Validations rules to $_POST data
     * @var [array]
     */
    protected $rules = [
            'required' => [
                ['name'],
                ['email'],
            ],
            'lengthMin' => [
                ['name', 3],
            ],

            'email' => 'email',
        ];

    /**
     * Input labels
     * @var array
     */
    protected $labels = [
        'name'  => 'Name',
        'email' => 'Email',
    ];


    public function store()
    {

        $errors = $this->validate($_POST, $this->rules, $this->labels);

        if ($errors) {
            return view('home.twig', compact('errors'));
        }

        $request = (object) cleanRequest($_POST);

        $lead            = new Lead();
        $lead->name      = $request->name;
        $lead->email     = $request->email;
        $lead->date      = date('Y-m-d H:i:s');

        if (!$lead->isRegistered($request->email)) {
            $lead->save();
        }

        Email::send($lead->email, getenv('LEAD_EMAIL_SUBJECT'), 'lead', $lead);
        Email::send(getenv('ADMIN_EMAIL'), getenv('ADMIN_EMAIL_SUBJECT'), 'admin', $lead); */


        //redirect('thanks');
    }

    public function sub()
    {
        $request = (object) cleanRequest($_POST);
        $MailChimp = new MailChimp('3dd8b536c8d3422aeec51598942036ac-us12');
        $MailChimp->verify_ssl = false;
        $list_id = '104118cb85';

        $result = $MailChimp->post("lists/$list_id/members", [
            'email_address' => $request->email,
            'status'        => $request->status,
            'merge_fields' => [
                'FNAME'		=>	$request->name,
                'LNAME'		=>	'Ranmírez',
            ]
        ]);

        if ($MailChimp->success()) {
            return json_encode($result);
        }

        return $MailChimp->getLastError();
    }
}
