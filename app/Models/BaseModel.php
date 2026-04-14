<?php namespace App\Models;

use CodeIgniter\Model;

class BaseModel extends Model{
	
	protected $table = 'users';
	
	protected $primaryKey = 'id';

	protected $useSoftDeletes = false;

	protected $tempReturnType = 'array';
	
	protected $db;
	
	protected $builder;
	
	public function __construct()
	{
	
		$this->db      = \Config\Database::connect();
		
		$this->builder = $this->db->table( $this->db->getPrefix() . $this->table );
	
	}
	
	public function get( $id )
	{
		
		$this->builder->where( 'id', $id );
		
		$data = (array)$this->builder->get()->getRow();
		
		if (isset($data['id']))
		{
			
			return $data;
			
		}
		
		return $this->getObject();
		
	}
	
	public function updateField( $id, $field, $value )
	{
		
		$this->builder->set($field, $value);
		
		$this->builder->where('id', $id);
		
		$this->builder->update();
		
	}
	
	public function updateFieldWhere( $attrs = [], $field, $value )
	{
		
		$this->builder->set($field, $value);
		
		foreach( $attrs as $key => $value )
		{
			
			$this->builder->where($key, $value);
			
		}
		
		$this->builder->update();
		
	}
	
	public function select( $attrs = [] )
	{
		
		foreach( $attrs as $key => $value )
		{
			
			$this->builder->where($key, $value);
			
		}
		
		return $this->builder->get()->getResultArray();
		
	}
	
	public function selectOr( $attrs = [] )
	{
		
		foreach( $attrs as $key => $value )
		{
			
			$this->builder->orWhere($key, $value);
			
		}
		
		return $this->builder->get()->getResultArray();
		
	}
	
	public function store( $data )
	{
		
		if ( $data[ 'id' ] == 0 )
		{
			
			$this->builder->insert($data);
			
			$insertID = $this->db->insertID();
			
			return $insertID;
			
		}
		else
		{
			
			$this->builder->where( 'id', $data[ 'id' ] );
			
			$this->builder->update( $data );

		}			
		
		return $data[ 'id' ];
		
	}
	
	public function selectAll( $attrs = [], $order = '', $orderby = 'asc', $where = [] )
	{
		
		if ( is_array($attrs) )
		{
			
			foreach( $attrs as $key => $value )
			{
				
				$this->builder->orLike($key, $value);
				
			}
			
		}
		
		if ( !empty($order) )
		{
			
			$this->builder->orderBy($order, $orderby);
			
		}
		
		if ( is_array($where) )
		{
			
			foreach( $where as $key => $value )
			{
				
				$this->builder->where($key, $value);
				
			}
			
		}
		
		return $this;
		
	}
	public function deleteItem( $id = 0 )
	{
		
		$this->builder->where('id', $id);
		
		$this->builder->delete();

	}
	public function deleteItemWhere( $attrs= [] )
	{
		
		foreach( $attrs as $key => $value )
		{
			
			$this->builder->where($key, $value);
			
		}
		
		$this->builder->delete();

	}
}
?>