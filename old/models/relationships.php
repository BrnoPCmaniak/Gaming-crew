<?php

class Relationships{
	
	
	public function __construct( Registry $registry )
	{
		$this->registry = $registry; 
	}
	
	/**
	 * Z�sk� typy vztah�
	 * @param $cache m� se v�sledek ulo�it do mezipam�ti?
	 * @return mixed [int|array]
	 */
	public function getTypes( $cache=false )
	{
		$sql = "SELECT ID as type_id, name as type_name, plural_name as type_plural_name, mutual as type_mutual FROM relationship_types WHERE active=1";
		if( $cache == true )
		{
			$cache = $this->registry->getObject('db')->cacheQuery( $sql );
			return $cache;
		}
		else
		{
			$types = array();
			while( $row = $this->registry->getObject('db')->getRows() )
			{
				$types[] = $row;
			}
			return $types;
		}
	}
	
	/**
	 * Z�sk� vztahy mezi u�ivateli
	 * @param int $usera 
	 * @param int $userb
	 * @param int $approved
	 * @return int cache
	 */
	public function getRelationships( $usera, $userb, $approved=0 )
	{
		$sql = "SELECT t.name as type_name, t.plural_name as type_plural_name, uap.name as usera_name, ubp.name as userb_name, r.ID FROM relationships r, relationship_types t, profile uap, profile ubp WHERE t.ID=r.type AND uap.user_id=r.usera AND ubp.user_id=r.userb AND r.accepted={$approved}";
		if( $usera != 0 && $userb == 0)
		{
			$sql .= " AND ( r.usera={$usera} OR r.userb={$usera} )";
		}
		elseif( $usera == 0 && $userb != 0)
		{
			$sql .= " AND ( r.usera={$userb} OR r.userb={$userb} )";
		}
		elseif( $userb != 0 )
		{
			$sql .= " AND ( ( r.usera={$usera} OR r.userb={$userb} ) OR ( ( r.usera={$userb} OR r.userb={$usera} ) ) ";
		}
		$cache = $this->registry->getObject('db')->cacheQuery( $sql );
		return $cache;
	}
	
	/**
	 * Z�sk� vztahy u�ivatele
	 * @param int $user identifik�tor u�ivatele, jeho� vztahy se maj� z�skat
	 * @param boolean $obr maj� se v�sledky n�hodn� se�adit?
	 * @param int $limit m� se omezit po�et v�sledk�? ( 0 znamen� ne, > 0 znamen� omezit na zadan� po�et)
	 * @return int identifik�tor v mezipam�ti
	 */
	public function getByUser( $user, $obr=false, $limit=0 )
	{
		// standardn� dotaz pro z�sk�n� vztah� u�ivatele
		$sql = "SELECT t.plural_name, p.name as users_name, u.ID FROM users u, profile p, relationships r, relationship_types t WHERE t.ID=r.type AND r.accepted=1 AND (r.usera={$user} OR r.userb={$user}) AND IF( r.usera={$user},u.ID=r.userb,u.ID=r.usera) AND p.user_id=u.ID";
		// n�hodn� se�adit?
		if( $obr == true )
		{
			$sql .= " ORDER BY RAND() ";
		}
		// omezit po�et v�sledk�?
		if( $limit != 0 )
		{
			$sql .= " LIMIT " . $limit;
		}
		// ulo�en� v�sledku do mezipam�ti
		$cache = $this->registry->getObject('db')->cacheQuery( $sql );
		return $cache;
	}
	
	/**
	 * Z�sk� identifik�tory kontakt� u�ivatele
	 * @param int $user identifik�tor, jeho� kontakty se maj� z�skat
	 * @return array
	 */
	public function getNetwork( $user )
	{
		$sql = "SELECT u.ID FROM users u, profile p, relationships r, relationship_types t WHERE t.ID=r.type AND r.accepted=1 AND (r.usera={$user} OR r.userb={$user}) AND IF( r.usera={$user},u.ID=r.userb,u.ID=r.usera) AND p.user_id=u.ID";
		$this->registry->getObject('db')->executeQuery( $sql );
		$network = array();
		if( $this->registry->getObject('db')->numRows() > 0 )
		{
			while( $r = $this->registry->getObject('db')->getRows() )
			{
				$network[] = $r['ID'];
			}
		}
		return $network;
	}
	
	/**
	 * Z�sk� identifik�tory u�ivatel�, se kter�mi je u�ivatel v kontaktu
	 * @param int $user identifik�tor u�ivatele
	 * @param bool $cache maj� se v�sledky ulo�it do mezipam�ti?
	 * @return String / int
	 */
	public function getIDsByUser( $user, $cache=false )
	{
		$sql = "SELECT u.ID FROM users u, profile p, relationships r, relationship_types t WHERE t.ID=r.type AND r.accepted=1 AND (r.usera={$user} OR r.userb={$user}) AND IF( r.usera={$user},u.ID=r.userb,u.ID=r.usera) AND p.user_id=u.ID";
		if( $cache == false )
		{
			return $sql;
		}
		else
		{
			$cache = $this->registry->getObject('db')->cacheQuery( $sql );
			return $cache;
		}
	}
}

?>