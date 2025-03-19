<?php

namespace App\Controllers\Api\V1;

use App\Models\CompanyModel;
use App\Validation\CompanyValidation;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class CompaniesController extends ResourceController{

    protected $modelName = CompanyModel::class;
    protected $format = 'json';
    
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index(){

        return $this->respond(
            data: $this->model->orderBy('name', 'ASC')->findAll(),
            status: ResponseInterface::HTTP_OK
        );
    
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null){

        $company = $this->model->asObject()->find($id);

        if($company === null){
            return $this->failNotFound(
                description: 'Empresa não encontrada',
                code: ResponseInterface::HTTP_NOT_FOUND
            );
        }

        return $this->respond(data: $company, status: ResponseInterface::HTTP_OK);

    }


    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create(){
        
        $rules = (new CompanyValidation)->getRules();

        if(!$this->validate($rules)){
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $inputRequest = esc($this->request->getJSON(assoc: true));
    
        $id = $this->model->insert($inputRequest);

        $companyCreated = $this->model->find($id);

        return $this->respondCreated(data: $companyCreated, message: 'Empresa criada com sucesso!');

    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null){}

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        
        $rules = (new CompanyValidation)->getRules($id);

        if(!$this->validate($rules)){
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $inputRequest = esc($this->request->getJSON(assoc: true));
    
        $this->model->update($id, $inputRequest);

        $company = $this->model->find($id);

        return $this->respondUpdated(data: $company, message: 'Empresa atualizada com sucesso!');

    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null){

        $company = $this->model->find($id);

        if($company === null){
            return $this->failNotFound(code: ResponseInterface::HTTP_NOT_FOUND);
        }

        $this->model->delete($id);

        return $this->respondDeleted();
        
    }

}
