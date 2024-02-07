<?php

namespace app\controllers;
class DashboardController extends Controller
{
  public function index() {
    session_start();
   
    if (!isset($_SESSION['auth'])) {
      header("Location: /login?=notauth");
      die();
  }
  // Obtém as informações do usuário da sessão
  $user = $_SESSION['auth'];

  // Passa as informações do usuário para a visualização
  $this->view('dashboard', ['user' => $user]);
}
    
    
  }
