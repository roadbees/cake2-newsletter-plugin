 <?php
/**
 *
 * Roadbees Email Controller
 *
 *
 * @copyright Copyright (c) 2011, Haithem Bel Haj
 * @author Haithem Bel Haj <haythem.belhaj@googlemail.com>
 * @link          http://roadbees.de
 * @since         Roadbees v 0.1
 */

class NewslettersController extends NewsletterAppController {

	/**
	 * Controller name
	 *
	 * @var string
	 * @access public
	 */
	public $name = 'Newsletters';
        
    var $uses = array('Newsletter.Newsletter', 'Newsletter.Subscriber', 'Newsletter.Campaign');
	
        
    /**
	*
	* before filter
	*
	* @return void
	*/
	
	public function beforeFilter() {
		parent::beforeFilter();		
		$this->Auth->allow('*');

	}
        
    public function index(){
        $newsletters = $this->Newsletter->find('all', array('conditions' => array('Newsletter.publish' => '1')));
        $this-> set('newsletters', $newsletters);
    }
	
	
	/**
	 *
	 * view a newsletter
	 *
	 * @param {string} id newsletterId
	 * @public
	 */
	
	public function view($id = null){
		$this->Newsletter->id = $id;
		$this->set('news', $this->Newsletter->read());
		//counter increment 
		$this->Newsletter->incrementCounter();
	}
        
        
    /* MANAGER FUNCTIONS */
        
	/**
	* manager_index
	*
	*/
	
	public function manager_dashboard() {
		$newsletters = $this->Newsletter->find('all');
		$subscribers = $this->Subscriber->find('all');
		$campaigns = $this->Campaign->find('all');
		$this->set(array(
			'newsletters' => json_encode($newsletters), 
			'subscribers' => json_encode($subscribers),
			'campaigns' => json_encode($campaigns)
			)
		);
	}

	/**
	* manager_newsletter_index
	*
	*/

	public function manager_index(){
		$newsletters = $this->Newsletter->find('all');
		$this->set('newsletters' , $newsletters);
	}


	/**
	* manager_view
	*
	* 
	*/
	
	public function manager_view($id = null){
		$this->Newsletter->id = $id;
		$this->set('newsletter', $this->Newsletter->read());
	}
        
    /**
	* manager_newsletter_add
	*
	* 
	*/
	
	public function manager_add(){
		$this->set('campaigns',  $this->Campaign->find('list',array('fields' => array('Campaign.name'))));
		if($this->data){
			//files 
			if($this->data['Images'] && $this->data['Images']['name'] != "" ){
				$fileOK = $this->uploadFiles('img/newsletter', $this->data['Images']);
				if(!array_key_exists('urls', $fileOK)) {
					$this->Session->setFlash("File error");
					debug($fileOK);
				}
			}		
			$this->Newsletter->create();
			$this->Newsletter->set($this->data);
			$this->Newsletter->set(array(
				"viewCounter" => 0,
				"publishCounter" => 0, 
				"published" => 0,
				"campaigns" => $this->data['Campaign']['Campaign']
				));
			if($this->Newsletter->save()) {
				$this->Session->setFlash("Newsletter angelegt");
				$this->redirect(array('manager' => true, 'controller' => "newsletters", "action" => "index"));
			} else {			
				$this->Session->setFlash("newsletter konnte nicht angelegt werden");
				$this->render();
			}
		}
	}
	
	/**
	* manager_newsletter_edit
	*
	*/
	
	public function manager_edit($newsid = null) {
		$this->Newsletter->id = $newsid;	
		if ($this->request->is('get')) {	
			$this->request->data = $this->Newsletter->read();
			$this->set('campaigns',  $this->Campaign->find('all',array('fields' => array('Campaign.name'))));
			//debug($this->Campaign->find('all',array('fields' => array('Campaign.name'))));
			//die;
		 } else {
		 	$this->Newsletter->Behaviors->attach('Mongodb.SqlCompatible');
			if ($this->Newsletter->save($this->request->data)) {	
				$this->Session->setFlash("Newsletter angelegt");
				$this->redirect(array('manager' => true, 'controller' => "newsletters", "action" => "index"));
			} else {
				$this->Session->setFlash("Newsletter konnte nicht angelegt werden");
				$this->render();
			}
		}	
	}
	
	
	/**
	*
	* manager publish news
	*
	**/
	
	public function manager_publish($newsid = null) {
		
		if($newsid == null) {
			$this->redirect('/manager/newsletter');
		}
		
		$this->Newsletter->id = $newsid;
		
		$data = $this->Newsletter->read();
		//$data['Email']['content'] = $this->Markitup->parse($data['News']['content'],'markdown');
		
		$counter = $this->sendEmailToSubscribers($data);
		
		if($counter > 0) {
			$this->Newsletter->set(array('publishCounter' => $counter, 'published' => 1));
			$this->Newsletter->save();
			
			$this->Session->setFlash("Newsletter erfolgreich veröffentlicht");
			$this->redirect(array('manager' => true, 'controller' => "newsletters", "action" => "index"));
		} else {
			$this->Session->setFlash("Newsletter konnte nicht veröffentlicht werden");
			$this->redirect(array('manager' => true, 'controller' => "newsletters", "action" => "index"));
		}
	}
	
	/**
	*
	* manager_newsletter_delete
	*
	**/
	
	public  function manager_delete($newsid = null) {
		
		if($newsid == null) {
			$this->redirect('/manager/newsletter');
		}
		
		$this->Newsletter->id = $newsid;
		
		if($this->Newsletter->delete()) {
			$this->Session->setFlash("news erfolgreich gelöscht");
			$this->redirect(array('manager' => true, 'controller' => "newsletters", "action" => "index"));
		} else {
			$this->Session->setFlash("news konnte nicht gelöscht werden");
			$this->redirect(array('manager' => true, 'controller' => "newsletters", "action" => "index"));
		}
		
	}



	
	/* Helper Functions */
        
	private function sendEmailToSubscribers($data) {
		App::uses('CakeEmail', 'Network/Email');

		//define chunk size;
		$chunk_size = 1000;
		$sleep = 1; //was ist hier sinnvoll?
		    
		//send mail		
		$email = new CakeEmail("smtp");

		//filter active
		$active_campaigns = array();

		foreach($data['Newsletter']['campaigns'] as $id){
			$this->Campaign->id = $id;
			if($this->Campaign->field('active') == 1)
				array_push($active_campaigns, $id);
		}


		$subscribers = $this->Subscriber->find('all',array('conditions' => array('Subscriber.campaigns' => array('$in' => $active_campaigns))));

		debug($subscribers);

		$email_chunks = array_chunk($subscribers,$chunk_size);
		
		foreach($email_chunks as $email_adresses){

			foreach($email_adresses as $email_adress){
				
				$data['subscriberId'] = $email_adress['Subscriber']['_id'];
				
				$email->viewVars(array('info' => $data));
				
				$email->subject('Roadbees - Newsletter')
				->from('hallo@codebility.com')
				->to($email_adress['Subscriber']['email'])
				->template('newsletter/info')
				->emailFormat('both')
				->send();
			}

			sleep($sleep);	
		}
		
		return sizeof($subscribers);
    }


    //fileUpload helper (Thanks Bakers :) )

    function uploadFiles($folder, $formdata, $itemId = null) {
		// setup dir names absolute and relative
		$folder_url = WWW_ROOT.$folder;
		$rel_url = $folder;
		
		// create the folder if it does not exist
		if(!is_dir($folder_url)) {
			mkdir($folder_url, 0777, true);
		}
			
		// if itemId is set create an item folder
		if($itemId) {
			// set new absolute folder
			$folder_url = WWW_ROOT.$folder.'/'.$itemId; 
			// set new relative folder
			$rel_url = $folder.'/'.$itemId;
			// create directory
			if(!is_dir($folder_url)) {
				mkdir($folder_url);
			}
		}
		
		// list of permitted file types, this is only images but documents can be added
		$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');
		
		// loop through and deal with the files
		foreach($formdata as $file) {
			// replace spaces with underscores
			$filename = str_replace(' ', '_', $file['name']);
			// assume filetype is false
			$typeOK = false;
			// check filetype is ok
			foreach($permitted as $type) {
				if($type == $file['type']) {
					$typeOK = true;
					break;
				}
			}
			
			// if file type ok upload the file
			if($typeOK) {
				// switch based on error code
				switch($file['error']) {
					case 0:
						// check filename already exists
						if(!file_exists($folder_url.'/'.$filename)) {
							// create full filename
							$full_url = $folder_url.'/'.$filename;
							$url = $rel_url.'/'.$filename;
							// upload the file
							$success = move_uploaded_file($file['tmp_name'], $url);
						} else {
							// create unique filename and upload file
							ini_set('date.timezone', 'Europe/London');
							$now = date('Y-m-d-His');
							$full_url = $folder_url.'/'.$now.$filename;
							$url = $rel_url.'/'.$now.$filename;
							$success = move_uploaded_file($file['tmp_name'], $url);
						}
						// if upload was successful
						if($success) {
							// save the url of the file
							$result['urls'][] = $url;
						} else {
							$result['errors'][] = "Error uploaded $filename. Please try again.";
						}
						break;
					case 3:
						// an error occured
						$result['errors'][] = "Error uploading $filename. Please try again.";
						break;
					default:
						// an error occured
						$result['errors'][] = "System error uploading $filename. Contact webmaster.";
						break;
				}
			} elseif($file['error'] == 4) {
				// no file was selected for upload
				$result['nofiles'][] = "No file Selected";
			} else {
				// unacceptable file type
				$result['errors'][] = "$filename cannot be uploaded. Acceptable file types: gif, jpg, png.";
			}
		}

	return $result;
	}

        
}