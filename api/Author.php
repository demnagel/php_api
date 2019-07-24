<?php

class Author extends MainApi
{

    public function __toString()
    {
        return __CLASS__;
    }

    public function get($param)
    {
        return $this->response('');
    }

    public function post($param)
    {
        return $this->response('');
    }

    public function put($param)
    {
        return $this->response('');
    }

    public function delete($param)
    {
        $id = [(int)$param['id']];
        $data = Model::delAuthor($id);
        if ($data) {
            return $this->response('', 204);
        }
        return $this->response('');
    }
}