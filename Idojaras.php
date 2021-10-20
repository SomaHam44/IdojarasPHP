<?php

class Idojaras {
    private $id;
    private $datum;
    private $hofok;
    private $leiras;

    public function __construct(DateTime $datum, int $hofok, string $leiras) {
        $this->datum = $datum;
        $this->hofok = $hofok;
        $this->leiras = $leiras;


    }

    public function uj() {
        global $db;
        $db->prepare('INSERT INTO elorejelzes(datum, hofok, leiras) VALUES (:datum, :hofok, :leiras)')
        ->execute(['datum' => $this->datum->format('Y-m-d'), ':hofok' => $this->hofok, ':leiras' => $this->leiras]);
    }


    public function getId() : ?int {
        return $this->id;
    }

    public function getDatum() : DateTime {
        return $this->datum;
    }

    public function getHofok() : int {
        return $this->hofok;
    }

    public function getLeiras() : string {
        return $this->leiras;
    }

    public function setLeiras(string $leiras): void {
        $this->leiras = $leiras;
    }

    public function setHomerseklet(int $homerseklet): void {
        $this->hofok = $homerseklet;
    }
    public static function torol(int $id){
        global $db;
        $db->prepare('DELETE FROM elorejelzes WHERE id = :id')
        ->execute([':id' => $id]);
    }

    public static function getById(int $id) : Idojaras  {
        /*global $db;
        $stmpt = $db->prepare("SELECT * FROM elorejelzes WHERE id = ':id'")
        ->execute([':id' => $id]);
        $eredmeny = $stmpt->fetchAll();
        if (count($eredmeny) !== 1) {
            throw new Exception("A DB lekérdezés nem egy sort adott vissza");
        }
        $idojaras = new Idojaras(new DateTime($eredmeny[0]['datum'], $eredmeny[0]['hofok'], $eredmeny[0]['leiras']));
        $idojaras->id = eredmeny[0]['id'];

        return $idojaras;
        */
        global $db;

        $t = $db->query("SELECT * FROM elorejelzes ORDER BY datum ASC")
        ->fetchAll();
        //$eredmeny = [];
        foreach ($t as $elem) {
            $idojaras =  new Idojaras(new DateTime($elem['datum']), $elem['hofok'], $elem['leiras']);
            $idojaras->id = $elem['id'];
            $idojaras->datum = new DateTime($elem['datum']);
            $idojaras->hofok = $elem['hofok'];
            $idojaras->leiras = $elem['leiras'];
            //$eredmeny[] = $idojaras;
        }

        return $idojaras;
        
    }

    public static function osszes(): array{
        global $db;

        $t = $db->query("SELECT * FROM elorejelzes ORDER BY datum ASC")
        ->fetchAll();
        $eredmeny = [];
        foreach ($t as $elem) {
            $idojaras =  new Idojaras(new DateTime($elem['datum']), $elem['hofok'], $elem['leiras']);
            $idojaras->id = $elem['id'];
            $idojaras->datum = new DateTime($elem['datum']);
            $idojaras->hofok = $elem['hofok'];
            $idojaras->leiras = $elem['leiras'];
            $eredmeny[] = $idojaras;
        }

        return $eredmeny;

    }

    public function mentes() {
        global $db;
        $db->prepare('UPDATE elorejelzes SET hofok = :hofok, leiras = :leiras WHERE id = :id')
        ->execute([':hofok' => $this->hofok, ':leiras' => $this->leiras, ':id' => $this->id]);


    }



}