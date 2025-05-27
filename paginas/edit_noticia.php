<?php
require 'conexao.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD']==='GET' && isset($_GET['id'])) {
  $id = (int)$_GET['id'];
  $stmt = $conn->prepare("SELECT id_noticia, titulo, conteudo FROM noticias WHERE id_noticia=?");
  $stmt->execute([$id]);
  echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
  exit;
}

if ($_SERVER['REQUEST_METHOD']==='POST') {
  $id      = $_POST['id_noticia'];
  $titulo  = $_POST['titulo'];
  $conteudo= $_POST['conteudo'];
  $upd = $conn->prepare("UPDATE noticias SET titulo=?, conteudo=? WHERE id_noticia=?");
  $success = $upd->execute([$titulo,$conteudo,$id]);
  echo json_encode(['success'=>$success]);
}