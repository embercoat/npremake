<?php
/**
 *
 * @author Kristian Nordman <kristian.nordman@scripter.se>
 *
 */
class menu{
    static function get_items($disregardVisible = false){
		$menu = array();
        $baseQuery = DB::select('*')->from('menu')->order_by('group', 'ASC')->order_by('sortorder', 'ASC');
        if(isset($_SESSION['user'])){
            if(!$_SESSION['user']->logged_in())
                $baseQuery = $baseQuery->where('requireLogin', '=', '0');
            if(!$_SESSION['user']->isAdmin())
                $baseQuery = $baseQuery->where('requireAdmin','=','0');
            if(!$_SESSION['user']->isPhosare())
                $baseQuery = $baseQuery->where('requirePhosare','=','0');
            if($disregardVisible == false)
                $baseQuery = $baseQuery->where('visible','=','1');
        } else
            $baseQuery = $baseQuery->where('requireLogin', '=', '0');

        $items = $baseQuery->execute();
		foreach($items as $i){
		    $menu[$i['group']][] = $i;
		}
    	return $menu;
    }
    static function get_item($id){
        $item = DB::select('*')->from('menu')->where('id','=', $id)->execute()->as_array();
        if(count($item) > 0){
            list($item) = $item;
            return $item;
        } else {
            return false;
        }

    }
    static function get_complete_groups(){
        $groups = DB::select('*')->from('menu_groups')->order_by('sortorder')->execute();
        $groupsArr = array();
		foreach($groups as $g){
		    $groupsArr[$g['id']] = $g;
    	}
        return $groupsArr;

    }
    static function get_groups(){
        $groups = DB::select('id','title')->from('menu_groups')->order_by('sortorder')->execute();

        $groupsArr = array();
		foreach($groups as $g){
		    $groupsArr[$g['id']] = $g['title'];
    	}
        return $groupsArr;
    }
    static function get_group($id){
        if($ret = DB::select('*')->from('menu_groups')->where('id','=',$id)->execute()->as_array()){
            return $ret;
        } else {
            return false;
        }
    }
    static function update_item($id, $values){
        if($id != "new"){
            $query = DB::update('menu')
            ->value('title', $values['title'])
            ->value('visible', ((isset($values['visible']))?1:0))
            ->value('requireLogin', ((isset($values['requireLogin']))?1:0))
            ->value('requireAdmin', ((isset($values['requireAdmin']))?1:0))
            ->value('requirePhosare', ((isset($values['requirePhosare']))?1:0))
            ->value('url', $values['url'])
            ->value('group', $values['group'])
            ->value('sortorder', $values['sortorder'])
            ->where('id', '=', $id);
        } else {
            unset($values['id'], $values['save']);
            $query = DB::insert('menu', array_keys($values))->values($values);
        }
        return $query->execute();
    }
    static function update_group($id, $values){
        if($id != "new"){
            $query = DB::update('menu_groups')
            ->value('title', $values['title'])
            ->value('sortorder', $values['sortorder'])
            ->where('id', '=', $id);
        } else {
            unset($values['id'], $values['save']);

            $query = DB::insert('menu_groups', array_keys($values))->values($values);
        }
        return $query->execute();
    }
}




?>