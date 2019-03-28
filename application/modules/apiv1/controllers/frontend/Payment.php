<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends Base_Controller
{
    var $tableMethod = 'payment_banks';
    var $tableBanks = 'payment_methods';
    const BANK_URL = 'payment/bank';
    const METHOD_URL = 'product/method';

    public function __construct()
    {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
    }

    public function banks()
    {
        $data['page_name'] = 'BusinessType';
        $this->load->view('admin/payment/bank', $data);
    }

    public function methods()
    {
        $data['page_name'] = 'type';
        $this->load->view('admin/payment/method', $data);
    }

    public function banks_create()
    {
        $id = $this->input->post('id');
        $rules = array(
            array(
                'field' => 'accountNumber',
                'label' => 'Account Number',
                'rules' => 'required|is_unique[payment_banks.bnk_accountNumber]',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                    'is_unique' => '%s already exists',
                ),
            )
        );
        $this->create(SELF::BANK_URL, $id, $rules, $this->postBankData(), $this->tableMethod, 'bnk_id');
    }

    public function banks_delete()
    {
        $id = $this->input->post('id');
        $this->Product_model->delete($id, $this->tableBanks, 'bnk_id');
    }

    public function methods_create()
    {
        $id = $this->input->post('pcaId');
        $rules = array(
            array(
                'field' => 'pcaName',
                'label' => 'Category Name',
                'rules' => 'required|is_unique[product_categories.pca_name]',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                    'is_unique' => '%s already exists',
                ),
            )
        );
        $this->create(SELF::CATEGORY_URL, $id, $rules, $this->postCategoryData(), $this->tableCategories, 'pca_id');
    }

    public function methods_delete()
    {
        $id = $this->input->post('id');
        $this->Product_model->delete($id, $this->tableCategories, 'pca_id');
    }


    public function create($view, $id, $rules, $requestData, $table, $id_name)
    {
        $data = new stdClass();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $submitType = $this->input->post('create_update');

        if ($submitType == "Create") {
            // set validation rules
            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run() === false) {

                // validation not ok, send validation errors to the view
                $this->load->view('admin/' . $view, $data);

            } else {
                if ($this->Product_model->insert($requestData, $table)) {
                    redirect($view);
                }
            }
        } else {
            if ($this->Product_model->update($requestData, $id, $table, $id_name)) {
                redirect($view);
            }
        }
    }


    private function postBankData()
    {
        $bankName = $this->input->post('name');
        $accountHolderName = $this->input->post('accountName');
        $accountNumber = $this->input->post('accountNumber');
        $sortCode = $this->input->post('sortCode');
        $branch = $this->input->post('branch');
        $data = array(
            'bnk_name' => $bankName,
            'bnk_accountName' => $accountHolderName,
            'bnk_accountNumber' => $accountNumber,
            'bnk_sortCode' => $sortCode,
            'bnk_branch' => $branch
        );
        return $data;
    }

    private function postMethodData()
    {
        $methodName = $this->input->post('pcaName');
        $methodDescription = $this->input->post('pcaDescription');
        $data = array(
            'pca_name' => $methodName,
            'pca_description' => $methodDescription
        );
        return $data;
    }



}