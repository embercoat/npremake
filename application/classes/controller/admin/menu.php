<?php

class Controller_Admin_Menu extends SuperAdminController{
    function action_index(){
        $this->content = View::factory('admin/menu/mainMenu');
    }
    function action_editItem($id){
        if(Arr::get($_POST, 'id', false)){
            $post = Validation::factory($_POST);
            $post
                ->rule('title', 'not_empty')
                ->rule('sortorder', 'numeric')
                ->rule('group', 'numeric');
            if($post->check()){
                menu::update_item($post['id'], $post);
                $this->request->redirect('/admin/menu/editItem/'.$post['id']);
            }

        }
        $this->content = View::factory('admin/menu/editItem');
        $this->content->itemId = $id;
        $this->content->action = 'editItem';
    }
    function action_addItem(){
        if(Arr::get($_POST, 'id', false) !== false){
	        $post = Validation::factory($_POST);
	        $post
	            ->rule('title', 'not_empty')
                ->rule('sortorder', 'numeric')
                ->rule('group', 'numeric');
	        if($post->check()){
	            $id = menu::update_item($post['id'], $post->as_array());
	            $this->request->redirect('/admin/menu/editItem/'.$id[0]);
	        } else {
	            var_dump($post->errors());
	        }

        }
	    $this->content = View::factory('admin/menu/editItem');
	    $this->content->itemId = "new";
	    $this->content->action = 'addItem';
    }
    function action_delItem($id){
        $query = DB::delete('menu')->where('id','=',$id)->execute();
        $this->request->redirect('/admin/menu/');
    }
    function action_editGroup($id){
        if(Arr::get($_POST, 'id', false)){
            $post = Validation::factory($_POST);
            $post
                ->rule('title', 'not_empty')
                ->rule('sortorder', 'numeric')
                ->rule('group', 'numeric');
            if($post->check()){
                menu::update_group($post['id'], $post->as_array());
                $this->request->redirect('/admin/menu/editGroup/'.$post['id']);
            }

        }
        $this->content = View::factory('admin/menu/editGroup');
        $this->content->groupId = $id;
        $this->content->action = 'editGroup';
    }
    function action_addGroup(){
        if(Arr::get($_POST, 'id', false) !== false){
	        $post = Validation::factory($_POST);
	        $post
	            ->rule('title', 'not_empty')
                ->rule('sortorder', 'numeric')
                ->rule('group', 'numeric');
	        if($post->check()){
	            $insertid = menu::update_group($post['id'], $post->as_array());
	            $this->request->redirect('/admin/menu/editGroup/'.$insertid[0]);
	        } else {
//	            var_dump($post->errors());
	        }

        }
	    $this->content = View::factory('admin/menu/editGroup');
	    $this->content->groupId = "new";
	    $this->content->action = 'addGroup';
    }
    function action_delGroup($id){
        if($id != 6){
            // Move children to group 'Övrigt' and hide from view before removing the group.
            $query = DB::update('menu')->value('group', 6)->value('visible', 0)->where('id','=', $id);
            $query = DB::delete('menu_groups')->where('id','=',$id)->execute();
        }
        $this->request->redirect('/admin/menu/');
    }
}

?>
