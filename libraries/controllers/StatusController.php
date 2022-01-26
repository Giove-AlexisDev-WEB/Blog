<?php

require_once 'Controller.php';

class StatusController extends Controller
{
    protected $modelName = "StatusModel";

    public function index()
    {

        $status = $this->model->findAll();

        $this->view('status/index', [
            'status' => $status,
        ]);
    }

    public function show()
    {
        $id = Request::get('id', Request::INT);

        $status = $this->model->find($id);

        $this->view('status/show', [
            'status' => $status,
        ]);
    }

    public function edit()
    {

        $id = Request::get('id', Request::INT);

        $status = $this->model->find($id);

        $this->view(
            "status/edit",
            [
                'status' => $status,
            ]
        );
    }

    public function update()
    {
        Request::redirectIfNotSubmitted('index.php');


        $id = Request::get('id', Request::INT);
        $content = Request::get('content', Request::SAFE);

        $status = $this->model->find($id);

        $data = compact('id', 'content');
        $this->model->update($data);

        $this->view(
            "status/show",
            [
                'status' => $status,
            ]
        );
    }

    public function delete()
    {
        $id = Request::get('id', Request::INT);
        $status = $this->model->findAll();

        $this->model->delete($id);

        $this->view('status/index', [
            'status' => $status,
        ]);
    }

    public function save()
    {
        $status = $this->model->findAll();

        $title = Request::get('title', Request::SAFE);
        $content = Request::get('content', Request::SAFE);
        $auteur = Request::get('auteur', Request::SAFE);

        $data = [
            'title' => $title,
            'content' => $content,
            'createdAt' => date('Y-m-d H:i:s'),
            'auteur' => $auteur,
        ];

        $this->model->insert($data);

        $this->view('status/index', [
            'status' => $status,
        ]);
    }

    public function add()
    {

        $this->view(
            "status/add",
        );
    }
}
