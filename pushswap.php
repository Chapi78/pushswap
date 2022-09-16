<?php

class sorting{

    public $la;
    public $lb;
    public $maxla;

    public function init()
    {
        // echo "init\n"; //comm
        global $argv;
        array_shift($argv);
        $this->lb = [];
        $this->la = $argv;
        // $this->checkorder();
        // $this->test();
        // echo "\nmin: " . min($this->la) . "\n\n";
        if($this->checkorder() == true) {
            exit;
        }
        $this->compute();
    }

    public function test()
    {

    }

    public function compute()
    {
        // echo "computed\n"; //comm
        $maxla = max($this->la); // trouve le maximum
        $minla = min($this->la);
        // echo "\nmaxla: " . $maxla . "\n"; //comm
        if(empty($this->lb)) {
            $first_b = "empty";
        } else {
            $first_b = $this->lb[0];
        }
        // echo "\n first lb: " . $this->lb[0] . "\n"; //comm
        // var_dump($this->la, $this->lb); //comm
        // var_dump(array_keys($this->la)); //comm
        // var_dump($this->la, $this->la);
        // echo $this->lb[0];

        
        foreach(array_keys($this->la) as $check){
            // echo count($this->la) . "  ". $check . "\n"; //comm
            if(array_key_last($this->la) >= 1) {
                // echo "\ncheck: " . ($check + 1) . "\nlastkey: " . array_key_last(array_keys($this->la)) . "\n"; //comm
                if($maxla == $this->la[0]){
                    $this->ra();
                    if($this->checkorder() == true && min($this->la) > min($this->lb)){
                        $this->reverse();
                    }
                    $this->compute();
                }
                if($this->la[$check] > $this->la[$check + 1]){ // check les adjacent
                    // echo "\njeffff" . $this->la[$check] . "\n\n" . $this->la[$check + 1] . "\n"; //comm
                    $this->sa();
                    if($this->checkorder() == true && min($this->la) > min($this->lb)){
                        $this->reverse();
                    }
                    $this->compute();
                } else { // partie push sur lb
                    $this->pb();
                    if(min($this->lb) == $this->lb[0] && count($this->lb) > 2){
                        $this->rb();
                    }
                    if($this->checkorder() == true && min($this->la) > min($this->lb)){
                        $this->reverse();
                    }
                    $this->compute();
                }
                // echo $this->la[$check] . "\n"; //comm
                // echo $this->la[$check + 1] . "\n"; //comm
            }
        }
    }

    public function checkorder() //savoir quand re repmlir le tableau la
    {
        $lastone = null;
        foreach($this->la as $order){
            if(!$lastone == null) {
                if($lastone > $order){
                    // echo "\nfalse\n"; //comm
                    return false;
                }
            }
            // echo $lastone . "   " . $order . "\n"; //comm
            $lastone = $order;
        }
        return true;
    }

    public function reverse()
    {
        // echo "\n\nwe need the great reverse!\n\n"; //comm
        // echo $this->la[0] . "\n" . $this->lb[0]; //comm
        foreach(array_keys($this->lb) as $item){ //verifier que les chiffre sont dans le bonne
            // echo "\nITEM: " . $item . " !!!!!!!!!!!!\n"; // ordre qd il sont push sur la
            $this->pa();
            if(array_key_last($this->la) > 1) {
                foreach(array_keys($this->la) as $check){
                    if($this->la[0] > $this->la[1]){
                        $this->sa();
                    }
                }
            }
        }
        $exit = implode(" ", $this->la);
        exit($exit);
        // if($this->la[0] >= $this->lb[0]){
        //     $this->pa();
        // }
    }

    public function sa() // reverse les 2 premiere valeur
    {
        $temp = $this->la[0];
        $this->la[0] = $this->la[1];
        $this->la[1] = $temp;
        echo "sa ";
        // echo $this->la[0] . "\n" . $this->la[1] . "\n"; //comm
        // echo "\n"; //comm
        // var_dump($this->la, $this->lb); //comm
    }

    public function sb() // reverse les 2 premiere valeur
    {
        $temp = $this->lb[0];
        $this->lb[0] = $this->lb[1];
        $this->lb[1] = $temp;
        echo "sb ";
        // echo $this->lb[0] . "\n" . $this->lb[1] . "\n"; //comm
        // echo "\n"; //comm
        // var_dump($this->lb, $this->lb); //comm
    }

    public function sc() // reverse les 2 premiere valeur des deux tableau
    {
        $this->sa();
        $this->sb();
    }

    public function pa() // 1er element de b dans a
    {
        array_unshift($this->la, array_shift($this->lb));
        // var_dump($this->la, $this->lb); //comm
        echo "pa ";
    }

    public function pb() // 1er element de a dans b
    {
        array_unshift($this->lb, array_shift($this->la));
        // var_dump($this->la, $this->lb); //comm
        echo "pb ";
    }

    public function ra() // 1er element devient dernier a
    {
        $max = count($this->la) - 1;
        array_push($this->la, array_shift($this->la));
        // var_dump($this->la, $this->lb); //comm
        echo "ra ";
    }

    public function rb() // 1er element devient dernier b
    {
        $max = count($this->lb) - 1;
        array_push($this->lb, array_shift($this->lb));
        // var_dump($this->la, $this->lb); //comm
        echo "rb ";
    }

    public function rr() // rb() ra()
    {
        $this->ra();
        $this->rb();
    }

    public function rra() // dernier devient 1er a
    {
        $max = count($this->la) - 1;
        array_unshift($this->la, $this->la[$max]);
        array_pop($this->la);
        // var_dump($this->la, $this->lb); //comm
    }

    public function rrb() // dernier devient 1er b
    {
        $max = count($this->lb) - 1;
        array_unshift($this->lb, $this->lb[$max]);
        array_pop($this->lb);
        // var_dump($this->la, $this->lb); //comm
    }

    public function rrr() // rra rrb
    {
        $this->rra();
        $this->rrb();
    }
}

$jeff = new sorting();
$jeff->init();