<?php 
require "phpassets/functions.php";

$url = $_SERVER['REQUEST_URI'];
$link = explode("/", $url);
$lch = is_present($link, "influencedbyus");
$l1 = $lch + 1;
$l = $lch + 2;

	/*
		Start First Level URI Auth routes and processes
	*/

if(count($link) === $l){
	if(strtolower($link[$l1]) !== ''){
	
	if(strtolower($link[$l1]) == 'campaigns' || strtolower($link[$l1]) == 'dashboard' || strtolower($link[$l1]) == 'settings' || strtolower($link[$l1]) == 'referrals' || strtolower($link[$l1]) == 'earnings'){
		if(!isset($_SESSION['user']))
			header("Location: ./login");
		else{
			require "inc/dashboard/header.php";
			if(strtolower($link[$l1]) === 'dashboard')
				require("influencer/dashboard.php");

			elseif(strtolower($link[$l1]) === 'settings')
				require("influencer/settings.php");	

			elseif(strtolower($link[$l1]) === 'referrals')
				require("influencer/referral.php");	

			elseif(strtolower($link[$l1]) === 'earnings')
				require("influencer/earnings.php");

			else header("Location: ./error");

			require "inc/dashboard/footer.php";	
		}

	}

	else{

		require "inc/header.php";

	if(strtolower($link[$l1]) === 'register'){
		if(isset($_SESSION['user']) && !isset($_SESSION['confirm_email']))
			header("Location: ./dashboard");
		else
		require("auth/register.php");
	}
	elseif(strtolower($link[$l1]) === 'login'){
		if(isset($_SESSION['user']))
			header("Location: ./dashboard");
		else
		require("auth/login.php");
	}
	elseif(strtolower($link[$l1]) === 'verify-email'){
		require("auth/confirm_email.php");
	}
	elseif(strtolower($link[$l1]) === 'logout'){
		require("signout.php");
	}
	elseif(strtolower($link[$l1]) === 'reset'){
		require("auth/reset_password.php");
	}
	elseif(strtolower($link[$l1]) === 'reset-email'){
		require("auth/reset_email.php");
	}
	elseif(strtolower($link[$l1]) === 'reset-pw'){
		require("auth/password_change.php");
	}
	elseif(strtolower($link[$l1]) === 'account-setup-instagram'){
		require("auth/instagram_link.php");
	}
	elseif(strtolower($link[$l1]) === 'instagram-link-successful'){
		require("auth/ig_token_ver.php");
	}
	elseif(strtolower($link[$l1]) === 'account-setup-preferences'){
		require("auth/preferences.php");
	}
	elseif(strtolower($link[$l1]) === 'account-setup-more'){
		require("auth/profile_plus.php");
	}
	elseif(strpos($link[$l1], "?") > 0){
		$link2 = explode("?", $link[$l1]);
		if(strtolower($link2[0]) === 'instagram-link-successful'){
			$code = $link2[1];
			$code = explode("=", $code)[1];
			require("auth/ig_token_ver.php");
		}
		if(strtolower($link2[0]) === 'stunt'){
			$code = $link2[1];
			$code = explode("=", $code)[1];
			echo $code;
			require("stunt.php");
		}
	}

	elseif(strtolower($link[$l1]) === 'notfound' ||strtolower($link[$l1]) === 'invalid-token'){
		require("404.php");
	}

	elseif ($link[$l1] === 'stunt') {
		require "stunt.php";
	}

	else{
		require "404.php";
	}

		require "inc/footer.php";
}
}
	else{
		require("index.html");
	}
}

	/*
		End First Level URI Auth routes and processes
	*/

elseif(count($link) > $l){
//second level route
	/*
		Start Second Level URI Auth routes and processes
	*/
		//for registration of influencer

	if(strtolower($link[$l1]) === 'verify-email'){
		$token = $link[$l];
		require 'auth/email_token_ver.php';
	}

	elseif(strtolower($link[$l1]) === 'reset-pass'){
		$token = $link[$l];
		require 'auth/reset_token_ver.php';
	}

	elseif(strtolower($link[$l1]) === 'register'){
		$_SESSION['referral'] = $link[$l];
		header("Location: ../register");
	}

	/*
		End Second Level URI Auth routes and processes
	*/
	else
		require("404.php");
}

 ?>