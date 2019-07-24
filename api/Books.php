<?php

class Books extends MainApi
{

    public function __toString()
    {
        return __CLASS__;
    }

    public function get($param)
    {
        $data = Model::getBooksAuthor((int)$param['id']);
        if ($data) {
            return $this->response($data, 200);
        }
        return $this->response('');
    }

    public function post($param)
    {
        $param_req = [
            'id_author' => ($param['id_author']) ? (int)$param['id_author'] : 0,
            'date_manufacture' => ($param['date_manufacture']) ? date('Y-m-d', (int)$param['date_manufacture']) : '1970-01-01',
            'name' => ($param['name']) ? trim(strip_tags($param['name'])) : '',
            'id_publisher' => ($param['id_publisher']) ? (int)$param['id_publisher'] : 0
        ];

        if (Model::addBook($param_req)) {
            return $this->response('', 204);
        } else {
            return $this->response('');
        }
    }


    public function put($param)
    {
        if ($param['id_author'] && $param['id_book']) {

            $param_req = [
                'id_author' => (int)$param['id_author'],
                'id_book' => (int)$param['id_book'],
            ];

            if (Model::changeAuthorBook($param_req)) {
                return $this->response('', 204);
            }
            return $this->response('');
        } else {
            return $this->response('');
        }
    }

    public function delete($param)
    {
        return $this->response('');
    }
}