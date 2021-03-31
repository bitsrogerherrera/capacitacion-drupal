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
    public $book_;
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
     ## descripcion sobreescrito
     public function description(){
        $this->book_ = array(
            'libro',
            'autor'=>$this->author,
            'Año'=>$this->year,
            'Paginas'=>$this->sheets,
            'Contenido'=>$this->index
        );
        print_r($this->book_);
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
        ## si no encuentra el capitulo sigue hasta este mensaje
        print_r(array('Capitulo no encontrado'=>0));
    }
}

/* clase automation */
class automation extends book{
    private $books;
    private $Arraybooks =[];
    private static $_instancia;

    public static function getInstance()
    {
        if (!self::$_instancia) {
            self::$_instancia = new self();
            /* otra opcion
                        $c = __CLASS__;
             self::$instancia = new $c;
        */
        }
        return self::$_instancia;
    }

    /* constructor */
    public function __construct() {

        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();

        $this->books = file_get_contents("json/books.json");
        $this->books = json_decode($this->books);
        $this->addBooksbyJson($this->books);
        ## validar inicializacion
        if($number_of_arguments==1){
            if($get_arguments[0]){
                $this->Arraybooks = [];
                print_r(array('Inicializar  por Constructor'));
                print_r($this->Arraybooks);
            }else{
                $this->setbook();
                print_r(array('Inicializar  por metodos'));
                print_r($this->getbook());
            }
        }
    }
    /* crear libros */
    public function addBooksbyJson($book){
        $count = 0;
        foreach ($book as $item) {
            $count++;
            $this->addBook($item->Autor,$item->Año,$item->Paginas,$item->Contenido,$count);
        }
    }

    ##metodo para añadir libros
    public function addBook($autor,$year,$sheets,$index,$count){
        $data = array(
            'libro'=>$count,
            'autor'=>$autor,
            'Año'=>$year,
            'Paginas'=>$sheets,
            'Contenido'=>$index
        );
        array_push($this->Arraybooks,$data);
    }
    ## set y get book
    public function setbook(){
        $this->Arraybooks = [];
    }
    public function getbook(){
        $data = $this->Arraybooks;
        return  $data;
    }
    #metodo magico
    public function __get($index){
        print_r($this->Arraybooks[$index]);
    }
    #metodo para usar el metodo magico
    public function methodByindex(){
        foreach ($this->Arraybooks as $key => $value) {
            if ($key%2==0){
                $data = $this->getbook();
                print_r(array('metodo normal'));
                print_r($data[$key]);
            }else{
                print_r(array('metodo magico'));
                $this->__get($key);
            }
        }
    }

    ## metodo para mostrar capitulos por libro
    public function ChapterbyBook(){
        $Chapters = [];
        foreach ($this->Arraybooks as $key => $book) {
            $value = 0;
            foreach ($book['Contenido'] as $chapters) {
                $value++;
            }
            array_push($Chapters,array('Libro'=>$key+1,'capitulos'=>$value));
        }
        print_r($Chapters);
    }

    ## metodo para tener 3 posiciones al azar de cada libro
    public function randomChapters(){
        foreach ($this->Arraybooks as $index => $book) {
            $ArrayChapterRandom =[];
            print_r('############################################');
            foreach ($book['Contenido'] as $key => $value) {
                array_push($ArrayChapterRandom,$key);
            }
            if(count($ArrayChapterRandom)>0){
                $random = array_rand($ArrayChapterRandom,3);
                ### imprimir los 3 capitulos random
                foreach ($random as $value) {
                    print_r(array('libro'=>$index+1));
                    print_r(array('capitulo'=>$value+1,'contenido'=>$book['Contenido']->$value));
                }
            }else{
                print_r(array('libro'=>$index+1));
                print_r(array('Sin capitulos'));
            }
            print_r('############################################');
        }
    }

    ##paginas por capitulo
    public function SheetsByChapter(){
        foreach ($this->Arraybooks as $key => $value) {
            print_r('############################################');
            print_r(array('libro'=>$key+1));
            foreach ($value['Contenido'] as $cap => $value) {
                print_r(array('capitulo'=>$cap+1,'paginas'=>$value->paginas));
            }
            print_r('############################################');
        }
    }

    ## convertir Json cada libro
    public function JsonByBook(){
        foreach ($this->Arraybooks as $key => $value) {
            print_r(array('############################################'));
            print_r(json_encode($value));
            print_r(array('############################################'));
        }
    }

    ## destruir libros
    public function deleteAll(){
        return $this->Arraybooks = [];
    }
}

############## Comandos por consola ############################
##  diseñado para enviar 0 o 2
##  variables eb caso de poner una sola variable si
##  es numerico quedara como precio pero si es texto quedara como nombre del producto

//$product = new product('Compressor 10AAX',123456);
## descripcion
//$product->description();
## ejemplo sin parametros
//$product = new product();
//$product->description();

##  diseñado para enviar 0 o 2
##  variables en caso de poner una sola variable si
##  es numerico quedara como precio pero si es texto quedara como nombre del producto

//$book = new book('Camilo Leon','2010');
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
//$book->averageSheetsPerChapter(2);

## llamar clase automation
//$auto = new automation();
// $auto->getbook();
## inicializar por constructor
//$auto = new automation(true);

## inicializar por metodos
//$auto = new automation(false);

## metodos magico o metodo get
//$auto = new automation();
//$auto->methodByindex();

## metodo para mostrar los capitulos de cada libro
//$auto = new automation();
//$auto->ChapterbyBook();


## metodo para mostrar 3 capitulos al azar de cada libro
//$auto = new automation();
//$auto->randomChapters();


## metodo para mostrar las paginas por capitulo
//$auto = new automation();
//$auto->SheetsByChapter();


## json de cada libro
//$auto = new automation();
//$auto->JsonByBook();


## destruir libros
/* $auto = new automation();
$response = array('libros destruidos','libros'=>$auto->deleteAll());
print_r($response); */
