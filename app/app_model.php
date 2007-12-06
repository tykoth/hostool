<?
class AppModel extends Model {


	function generateMultiList($conditions = null, $order = null, $limit = null, $keyPath = null, $valuePath = null, $separator = '') {
		if ($keyPath == null && $valuePath == null && $this->hasField($this->displayField)) {
			$fields = array($this->primaryKey, $this->displayField);
		} else {
			$fields = null;
		}
		$recursive = $this->recursive;
		$result = $this->findAll($conditions, $fields, $order, $limit);
		$this->recursive = $recursive;
		if(!$result) {
			return false;
		}
		if ($keyPath == null) {
			$keyPath = '{n}.' . $this->name . '.' . $this->primaryKey;
		}
		if ($valuePath == null) {
			$valuePath = '{n}.' . $this->name . '.' . $this->displayField;
		}
		// extract the keys as normal
		$keys = Set::extract($result, $keyPath);
		$finalVals = array();
		// explode the value path by our delimiter
		$tmpVals = explode('#', $valuePath);
		$i = 0;
		//		echo "<pre>";
		foreach($tmpVals as $tmpVal) {
			// extract the data for each path sibling
			$vals = Set::extract($result, $tmpVal);
			list($k, $n, $field) = explode(".", $tmpVal);
			//			die(strpos($tmpVal, ".", 1));
			//			print_r($finalVals);

			foreach($vals as $key => $value) {
				//				echo "valor = $key - <b>{$value}</b>\n";
				if(!array_key_exists($key, $finalVals)) {
					$finalVals[$key] = array($field => $value);
				} else {
					$finalVals[$key] = $finalVals[$key]+array($field => $value);
				}
			}
			$i++;
		}
		//		print_r($finalVals);
		//		die();
		if (!empty($keys) && !empty($finalVals)) {
			$out = array();
			$return = array_combine($keys, $finalVals);
			return $return;
		}
		return null;
	}

	/**
	 * Função utilizada para multiplos saves
	 *
	 * @param array $multidata Array contendo todos os dados para salvar.
	 * @param string $key Chave, para adicinar valor de chave associativa
	 * @param mixed $keyval Valor da chave.
	 * @return bool
	 * 
	 * @since 03/12/2007 - 09:07
	 * @todo Criar um método que não precise utilizar $key e $keyval
	 * 
	 */
	function multisave($multidata = null, $key = null, $keyval = null)
	{
		// Verifica se o mesmo é um array, e se não está vazio
		if(!is_array($multidata) || empty($multidata)) return false;
		
		// Verifica se existe a chave com nome do Model
		if(key_exists($this->name,$multidata)) $multidata = $multidata[$this->name];

		foreach($multidata as $data)
		{
			$this->create();
			if($key !== null && $keyval !== null) $data[$key] = $keyval;
//			if($key !== null && $keyval !== null) $this->$key = $keyval;
			
			if(!is_array($data))
			{
				if(!$this->save($multidata)) return false;
				return true;
			}
			else 
			{
				if(!$this->save($data)) return false;
			}
		}
		return true;
	}
	
	function beforeSave()
	{
		/**
		 * Solução prática para a conversão de caracteres, em POSTs em ajax.
		 */
		foreach($this->data[$this->name] as $key => $data)
		{
			$this->data[$this->name][$key] = utf8_decode($data);
		}
		 
		return true;
	}
}
?>