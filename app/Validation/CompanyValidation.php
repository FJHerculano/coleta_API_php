<?php

namespace App\Validation;

class CompanyValidation{

    public function getRules(?int $id = null): array {

        return[

            'id' => [
                'label' => 'Id',
                'rules' => 'permit_empty|is_natural_no_zero'
            ],
            'name' => [
                'label' => 'Empresa',
                'rules' => "required|is_unique[companies.name,id,{$id}]",
                'errors'=> [
                    'required' => "O nome é obrigatório",
                    'is_unique' => "Já existe uma empresa com esse nome",
                ],
            ],
            'email' => [
                'label' => 'E-mail',
                'rules' => "required|is_unique[companies.email,id,{$id}]",
                'errors'=> [
                    'required' => "O e-mail é obrigatório",
                    'is_unique' => "esse e-mail já existe",
                ],
            ],
            'phone' => [
                'label' => 'Telefone',
                'rules' => "required|is_unique[companies.phone,id,{$id}]",
                'errors'=> [
                    'required' => "O Telefone é obrigatório",
                    'is_unique' => "Esse telefone já existe",
                ],
            ],
            'address' => [
                'label' => 'Endereço',
                'rules' => "required|max_length[169]",
                'errors'=> [
                    'required' => "O Endereço é obrigatório",
                    'max_length' => "O Endereço ultrapassou a quantidade de caracteres permitidos",
                ],
            ],

        ];
    }
    
}
