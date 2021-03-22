<?php
/* definir namespace */
namespace php\taller03;

/* interface product product */
interface iproduct{
    public function setPrice($price);
    public function getPrice();
    public function setName($Name);
    public function getName();
    public function description();
}

/* clase product implementando interface product*/
class product implements iproduct{
    // Declaración de unas variable string protegidas
    protected $name = "";
    protected $price = 0;
    /* set y get */
    ## nombre
    public function setName($param){
        $this->name = $param;
    }

    public function getName(){
        return $this->name;
    }
    ## precio
    public function setPrice($param){
        if($param<=0)
        $param=0;

        $this->price = $param;
    }

    public function getPrice(){
        return $this->price;
    }
    /* constructor */
    public function __construct() {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if($number_of_arguments>0){
            foreach ($get_arguments as $item) {
                if(is_numeric($item)){
                    // guardar valor del producto
                    $this->setPrice($item);
                }else{
                    /// guardar nombre del producto
                    $this->setName($item);
                }
            }

            echo 'class product ';
        }else{
            print_r(array('Contructor vacio producto'));
        }
    }
    /* destructor */
    function __destruct() {
        print_r(array('Destructor Se elimino el producto'));
    }


    // Declaración de un método leer
    public function index()
    {
    }
    // Declaración de un método crear
    public function create()
    {
    }
    // Declaración de un método actualizar
    public function update()
    {
    }
    // Declaración de un método eliminar
    public function delete()
    {
    }
    ## descripcion
    public function description(){
        $data = [
            'Nombre'=>!empty($this->getName())?$this->getName():'Sin nombre',
            'Precio'=>$this->getPrice()
        ];
        print_r($data);
    }
}

/* clase book */
class book extends product {
    // Declaración de unas variable string protegidas
    protected $author,$year,$sheets,$product;
    protected $index = array(
                        array('# Capitulo' => 1, 'Nombre Capitulo'=>'introduccion','paginas'=>5),
                        array('# Capitulo' => 2, 'Nombre Capitulo'=>'inicio del fin','paginas'=>20),
                        array('# Capitulo' => 3, 'Nombre Capitulo'=>'verdad oculta','paginas'=>50),
                        array('# Capitulo' => 4, 'Nombre Capitulo'=>'misterio nocturno','paginas'=>50),
                    );

    /* set y get */
    ## author
    public function setAuthor($fullAuthor){
        $this->author = $fullAuthor;
    }

    public function getAuthor(){
        return $this->author;
    }
    ## index
    public function setIndex($param){
        $this->index = $param;
    }

    public function getIndex(){
        return $this->index;
    }
    ## year
    public function setYear($param){
        $this->year = $param;
    }

    public function getYear(){
        return $this->year;
    }
    ## sheets onbtener numero de paginas

    public function getSheets(){
        $sum = 0;
        foreach ($this->index as $item) {
            $sum = $sum+$item['paginas'];
        }
        $this->sheets = $sum;
    }

    /* constructor */
    public function __construct() {
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        if($number_of_arguments>0){
            $count = 0;
            foreach ($get_arguments as $item) {
                if($count==0){
                    $this->setAuthor($item);
                }
                if($count==1){
                    $this->setYear($item);
                }
                $count++;
            }
            echo 'class book ';
        }else{
            print_r(array('Contructor vacio book'));
        }
        $this->getSheets();

    }
    /* destructor */
    function __destruct() {
        print_r(array('Destructor Se elimino el book'));
    }


    // Declaración de un método leer
    public function index()
    {
    }
    // Declaración de un método crear
    public function create()
    {
    }
    // Declaración de un método actualizar
    public function update()
    {
    }
    // Declaración de un método eliminar
    public function delete()
    {
    }
     ## descripcion sobre escrito
     public function description(){
        $data = [
            'Descripcion sobreescrito',
            'autor'=>!empty($this->getAuthor())?$this->getAuthor():'Sin nombre',
            'index'=>$this->index,
            'year'=>!empty($this->getYear())?$this->getYear():0,
            'sheets'=>$this->sheets,
        ];
        print_r($data);
        parent::description();
    }
    ##metodo para agregar capitulos
    public function addChapter($nameChapter,$numSheetsChapter){
        ##contar capitulos
        $contador = count($this->index)+1;
        $newChapter = array('# Capitulo' => $contador, 'Nombre Capitulo'=>$nameChapter,'paginas'=>$numSheetsChapter);
        array_push($this->index,$newChapter);
        ## contar nuevamente las paginas
        $this->getSheets();
        print_r(array('Capitulo agregado'));
    }
    ## traer capitulo por numero
    public function getChapterName($number){
        foreach ($this->index as $item) {
            if($number == $item['# Capitulo']){
                print_r($item);
                return;
            }
        }
        print_r(array('Capitulo no encontrado'));
    }
    ## promedio de hojas
    public function averageSheetsPerChapter($numberChapter){
        ##
        $sheet = $this->sheets;

        foreach ($this->index as $item) {
            if($numberChapter == $item['# Capitulo']){

                print_r(array('Capitulo'=>0,'Promedio'=>$item['paginas']/$sheet,'Porcentaje'=>$item['paginas']/$sheet*100));
                return;
            }
        }
        print_r(array('Capitulo no encontrado'=>0));
    }
}

##  diseñado para enviar 0 o 2
##  variables eb caso de poner una sola variable si
##  es numerico quedara como precio pero si es texto quedara como nombre del producto

$product = new product('Compressor 10AAX',123456);
## descripcion
//$product->description();
## ejemplo sin parametros
//$product = new product();
//$product->description();

##  diseñado para enviar 0 o 2
##  variables en caso de poner una sola variable si
##  es numerico quedara como precio pero si es texto quedara como nombre del producto

$book = new book('Camilo Leon','2010');
## descripcion
//$book->description();
## ejemplo sin parametros
//$book = new book();

##agregar capitulos
//$book->addChapter('prueba3',25);
//$book->description();

## buscar capitulo por numero
//$book->getChapterName(4);

## calcular promedio de paginas por capitulo
$book->averageSheetsPerChapter(2);