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

	function checkValidity($puzzle)
	{
		echo "checking validity\n";
		for($i = 0; $i < 9; $i++)
		{
			for($j = 0; $j < 9; $j++)
			{
				//check for duplicates inside same cell
				for($k = 0; $k < 9; $k++)
				{
					if(($puzzle[$i][$j] == $puzzle[$i][$k]) && ($puzzle[$i][$j] != 0) && ($puzzle[$i][$j] != 0) && ($k != $j))
					{
						return false;
					}
				}
				//check for duplicate inside row
				if($i < 3)
				{
					//row checks
					if($j < 3)
					{
						for($k = 0; $k < 3; $k++)
						{
							for($l = 0; $l < 3; $l++)
							{
								if($j != $l && $i != $k)
								{
									if($puzzle[$i][$j] == $puzzle[$k][$l] && $puzzle[$i][$j] != 0 && $puzzle[$k][$l] != 0)
									{
										return false;
									}
								}
							}
						}
					}
					elseif($j > 2 && $j < 6)
					{
						for($k = 0; $k < 3; $k++)
						{
							for($l = 3; $l < 6; $l++)
							{
								if($j != $l && $i != $k)
								{
									if($puzzle[$i][$j] == $puzzle[$k][$l] && $puzzle[$i][$j] != 0 && $puzzle[$k][$l] != 0)
									{
										return false;
									}
								}
							}
						}
					}
					elseif($j > 5)
					{
						for($k = 0; $k < 3; $k++)
						{
							for($l = 6; $l < 8; $l++)
							{
								if($j != $l && $i != $k)
								{
									if($puzzle[$i][$j] == $puzzle[$k][$l] && $puzzle[$i][$j] != 0 && $puzzle[$k][$l] != 0)
									{
										return false;
									}
								}
							}
						}
					}
				}
				elseif($i > 2 && $i < 6)
				{
					if($j < 3)
					{
						for($k = 3; $k < 6; $k++)
						{
							for($l = 0; $l < 3; $l++)
							{
								if($j != $l && $i != $k)
								{
									if($puzzle[$i][$j] == $puzzle[$k][$l] && $puzzle[$i][$j] != 0 && $puzzle[$k][$l] != 0)
									{
										return false;
									}
								}
							}
						}
					}
					elseif($j > 2 && $j < 6)
					{
						for($k = 3; $k < 6; $k++)
						{
							for($l = 3; $l < 6; $l++)
							{
								if($j != $l && $i != $k)
								{
									if($puzzle[$i][$j] == $puzzle[$k][$l] && $puzzle[$i][$j] != 0 && $puzzle[$k][$l] != 0)
									{
										return false;
									}
								}
							}
						}
					}
					elseif($j > 5)
					{
						for($k = 3; $k < 6; $k++)
						{
							for($l = 6; $l < 8; $l++)
							{
								if($j != $l && $i != $k)
								{
									if($puzzle[$i][$j] == $puzzle[$k][$l] && $puzzle[$i][$j] != 0 && $puzzle[$k][$l] != 0)
									{
										return false;
									}
								}
							}
						}
					}
				}
				elseif($i > 5)
				{
					if($j < 3)
					{
						for($k = 6; $k < 9; $k++)
						{
							for($l = 0; $l < 3; $l++)
							{
								if($j != $l && $i != $k)
								{
									if($puzzle[$i][$j] == $puzzle[$k][$l] && $puzzle[$i][$j] != 0 && $puzzle[$k][$l] != 0)
									{
										return false;
									}
								}
							}
						}
					}
					elseif($j > 2 && $j < 6)
					{
						for($k = 6; $k < 9; $k++)
						{
							for($l = 3; $l < 6; $l++)
							{
								if($j != $l && $i != $k)
								{
									if($puzzle[$i][$j] == $puzzle[$k][$l] && $puzzle[$i][$j] != 0 && $puzzle[$k][$l] != 0)
									{
										return false;
									}
								}
							}
						}
					}
					elseif($j > 5)
					{
						for($k = 6; $k < 9; $k++)
						{
							for($l = 6; $l < 8; $l++)
							{
								if($j != $l && $i != $k)
								{
									if($puzzle[$i][$j] == $puzzle[$k][$l] && $puzzle[$i][$j] != 0 && $puzzle[$k][$l] != 0)
									{
										return false;
									}
								}
							}
						}
					}
				}
				//column checks
				if($i%3 == 0)
				{
					if($j%3 == 0)
					{
						for($k = 0; $k < 9; $k++)
						{
							for($l = 0; $l < 9; $l++)
							{
								if($j != $l && $i != $k)
								{
									if($puzzle[$i][$j] == $puzzle[$k][$l] && $puzzle[$i][$j] != 0 && $puzzle[$k][$l] != 0)
									{
										echo "failed indexes $i, $j, $k, $l\n";
										return false;
									}
								}
								$l++;
								$l++;
							}
							$k++;
							$k++;
						}
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
			for($j = 0; $j < 3; $j++)
			{
				echo $puzzle[$i][$j];
			}
			for($j = 0; $j < 3; $j++)
			{
				echo $puzzle[$i][$j+3];
			}
			for($j = 0; $j < 3; $j++)
			{
				echo $puzzle[$i][$j+6];
			}
			echo "\n";
		}
	}
?>
