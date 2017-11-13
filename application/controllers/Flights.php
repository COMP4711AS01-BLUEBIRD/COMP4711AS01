<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Flight
 *
 * @author namblue
 */
class Flights extends Application
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
            
            // this is the view we want shown
            $this->data['pagebody'] = 'flights';

            // build the list of authors, to pass on to our view
            $source = $this->flights_model->all();

            // pass on the data to present, as the "authors" view parameter
            $this->data['flights'] = $source;

            $this->render();
	}
        
        function page()
        {
            $role = $this->session->userdata('userrole');
            if ($role == ROLE_ADMIN) 
            {
                $this->data['add'] = $this->parser->parse('flightadd',[], true);
            }
            else
            {
                $this->data['add'] = "";
            }
            
        }
        
        public function add()
        {
            $flight = $this->flights_model->create();
            $this->session->set_userdata('flight', $flight);
            $this->showit();        
        }
        
        public function edit($id = null)
        {
            if ($id == null)
                redirect('/flights');
            $flight = $this->tasks->get($id);
            $this->session->set_userdata('flight', $flight);
            $this->showit();
        }
           
        private function showit()
        {
            $submitButtonLabel = 'Update the flight';
            $this->load->helper('form');
            $flight = $this->session->userdata('flight');
            $this->data['id'] = $flight->id;

            // if no errors, pass an empty message
            if ( ! isset($this->data['error']))
            {
                $this->data['error'] = '';
            }
            
            // Check to see if its new or editing
            if (empty($flight->id))
            {
                $submitButtonLabel = 'Create new flight';
            }

            $fields = array(
                'fdestination'  => form_label('Destination') . form_dropdown('Destination', $this->wacky->airportIds()),
                'farrivalairport'  => form_label('Arrival Airport') . form_dropdown('ArrivalAirport', $this->wacky->airportNames()),
                'fdeparteairport'  => form_label('Departure Airport') . form_dropdown('DepartureAirport', $this->wacky->airportNames()),
                'fplaneid'  => form_label('Plane ID') . form_dropdown('PlaneID', $this->fleet_model->planeIds()),
                'fdeparturetime'  => form_label('Departure Time (24-hour clock format: HH:MM)') . form_input('DepartureTime', $flight->DepartureTime),
                'farrivaltime'  => form_label('Arrival Time (24-hour clock format: HH:MM)') . form_input('ArrivalTime', $flight->ArrivalTime),
                'zsubmit'    => form_submit('submit', $submitButtonLabel),
            );
            $this->data = array_merge($this->data, $fields);

            $this->data['pagebody'] = 'flightedit';
            $this->render();
        }
        
        // handle form submission
        public function submit()
        {
            // setup for validation
            $this->load->library('form_validation');
            $this->form_validation->set_rules($this->flights_model->rules());
            
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
                    $flight->id = $this->flights_model->highest() + 1;
                    $this->flights_model->add($flight);
                    $this->alert('Flight ' . $flight->id . ' added', 'success');
                } else
                {
                    $this->flights_model->update($flight);
                    $this->alert('Flight ' . $flight->id . ' updated', 'success');
                }
            } else
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
            redirect('/flights');
        }

        // Delete this item altogether
        function delete()
        {
            $dto = $this->session->userdata('flight');
            $flight = $this->tasks->get($dto->id);
            $this->tasks->delete($flight->id);
            $this->session->unset_userdata('flight');
            redirect('/flights');
        }
        
        
        public function arrivalTime_Check($str)
        {
                if (preg_match("/^([0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/i", $str))
                {
                        
                        return TRUE;
                }
                else
                {
                        $this->form_validation->set_message('arrivalTime_Check', 'The {field} field must be in the format: HH:MM');
                        return FALSE;
                }
        }
        
        public function departureTime_Check($str)
        {
                if (preg_match("/^([0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/i", $str))
                {
                        
                        return TRUE;
                }
                else
                {
                        $this->form_validation->set_message('departureTime_Check', 'The {field} field must be in the format: HH:MM');
                        return FALSE;
                }
        }
}