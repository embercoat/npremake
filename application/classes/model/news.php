<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Model_News extends Model
{
	public function get_news($limit = false){
		$query = DB::select_array(array('news.*', 'user.fname', 'user.lname'))
			->from('news')
			->join('user')
			->on('news.author', '=', 'user.user_id')
			->order_by('published', 'desc');
			
		if($limit)
			$query->limit($limit);
			
		return $query->execute()
			->as_array();
	}
	public function get_details($id){
		list($result) = DB::select('*')
				->from('news')
				->where('id', '=', $id)
				->execute()
				->as_array();
		return $result;
	}
	
	public function update_by_id($id, $title, $text, $author)
	{
		DB::update('news')
			->set(array(
				'author' => $author,
				'title'  => $title, 
				'text'   => $text
			))
			->where('id', '=', $id)
			->execute();
	}
	public function create($title, $text, $author, $timestamp)
	{
		list($id, $null) = DB::insert('news', array('title', 'text', 'author', 'published'))
			->values(
				array(
					'title'		=> $title,
					'text'		=> $text,
					'author'	=> $author, 
					'published'	=> $timestamp
				)
			)
			->execute();
		return $id;
	}
	public function delete($id)
	{
		DB::delete('news')
			->where('id', '=', $id)
			->execute();
	}
	
}