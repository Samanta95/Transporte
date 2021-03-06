<?php
/*
 * Generated by CRUDigniter v3.2
 * www.crudigniter.com
 */

class Paradero extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Paradero_model');
    }

    /*
     * Listing of paradero
     */
    function index()
    {
        $data['paradero'] = $this->Paradero_model->get_all_paradero();

        $data['_view'] = 'paradero/index';
        $this->load->view('layouts/main',$data);
    }

    /*
     * Adding a new paradero
     */
    function add()
    {
        $this->load->library('form_validation');

		$this->form_validation->set_rules('tipo_transporte_id','Tipo Transporte Id','required',
    array('required' => 'Debe seleccionar un tipo de transporte para el paradero.'
        )
  );
		$this->form_validation->set_rules('nombre','Nombre','required|max_length[20].',
    array('required' => 'Debe agregar un nombre para el paradero.',
          'max_length' => 'Como máximo solo pueden ser 20 caracteres.',
        )
  );
		$this->form_validation->set_rules('direccion','Direccion','required|max_length[80]',
    array('required' => 'Debe agregar una direccion para el paradero.',
          'max_length' => 'Como máximo solo pueden ser 80 caracteres.'
        )
  );
		$this->form_validation->set_rules('latitud','Latitud','required|max_length[13]',
    array('required' => 'Debe agregar la latitud para el paradero.',
          'max_length' => 'Como máximo solo pueden ser 10 caracteres.'
        )
  );
		$this->form_validation->set_rules('longitud','Longitud','required|max_length[13]',
    array('required' => 'Debe agregar la latitud para el paradero.',
          'max_length' => 'Como máximo solo pueden ser 10 caracteres.'
        )
  );

		if($this->form_validation->run())
        {
            $params = array(
				'tipo_transporte_id' => $this->input->post('tipo_transporte_id'),
				'nombre' => $this->input->post('nombre'),
				'direccion' => $this->input->post('direccion'),
				'latitud' => $this->input->post('latitud'),
				'longitud' => $this->input->post('longitud')
            );

            $paradero_id = $this->Paradero_model->add_paradero($params);
            redirect('paradero/index');
        }
        else
        {
			$this->load->model('Tipo_transporte_model');
			$data['all_tipo_transporte'] = $this->Tipo_transporte_model->get_all_tipo_transporte();

            $data['_view'] = 'paradero/add';
            $this->load->view('layouts/main',$data);
        }
    }

    /*
     * Editing a paradero
     */
    function edit($id)
    {
        // check if the paradero exists before trying to edit it
        $data['paradero'] = $this->Paradero_model->get_paradero($id);

        if(isset($data['paradero']['id']))
        {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('tipo_transporte_id','Tipo Transporte Id','required',
            array('required' => 'Debe seleccionar un tipo de transporte para el paradero.'
                )
          );
        		$this->form_validation->set_rules('nombre','Nombre','required|max_length[20].',
            array('required' => 'Debe agregar un nombre para el paradero.',
                  'max_length' => 'Como máximo solo pueden ser 20 caracteres.',
                )
          );
        		$this->form_validation->set_rules('direccion','Direccion','required|max_length[80]',
            array('required' => 'Debe agregar una direccion para el paradero.',
                  'max_length' => 'Como máximo solo pueden ser 80 caracteres.'
                )
          );
        		$this->form_validation->set_rules('latitud','Latitud','required|max_length[13]',
            array('required' => 'Debe agregar la latitud para el paradero.',
                  'max_length' => 'Como máximo solo pueden ser 10 caracteres.'
                )
          );
        		$this->form_validation->set_rules('longitud','Longitud','required|max_length[13]',
            array('required' => 'Debe agregar la latitud para el paradero.',
                  'max_length' => 'Como máximo solo pueden ser 10 caracteres.'
                )
          );

			if($this->form_validation->run())
            {
                $params = array(
					'tipo_transporte_id' => $this->input->post('tipo_transporte_id'),
					'nombre' => $this->input->post('nombre'),
					'direccion' => $this->input->post('direccion'),
					'latitud' => $this->input->post('latitud'),
					'longitud' => $this->input->post('longitud')
                );

                $this->Paradero_model->update_paradero($id,$params);
                redirect('paradero/index');
            }
            else
            {
				$this->load->model('Tipo_transporte_model');
				$data['all_tipo_transporte'] = $this->Tipo_transporte_model->get_all_tipo_transporte();

                $data['_view'] = 'paradero/edit';
                $this->load->view('layouts/main',$data);
            }
        }
        else
            show_error('The paradero you are trying to edit does not exist.');
    }

    /*
     * Deleting paradero
     */
    function remove($id)
    {
        $paradero = $this->Paradero_model->get_paradero($id);

        // check if the paradero exists before trying to delete it
        if(isset($paradero['id']))
        {
            $this->Paradero_model->delete_paradero($id);
            redirect('paradero/index');
        }
        else
            show_error('The paradero you are trying to delete does not exist.');
    }

    function deshabilitar($id){
      $data['paradero'] = $this->Paradero_model->get_paradero($id);

      if(isset($data['paradero']['id'])){
        $params = array('estado' => 0);
        $this->Paradero_model->update_paradero($id,$params);
        redirect('paradero/index');
      }else{
        show_error('El paradero que intenta deshabilitar no existe.');
      }

    }
    function habilitar($id){
      $data['paradero'] = $this->Paradero_model->get_paradero($id);

      if(isset($data['paradero']['id'])){
        $params = array('estado' => 1);
        $this->Paradero_model->update_paradero($id,$params);
        redirect('paradero/index');
      }else{
        show_error('El paradero  que intenta habilitar no existe.');
      }
    }

}
