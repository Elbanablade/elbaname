<?
	$puzzle = array();
	for($i = 0; $i < 9; $i++)
	{
		array_push($puzzle, array(0,0,0,0,0,0,0,0,0));
	}

	for($i = 0; $i < 81; $i++)
	{
		echo "checking position $i\n";
		$valid = false;
		$invalid = array();
		while ($valid == false)
		{
			$temp = $puzzle;
			$testNum = getRandomNum($invalid);
			$puzzle[$i/9][$i%9] = $testNum;
			if(!checkvalidity($puzzle))
			{
				array_push($invalid, $testNum);
				$puzzle = $temp;
			}
			else
			{
				$valid = true;
			}
			for($j = 0; $j < count($invalid); $j++)
			{
				echo "$invalid[$j] ";
			}
			echo "\n";
			if(count($invalid) == 9)
			{
				printPuzzle($puzzle);
			}
		}
	}
	echo "puzzle Filled\n";

	printPuzzle($puzzle);
print_r($puzzle);
	function checkValidity($puzzle)
	{
		for($i = 0; $i < 9; $i++)
		{
			for($j = 0; $j < 9; $j++)
			{
				for($k = 0; $k < 9; $k++)
				{
					for($l = 0; $l < 9; $l++)
					{
						//cell check
						if($i == $k && $j != $l)
						{
							if($puzzle[$i][$j] == $puzzle[$k][$l] && $puzzle[$i][$j] != 0 && $puzzle[$k][$l] != 0)
							{
								return false;
							}
						}
						//row check
						//column check
					}
				}
			}
		}
		return true;
	}

	function getRandomNum($invalid)
	{
		$invalidFlag = true;
		$min = 1;
		$max = 9;
		while ($invalidFlag)
		{
			$invalidFlag = false;
			$testNum = rand($min,$max);
			for($j = 0; $j < count($invalid); $j++)
			{
				if($testNum == $invalid[$j])
				{
					if($testNum == $min)
					{
						$min = $testNum++;
					}
					elseif($testNum == $max)
					{
						$max = $testNum--;
					}
				$invalidFlag = true;
					break;
				}
			}
		}
		return $testNum;
	}

	function printPuzzle($puzzle)
	{
		for($i = 0; $i < 9; $i++)
		{
			echo $puzzle[$i][0] . "\n";
		}
	}
?>
