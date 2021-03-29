<?php

class Pagina{

  private $title = "";
  private $description = "";
  private $content = "";

  public function getTitle(){
    return $this->title;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function getContent()
  {
    return $this->content;
  }

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function setDescription($description)
  {
    $this->description = $description;
  }

  public function setContent($content)
  {
    $this->content = $content;
  }
}

$page = new Pagina();
$page->setTitle("taller de GIT");
$page->setDescription("Se Creo una clase pagina");
$page->setContent("Se Creo una clase pagina sencilla donde se ingresan 3
                  paramentros");

echo "Titulo: " . $page->getTitle() . "<br/ >";
echo "Descripcion: " . $page->getDescription() . "<br/ >";
echo "Contenido: " . $page->getContent() . "<br/ >";
