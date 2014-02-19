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
                //3 rows
                echo $puzzle[0][0];
                echo $puzzle[0][1];
                echo $puzzle[0][2];
                echo $puzzle[1][0];
                echo $puzzle[1][1];
                echo $puzzle[1][2];
                echo $puzzle[2][0];
                echo $puzzle[2][1];
                echo $puzzle[2][2];
                echo "\n";
                echo $puzzle[0][3];
                echo $puzzle[0][4];
                echo $puzzle[0][5];
                echo $puzzle[1][3];
                echo $puzzle[1][4];
                echo $puzzle[1][5];
                echo $puzzle[2][3];
                echo $puzzle[2][4];
                echo $puzzle[2][5];
                echo "\n";
                echo $puzzle[0][6];
                echo $puzzle[0][7];
                echo $puzzle[0][8];
                echo $puzzle[1][6];
                echo $puzzle[1][7];
                echo $puzzle[1][8];
                echo $puzzle[2][6];
                echo $puzzle[2][7];
                echo $puzzle[2][8];
                echo "\n";
                //3 rows
                echo $puzzle[3][0];
                echo $puzzle[3][1];
                echo $puzzle[3][2];
                echo $puzzle[4][0];
                echo $puzzle[4][1];
                echo $puzzle[4][2];
                echo $puzzle[5][0];
                echo $puzzle[5][1];
                echo $puzzle[5][2];
                echo "\n";
                echo $puzzle[3][3];
                echo $puzzle[3][4];
                echo $puzzle[3][5];
                echo $puzzle[4][3];
                echo $puzzle[4][4];
                echo $puzzle[4][5];
                echo $puzzle[5][3];
                echo $puzzle[5][4];
                echo $puzzle[5][5];
                echo "\n";
                echo $puzzle[3][6];
                echo $puzzle[3][7];
                echo $puzzle[3][8];
                echo $puzzle[4][6];
                echo $puzzle[4][7];
                echo $puzzle[4][8];
                echo $puzzle[5][6];
                echo $puzzle[5][7];
                echo $puzzle[5][8];
                echo "\n";
                //3 rows
                echo $puzzle[6][0];
                echo $puzzle[6][1];
                echo $puzzle[6][2];
                echo $puzzle[7][0];
                echo $puzzle[7][1];
                echo $puzzle[7][2];
                echo $puzzle[8][0];
                echo $puzzle[8][1];
                echo $puzzle[8][2];
                echo "\n";
                echo $puzzle[6][3];
                echo $puzzle[6][4];
                echo $puzzle[6][5];
                echo $puzzle[7][3];
                echo $puzzle[7][4];
                echo $puzzle[7][5];
                echo $puzzle[8][3];
                echo $puzzle[8][4];
                echo $puzzle[8][5];
                echo "\n";
                echo $puzzle[6][6];
                echo $puzzle[6][7];
                echo $puzzle[6][8];
                echo $puzzle[7][6];
                echo $puzzle[7][7];
                echo $puzzle[7][8];
                echo $puzzle[8][6];
                echo $puzzle[8][7];
                echo $puzzle[8][8];
                echo "\n";

	}
?>
