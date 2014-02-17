<?
	function checkIfValueIsInArray($array, $value)
	{
		foreach ($array as $i=>$u)
		{
			foreach($u as $j=>$v)
			{
				if(strtolower($v) == strtolower($value))
				{
					return 1;
				}
			}
		}
		return 0;
	}

?>
