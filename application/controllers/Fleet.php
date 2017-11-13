<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * The fleet page should show all the airplanes in your fleet, ordered 
 * reasonably, presented as a grid or table. 
 * 
 * You don't need to show all data for a plane on this page ... 
 * clicking on a plane's identifier should trigger 
 * a separate page with everything you can determine or show for that plane. 
 * This would suit a subcontoller and secondary view for just the one plane.
 *
 * @author namblue
 */
class Fleet extends Application
{      
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Index for Fleet
	 */
	public function index()
	{
            $role = $this->session->userdata('userrole');
            $this->data['pagetitle'] = 'Viewing as ('. $role . ')';
            $this->page();
            
            // this is the view we want shown
            $this->data['pagebody'] = 'fleet';

            // build the list of authors, to pass on to our view
            $source = $this->fleet_model->all();
            
            // pass on the data to present, as the "authors" view parameter
            $this->data['fleet'] = $source;

            $this->render();
	}
        
        /*
         * Displays detailed info of the plane selected in a seperate view
         */
        public function show($key)
        {
            $role = $this->session->userdata('userrole');
            if ($role == ROLE_ADMIN)
            {
                $this->edit($key);
            }
            else
            {
                // this is the view we want shown
                $this->data['pagebody'] = 'plane';

                // build the list of authors, to pass on to our view
                $source = $this->fleet_model->get($key);

                // pass on the data to present, as the "authors" view parameter
                $this->data = array_merge($this->data, (array) $source);

                $this->render();
            }
        }
        
        // Extract & handle a page of items, defaulting to the beginning
        function page()
        {
            $role = $this->session->userdata('userrole');
            if ($role == ROLE_ADMIN) 
            {
                $this->data['add'] = $this->parser->parse('fleetadd',[], true);
            }
            else
            {
                $this->data['add'] = "";
            }

        }
        
        public function add()
        {
            $flight = $this->fleet_model->create();
            $this->session->set_userdata('flight', $flight);
            $this->showit();        
        }
        
        public function edit($id = null)
        {
            if ($id == null)
                redirect('/fleet');
            $flight = $this->fleet_model->get($id);
            $this->session->set_userdata('flight', $flight);
            $this->showit();
        }
           
        private function showit()
        {
            $submitButtonLabel = 'Update fleet';
            $this->load->helper('form');
            $flight = $this->session->userdata('flight');
            $this->data['id'] = $flight->id;

            // if no errors, pass an empty message
            if ( ! isset($this->data['error']))
                $this->data['error'] = '';

            // Check to see if its new or editing
            if (empty($flight->id))
            {
                $submitButtonLabel = 'Create new plane';
            }

            $fields = array(
                'hid'  => form_hidden('id', $flight->id),
                'fmanufacturer'  => form_label('Manufacturer') . form_dropdown('manufacturer', $this->wacky->manufacturers(), $flight->Manufacturer),
                'fmodel'  => form_label('Model') . form_dropdown('model', $this->wacky->models(), $flight->Model),
                'fprice'  => form_label('Price') . form_input('price', $flight->Price),
                'fseats'  => form_label('Seats') . form_input('seats', $flight->Seats),
                'freach'  => form_label('Reach') . form_input('reach', $flight->Reach),
                'fcruise'  => form_label('Cruise') . form_input('cruise', $flight->Cruise),
                'ftakeoff'  => form_label('Takeoff') . form_input('takeoff', $flight->Takeoff),
                'fhourly'  => form_label('Hourly') . form_input('hourly', $flight->Hourly),                
                'zsubmit'    => form_submit('submit', $submitButtonLabel),
            );
            $this->data = array_merge($this->data, $fields);

            $this->data['pagebody'] = 'fleetedit';
            $this->render();
        }
        
        // handle form submission
        public function submit()
        {
            // setup for validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules($this->fleet_model->rules());

            // retrieve & update data transfer buffer
            $flight = (array) $this->session->userdata('flight');
            $flight = array_merge($flight, $this->input->post());
            unset($flight['submit']);
            $flight = (object) $flight;  // convert back to object
            $this->session->set_userdata('flight', (object) $flight);

            // validate away
            if ($this->form_validation->run())
            {
                if (empty($flight->id))
                {
                    $num = $this->fleet_model->count() + 1;
                    $id =  sprintf("BB%03d", $num);
                    $flight->id = $id;
                    $this->fleet_model->add($flight);
                    $this->alert('Flight ' . $flight->id . ' added', 'success');
                } 
                else
                {
                    $this->fleet_model->update($flight);
                    $this->alert('Flight ' . $flight->id . ' updated', 'success');
                }  
            }else
            {
                $this->alert('<strong>Validation errors!<strong><br>' . validation_errors(), 'danger');
            }
            
            $this->showit();
        }
        
        // build a suitable error mesage
        private function alert($message) {
            $this->load->helper('html');        
            $this->data['error'] = heading($message,3);
        }

        // Forget about this edit
        function cancel() {
            $this->session->unset_userdata('flight');
            redirect('/fleet');
        }

        // Delete this item altogether
        function delete()
        {
            $dto = $this->session->userdata('flight');
            $task = $this->tasks->get($dto->id);
            $this->tasks->delete($task->id);
            $this->session->unset_userdata('flight');
            redirect('/fleet');
        }
}
