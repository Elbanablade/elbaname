function printAllElements()
{
	var a = document.getElementsByName("test");
	for (index = 0; index < a.length; ++index)
	{
		console.log(a[index]);
	}
}

function printHi()
{
	console.log("hi");
}

function showAll()
{
	var a = document.getElementsByClassName("anime_link");
	for (index = 0; index < a.length; ++index)
	{
		a[index].style.display = "inline-block";
	}
}

function showEnglishOnly()
{
	var a = document.getElementsByClassName("anime_link");
	for (index = 0; index < a.length; ++index)
	{
		if(a[index].classList.contains("English"))
		{
			a[index].style.display = "inline-block";
		}
		else
		{
			a[index].style.display = "none";
		}
	}
	console.log(a.length);

}

function showJapaneseOnly()
{
	var a = document.getElementsByClassName("anime_link");
	for (index = 0; index < a.length; ++index)
	{
		if(a[index].classList.contains("Japanese"))
		{
			a[index].style.display = "inline-block";
		}
		else
		{
			a[index].style.display = "none";
		}
	}
	console.log(a.length);

}

function showWatchedOnly()
{
	var a = document.getElementsByClassName("anime_link");
	for (index = 0; index < a.length; ++index)
	{
		if(a[index].classList.contains("watched"))
		{
			a[index].style.display = "inline-block";
		}
		else
		{
			a[index].style.display = "none";
		}
	}
	console.log(a.length);

}

function showInProgressOnly()
{
	var a = document.getElementsByClassName("anime_link");
	for (index = 0; index < a.length; ++index)
	{
		if(a[index].classList.contains("inprogress"))
		{
			a[index].style.display = "inline-block";
		}
		else
		{
			a[index].style.display = "none";
		}
	}
	console.log(a.length);

}

function showUnWatchedOnly()
{
	var a = document.getElementsByClassName("anime_link");
	for (index = 0; index < a.length; ++index)
	{
		if(a[index].classList.contains("unwatched"))
		{
			a[index].style.display = "inline-block";
		}
		else
		{
			a[index].style.display = "none";
		}
	}
	console.log(a.length);

}



function search()
{
	setTimeout(function() {
		var x = document.getElementById("search_input").value.replace(/ /,"_");
		var a = document.getElementsByClassName("anime_link");
		for (index = 0; index < a.length; ++index)
		{
			if (a[index].classList[1].indexOf(x) != -1)
			{
				a[index].style.display = "inline-block";
			}
			else
			{
				a[index].style.display = "none";
			}
		}
	}, 0);
}

function getValue()
{
	var $field = $(this);
	var beforeVal = $field.val();
	setTimeout(function() {
		var afterVal = $field.val();
		return afterVal;
	}, 0);
}

function moviesearch()
{
	setTimeout(function() {
		var x = document.getElementById("search_input").value.replace(/ /,"_");
		var a = document.getElementsByClassName("movie_link");
		for (index = 0; index < a.length; ++index)
		{
			if (a[index].classList[1].indexOf(x) != -1)
			{
				a[index].style.display = "inline-block";
			}
			else
			{
				a[index].style.display = "none";
			}
		}
	}, 0);
}

function animemoviesearch()
{
	setTimeout(function() {
		var x = document.getElementById("search_input").value.replace(/ /,"_");
		var a = document.getElementsByClassName("anime_movie_link");
		for (index = 0; index < a.length; ++index)
		{
			if (a[index].classList[1].indexOf(x) != -1)
			{
				a[index].style.display = "inline-block";
			}
			else
			{
				a[index].style.display = "none";
			}
		}
	}, 0);
}

function changeUserPasswordClick()
{
	var myAnchor = document.getElementById("change_user_password");
	var mySpan = document.createElement("span");
	mySpan.innerHTML = "<form action='#' method='post'><input type='text' name='password'><input type='button' value='Submit'></form>";
	myAnchor.parentNode.replaceChild(mySpan, myAnchor);
}

function changeUserPermissionsClick()
{
	var myAnchor = document.getElementById("change_user_permissions");
	var mySpan = document.createElement("span");
	var value = myAnchor.innerHTML;
console.log(value);
	mySpan.innerHTML = "<form action='#' method='post'><input type='text' name='permissions' placeholder='" + value + "'><input type='button' value='Submit'></form>";
	myAnchor.parentNode.replaceChild(mySpan, myAnchor);

}

function visibilityTogleUsersAdmin()
{
	var x = document.getElementById("users_admin");
	if(x.style.display == "inline-block")
	{
		x.style.display = "none";
	}
	else
	{
		x.style.display = "inline-block";
	}
}

function visibilityTogleUpdateAdmin()
{
	var x = document.getElementById("updates_admin");
	if(x.style.display == "inline-block")
	{
		x.style.display = "none";
	}
	else
	{
		x.style.display = "inline-block";
	}
}

function visibilityTogleDownloadListAdmin()
{
	var x = document.getElementById("downloadsList");
	if(x.style.display == "inline-block")
	{
		x.style.display = "none";
	}
	else
	{
		x.style.display = "inline-block";
	}
	var x = document.getElementById("downloadListAddForm");
	if(x.style.display == "block")
	{
		x.style.display = "none";
	}
	else
	{
		x.style.display = "block";
	}
}

function visibilityTogleBugListAdmin()
{
	var x = document.getElementById("bugList");
	if(x.style.display == "inline-block")
	{
		x.style.display = "none";
	}
	else
	{
		x.style.display = "inline-block";
	}
	var x = document.getElementById("bugListAddForm");
	if(x.style.display == "block")
	{
		x.style.display = "none";
	}
	else
	{
		x.style.display = "block";
	}
}

function new_user_button_toggle()
{
	var form = document.createElement("form");
	form.action='#';
	form.method='post';
	form.id='form_users_admin';
	form.innerHTML = "\
	<input type='text' name='name' value='name' placeholder='Name'></input>\
	<input type='text' name='permissions' value='permissions' placeholder='Permissions Level'></input>\
	<input type='text' name='password' value='password' placeholder='Pasword'></input>\
	<input type='submit' value='submit'></input>\
	";
	var anchor = document.getElementById("users_admin");
	anchor.parentNode.replaceChild(form, anchor);
	var table = document.createElement("table");
	table.innerHTML = anchor.innerHTML;
	document.getElementById('update_options').appendChild(table);
}

function showMovieQualityHd()
{
	var a = document.getElementsByClassName("movie_link");
	for (index = 0; index < a.length; ++index)
	{
		if(a[index].classList.contains("hd"))
		{
			a[index].style.display = "inline-block";
		}
		else
		{
			a[index].style.display = "none";
		}
	}
}

function showMovieQualitySd()
{
	var a = document.getElementsByClassName("movie_link");
	for (index = 0; index < a.length; ++index)
	{
		if(a[index].classList.contains("sd"))
		{
			a[index].style.display = "inline-block";
		}
		else
		{
			a[index].style.display = "none";
		}
	}
}

function showMovieMpaaRatingG()
{
	var a = document.getElementsByClassName("movie_link");
	for (index = 0; index < a.length; ++index)
	{
		if(a[index].classList.contains("G"))
		{
			a[index].style.display = "inline-block";
		}
		else
		{
			a[index].style.display = "none";
		}
	}
}

function showMovieMpaaRatingPg()
{
	var a = document.getElementsByClassName("movie_link");
	for (index = 0; index < a.length; ++index)
	{
		if(a[index].classList.contains("PG"))
		{
			a[index].style.display = "inline-block";
		}
		else
		{
			a[index].style.display = "none";
		}
	}
}

function showMovieMpaaRatingPg13()
{
	var a = document.getElementsByClassName("movie_link");
	for (index = 0; index < a.length; ++index)
	{
		if(a[index].classList.contains("PG-13"))
		{
			a[index].style.display = "inline-block";
		}
		else
		{
			a[index].style.display = "none";
		}
	}
}

function showMovieMpaaRatingR()
{
	var a = document.getElementsByClassName("movie_link");
	for (index = 0; index < a.length; ++index)
	{
		if(a[index].classList.contains("R"))
		{
			a[index].style.display = "inline-block";
		}
		else
		{
			a[index].style.display = "none";
		}
	}
}

function showMovieMpaaRatingUnrated()
{
	var a = document.getElementsByClassName("movie_link");
	for (index = 0; index < a.length; ++index)
	{
		if(a[index].classList.contains("UNRATED"))
		{
			a[index].style.display = "inline-block";
		}
		else
		{
			a[index].style.display = "none";
		}
	}
}

function showMovieRating(rating)
{
	var a = document.getElementsByClassName("movie_link");
	for (index = 0; index < a.length; ++index)
	{
		if( parseFloat(a[index].classList[7]) >= rating)
		{
			a[index].style.display = "inline-block";
		}
		else
		{
			a[index].style.display = "none";
		}
	}
}

function showMovieAll()
{
	var a = document.getElementsByClassName("movie_link");
	for (index = 0; index < a.length; ++index)
	{
		a[index].style.display = "inline-block";
	}
}

function showMovieGenre(genre)
{
	var a = document.getElementsByClassName("movie_link");
	for (index = 0; index < a.length; ++index)
	{
		if(a[index].classList.contains(genre))
		{
			a[index].style.display = "inline-block";
		}
		else
		{
			a[index].style.display = "none";
		}
	}
}

function togleVisible()
{
	console.log(this);
}



