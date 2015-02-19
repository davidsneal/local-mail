<?php namespace App\Http\Controllers;
	
use Config;

class MailController extends Controller {	
	
	// variables
	public $excerpts = [];
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		// connect to the mailbox
		$this->connect();
		
		// get required info for email excerpts
		$this->get_excerpts();

		// close mailbox connection
		$this->close();

		// prepare data
		$data = array(
			'excerpts' => $this->excerpts,
		);
		
		// respond with the page
		return view('/layouts/mailbox', $data);
	}
	
	// view a single email
	public function view($messageid)
	{
		// connect to the mailbox
		$this->connect();
		
		// get the email body
		$body = imap_body($this->mbox, $messageid);
		
		//$header = $this->get_header($messageid);
		
		// get the email header
		$header = imap_header($this->mbox, $messageid);

		// get html for header
		$header = view('/sections/email_header', array('header' => $header));

		// close mailbox connection
		$this->close();
		
		// prepare data
		$data = array(
			'header' => $header->render(),
			'body' 	 => $body,
		);

		// return json response
		return response()->json($data);
	}
	
	// get a single email's header
	public function get_header($messageid)
	{
		// connect to the mailbox
		$this->connect();
		
		// get the email header
		$header = imap_header($this->mbox, $messageid);

		// close mailbox connection
		$this->close();

		// prepare data
		$data = array(
			'header' => $header,
		);
		
		// respond with the header section html
		return view('/sections/email_header', $data);
	}
	
	// connect to the mailbox
	private function connect()
	{
		// get the mailfile location, set in /config/settings.php
		$mail_file = Config::get('settings.mail_file');

		// connect to the mailbox
		$this->mbox = imap_open($mail_file,'','');
		
		// if there's an error connecting
		if( ! $this->mbox)
		{
			// get error, show and kill the script
			$error = imap_last_error();
			die($error);
		}
	}
	
	// close the mailbox connection
	private function close()
	{
		// close the connection to the mailbox
		imap_close($this->mbox);
	}
	
	// empty the mailbox
	public function empty_mailbox()
	{
		// get the mailfile location, set in /config/settings.php
		$mail_file = Config::get('settings.mail_file');

		// create a file handler by opening the file
		$handler = @fopen($mail_file,"r+");
		
		//truncate the file to zero
		@ftruncate($handler, 0);
	}

	// get required data for email excerpts
	public function get_excerpts()
	{
		// sort the messages - newest first
		$ordered = imap_sort($this->mbox, SORTARRIVAL, 1);
		
		// loop through each email listed
		foreach($ordered as $email_id)
		{
			$this->excerpts[] = imap_header($this->mbox, $email_id);
		}
	}
}
