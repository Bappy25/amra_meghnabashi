<?php

namespace App\Models;

class Member extends Model{

	/* Declaring all variables */

  protected $id;
  protected $name;
  protected $tags;
  protected $designation;
  protected $details;

  /* Setter getter for all variables */

    // ID setter getter
  function setId($id){
    $this->id = intval($id);
  }
  function getId(){
    return $this->id;
  }

    // Name setter getter
  function setName($name){
    $this->name = ucwords($name);
  }
  function getName(){
    return $this->name;
  }

      // Tags setter getter
  function setTag($tags){
      $this->tags = $tags;
  }
  function getTag(){
      return $this->tags;
  }

  	// Designation setter and geter
  function setDesignation($designation){
    $this->designation = $designation;
  }
  function getDesignation(){
    return $this->designation;
  }

      // Image setter getter
  function setImage($image_path){
    $this->image_path = $image_path;
  }
  function getImage(){
    return $this->image_path;
  }

    // Detail setter getter
  function setDetail($details){
    $this->details = $details;
  }
  function getDetail(){
    return $this->details;
  }

  /* All functions */

    // Setting all the data 
  public function setData($data = ''){

    if (isset($data['id'])){
      $this->setId($data['id']);
    }

    if (isset($data['name'])){
      $this->setName($data['name']);
    }

    if (isset($data['tags'])){
        $this->setTag($data['tags']);
    }

    if (isset($data['designation'])){
      $this->setDesignation($data['designation']);
    }

    if (isset($data['image_path'])){
      $this->setImage($data['image_path']);
    }

    if (isset($data['details'])){
        $this->setDetail($data['details']);
    }

    return $this;
  }

  public function getMembers(){    
    $members = $this->db->table('members')->orderBy('created_at', 'desc')->limit(2000)->read();
    return $members;
  }

  public function getPeople($tag='all'){    
    $people = $this->db->table('members');
    if($tag == 'all'){
      $people = $people->condition('WHERE tags LIKE "%adviser%" OR tags LIKE "%vip%" OR tags LIKE "%admin%" OR tags LIKE "%volunteer%"');
    }
    else{
      $people = $people->where('tags', 'LIKE', '%'.$tag.'%');
    }
    $people = $people->and('approved', '=', 1)->orderBy('name')->limit(2000)->read();
    return $people;
  }

  public function getMember(){    
    $members = $this->db->table('members')->where('id', '=', $this->getId())->read();
    return $members[0];
  }

  public function store(){   
    $store = $this->db->table('members')->data(['name' => $this->getName(), 'tags' => $this->getTag(), 'designation' => $this->getDesignation(), 'image_path' => $this->getImage(), 'details' => $this->getDetail()])->create();
    return $store;
  }

  public function approve(){ 
    $approve = $this->db->table('members')->set(['approved' => 1, 'details' => $this->getDetail()])->where('id', '=', $this->getId())->update();
    return $approve;
  }

  public function update(){ 
    if(empty(getErrors())){
      $update = $this->db->table('members')->set(['name' => $this->getName(), 'tags' => $this->getTag(), 'designation' => $this->getDesignation(), 'image_path' => $this->getImage(), 'details' => $this->getDetail()])->where('id', '=', $this->getId())->update();
      return $update;
    }
  }

  public function delete() {  
      $delete = $this->db->table('members')->where('id', '=', $this->getId())->delete();
      return $delete; 
  }

}