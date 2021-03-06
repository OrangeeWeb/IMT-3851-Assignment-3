<?php
namespace App\Controllers;

use Controller, Request, View, Account, Direct;

class LoginController extends Controller {

	/**
	 * Ajax login
	 * @method login_action
	 * @author [Agne Ødegaard]
	 * @param  Request      $data [description]
	 * @return JSON
	 */
	public function login_action(Request $data){
		$msg = Account::login($data->post->username, $data->post->password);
		if($msg === true) return ['toast' => 'Welcome ' . $data->post->username, 'status' => true];
		return ['toast' => $msg,];
	}

	/**
	 * Register View
	 * @method register
	 * @author [Agne Ødegaard]
	 * @return View
	 */
	public function register(){
		if(Account::isLoggedIn()) return Direct::re('/');

		return View::make('register');
	}

	/**
	 *  Logout function
	 * @method logout
	 * @author [Agne Ødegaard]
	 * @param  Request $data [description]
	 * @return JSON
	 */
	public function logout(Request $data){
		Account::logout();
		return ['toast' => 'You have logged out, redirecting to Home'];
	}
	/**
	 * Ajax: Register a user
	 * @method save
	 * @author [Agne Ødegaard]
	 * @param  Request $data [description]
	 * @return JSON
	 */
	public function save(Request $data){
		if(empty($data->post->name))
			return ['toast' => 'Please enter your name'];
		if(empty($data->post->surname))
			return ['toast' => 'Please enter your surname'];
		if(empty($data->post->username))
			return ['toast' => 'Please enter your username'];
		if(empty($data->post->mail))
			return ['toast' => 'Please enter your mail'];
		if(empty($data->post->password))
			return ['toast' => 'Please enter your password'];
		if(empty($data->post->password_again))
			return ['toast' => 'Please confirm your password'];

		$msg = Account::register($data->post->username,
								  $data->post->password,
								  $data->post->password_again,
								  $data->post->mail,
								  $data->post->name,
								  $data->post->surname);

		if(is_numeric($msg) && $msg > 0) return ['status' => 'ok', 'toast' => 'You are now a use, Welcome to DIBS', 'username' => $data->post->username];
		return ['toast' => 'Username or Mail already taken'];

	}

	/**
	 * Ajax: Menu view, fetched with ajax to get the new menu
	 * @method menu
	 * @author [Agne Ødegaard]
	 * @return View
	 */
	public function menu(){
		return View::make('layout.menu');
	}
}
