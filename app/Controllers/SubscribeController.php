<?php

namespace App\Controllers;

use DrewM\MailChimp\MailChimp;

class SubscribeController
{
    protected $mailChimp;
    protected $listId;

    public function __construct()
    {
        $this->mailChimp = new MailChimp(getenv('MAILCHIMP_API_KEY'));
        $this->mailChimp->verify_ssl = false;
        $this->listId = getenv('MAIL_CHIMP_LIST_ID');
    }

    public function addMember()
    {
        $request = (object) cleanRequest($_POST);

        $result = $this->mailChimp->post("lists/{$this->listId}/members", [
            'email_address' => $request->email,
            'status'        => $request->status,
            'merge_fields' => [
                'FNAME'		=>	$request->name,
                'LNAME'		=>	'Ramírez',
            ]
        ]);

        if ($this->mailChimp->success()) {
            return json_encode($result);
        }

        return json_encode($this->mailChimp->getLastError());
    }
}
