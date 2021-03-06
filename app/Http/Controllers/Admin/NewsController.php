<?php

namespace App\Http\Controllers\Admin;

use Base\Request; 
use App\Models\Auth; 
use App\Models\News; 
use App\Http\Controllers\Controller; 

class NewsController extends Controller
{

    private $news;
    private $auth;
    private $request;

    public function __construct() {
        $this->guard('CheckAuth');
        $this->news = new News;
        $this->auth = new Auth;
        $this->request = new Request;  
    }

    public function index() 
    {
        $auth_user = $this->auth->getAuth(); 
        $newses = $this->news->getAllNewses();
        return $this->view('admin.news.index', compact('newses', 'auth_user'));
    }

    public function create() 
    {
        $auth_user = $this->auth->getAuth(); 
        return $this->view('admin.news.create', compact('auth_user'));
    }

    public function store() 
    {
        $store = $this->news->setData($_POST)->store();
        if($store){
            $this->notifySubscibers($_POST['title'], route('news/show', ['id' => $this->news->getLastId()]));
            $this->request->setFlash(['success' => locale('message', 'success')]);
            $this->redirect('admin/news/all');
        }
        else{
            $this->redirect(back());
        }
    }

    public function edit() 
    {
        $news = $this->news->setData($_GET)->getNews();
        return $this->view('admin.news.edit', compact('news'));  
    }

    public function update() 
    {
        $update = $this->news->setData($_POST)->update();
        if($update){
            $this->request->setFlash(['success' => locale('message', 'success')]);
            $this->redirect('admin/news/all');
        }
        else{
            $this->redirect(back());
        }
    }

    public function delete() 
    { 
        $delete = $this->news->setData($_POST)->delete();
        if($delete){
            $this->request->setFlash(['success' => locale('message', 'success')]);
            $this->redirect('admin/news/all');
        }
        else{
            $this->request->setFlash(['danger' => locale('message', 'danger')]);
            $this->redirect(back());
        }  
    }

    private function notifySubscibers($title, $link){
        $subscribers = $this->get_subscribers();
        if(count($subscribers) > 0){
            $subject = 'New news article has been added!';
            $body = 'We have published a new article titled "<b>'.$title.'</b>"! Please click on <a href="'.$link.'">this link</a> to checkout this article!';
            $this->sendMail($subscribers, $subject, $body);
        }
    }

}