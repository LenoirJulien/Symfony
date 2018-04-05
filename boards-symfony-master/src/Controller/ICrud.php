<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;

interface ICrud {
	public function index();
	public function refresh();
	public function edit($id);
	public function add();
	public function update(Request $request);
	public function deleteConfirm($id);
	public function delete($id,Request $request);
}
